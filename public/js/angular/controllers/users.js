var app = angular.module('orderApp', ['ui.bootstrap']);

var sortingOrder = 'name'; //default sort

app.controller('initUser', function($scope, $filter, $http) {
	
	jQuery('#main-container').addClass('disabled');
	jQuery('.loading').show();
 	$http.get('http://gp.doctus.com.au/ajax/users')
    .success(function(response){        
		  // init
			jQuery('#main-container').removeClass('disabled');
		  var collections = function(data) {
		      var output = [], 
		          keys = [];

		      angular.forEach(data, function(item) {
		          var key = item['id'];
		          if(keys.indexOf(key) === -1) {
		              keys.push(key);
		              output.push(item);
		          }
		      });
		      return output;
		   };

		   var searchMatch = function (haystack, needle) {
			    if (!needle) {
			      return true;
			    }
			    return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
			  };

		  $scope.sortingOrder = sortingOrder;
		  $scope.pageSizes = [5,10,25,50];
		  $scope.reverse = false;
		  $scope.filteredItems = [];
		  $scope.groupedItems = [];
		  $scope.itemsPerPage = 10;
		  $scope.pagedItems = [];
		  $scope.currentPage = 0;
		  $scope.allItems = response;
		  $scope.items = collections(response);

		  // init the filtered items
		  $scope.search = function () {
		    $scope.filteredItems = $filter('filter')($scope.items, function (item) {

		      for(var attr in item) {
		        if (searchMatch(item['id'], $scope.query))
		          return true;
		      }
		      return false;
		    });
		    // take care of the sorting order
		    if ($scope.sortingOrder !== '') {
		      $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sortingOrder, $scope.reverse);
		    }
		    $scope.currentPage = 0;
		    // now group by pages
		    $scope.groupToPages();
		  };
		  
		  // show items per page
		  $scope.perPage = function () {
		    $scope.groupToPages();
		  };
		  
		  // calculate page in place
		  $scope.groupToPages = function () {
		    $scope.pagedItems = [];
		    
		    for (var i = 0; i < $scope.filteredItems.length; i++) {
		      if (i % $scope.itemsPerPage === 0) {
		        $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)] = [ $scope.filteredItems[i] ];
		      } else {
		        $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)].push($scope.filteredItems[i]);
		      }
		    }
		  };
		  
		  $scope.editUser = function(user_id){
		  	$http.get('http://gp.doctus.com.au/ajax/users/'+user_id)
		  	.success(function(response){
		  		$scope.first_name = response.first_name;
		  		$scope.last_name = response.last_name;
		  		$scope.email = response.email;
		  	});
		  };

		  $scope.range = function (start, end) {
		    var ret = [];
		    if (!end) {
		      end = start;
		      start = 0;
		    }
		    for (var i = start; i < end; i++) {
		      ret.push(i);
		    }
		    return ret;
		  };
		  
		  $scope.prevPage = function () {
		    if ($scope.currentPage > 0) {
		      $scope.currentPage--;
		    }
		  };
		  
		  $scope.nextPage = function () {
		    if ($scope.currentPage < $scope.pagedItems.length - 1) {
		      $scope.currentPage++;
		    }
		  };
		  
		  $scope.setPage = function () {
		    $scope.currentPage = this.n;
		  };
		  
		  // functions have been describe process the data for display
		  $scope.search();
		 
		  
		  // change sorting order
		  $scope.sort_by = function(newSortingOrder) {
		    if ($scope.sortingOrder == newSortingOrder)
		      $scope.reverse = !$scope.reverse;
		    
		    $scope.sortingOrder = newSortingOrder;
		  };
		jQuery('.loading').hide();
    });

});
