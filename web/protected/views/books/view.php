<?php
/* @var $this BooksController */
/* @var $model Books */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Create Books', 'url'=>array('create')),
	array('label'=>'Update Books', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Books', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Books', 'url'=>array('admin')),
);
?>

<h1>View Books #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'date_create',
		'date_update',
		[
            'name' => 'preview',
            'type' => 'raw',
            'value'=> CHtml::image($this::PATH.$model->preview,$model->name,array(
                'onclick'=>'fullSize',
                'height' =>150,
            )),
        ],
		'date',
		[
            'name' => 'author_id',
            'value'=> $model->author_id ? Authors::model()->findByPk($model->author_id)->fullName : '',
        ],
	),
)); ?>
