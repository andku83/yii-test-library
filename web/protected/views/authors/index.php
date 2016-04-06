<?php
/* @var $this AuthorsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Authors',
);

$this->menu=array(
	array('label'=>'Create Authors', 'url'=>array('create')),
	array('label'=>'Manage Authors', 'url'=>array('admin')),
);
?>

<h1>Authors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
