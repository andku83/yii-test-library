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

        <?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>255, 'placeholder'=>Yii::t('books','Name book'))); ?>
    </div>


	<div class="row">
        <?php echo $form->label($model,'_date_from',array('style'=>'width: 120px;margin-top: 10px;')); ?>
        <?php echo $form->dateField($model,'_date_from',array('style'=>'float:left;')); ?>

        <?php echo $form->label($model,'_date_to',array('style'=>'width: 30px;margin-top: 10px;')); ?>
        <?php echo $form->dateField($model,'_date_to',array()); ?>
        <?php echo CHtml::submitButton(Yii::t('books','Search'),array('style'=>'float:right;')); ?>
    </div>

	<div class="row buttons">
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->