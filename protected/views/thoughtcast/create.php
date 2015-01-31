<?php
/* @var $this ThoughtcastController */
/* @var $model Thoughtcast */

$this->breadcrumbs=array(
	'Thoughtcasts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Thoughtcast', 'url'=>array('index')),
	array('label'=>'Manage Thoughtcast', 'url'=>array('admin')),
);
?>

<h1>Create Thoughtcast</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>