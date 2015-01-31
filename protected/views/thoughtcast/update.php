<?php
/* @var $this ThoughtcastController */
/* @var $model Thoughtcast */

$this->breadcrumbs=array(
	'Thoughtcasts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Thoughtcast', 'url'=>array('index')),
	array('label'=>'Create Thoughtcast', 'url'=>array('create')),
	array('label'=>'View Thoughtcast', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Thoughtcast', 'url'=>array('admin')),
);
?>

<h1>Update Thoughtcast <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>