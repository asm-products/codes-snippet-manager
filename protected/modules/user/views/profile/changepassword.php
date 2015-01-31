<div class="container clearfix">
	
	<div id="profile-page" style="padding:20px;">
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password"); ?>
<h2><?php echo UserModule::t("Change password"); ?></h2>
<?php echo $this->renderPartial('menu'); ?>

<div class="form">
	<table>
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
)); ?>
	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo CHtml::errorSummary($model); ?>
	
<table style="width:100%">

<tr>
	<td><?php echo $form->labelEx($model,'password'); ?></td>
	<td><?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?></td>
	<p class="hint">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>
	<td></td>
</tr>
	<tr>

	<td><?php echo $form->labelEx($model,'verifyPassword'); ?></td>
	<td><?php echo $form->passwordField($model,'verifyPassword'); ?>
	<?php echo $form->error($model,'verifyPassword'); ?></td>
	<td></td>
</tr>
	</table>
	
	<div class="row submit">
	<?php echo CHtml::submitButton(UserModule::t("Save")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
	</div>
</div>