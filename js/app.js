var thoughtcastApp = angular.module("thoughtApp", [ "ui.bootstrap", "ui.codemirror", "filters", "ngDragDrop","ngResource","ngSanitize" ]);
angular.module("filters", []).filter("truncate", function() {
    return function(c, b, a) {
	if (isNaN(b)) {
	    b = 20
	}
	if (a === undefined) {
	    a = "..."
	}
	if (c.length <= b || c.length - a.length <= b) {
	    return c
	} else {
	    return String(c).substring(0, b - a.length) + a
	}
    }
});
thoughtcastApp.filter("removeComma", function() {
    return function(c) {
	var d = [];
	c = c.split(",");
	var b = c.length;
	var a;
	for (a = 0; a < b; a++) {
	    if (c[a] != "") {
		d.push(c[a])
	    }
	}
	return d
    }
});
thoughtcastApp.factory("$debounce", [ "$timeout", "$q", function(b, a) {
    return function(e, g, d) {
	var f;
	var c = a.defer();
	return function() {
	    var k = this, j = arguments;
	    var i = function() {
		f = null;
		if (!d) {
		    c.resolve(e.apply(k, j));
		    c = a.defer()
		}
	    };
	    var h = d && !f;
	    if (f) {
		b.cancel(f)
	    }
	    f = b(i, g);
	    if (h) {
		c.resolve(e.apply(k, j));
		c = a.defer()
	    }
	    return c.promise
	}
    }
}]);

thoughtcastApp.factory('ThoughtCastService',['$resource',function($resource){
    
    var a = function() {
	
    };
    a.prototype = {
	    snippets : function(){
		return $resource('/thoughtcast/:action',{action:"@action"},{
		   query: {
		       method : "GET",
		       params : {
			   action: "getsnippets",
			   limit : "@limit",
			   offset : "@offset",
			   query : "@query",
			   archive : "@archive"
		       },
		       responseType: "JSON",
		       isArray: true
		   },
		   getSnippet: {
		       method: "GET",
		       params : {
			   action : "getsnippet",
			   id : '@id',
		       },
		      isArray : false,

		   },
		   saveSnippets : {
		       method : "POST",
		       params : {
			   action : "savesnippets",
		       },
		       headers: {
			   "Content-Type": "application/json;charset=utf-8"
		       }
		   },
		   archiveSnippet : {
		       method: "POST",
		       params : {
			   action : "archivesnippet",
		       },
		       headers: {
			   "Content-Type": "application/json;charset=utf-8"
		       }
		   },
		   deleteSnippet : {
		       method : "POST",
		       params : {
			   action : "deletesnippet",
		       },
		       headers: {
			   "Content-Type": "application/json;charset=utf-8"
		       }
		   },
		   countSnippets : {
		       method: "GET",
		       params : {
			   action : "CountSnippets"
		       },
		       responseType: "JSON",
		       isArray: true
		   },
		   countArchiveSnippets : {
		       method : "GET",
		       params : {
			   action : "CountArchiveSnippets"
		       },
		       responseType: "JSON",
		       isArray: true
		       
		   },
		   getLabels : {
		       method: "GET",
		       params : {
			   action : "getlabels",
		       },
		       responseType: "JSON",
		       isArray : true
		   },
		   updateLabels : {
		       method:"POST",
		       params : {
			   action: "updatelabels",
			   ids : "@ids",
			   names : "@names"
		       },
		       headers: {
			   "Content-Type": "application/json;charset=utf-8"
		       }
		   }
		   
		});
	    }
    }
    
    return new a();
    
}]);


