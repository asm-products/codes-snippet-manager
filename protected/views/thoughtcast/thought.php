 <div class=" clearfix" id="thoughtcast">
<div data-ng-app="thoughtApp" >
    <div id="app" ng-controller="listCtrl">
 <?php require_once('layout/sidebar.php') ?>
          <div id="headers">
    <a href="#"><span class="entypo-big">&#128319;<br/> <span  class="size15">DREAMS | THOUGHTS</span>

    </a>
    </div>
            <div id="thoughts-content" ng-controller="dreamsCtrl">
                <div id="submenu">

    

<div contenteditable="true" class="notes" data-ng-model="your_dream" >

</div>
<div id="tools">
 <span class="block"><a href="" ng-click="saveTodo()" class="entypo">&#128190;</a> </span>
<span class="block"> <a class="entypo" href="" ng-clicl="deleteTodo()"> &#59177;</a> </span>
<span class="block"> <a class="entypo" href="" ng-clicl="deleteTodo()"> &#59225;</a> </span>
<span class="block"> <a class="entypo" href="" ng-clicl="deleteTodo()"> &#59226;</a> </span>
</div>
  



</div>
            </div>

        </div>
    </div>
</div>