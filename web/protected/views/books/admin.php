<?php
/* @var $this BooksController */
/* @var $model Books */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Create Books', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#books-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->widget('application.extensions.fancybox.EFancyBox', array(
        'target'=>'a[class=fancybox1]',
        'config'=>array(),
    )
);
?>

<h1>Manage Books</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search_admin',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'books-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		[
            'name' => 'id',
            'htmlOptions'=>array('width'=>'20px'),
        ],
		'name',
        [
            'name' => 'preview',
            'type' => 'html',
            'value'=> '(!empty($data->preview)) ?
                CHtml::image(
                    $data::PATH.$data->preview,
                    "$data->name",
                    array("style"=>"height:100px;",
                        "onclick"=>"fullSize",
                        "class"=>"group1 cboxElement")) :
                "no image"',
//CHtml::image($this::PATH.$model->preview),
        ],
        //'ImageUrl'=>Yii::app()->baseUrl.'/image/update.png',
        [
            'name' => Yii::t("books","author_id"),
            //'filter' => CHtml::listData(Authors::model()->findAll(), 'id', 'fullName'),
            'value' => 'isset($data->author) ? $data->author->fullName : ""',
//            'value' => 'Authors::model()->FindByPk($data->author_id)->fullName',
        ],
        array(
            'name'=>'author_search',
            'value'=> 'CHtml::value($data,"author.fullName")',
        ),
        [
            'name' => Yii::t("books","date"),
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)',
        ],
        'date_create',
		//'date_update',
		array(
            'header'=>Yii::t('books','Action buttons'),
            'headerHtmlOptions'=>array(
                                    'colspan'=>'3',
                                    ),
			'class' =>'CButtonColumn',
            'template'=>'{update}</td><td>{view}</td><td>{delete}',

            'updateButtonImageUrl'=>false,
            'updateButtonLabel'=>Yii::t("books","[edit]"),

            'viewButtonImageUrl'=>false,
            'viewButtonLabel'=>Yii::t("books","[view]"),

            'deleteButtonImageUrl'=>false,
            'deleteButtonLabel'=>Yii::t("books","[del]"),
        ),
	),
)); ?>
