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
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'date_create'); ?>
        <?php echo $form->textField($model,'date_create'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'date_update'); ?>
        <?php echo $form->textField($model,'date_update'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'preview'); ?>
        <?php echo $form->fileField($model,'preview',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'date'); ?>
        <?php echo $form->textField($model,'date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'author_id'); ?>
        <?php echo $form->textField($model,'author_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->