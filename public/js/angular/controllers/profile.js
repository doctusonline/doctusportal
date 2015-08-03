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
	//jQuery('#main-container').addClass('disabled');
	//jQuery('.loading').show();

 	// $http.get(hostname+'/ajax/users/' + $scope.userId)
  //   .success(function(response){        
  //   	$scope.image_profile = hostname+'/images/profile_pic/';
		// jQuery('#main-container').removeClass('disabled');
		// jQuery('.loading').hide();
  //   });

});
var getTotal = function($scope, $http){
	 $http.get(mage_hostname+'/secured-api/orders-total.php?apiKey=7e56fb7d3287772f05bbf31dba4a85d5&time='+Math.random())
    .success(function(response){ 
    	$scope.awaiting_count = response.awaiting_count;
		$scope.prescription_approved_count = response.prescription_approved_count;
    });
}