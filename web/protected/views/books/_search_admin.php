<?php
/* @var $this BooksController */
/* @var $model Books */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->dropDownList($model,'author_id',CHtml::listData(Authors::model()->findAll(), 'id', 'fullName'), array('empty'=>Yii::t('books','Author'))); ?>

        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255, 'placeholder'=>Yii::t('books','Name book'))); ?>
    </div>


<!--	<div class="row">
        <?php /*echo $form->label($model,'_date_from'); */?>
        <?php /*echo $form->textField($model,'_date_from'); */?>

        <?php /*echo $form->label($model,'_date_to'); */?>
        <?php /*echo $form->textField($model,'_date_to'); */?>
    </div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('books','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->