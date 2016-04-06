<?php
/* @var $this AuthorsController */
/* @var $model Authors */

$this->breadcrumbs=array(
	'Authors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Authors', 'url'=>array('index')),
	array('label'=>'Create Authors', 'url'=>array('create')),
	array('label'=>'View Authors', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Authors', 'url'=>array('admin')),
);
?>

<h1>Update Authors <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>