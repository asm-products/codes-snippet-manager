//thoughtcastApp.controller("clockCtrl", [ "$scope", "$timeout", "ThoughtCastService", function($scope, $timeout, ThoughtCastService) {
//    $scope.currentTime = new Date();
//    $scope.$watch('currentTime', function() {
//	$timeout(function() {
//	    $scope.currentTime = new Date();
//	}, 1000);
//    });
//} ]);
thoughtcastApp.controller("clockCtrl", [ '$scope', '$timeout', function($scope, $timeout) {

    // Function to convert the number into binary. This is an easy trick :P Everyone knows it.
    $scope.toBinary = function(num, length) {
	var r = 0, s = [];
	for (i = 0; i < length; i++) {
	    r = parseInt(num % 2);
	    s.push(r);
	    num = parseInt(num / 2);
	}
	return s;
    };

    // Adding to watch with timeout of 1 second, so that clock updates every second.
    $scope.$watch('currentTime', function() {
	$timeout(function() {
	    // Initializing arrays for storing time digits in binary format
	    // 0 => Hours, 1=>Minutes , 2=>seconds
	    $scope.time_binary = [ {
		digit : {
		    tens : [],
		    ones : []
		}
	    }, {
		digit : {
		    tens : [],
		    ones : []
		}
	    }, {
		digit : {
		    tens : [],
		    ones : []
		}
	    } ];
	    $scope.time_array = [];
	    $scope.showTime = new Date();
	    // Get current time in hh:mm:ss , Just removing the Zone part
	    $scope.currentTime = new Date().toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1").split(":");
	    $scope.time_array.push($scope.currentTime[0].split(""));
	    $scope.time_array.push($scope.currentTime[1].split(""));
	    $scope.time_array.push($scope.currentTime[2].split(""));
	    for (var i = 0; i < 3; i++) {
		if (i == 0) // This code is executed for Hours hand of clock.
		    $scope.time_binary[i].digit.tens = $scope.toBinary(parseInt($scope.time_array[i][0]), 2).reverse();
		else
		    $scope.time_binary[i].digit.tens = $scope.toBinary(parseInt($scope.time_array[i][0]), 3).reverse();
		$scope.time_binary[i].digit.ones = $scope.toBinary(parseInt($scope.time_array[i][1]), 4).reverse();
	    }
	}, 1000);
    });

} ]);

