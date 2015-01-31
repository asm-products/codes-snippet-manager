<html>
    <head>
        <title>Binary Clock</title>
        <link href="binary.css" rel="stylesheet" type="text/css" />
         <script src="angular.min.js" type="text/javascript"></script>
        <script src="binary.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="binary-clock" ng-app="binary-clock">
            <div ng-controller="runCtrl">
                <div ng-repeat="hand in time_binary" id="place_{{$index}}">
                 <div class="tens one-third-small" >
                    <span ng-repeat="h_tens in hand.digit.tens"
                          ng-class="{circle:true,active:h_tens==1}">
                    </span>
                 </div>
                  <div class="ones one-third-small">
                   <span ng-repeat="h_ones in hand.digit.ones"
                          ng-class="{circle:true,active:h_ones==1}">
                    </span>
                </div>
            </div>
          </div>
        </div>
    </body>
</html>