angular.module('app_booking')
.controller('bookingController',function($scope,bookingService, $http){
    
$scope.booking = {};
     
    $scope.postBooking = function(date, time){
        $scope.promise = bookingService.saveBooking(date, time)
        .then(function(response){
            //console.log(response);
        })
    }
    
    $scope.postPayment = function(paid, date, time){
        $scope.promise = bookingService.savePayment(paid, date, time)
        .then(function(response){
            //console.log(response);
        })
    }    

});