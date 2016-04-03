<?php
/* @var $this BooksController */
/* @var $model Books */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'books-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo $form->labelEx($model,'author_id'); ?>
        <?php echo $form->dropDownList($model,'author_id',CHtml::listData(Authors::model()->findAll(), 'id', 'fullName'), array('empty'=>Yii::t('books','Author'))); ?>
        <?php echo $form->error($model,'author_id'); ?>

        <?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

<!--	<div class="row">
		<?php /*echo $form->labelEx($model,'date_create'); */?>
		<?php /*echo $form->textField($model,'date_create'); */?>
		<?php /*echo $form->error($model,'date_create'); */?>
	</div>
-->
<!--	<div class="row">
		<?php /*echo $form->labelEx($model,'date_update'); */?>
		<?php /*echo $form->textField($model,'date_update'); */?>
		<?php /*echo $form->error($model,'date_update'); */?>
	</div>
-->
	<div class="row">
		<?php echo $form->labelEx($model,'preview'); ?>
		<?php echo $form->fileField($model,'preview'); ?>
		<?php echo $form->error($model,'preview'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->dateField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->