thoughtcastApp.controller("listCtrl", [
	"$scope",
	"$http",
	"ThoughtCastService",
	'$timeout',
	'$debounce',
	'$modal',
	'$log',
	function($scope, $http, ThoughtCastService, $timeout, $debounce, $modal, $log) {
	    $http.get('/thoughtcast/AjaxGetUserID/').success(function(userid) {
		$scope.userID = userid;
	    });

	    var ThoughtCast = ThoughtCastService.snippets();

	    $scope.archive = 0;
	    $scope.labels_list = [];
	    $scope.labels_id = [];
	    $scope.getLabels_id = [];
	    $scope.query = "";
	    $scope.alert = {
		type : 'success',
		show : 'false',
		errorShow : 'false'
	    };
	    $scope.isSaving = false;
	    $scope.offset = 0;
	    $scope.limit = 10;

	    /******************* GET ALL THE SNIPPETS ****************/
	    $scope.getSnippets = function() {

		$scope.mode = "";
		$scope.snippet = '';
		$scope.title = '';
		$scope.excerpt = '';
		$scope.selectedIndex = "";
		$scope.archive = 0;
		$scope.labels_id = [];
		ThoughtCast.query({
		    limit : $scope.limit,
		    offset : $scope.offset,
		    query : $scope.query,
		    archive : $scope.archive
		}, function(returnSnippet) {
		    $scope.thoughts = returnSnippet;
		    $scope.count();

		});
	    }
	    /******************* COUNT SNIPPETS ****************/
	    $scope.count = function() {
		ThoughtCast.countSnippets(function(returnTotal) {
		    $scope.total = parseInt(returnTotal[0].total);
		})
	    };

	    $scope.getSnippets();
	    /******************* ASSIGN COLORS TO LABELS ****************/
	    $scope.colors = [ "#ff7e7f", "#8bccff", "#c1c1c1", "#ff7e7f", "#5e96c6", "#b6ed24", "#ffed24", "#ffc035", "#bcbcbc", "#e8abff" ];

	    /******************* GET THE DETAILS OF SELECTED SNIPPET ****************/
	    $scope.showDetails = function(index) {
		var labels;
		$scope.isAutoSave = false;
		$scope.mode = $scope.thoughts[index].type;
		$scope.currentSelectedIndex = index;
		$scope.selectedIndex = $scope.thoughts[index].id;
		$scope.title = $scope.thoughts[index].title;
		$scope.excerpt = $scope.thoughts[index].excerpt;
		ThoughtCast.getSnippet({
		    id : $scope.selectedIndex
		}, function(returnObj) {
		    $scope.snippet = returnObj.content.replace(/\\\\/g, '\\');
		    $scope.snippet = $scope.snippet.replace(/\\"/g, '\"').replace(/\\'/g, "\'");
		    $scope.labels_id = returnObj.labels.split(",");

		});

		$scope.show = true;

	    };

	    /******************* SAVE SNIPPET ****************/
	    var _save = function(index) {
		var data = {
		    id : $scope.selectedIndex,
		    uid : $scope.userID,
		    snippet : $scope.snippet,
		    title : $scope.title,
		    excerpt : $scope.excerpt,
		    type : $scope.mode,
		    labels : $scope.labels_id.toString()
		}
		ThoughtCast.saveSnippets({}, data, function(returnObj) {

		    $scope.isSaving = false;
		    if ($scope.selectedIndex == "" || $scope.selectedIndex == void 0) {
			var date = new Date;
			$scope.selectedIndex = returnObj.id;
			$scope.currentSelectedIndex = 0;
			$scope.thoughts.unshift({
			    id : $scope.selectedIndex,
			    uid : $scope.userID,
			    snippet : $scope.snippet,
			    title : $scope.title,
			    excerpt : $scope.excerpt,
			    type : $scope.mode,
			    date_added : date.getTime(),
			    labels : $scope.labels_id.toString()
			});

			$scope.total += 1;

		    } else {
			$scope.selectedIndex = returnObj.id;
			$scope.thoughts[index].title = $scope.title;
			$scope.thoughts[index].excerpt = $scope.excerpt;
			$scope.thoughts[index].type = $scope.mode;
			$scope.thoughts[index].labels = $scope.labels_id.toString();
		    }

		});
	    }
	    $scope.changeAutoSave = function() {
		$scope.isAutoSave = true;
	    }

	    // Save Snippet
	    $scope.saveSnippet = function(index) {

		if ($scope.title == "") {
		    $scope.alert = {
			type : 'error',
			msg : "Please provide a title for your Snippet",
			errorShow : 'true'
		    };
		    return;
		}
		$scope.isSaving = true;
		_save($scope.currentSelectedIndex);
	    };
	    // Auto Save if character changes is more than 5 seconds of snippet
	    // change

	    $scope.autoSave = function() {
		if ($scope.title == "" || $scope.snippet == "" || !$scope.isAutoSave) {

		    return;
		}
		$scope.isSaving = true;
		_save($scope.currentSelectedIndex);
	    }

	    $scope.$watch('snippet', $debounce($scope.autoSave, 2000), true);
	    $scope.$watch('title', $debounce($scope.autoSave, 2000), true);
	    $scope.$watch('mode', $debounce($scope.autoSave, 2000), true);
	    $scope.$watch('excerpt', $debounce($scope.autoSave, 2000), true);
	    $scope.$watch('labels_id', $debounce($scope.autoSave, 2000), true);
	    $scope.$watch('query', $debounce($scope.getSnippets, 2000), true);

	    $scope.clearFields = function() {
		$scope.mode = "";
		$scope.snippet = '';
		$scope.title = '';
		$scope.excerpt = '';
		$scope.selectedIndex = "";
		$scope.count();
		$scope.labels_id = [];
	    };

	    // Archive Snippet
	    $scope.archiveSnippet = function(id) {
		ThoughtCast.archiveSnippet({}, {
		    id : id
		}, function() {
		    $scope.thoughts.splice($scope.currentSelectedIndex, 1);
		    $scope.total -= 1;
		    $scope.clearFields();
		    $scope.getSnippets();
		}); // Archive Snippet

	    };

	    // Delete Logic
	    var stop;
	    $scope.deleteSnippet = function(id, timeRemaining) {
		if ($scope.title == '') {
		    $scope.alert = {
			type : "error",
			msg : "No script selected ",
			show : false,
			errorShow : true
		    };
		    return;
		}
		$scope.timeRemaining = timeRemaining;
		$scope.alert = {
		    type : "error",
		    msg : "Deleting Snippet ... ",
		    show : true
		};
		stop = $timeout(function() {
		    if ($scope.timeRemaining == 0) {
			ThoughtCast.deleteSnippet({}, {
			    id : id
			}, function() {
			    $scope.thoughts.splice($scope.currentSelectedIndex, 1);
			    $scope.total -= 1;
			    $scope.clearFields();
			    $scope.getSnippets();
			}); // Archive Snippet
			// Reload Snippet
			$timeout.cancel(stop);
			$scope.alert = {
			    show : false
			};
			$scope.clearFields();

		    } else {
			$scope.timeRemaining = $scope.timeRemaining - 1;
			$scope.deleteSnippet(id, $scope.timeRemaining);
		    }
		}, 1000);
	    }
	    $scope.stopDelete = function() {
		$timeout.cancel(stop);
		$scope.alert = {
		    show : false
		};

	    }
	    $scope.closeAlert = function() {
		$scope.alert = {
		    show : false
		};
	    }

	    // Pagination
	    $scope.getNextSet = function(limit, offset) {
		$scope.mode = "";
		$scope.snippet = '';
		$scope.title = '';
		$scope.excerpt = '';
		$scope.labels_id = [];
		$scope.selectedIndex = ""; // reset Details view
		if ($scope.offset >= $scope.total - limit) {
		    return;
		}

		$scope.offset = offset + limit;
		ThoughtCast.query({
		    limit : $scope.limit,
		    offset : $scope.offset,
		    query : $scope.query,
		    archive : $scope.archive
		}, function(returnSnippet) {
		    $scope.thoughts = returnSnippet;
		});

	    }
	    $scope.getPreviousSet = function(limit, offset) {

		$scope.mode = "";
		$scope.snippet = '';
		$scope.title = '';
		$scope.excerpt = '';
		$scope.labels_id = [];
		$scope.selectedIndex = ""; // Reset Details workspace
		if ($scope.offset <= 0) {
		    return;
		}
		$scope.offset = offset - limit;
		ThoughtCast.query({
		    limit : $scope.limit,
		    offset : $scope.offset,
		    query : $scope.query,
		    archive : $scope.archive
		}, function(returnSnippet) {
		    $scope.thoughts = returnSnippet;
		});

	    }
	    // CodeMirror Initialization
	    $scope.codemirrorLoaded = function(_editor) {
		// Editor part
		var _doc = _editor.getDoc();

		// Options
		_editor.setOption('lineNumbers', true);
		_editor.setOption("placeholder", "/* Paste or write your snippet here */");
		_editor.setOption("mode", $scope.mode);
		_editor.setOption('firstLineNumber', 1);
		_editor.setOption('theme', "default");
		$scope.$watch('mode', function() {
		    var parent_mode = $scope.mode;
		    var mode = $scope.mode;
		    switch ($scope.mode) {
		    case 'clike':
			mode = 'text/x-c++src';
			break;
		    case 'sql':
			mode = 'text/x-mysql';
			break;
		    case 'xml':
			mode = 'text/html';
			break;
		    case 'java':
			mode = 'text/x-java';
			break;
		    case 'c++':
			mode = 'text/x-c++src';
			break;
		    }
		    if ($scope.mode == "java") {
			parent_mode = "clike";
		    } else if ($scope.mode == "c++") {
			parent_mode = "clike";
		    }
		    CodeMirror.autoLoadMode(_editor, parent_mode);
		    _editor.setOption("mode", mode);
		});

	    };
	    $scope.modes = [ 'apl', 'asterisk', 'clike', 'c++', 'clojure', 'cobol', 'coffeescript', 'commonlisp', 'css', 'd', 'diff', 'dtd', 'ecl', 'eiffel', 'erlang', 'fortran', 'gas', 'gfm', 'gherkin', 'go', 'groovy', 'haml', 'haskell', 'haxe', 'htmlembedded', 'htmlmixed', 'http', 'jade', 'java',
		    'javascript', 'jinja2', 'julia', 'less', 'livescript', 'lua', 'markdown', 'mirc', 'nginx', 'ntriples', 'ocaml', 'octave', 'pascal', 'pegjs', 'perl', 'php', 'pig', 'properties', 'python', 'q', 'r', 'rpm', 'rst', 'ruby', 'rust', 'sass', 'scheme', 'shell', 'sieve', 'smalltalk',
		    'smarty', 'smartymixed', 'sparql', 'sql', 'stex', 'tcl', 'tiddlywiki', 'tiki', 'toml', 'turtle', 'vb', 'vbscript', 'velocity', 'verilog', 'xml', 'xquery', 'yaml', 'z80' ];

	    // Labels Functionality
	    $scope.current_label_index = 0;

	    ThoughtCast.getLabels({}, function(returnLabels) {
		$scope.labels = returnLabels;
	    });

	    $scope.removeElement = function(event, ui, $index) {
		$scope.current_label_index--;

		$scope.labels_list.splice($index, 1);
		$scope.labels_id.splice($index, 1);
		$scope.isAutoSave = true;

	    }
	    // update labels id
	    $scope.update_label_id = function(event, ui, list) {

		if ($scope.labels_id.indexOf(list[$scope.current_label_index].label_id) === -1) {
		    $scope.labels_id.push(list[$scope.current_label_index].label_id)
		    $scope.current_label_index++;
		    $scope.isAutoSave = true;
		}

	    }

	    // Edit labels modal
	    $scope.open_edit_labels = function() {

		var modalInstance = $modal.open({
		    templateUrl : 'editLabels.html',
		    controller : ModalInstanceCtrl,
		    resolve : {
			edit_labels : function() {
			    return $scope.labels;
			}
		    }
		});

		modalInstance.result.then(function(selectedItem) {
		    $scope.selected = selectedItem;
		}, function() {
		    $log.info('Modal dismissed at: ' + new Date());
		});
	    };

	    var ModalInstanceCtrl = function($scope, $modalInstance, edit_labels) {
		$scope.edit_labels = edit_labels;
		$scope.colors = [ "#ff7e7f", "#8bccff", "#c1c1c1", "#ff7e7f", "#5e96c6", "#b6ed24", "#ffed24", "#ffc035", "#bcbcbc", "#e8abff" ];

		$scope.ok = function() {
		    var i, length = $scope.edit_labels.length;
		    var ids = [], names = [];
		    for (i in $scope.edit_labels) {
			ids.push($scope.edit_labels[i].id);
			names.push($scope.edit_labels[i].label_name);
		    }

		    ThoughtCast.updateLabels({
			ids : ids,
			names : names
		    });
		    $modalInstance.close();
		};

		$scope.cancel = function() {
		    $modalInstance.dismiss('cancel');
		};
	    };

	    // Get Archive Snippets
	    $scope.getArchiveSnippet = function() {
		$scope.clearFields();
		$scope.archive = 1;
		$scope.offset = 0;

		ThoughtCast.countArchiveSnippets(function(returnTotal) {
		    $scope.total = parseInt(returnTotal[0].total);
		});
		ThoughtCast.query({
		    limit : $scope.limit,
		    offset : $scope.offset,
		    query : $scope.query,
		    archive : $scope.archive
		}, function(returnSnippet) {
		    $scope.thoughts = returnSnippet;
		});

	    }
	} ]);

// Home controller
thoughtcastApp.controller('dreamsCtrl', [ "$scope", function($scope) {
    $scope.isCompleted = false;
    $scope.taskCompleted = function() {
	$scope.isCompleted = !$scope.isCompleted;
    };

} ]);

// Directive
thoughtcastApp.directive('contenteditable', [ function() {
    return {
	require : 'ngModel',
	link : function(scope, element, attrs, ctrl) {
	    // view -> model
	    element.bind('keyup', function() {
		scope.$apply(function() {
		    // Parse html
		    ctrl.$setViewValue((element.html()).replace(/&lt;|&gt;/g, function(s) {
			return s === "&lt;" ? "<" : ">"
		    }));
		});
	    });

	    // model -> view
	    ctrl.$render = function() {
		element.html(ctrl.$viewValue);
	    };

	    // load init value from DOM
	    ctrl.$render();
	}
    };
} ]);