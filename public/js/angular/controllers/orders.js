
initApp.$inject = ['$scope', '$filter', '$http'];

var sortingOrder = 'name'; //default sort

function initApp($scope, $filter, $http) {
 $scope.loading = true;


  var searchMatch = function (haystack, needle) {
    if (!needle) {
      return true;
    }
    return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
  };
  

$http.get('http://52.64.118.158/mage-api/orders-json.php?range=month&status=processing')
    .success(function(response){        
		  // init
		  $scope.sortingOrder = sortingOrder;
		  $scope.pageSizes = [5,10,25,50];
		  $scope.reverse = false;
		  $scope.filteredItems = [];
		  $scope.groupedItems = [];
		  $scope.itemsPerPage = 10;
		  $scope.pagedItems = [];
		  $scope.currentPage = 0;
		  $scope.items = response;

		  $scope.statusOptions = [
		      {id:'pending', name:'Pending'},
		      {id:'processing', name:'Processing'},
		      {id:'waiting', name:'Waiting to confirm'}
		    ];
		  $scope.repeatOptions = [
		  	{id:1, name:1}, {id:2, name:2}, {id:3, name:3}, {id:4, name:4}, {id:5, name:5}, {id:6, name:6},
		      {id:7, name:7}, {id:8, name:8}, {id:9, name:9}, {id:10, name:10}
		  ];




		  // init the filtered items
		  $scope.search = function () {
		    $scope.filteredItems = $filter('filter')($scope.items, function (item) {
		      for(var attr in item) {
		        if (searchMatch(item[attr], $scope.query))
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
		  
		   $scope.deleteItem = function (idx) {
		        var itemToDelete = $scope.pagedItems[$scope.currentPage][idx];
		        var idxInItems = $scope.items.indexOf(itemToDelete);
		        $scope.items.splice(idxInItems,1);
		        $scope.search();
		        
		        return false;
		    };
		  
		    $scope.changeStatus = function(status){
		    	$http.get('http://52.64.118.158/mage-api/orders-json.php?range=month&status=processing')
		    	.success(function(response){
		    		alert(status);
		    	});
		    };

		    $scope.changeRepeat = function(status){
		    	$http.get('http://52.64.118.158/mage-api/orders-json.php?range=month&status=processing')
		    	.success(function(response){
		    		alert(status);
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
		  $scope.loading = false;
    });
};
