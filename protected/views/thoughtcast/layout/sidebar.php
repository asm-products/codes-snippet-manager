<div id="tc-sidebar">
            <div id="binary-clock" data-ng-controller="clockCtrl">
         
                <div ng-repeat="hand in time_binary track by $index" id="place_{{$index}}">
                 <div class="tens one-third-small" >
                    <span ng-repeat="h_tens in hand.digit.tens track by $index"
                          ng-class="{circle:true,active:h_tens==1}">
                    </span>
                 </div>
                  <div class="ones one-third-small">
                   <span ng-repeat="h_ones in hand.digit.ones track by $index"
                          ng-class="{circle:true,active:h_ones==1}">
                    </span>
                </div>
           
        </div>
                <div id="time" data-ng-bind="showTime | date:'HH:mm:ss'">
                 </div>
            </div>
        <ul id="side-menu-items">
            <li class="item heading">CODES</li>
            <ul id="thougtcast-menu">
<a href="#" ng-click="getSnippets()">
    <li class="entypo sidebar" popover-placement="right" popover="Remeber your code snippets and commands!" popover-trigger="mouseenter" >&#59156;
    <span class="size18">Snippets</span></li></a>
 <a href="#" ng-click="getArchiveSnippet()"><li class="entypo sidebar">&#59392; <span class="size18">Archives</span></li></a>

            </ul>
            <li class="item heading">LABELS</li>
            <ul id="cats" ng-cloak>
                <li ng-repeat="label in labels">
                    <span 
                    data-drag="true" data-jqyoui-options="{revert: 'invalid'}" ng-model="label" jqyoui-draggable="{animate:true,placeholder:'keep'}"
                    >
                        <span class="circle" style="background-color:{{colors[$index]}}"></span> {{label.label_name}}</span></li>
            
            </ul>
            <li>
                 <a href="#" ng-click="open_edit_labels()"><span class="entypo sidebar" style="font-size: 35px;">&#59290;</span> Edit Labels</a>
            </li>
        </ul>
      
</div>

<!-- Edit labels Dialog -->
 <script type="text/ng-template" id="editLabels.html">
        <div class="modal-header">
            <h3>Edit Labels</h3>
        </div>
        <div class="modal-body">
            <ul style="list-style: none">

                <li ng-repeat="label in edit_labels">
                    <span class="circle" style="background-color:{{colors[$index]}}"></span>
                    <input type="text" ng-model="label.label_name">
                </li>
               
            </ul>

        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">OK</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>