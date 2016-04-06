<?php
/* @var $this AuthorsController */
/* @var $model Authors */

$this->breadcrumbs=array(
	'Authors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Authors', 'url'=>array('index')),
	array('label'=>'Manage Authors', 'url'=>array('admin')),
);
?>

<h1>Create Authors</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>