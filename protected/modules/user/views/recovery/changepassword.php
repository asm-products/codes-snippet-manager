<div class="container clearfix" style="margin-top:100px">
<h1><?php echo UserModule::t("Change Password"); ?></h1>


<div class="form">
<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo CHtml::errorSummary($form); ?>
	<table>
	<tr>
	<td>
	<?php echo CHtml::activeLabelEx($form,'password'); ?></td>
	<td><?php echo CHtml::activePasswordField($form,'password'); ?>
	<p class="hint">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p></td>
	</tr>
	<tr>
	<td>
	
	<?php echo CHtml::activeLabelEx($form,'verifyPassword'); ?></td>
	<td><?php echo CHtml::activePasswordField($form,'verifyPassword'); ?>
	</td>
	</tr>
	</table>
	
	
	<div class="row submit">
	<?php echo CHtml::submitButton(UserModule::t("Save")); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
</div>