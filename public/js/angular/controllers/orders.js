var app = angular.module('orderApp', ['ui.bootstrap']);

var sortingOrder = 'name'; //default sort

app.controller('initApp', function($scope, $filter, $http) {
	var app_env = $scope.appEnv;
	$scope.isCollapsed = true;
	$scope.selectedStatus = 'processing';
	firstLoad($scope, $filter, $http, 'processing');
	$scope.filterStatus = function(status){
		firstLoad($scope, $filter, $http, status);
	};
});

 var firstLoad = function($scope, $filter, $http, status){

	jQuery('#main-container').addClass('disabled');
	jQuery('.loading').show();
 $http.get('http://52.64.118.158/mage-api/orders-json.php?range=month&status='+status+'&time='+Math.random())
    .success(function(response){        
		  // init
			jQuery('#main-container').removeClass('disabled');
		  $scope.pdf = (status == 'prescription_approved')?true:false;
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

		  // $scope.statusOptions = [
		  //     {id:'awaiting_doctor_review', name:'Awaiting Doctor Review'},
		  //     {id:'awaiting_patient_response', name:'Awaiting Patient Response'},
		  //     {id:'manually_processed', name:'Manually Processing'},
		  //     {id:'prescription_approved', name:'Prescription Approved'},
		  //     {id:'prescription_denied', name:'Prescription Denied'},
		  //     {id:'prescription_only_approved', name:'Prescription Only Approved'}
		     
		  //   ];
		  $scope.statusOptions = [
		      {id:'processing', name:'Processing'},
		      {id:'prescription_approved', name:'Prescription Approved'},
		      {id:'processed_bp', name:'Processed BP'},
		      {id:'complete', name:'Complete'}
		     
		    ];
		  $scope.repeatOptions = [
		  	{id:1, name:1}, {id:2, name:2}, {id:3, name:3}, {id:4, name:4}, {id:5, name:5}, {id:6, name:6},
		      {id:7, name:7}, {id:8, name:8}, {id:9, name:9}, {id:10, name:10}
		  ];

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
		  
		   // $scope.deleteItem = function (idx) {
		   //      var itemToDelete = $scope.pagedItems[$scope.currentPage][idx];
		   //      var idxInItems = $scope.items.indexOf(itemToDelete);
		   //      $scope.items.splice(idxInItems,1);
		   //      $scope.search();
		        
		   //      return false;
		   //  };
		  
		    $scope.changeStatus = function(orderid, status, index){
				jQuery('#main-container').addClass('disabled');
				jQuery('.loading').show();
		    	var orders_obj = $filter('filter')($scope.allItems, function (d) {return d.id === orderid;});
		    	
		    	// $http.post('http://localhost/doctusportal/public/ajax/generate/pdf',{data:orders_obj})
		    	// .success(function(response){	
		    	// 	jQuery('.message-portal').html('Order# '+orderid+'<br />Updated status code to ' + status +' <br /> Generated PDF file<br /> ['+response+']');			    		
	    		// 	jQuery('.message-portal').fadeIn(100).delay(3000).fadeOut();
		    	// });

		   //  	console.log(index);
		    	var itemToDelete = $scope.pagedItems[$scope.currentPage][index];
		        var idxInItems = $scope.items.indexOf(itemToDelete);
		        $scope.items.splice(idxInItems,1);
		        $scope.search();
			    $http({
		            method:'GET',
		            url : 'http://52.64.118.158/mage-api/update_status.php?order_id='+orderid+'&status='+status+'&time='+Math.random(),
		        	dataType: "jsonp"})
			    .success(function(data){
					jQuery('.loading').hide();
			    	if(status == 'prescription_approved'){
				    	$http.post('http://gp.doctus.com.au/ajax/generate/pdf',{data:orders_obj})
				    	.success(function(response){	
				    		jQuery('.message-portal').html('Order# '+orderid+'<br />Updated status code to ' + status +' <br /> Generated PDF file<br /> ['+response+']');			    		
			    			jQuery('.message-portal').fadeIn(100).delay(3000).fadeOut();
				    	});
				    }else{
				    	jQuery('.message-portal').html('Order# '+orderid+'<br />Updated status code to ' + status);			    		
			    		jQuery('.message-portal').fadeIn(100).delay(3000).fadeOut();
				    }
					jQuery('#main-container').removeClass('disabled');
			    });


		    	// $http.get('http://52.64.118.158/mage-api/update_status.php?order_id='+orderid+'&status='+status)
		    	// .success(function(response){
		    	// 	if(status == 'prescription_approved'){
				   //  	$http.post('http://gp.doctus.com.au/ajax/generate/pdf',{data:orders_obj})
				   //  	.success(function(response){
				   //  		alert('Status Approved');
				   //  	});
				   //  }
		    	// });

		    	
		    	
		    };

		    $scope.changeRepeat = function(repeat, orderid, productid){
		    	jQuery('.loading').show();
		    	$http({
		            method:'GET',
		            url : 'http://52.64.118.158/mage-api/reorder.php?orderid='+orderid+'&productid='+productid+'&repeat='+repeat,
		        	dataType: "jsonp"})
			    .success(function(repeat){
			    	jQuery('.loading').hide();
			    	jQuery('.message-portal').html('Order# '+orderid+'<br />Updated repeats');			    		
			    	jQuery('.message-portal').fadeIn(100).delay(3000).fadeOut();
			    });


		    	// $http.get('http://52.64.118.158/mage-api/reorder.php?orderid='+orderid+'&productid='+productid+'&repeat='+repeat)
		    	// .success(function(response){
		    	// 	alert(repeat);
		    	// });
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
	
	};