<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("User View");

?>
<?php
	define("SECOND", 1);
		define("MINUTE", 60 * SECOND);
		define("HOUR", 60 * MINUTE);
		define("DAY", 24 * HOUR);
		define("MONTH", 30 * DAY);
 function relativeTime($time)
	{
	
		$delta = time() - $time;
	
		if ($delta < 1 * MINUTE)
		{
			return $delta == 1 ? "one second ago" : $delta . " seconds ago";
		}
		if ($delta < 2 * MINUTE)
		{
		  return "a minute ago";
		}
		if ($delta < 45 * MINUTE)
		{
			return floor($delta / MINUTE) . " minutes ago";
		}
		if ($delta < 90 * MINUTE)
		{
		  return "an hour ago";
		}
		if ($delta < 24 * HOUR)
		{
		  return floor($delta / HOUR) . " hours ago";
		}
		if ($delta < 48 * HOUR)
		{
		  return "yesterday";
		}
		if ($delta < 30 * DAY)
		{
			return floor($delta / DAY) . " days ago";
		}
		if ($delta < 12 * MONTH)
		{
		  $months = floor($delta / DAY / 30);
		  return $months <= 1 ? "one month ago" : $months . " months ago";
		}
		else
		{
			$years = floor($delta / DAY / 365);
			return $years <= 1 ? "one year ago" : $years . " years ago";
		}
	}

?>
<div class="container clearfix">
	<div id="profile-page">
<div class="profile-container">

<?php
if(isset($user_meta_model->meta_value))
 $meta_info =  unserialize( $user_meta_model->meta_value);
?>
<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
</div>
<div id="username">
	<?php 
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
					//echo "<pre>"; print_r($profile); die();
				if($field->title !='Birthday') {
			?>

 <?php

	echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))) ." "; ?>
	<?php }
			}//$profile->getAttribute($field->varname)
		}
?>
</div>
<div class="profile">
<div id="profile-pic">
	<img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( CHtml::encode($model->email) ) ) ) ?>?s=150" />
	
		
	
</div>
<div id="title">
<?php  echo isset($meta_info[3]) ? $meta_info[3] : "" ?>
</div>
</div>
<div id="profile-info">
<div class="right-heading">
	user inforamtion
</div>
<div>
	<?php echo CHtml::encode($model->username); ?><br/>
	<?php echo CHtml::encode($model->email); ?>
</div>
<div class="right-heading">
	website
</div>
<div>
	<?php echo isset($meta_info[0]) ? $meta_info[0]:"" ?>
</div>
<div class="right-heading">
	location
</div>
<div>
	<?php echo isset($meta_info[1]) ? $meta_info[1]:"" ?>
</div>
<div class="right-heading">
	memeber since
</div>
<div>
	<?php echo relativeTime($model->createtime); ?>
</div>
	<div class="right-heading">
	Last Seen
</div>
<div>
	<?php echo relativeTime($model->lastvisit); ?>
</div>
</div>
<div id="about" style="margin-top: 10px;padding: 20px;width: 686px;float: left;display: inline-block;">
	<div class="right-heading">
	About
</div>
	<?php echo isset($meta_info[1]) ? $meta_info[2]:"" ?>
</div>
</div>
</div>
</div>