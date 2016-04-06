<?php
/* @var $this BooksController */
/* @var $model Books */

$cs = Yii::app()->getClientScript();
$baseUrl = Yii::app()->baseUrl;
$cs->registerScriptFile($baseUrl.'/assets/e7e88703/js/fancybox/jquery.fancybox-1.3.1.pack.js');
$cs->registerCssFile($baseUrl.'/assets/e7e88703/js/fancybox/jquery.fancybox-1.3.1.css');

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

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'viewmodal',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'',
        'autoOpen'=>false,
        'resizable' => false,
        'width' => 'auto',
        'height' => 'auto',
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.5',
        ),

    ),
    'htmlOptions' => array(
    ),
));

echo 'dialog content here';

$this->endWidget('zii.widgets.jui.CJuiDialog');


/*$this->widget('application.extensions.fancybox.EFancyBox', array(
        'target'=>'a[class=fancybox1]',
        'config'=>array(),
    )
);*/
$maxHeight='100px';
$maxWidth='100px';

?>

<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox1").fancybox({
            'transitionIn'		: 'none',
            'transitionOut'		: 'none',
            'titlePosition' 	: 'inside',
            'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
                return '<span id="fancybox-title-over">Image ' +  (currentIndex + 1) + ' / ' + currentArray.length + ' ' + title + '</span>';
            }
        });
    });
    function book_view() {
        var url = $(this).attr('href');
        $.get(url, function(r){
            $("#viewmodal").html(r).dialog("open");
        });
        return false;
    }

</script>

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
    'enableHistory'=>true,
    'columns'=>array(
		[
            'name' => 'id',
            'htmlOptions'=>array('width'=>'20px'),
        ],
		'name',
                        /*---- Fancybox start ----*/
        array(
            'name'=>'preview',
            'type'=>'html',
            'filter' => '',
            'value'=>
                '(!empty($data["preview"])) ?
                CHtml::link(
                    CHtml::tag(
                        "img",
                        array(
                            "height"=>"'.$maxHeight.'",
                            "src" => $data::PATH.$data->preview,
                        )
                    ),
                    "",
                    array(
                        "rel" => "example_group",
                        "class"=>"fancybox1",
                        "title"=>$data->name,
                        "href"=> $data::PATH.$data->preview,
                    )
                ) :
                CHtml::tag(
                    "img",
                    array(
                        "height"=>"'.$maxHeight.'",
                        "src" => $data::PATH.$data->preview,
                    )
             //   )
            )'  ,
            "htmlOptions" => array("height" => "100px"),
        ),
                        /*---- Fancybox end ----*/
/*        [
            'name' => 'preview',
            'type' => 'html',
            'value'=> '
                (!empty($data->preview)) ?
                CHtml::image(
                    $data::PATH.$data->preview,
                    "$data->name",
                    array("style"=>"height:100px;",
                        "onclick"=>"fullSize",
                        "class"=>"group1 cboxElement")
                ) :
                "no image"',
        ],*/
        [
            'name' => Yii::t("books","author_id"),
            //'filter' => CHtml::listData(Authors::model()->findAll(), 'id', 'fullName'),
            'value' => 'CHtml::value($data,"author.fullName")',
//            'value' => 'isset($data->author) ? $data->author->fullName : ""',
//            'value' => 'Authors::model()->FindByPk($data->author_id)->fullName',
        ],
/*        array(
            'name'=>'author_search',
            'value'=> 'CHtml::value($data,"author.firstname")',
        ),*/
        [
            'name' => Yii::t("books","date"),
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)',
        ],
        'date_create',
		//'date_update',
		array(
            'class' =>'CButtonColumn',
            'header'=>Yii::t('books','Action buttons'),
            'headerHtmlOptions'=>array(
                                    'colspan'=>'3',
                                    ),
            'template'=>'{update}</td><td>{view}</td><td>{delete}',

            'buttons'=>array(
                'update'=>array(
                    'imageUrl'=>false,
                    'label'=>Yii::t("books","[edit]"),
                ),
                'view'=>array(
                    'imageUrl'=>false,
                    'label'=>Yii::t("books","[view]"),
                    'click'=>'book_view',
                ),
                'delete'=>array(
                    'imageUrl'=>false,
                    'label'=>Yii::t("books","[del]"),
                ),
            ),
        ),
	),
));
?>
<?php //print_r($_GET); ?>
<?php// echo date('Y-m-d',strtotime($_GET['Books']['_date_from'])); ?>