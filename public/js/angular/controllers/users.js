var app = angular.module('orderApp', ['ui.bootstrap']);
var hostname = 'http://gp.doctus.com.au';
if (document.location.hostname == "localhost"){
	hostname = 'http://localhost/doctusportal/public'
}

mage_hostname = 'http://52.64.118.158';
var sortingOrder = 'name'; //default sort

app.controller('initApp', function($scope, $filter, $http) {
	$scope.awaiting_count = 0;
	$scope.prescription_approved_count = 0;
	$scope.awaiting_url = true;
	$scope.prescription_url = true;
	getTotal($scope, $http);
	jQuery('#main-container').addClass('disabled');
	jQuery('.loading').show();
 	$http.get(hostname+'/ajax/users')
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
		 
		  //Popup edit form
		  $scope.editUser = function(user_id){
		  	$scope.user_id = '';
	  		$scope.first_name = '';
	  		$scope.last_name = '';
	  		$scope.telephone = '';
	  		$scope.email = '';
	  		$scope.role = '';

		  	$http.get(hostname+'/ajax/users/'+user_id)
		  	.success(function(response){
		  		//console.log(response.role[0].id);

		  		$scope.user_id = user_id;
		  		$scope.first_name = response.user.first_name;
		  		$scope.last_name = response.user.last_name;
		  		$scope.telephone = response.user.telephone;
		  		$scope.email = response.user.email;
		  		if(response.role!='')
		  		$scope.role = response.role[0].id;

		  	});
		  };
		  //Save User
 			$scope.roleOptions = [
			      {id:'1', name:'Admin'},
			      {id:'2', name:'Doctor'},
			      {id:'3', name:'Magento User'}		     
			    ];


		  $scope.save = function(user_id){
		  	var first_name = $scope.first_name;
		  	var last_name = $scope.last_name;
		  	var email = $scope.email;
		  	var telephone = $scope.telephone;
		  	var role = $scope.role;
		  	console.log(first_name);
		  	$http.post(hostname+'/ajax/users/update',{user_id:user_id,first_name:first_name,last_name:last_name,email:email,telephone:telephone,role:role})
		  	.success(function(response){
		  		$http.get(hostname+'/ajax/users/create-image/'+user_id)
			  	.success(function(response){
			  		
			  	});

		  		jQuery('.message-portal').css('z-index','10000');
		  		jQuery('.message-portal').html('Updated user');			    		
			    jQuery('.message-portal').fadeIn(100).delay(3000).fadeOut();
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
