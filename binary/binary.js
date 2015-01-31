var binary = angular.module("binary-clock",[]);
binary.controller("runCtrl",function($scope,$timeout){
    
    // Function to convert the number into binary. This is an easy trick :P Everyone knows it.
    $scope.toBinary = function(num,length) {
        var r=0,s=[];
        for(i=0;i<length;i++) {
            r=parseInt(num%2);
            s.push(r);
            num=parseInt(num/2);
        }
        return s;
     };
    
   // Adding to watch with timeout of 1 second, so that clock updates every second.
    $scope.$watch('currentTime',function() {
	$timeout(function() {
        // Initializing arrays for storing time digits in binary format
        // 0 => Hours, 1=>Minutes , 2=>seconds
        $scope.time_binary = [{digit:{tens:[],ones:[]}},
                              {digit:{tens:[],ones:[]}},
                              {digit:{tens:[],ones:[]}}
                              ];
        $scope.time_array = [];
        
         // Get current time in hh:mm:ss , Just removing the Zone part
        $scope.currentTime = new Date().toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1").split(":");
        $scope.time_array.push($scope.currentTime[0].split(""));
        $scope.time_array.push($scope.currentTime[1].split(""));
        $scope.time_array.push($scope.currentTime[2].split(""));
        for(var i=0;i<3;i++) {
            if (i==0) // This code is executed for Hours hand of clock.
                 $scope.time_binary[i].digit.tens = $scope.toBinary(parseInt($scope.time_array[i][0]),2).reverse(); 
            else 
                $scope.time_binary[i].digit.tens = $scope.toBinary(parseInt($scope.time_array[i][0]),3).reverse(); 
           $scope.time_binary[i].digit.ones = $scope.toBinary(parseInt($scope.time_array[i][1]),4).reverse();
        }

		},1000);
	});
    
});