<?php

class BooksController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','create','update', 'delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        if(Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('view', array('model' => $this->loadModel($id)), false, true);
        } else
        {
            $this->render('view', array(
                'model' => $this->loadModel($id),
            ));
        }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Books;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Books']))
		{

            $model->attributes = $_POST['Books'];

            $model->date_create = $model->date_update = date('Y-m-d');

            $uploadedFile = CUploadedFile::getInstance($model, 'preview');

            if (is_object($uploadedFile) && get_class($uploadedFile)==='CUploadedFile')
            {
                $timestamp=date('U');
                //$filename=$uploadedFile->getName();
                $type = $uploadedFile->extensionName;

                $model->preview = $timestamp.'.'.$type;
            } else {
                $model->preview = 'default.png';
            }

            if($model->save())
            {
                if ($model->preview!='default.png')
                {
                    $model->preview = 'book_'.$model->id.'_'.$timestamp.'.'.$type;
                    $model->save();

                    $name = Yii::app()->basePath.$model::PATH.$model->preview;
                    $uploadedFile->saveAs($name);

                    $this->resize($name);
                }
                $this->redirect(array('view','id'=>$model->id));
            }

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        $old_preview = $model->preview;
		if(isset($_POST['Books']))
		{
			$model->attributes = $_POST['Books'];
            $model->date_update = date('Y-m-d');
            $uploadedFile = CUploadedFile::getInstance($model, 'preview');
            if (is_object($uploadedFile) && get_class($uploadedFile)==='CUploadedFile')
            {
                $timestamp=date('U');
                //$filename=$uploadedFile->getName();
                $type = $uploadedFile->extensionName;

                $model->preview = 'book_'.$model->id.'_'.$timestamp.'.'.$type;

            } else {
                $model->preview = $old_preview;
            }

            if($model->save())
            {
                if (get_class($uploadedFile)==='CUploadedFile')
                {
                    $name = Yii::app()->basePath.$model::PATH.$model->preview;
                    $uploadedFile->saveAs($name);

                    if ($old_preview != 'default.png')
                    {
                        @unlink(Yii::app()->basePath.$model::PATH.$old_preview);
                    }

                    $this->resize($name);
                }
                if (is_array(Yii::app()->session['last_criteria']))
                    $this->redirect(array_merge(array('admin'), Yii::app()->session['last_criteria']));
                else
                    $this->redirect(array_merge(array('admin')));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model = $this->loadModel($id);
        $preview = $model->preview;
        if ($model->delete() && $preview!='default.png')
        {
            @unlink(Yii::app()->basePath.$model::PATH.$preview);
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Books');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        //$session = new CHttpSession;
        //$session->open();
		$model=new Books('search');
		//$model->unsetAttributes();  // clear any default values
		if (!empty($_GET))
        {
            if(isset($_GET['Books']))
            {
                $model->attributes=$_GET['Books'];
            }

            Yii::app()->session['last_criteria'] = $_GET;

        } else
        {
            unset(Yii::app()->session['last_criteria']);
        }


		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Books the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Books::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Books $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='books-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    private function resize($name, $max_size = 900)
    {
        $image = Yii::app()->image->load($name);

        $height = $image->__get('height');
        $width = $image->__get('width');
        if ($height < $max_size && $width < $max_size)
        {
            return;
        }

        $image->resize($max_size, $max_size)->quality(100);

        $image->save();

    }
}
