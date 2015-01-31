
<div class="container clearfix" style="margin-top: 100px; margin-bottom:50px;">
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");

?>

<h1 class="login-text"><?php echo UserModule::t("Create New Account"); ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="form">
	<div id="createUser">
<div>
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo $form->errorSummary(array($model,$profile)); ?>
	<table>
		<tbody>
			<tr>
	
	<td><?php echo $form->labelEx($model,'username'); ?></td>
	<td><?php echo $form->textField($model,'username'); ?>
	<?php echo $form->error($model,'username'); ?>
	</td>
			</tr>
			<tr>
	
	<td> <?php echo $form->labelEx($model,'password'); ?></td>
	<td> <?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?> </td>
	<p class="hint">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>

	</tr>
	<tr>
	<td> 
	<?php echo $form->labelEx($model,'verifyPassword'); ?></td>
	<td> <?php echo $form->passwordField($model,'verifyPassword'); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</td>
	</tr>
	<tr>
	<td> 
	<?php echo $form->labelEx($model,'email'); ?>
	</td>
	<td> 
	<?php echo $form->textField($model,'email'); ?>
	<?php echo $form->error($model,'email'); ?>
	</td>
	</tr>


	<tr>
	<?php if (UserModule::doCaptcha('registration')): ?>
<td>		<?php echo $form->labelEx($model,'verifyCode'); ?>
	</td>
<td>	
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
		
		<p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
		<br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
</td>
	<?php endif; ?>
	</tr>
		</tbody>
		</table>
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Register")); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div>
<div style="display:inline-block;float:left">
<?php  //$this->widget('ext.hoauth.widgets.HOAuth');
?>
</div>
</div><!-- form -->
<?php endif; ?>
</div>