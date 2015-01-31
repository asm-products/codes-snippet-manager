<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");

?>
<div class="container text-center">
<h1 class="login-text" style="margin-top:80px"> One Account, to dive into world of coding . </h1>
</div>
<div class="clearfix login">

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>



<div class="form">
<?php echo CHtml::beginForm(); ?>
	
	<?php echo CHtml::errorSummary($model); ?>
	
	<div class="row">
		<div class="entypo"> &#128100; </div>
	
		<?php echo CHtml::activeTextField($model,'username',array('placeholder'=>'Username || Email')) ?>
	</div>
	
	<div class="row">
	
		<?php echo CHtml::activePasswordField($model,'password',array('placeholder'=>'Password')) ?>
	</div>
	
	<div class="row">
		<p class="hint">
		<?php echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
		</p>
	</div>
	
	<div class="row rememberMe">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Login")); ?>
	</div>
	
<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<?php // $this->widget('ext.hoauth.widgets.HOAuth');
?>
</div>

<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>