<style>
.logo {
display:none;
}
</style>
 <div class=" clearfix" id="thoughtcast">
<div data-ng-app="thoughtApp" >
    <div id="app">
        <div ng-controller="listCtrl" ng-cloak>
<?php require_once('layout/sidebar.php') ?>

    <div id="tclist" >
<div ng-show="alert.show" ng-cloak>
  <alert type="alert.type" close="closeAlert()" ng-cloak><span ng-bind="alert.msg"></span> in&nbsp; <span ng-bind="timeRemaining"> </span> &nbsp;seconds <a href="" ng-click="stopDelete()"> Undo </a> </alert>
</div>
<div ng-show="alert.errorShow">
  <alert type="alert.type" close="closeAlert()" ng-cloak><span ng-bind="alert.msg"></span></alert>
  
</div>

        <span id="heading">Code Snippets</span> <br/>
    <span id="pagination-info">
                Total Snippets : <span  ng-bind="total"></span><br>
                Displaying 10 per page.
            </span>
        <div class="right" id="pagination">
        
<a href="#" ng-click="getPreviousSet(limit,offset)" class="entypo" title="prev page">&#59225;</a> <a href="#" ng-click="getNextSet(limit,offset)" class="entypo" title="next page"> &#59226;</a></div>
        <div>
        <input id="snippetSearch" type="text" data-ng-model="query" placeholder="Search Snippets ...">
            </div>
        <div style="overflow: auto;height:500px">
        <table id="list" >
         
            <tr data-ng-repeat="thought in thoughts " data-ng-click="showDetails($index)" data-ng-class="{selected: thought.id==selectedIndex}">
    <td data-ng-bind-html="thought.title | truncate"></td>
    <td><span ng-repeat="label in thought.labels | removeComma">
    <span class="circle" style="background-color:{{colors[label]}}"></span>
    </span></td>
    <td class="description" data-ng-bind-html="thought.excerpt | truncate:50"></td>
        <td ng-bind='thought.date_added | date:"dd/MM/yyyy"'></td> 
    </tr> 
</table>
 </div>
</div>
    <div id="tcdetails" ng-cloak >
        <div id="title-thoughtcast" contenteditable="true" ng-model="title" data-text='Title for your code-snippet' ng-change="changeAutoSave()">

</div>
<div id="excerpt" contenteditable="true" ng-model="excerpt" data-text='Brief description' ng-change="changeAutoSave()">

</div>
  <div data-drop="true"  data-jqyoui-options ng-model="labels_list" jqyoui-droppable="{multiple:true,onDrop:'update_label_id(labels_list)'}">
<label>Language you code in...</label>
<input type="text" id="language-moveahead" ng-model="mode"  typeahead="m for m in modes | filter:$viewValue | limitTo:10">
   
    <span ng-repeat="label in labels_id">
        <span data-drag="true" data-jqyoui-options="{distance: 10}" ng-model="labels_list" jqyoui-draggable="{animate:true,placeholder:false,onStop:'removeElement($index)'}">
        <span class="circle" style="background-color:{{colors[label]}}"></span></span>
    </span> <span style="font-size: 12px;color:#1B5CAB;width:150px">Drop labels here </span>
<div id="toolbox" class="right">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ajax-loader.gif" style="height: 25px;" ng-show="isSaving">
   <a href="" ng-click="clearFields()" class="entypo"><span style="font-size:10px;vertical-align:middle">Add New </span>&#59156;</a>
<a href="#" ng-click="saveSnippet(currentSelectedIndex)"class="entypo" title="save">&#128190;</a>
<a href="#" ng-click="archiveSnippet(selectedIndex)"class="entypo" title="archive">&#59392;</a>

<a href="#" ng-click="deleteSnippet(selectedIndex,3)"class="entypo" title="delete">&#59177;</a>
</div>
  </div>
<textarea ui-codemirror="{ onLoad : codemirrorLoaded }" ng-model="snippet" id="snippet" ng-change="changeAutoSave()" ng-trim="true">

</textarea>

</div>
    </div>
</div>
</div>