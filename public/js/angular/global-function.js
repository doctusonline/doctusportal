var getTotal = function($scope, $http){
	 $http.get(mage_hostname+'/secured-api/orders-total.php?apiKey=7e56fb7d3287772f05bbf31dba4a85d5&time='+Math.random())
    .success(function(response){ 
    	$scope.awaiting_count = response.awaiting_count;
		$scope.prescription_approved_count = response.prescription_approved_count;
    });
}