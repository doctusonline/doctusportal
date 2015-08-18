var app = angular.module('orderApp', ['ui.bootstrap']);
var hostname = 'http://gp.doctus.com.au';
var mage_hostname = 'http://52.64.118.158';
if (document.location.hostname == "localhost"){
	hostname = 'http://localhost/doctusportal/public';
	mage_hostname = 'http://localhost/doctus';
}

mage_hostname = 'http://52.64.118.158';

var sortingOrder = 'name'; //default sort

app.controller('initApp', function($scope, $filter, $http) {
	var app_env = $scope.appEnv;
	$scope.isCollapsed = true;
	$scope.awaiting_count = 0;
	$scope.prescription_approved_count = 0;
	$scope.selectedStatus = 'awaiting_doctor_review';
	firstLoad($scope, $filter, $http, 'awaiting_doctor_review');	
	getTotal($scope, $http);
	$scope.awaiting_void = true;
	$scope.prescription_void = true;
	$scope.filterStatus = function(status){
		firstLoad($scope, $filter, $http, status);
	};
});

 var firstLoad = function($scope, $filter, $http, status){
 	
 // 	$http.get(mage_hostname+'/mage-api/auto-login.php')
 //    .success(function(url){
	// 	$http.get(mage_hostname+'/mage-api/api-test.php?display=orders')
	//     .success(function(response){
	//     	var token = response.oauth_token;
	//     	// if(token !== undefined)
	//     	$http.get(mage_hostname+'/index.php/admin/oauth_authorize/confirm?oauth_token='+token)
	// 	    .success(function(response){	
	// 	    	//console.log(response);
	// 	    });
	// 	    //console.log(response);
	//     });
	// });

	jQuery('#main-container').addClass('disabled');
	jQuery('.loading').show();
 $http.get(mage_hostname+'/secured-api/orders-json.php?apiKey=7e56fb7d3287772f05bbf31dba4a85d5&range=month&status='+status+'&time='+Math.random())
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

		  
		  $scope.statusOptions = [
		      {id:'awaiting_doctor_review', name:'Awaiting Doctor Review'},
		      {id:'awaiting_patient_response', name:'Awaiting Patient Response'},
		      {id:'manually_processed', name:'Manually Processing'},
		      {id:'prescription_approved', name:'Prescription Approved'},
		      {id:'prescription_denied', name:'Prescription Denied'},
		      {id:'prescription_only_approved', name:'Prescription Only Approved'}		     
		    ];
		  // $scope.statusOptions = [
		  //     {id:'processing', name:'Processing'},
		  //     {id:'prescription_approved', name:'Prescription Approved'},
		  //     {id:'processed_bp', name:'Processed BP'},
		  //     {id:'complete', name:'Complete'}
		     
		  //   ];
		  $scope.repeatOptions = [
		  	{id:1, name:1}, {id:2, name:2}, {id:3, name:3}, {id:4, name:4}, {id:5, name:5}, {id:6, name:6},
		      {id:7, name:7}, {id:8, name:8}, {id:9, name:9}, {id:10, name:10}, {id:11, name:11}, {id:12, name:12},
		      {id:13, name:13}, {id:14, name:14}, {id:15, name:15}
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
		  	print_r($scope.groupToPages());
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

		    	var itemToDelete = $scope.pagedItems[$scope.currentPage][index];
		        var idxInItems = $scope.items.indexOf(itemToDelete);
		        $scope.items.splice(idxInItems,1);
		        $scope.search();

			    $http({
		            method:'GET',
		            url : mage_hostname+'/secured-api/update_status.php?apiKey=7e56fb7d3287772f05bbf31dba4a85d5&order_id='+orderid+'&status='+status+'&time='+Math.random(),
		        	dataType: "jsonp"})
			    .success(function(data){
					jQuery('.loading').hide();

					getTotal($scope, $http);
		       
					//$http.post('http://localhost/doctusportal/public/ajax/update/order',{order_id:orderid,status_code:status})
				    $http.post(hostname+'/ajax/update/order',{order_id:orderid,value:status,type:'status_code'})
				    .success(function(response){	
				    	
				    });

			    	if(status == 'prescription_approved'){
				    	$http.post(hostname+'/ajax/generate/pdf',{data:orders_obj})
				    	//$http.post('http://localhost/doctusportal/public/ajax/generate/pdf',{data:orders_obj})
				    	.success(function(response){	
				    		jQuery('.message-portal').html('Order# '+orderid+'<br />Updated status to <span class="capitalize">' + $scope.itemStatus(status) +'</span> <br /> Generated PDF file<br /> ['+response+']');			    		
			    			jQuery('.message-portal').fadeIn(100).delay(3000).fadeOut();
				    	});
				    }else{
				    	jQuery('.message-portal').html('Order# '+orderid+'<br />Updated status to <span class="capitalize">' + $scope.itemStatus(status) + '</span>');			    		
			    		jQuery('.message-portal').fadeIn(100).delay(3000).fadeOut();
				    }
					jQuery('#main-container').removeClass('disabled');
			    });
	    	
		    };

		    $scope.changeRepeat = function(repeat, orderid, productid){
		    	jQuery('#main-container').addClass('disabled');
		    	jQuery('.loading').show();
		    	$http({
		            method:'GET',
		            url : mage_hostname+'/secured-api/reorder.php?apiKey=7e56fb7d3287772f05bbf31dba4a85d5&orderid='+orderid+'&productid='+productid+'&repeat='+repeat,
		        	dataType: "jsonp"})
			    .success(function(response){

					getTotal($scope, $http);
		       
			    	$http.post(hostname+'/ajax/update/order',{order_id:orderid,value:repeat,type:'repeats'})
				    .success(function(response){	
				    	
				    });
			    	jQuery('#main-container').removeClass('disabled');
			    	jQuery('.loading').hide();
			    	jQuery('.message-portal').html('Order# '+orderid+'<br />Updated repeats');			    		
			    	jQuery('.message-portal').fadeIn(100).delay(3000).fadeOut();
			    });
		    };

		    $scope.popupMessageForm = function(item){
		    	$scope.recipient_name = item.name;
		    	$scope.recipient_email = item.email;
		    };
		    $scope.sendMessage = function(){
		    	var subject = $scope.subject;
		    	var message = $scope.message;
		    	$http.post(hostname+'/messages/send',{subject:subject,message:message})
			  	.success(function(response){
			  		
			  		jQuery('.message-portal').css('z-index','10000');
			  		jQuery('.message-portal').html('Message has been sent');			    		
				    jQuery('.message-portal').fadeIn(100).delay(3000).fadeOut();
			  	});
		    };

		  $scope.itemStatus = function(e){
		  	return e.replace(/_/g," ");
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
