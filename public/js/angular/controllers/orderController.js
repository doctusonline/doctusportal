angular.module('app_orders')
.controller('orderController',function($scope,orderService, $http){
    
$scope.discussions = {};
     
    $scope.migrateOrders = function(range){
        $scope.promise = orderService.saveOrders(range)
        .then(function(response){
            //console.log(response);
        })
    }
        
});