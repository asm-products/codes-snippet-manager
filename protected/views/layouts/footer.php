<div class="horizontal-rule"></div>
<div class="footer">
	<div class="container center">
		<div class="one-sixth">
			GET SOCIAL
			<ul>
				<li><a href="http://facebook.com/icanbeacoder">Facebook</a></li>
				<li><a href="http://twitter.com/harshihustle">Twitter</a></li>
			</ul>
		</div>
		<div class="one-sixth">
			<a href="http://blog.icanbeacoder.com">Blog</a>
		</div>
		<div class="one-sixth">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/codes">Codes</a>
		</div>
		<div class="one-sixth">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/comicstrip">WebComic</a>
		</div>
		<div class="one-sixth">
			Copyright 2013.<br /> Under GNU Public License.
		</div>
	</div>
</div>
</div>




<?php
$current_url = Yii::app ()->urlManager->parseUrl ( Yii::app ()->request );
$pos = strrpos ( $current_url, "thoughtcast" );
if ($pos !== false) {
	?>
<script
	src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/angular.min.js"></script>
	<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/angular-resource.js"></script>
<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/ui-bootstrap-tpls.min.js"></script>
<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/angular-dragdrop.min.js"></script>
	<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/angular-sanitize.js"></script>

<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/highlighter/lib/codemirror.js"></script>
<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/highlighter/addon/mode/loadmode.js"></script>
<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/highlighter/addon/runmode/colorize.js"></script>
<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/highlighter/addon/display/placeholder.js"></script>
<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/ui-codemirror.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/app.js"></script>

<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/controllers/thoughtcastControllers.js"></script>
<script>
CodeMirror.modeURL = "<?php echo Yii::app()->request->baseUrl; ?>/js/highlighter/mode/%N/%N.js";
</script>
<?php

}
?>
 <?php
	$pos = strrpos ( $current_url, "comicstrip" );
	if ($pos !== false) {
		?>
<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/angular.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/comics.js"></script>
<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/controllers/comicController.js"></script>
<?php } ?>
</body>
</html>
