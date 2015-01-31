<style>{font-size:90%}.ui-widget{font-family:"Helvetica Neue","Trebuchet MS",Tahoma,Verdana,Arial,sans-serif;background:#29a2d9;border:0;border-radius:0;-webkit-border-radius:0;-moz-border-radius:0;box-shadow:0 1px 3px #252525}.ui-datepicker{padding:0}.ui-datepicker-header{border:0;border-bottom:1px solid #2d97cb;background:0 0;font-weight:400;font-size:11px;text-transform:uppercase}.ui-datepicker-header .ui-state-hover{background:0 0;border-color:transparent;cursor:pointer;border-radius:0;-webkit-border-radius:0;-moz-border-radius:0}.ui-datepicker .ui-datepicker-title{margin-top:1.5em;margin-bottom:1em}.ui-datepicker .ui-datepicker-next,.ui-datepicker .ui-datepicker-next-hover,.ui-datepicker .ui-datepicker-prev,.ui-datepicker .ui-datepicker-prev-hover{top:1.7em;border:0}.ui-datepicker .ui-datepicker-prev-hover{left:2px}.ui-datepicker .ui-datepicker-next-hover{right:2px}.ui-datepicker .ui-datepicker-next span,.ui-datepicker .ui-datepicker-prev span{background-image:url(/images/ui-icons_ffffff_256x240.png);background-position:-32px -32px;margin-top:0;top:0;font-weight:400}.ui-datepicker .ui-datepicker-prev span{background-position:-96px -32px}.ui-datepicker .ui-datepicker-prev-hover span{background-position:-96px -48px}.ui-datepicker .ui-datepicker-next-hover span{background-position:-32px -48px}.ui-datepicker table{margin:0}.ui-datepicker th{padding:3em 0;color:#9fd9f1;font-size:8px;font-weight:400;text-shadow:0 0 2px #45c4f8;text-transform:uppercase;border:0;border-top:1px solid #3fabdc}.ui-datepicker td{border:0;padding:0}td .ui-state-default{background:0 0;border:0;text-align:center;padding:1em 0;margin:0;font-weight:400;color:#efefef;font-size:12px}td .ui-state-active,td .ui-state-hover{background:#1b7fb0;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px}.ui-widget-content .ui-state-active,.ui-widget-header .ui-state-active,ui-state-active{border:1px solid #79b7e7;font-weight:700;color:#e17009;background-color:#79b7e7}.ui-state-default,.ui-widget-content .ui-state-default,.ui-widget-header .ui-state-default{border:1px solid #c5dbec;background:#dfeffc;font-weight:700;color:#2e6e9e}.ui-datepicker td a,.ui-datepicker td span{display:block;padding:10px;text-align:right;text-decoration:none}</style>
<div class="container clearfix">
	
	<div id="profile-page">
<div class="edit-heading">
<h2><?php echo UserModule::t('Edit profile'); ?></h2>
<?php echo $this->renderPartial('menu'); ?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

</div>
<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>
	
		
<table style="width:100%;">
	<tbody>
	
			<?php echo $form->errorSummary(array($model,$profile)); ?>
	<td>
		<span class="section-name">Profile Details</span>
	</td>

		<td>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'placeholder'=>'User Name')); ?>
		<?php echo $form->error($model,'username'); ?>

<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'placeholder'=>'Email')); ?>
		<?php echo $form->error($model,'email'); ?>
		</td>	
	</tr>
	<tr>
		<td>
		<span class="section-name">	Personal Informations</span>
		</td>
	<td>
		<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
		
		
	 <?php
		if ($field->widgetEdit($profile)) {
			echo $field->widgetEdit($profile);
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50,'placeholder'=>$form->labelEx($profile,$field->varname)));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),
																 'placeholder'=>$field->varname));
		}
		echo $form->error($profile,$field->varname); ?>


			<?php
			}
		}
?>	</td>
	
		</tr>
	<tr>
		<td>
			<span class="section-name">About Me </span>
			<?php $meta_info = unserialize( $user_meta_model->meta_value)?>
		</td>
		<td>
			<div>
			
				<input type='text' placeholder="Website" name="website" value="<?php echo isset($meta_info[0]) ? $meta_info[0]:"" ?>"/>
				<input type='text' placeholder="Location" name="location" value="<?php echo isset($meta_info[1]) ? $meta_info[1]:""  ?>"/>
				<input type='text' placeholder="Title Example: Software Engineer,Artist @ ABC Company " name="title" value="<?php echo isset($meta_info[3]) ? $meta_info[3]:""  ?>" style="width:717px"/>
				
			</div>
			<textarea name="about" placeholder="Say everything about yourself..." rows="10" style="width:717px"><?php echo isset($meta_info[2]) ? $meta_info[2]:""  ?></textarea>
		</td>
		
	</tr>
	</tbody>
	
</table>
	
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
</div>