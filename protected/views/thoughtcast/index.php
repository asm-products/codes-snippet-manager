
<?php
/* @var $this ThoughtcastController */
/* @var $dataProvider CActiveDataProvider */


?>
<div class="container clearfix" style="padding-top : 100px;">
<div class="index-page">

<h1 class="login-text"> Howdy ! Welcome to Codes a unified tool to manage your snippets </h1>
  <p>
  <strong> Codes </strong>is a snippet Manager, that helps you manage and sort small or large code snippets with search ability and much more. <br/>
    Login/Create Account <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/login">Here</a> and start using Snippet manager 
   App Page - <a href="<?php echo Yii::app()->request->baseUrl; ?>/codes/snippets">Codes - Snippet Manager App</a>
    
    <br>
        <strong>How To Use Codes</strong> </br>
   	1. Create New Snippet
   	<ol>
   	<li>  Provide a title for your snippet, this is mandatory .Obvsly You need a name for you snippet</li>
<li>  Give brief description, this is optional though </li>
<li> Paste or right down your snippet and save. </li>
   	</ol>
   	
   	See Screenshot demo : <br/>
   	<img src="/images/tutorial-thoughtcast.jpg" alt="Codes tutorial creating snippet"/>
    <br/>
    <p>
    2. Drag Drop Labels</p>
    <ol>
<li> The labels on sidebar can be dragged to the snippet area to give a color code to your snippet.</li>
<li> In order to remove the label from snippet just open snippet and drag label outside the snippet</li>
</ol>

<p>
 3. Search </p>
You can easily search snippet with title, description and snippet content

<p>
 4. Archive Snippet<br></p>
Snippets that are not of any use any more but are important to you can be easily archived by clicking the archive link here<br>

<p>
 5. Delete Snippet</p>
Snippets that don't play any role can be deleted, the snippets are deleted after 3 seconds delay so that you may stop the mishappening. Snippets once deleted cannot be recoverd so be careful. Yes our garbage collector is harsh.</br>
 
</div>