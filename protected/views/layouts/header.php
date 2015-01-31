<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/science.css" />


  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/highlighter/lib/codemirror.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/highlighter/theme/3024-day.css" />
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
  	<script type="text/javascript">
function FocusOnInput()
{

}
</script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-52556455-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>

<body onload="FocusOnInput()">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
 <div class="wrapper">

     <div class="header">
            <div class="container clearfix">

                 <div class="logo"></div>
                 <div class="container-inner">
                    <?php if(Yii::app()->user->isGuest) { ?>
                 <div class="left"></div><div id="title"></div>
                <div class="right menu-items">
                <?php
               $this->widget('application.extensions.mbmenu.MbMenu', array(
               'encodeLabel' => false,
               'activeCssClass'=>"",
	'items'=>array(
        // Important: you need to specify url as 'controller/actio/n',
        // not just as 'controller' even if default acion is used.
        array('label'=>'<h3>Home</h3>', 'url'=>array(Yii::app()->request->baseUrl . '')),
        // 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
array('label'=>'<h3>Codes</h3>', 'url'=>array(Yii::app()->request->baseUrl . '/codes/snippets')),

        array('label'=>'<a href="http://blog.icanbeacoder.com"><h3>Blog</h3></a>'),
        array('label'=>'<h3 class="sign-in">Sign in </h3> ', 'url'=>array(Yii::app()->request->baseUrl. '/user/login'),'visible'=>Yii::app()->user->isGuest),
         array('label'=>'<h3 class="button"> Sign Up</h3>', 'url'=>array(Yii::app()->request->baseUrl. '/user/registration'),'visible'=>Yii::app()->user->isGuest))
));
?>

            </div>
            <?php  } else { ?>

      <div class="left"><!-- <form class="search-form"><input id="search-box"type="text" value="" placeholder="Search"/></form>--></div><div id="title"></div>
                <div class="left menu-items">
                <?php
               $this->widget('application.extensions.mbmenu.MbMenu', array(
               'encodeLabel' => false,
               'activeCssClass'=>"",
    'items'=>array(
        // Important: you need to specify url as 'controller/actio/n',
        // not just as 'controller' even if default acion is used.
        array('label'=>'<h3>Home</h3>', 'url'=>array(Yii::app()->request->baseUrl .'' )),
        // 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
    array('label'=>'<h3>Codes</h3>', 'url'=>array(Yii::app()->request->baseUrl . '/codes/snippets')),
    ),
));
?>
</div>
 <div class="right menu-items">
<?php  $this->widget('application.extensions.mbmenu.MbMenu', array(
               'encodeLabel' => false,
               'activeCssClass'=>"",
    'items'=>array( array('label'=>'<h3>'.Yii::app()->user->name.'</h3>','url'=>array('/user/profile')),
                    array('label'=>'<span id="setting"></span>','url'=>array('/user/profile/edit')),

                    array('label'=>'<span id="logout"></span>','url'=>array('/site/logout'))
                    ))) ?>
               </div>


               <?php } ?>
                </div>
            </div>
     </div>
