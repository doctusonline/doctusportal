angular.module('app_booking',[])
.service('bookingService',function($http, $q, $rootScope){
    this.saveBooking = function(date, time){
        
        var q = $q.defer();
        $rootScope.loading = true;
        $http.post('api/booking/create',{date:date,time:time})
        .success(function(response){
            q.resolve(response);
            $rootScope.loading = false;
        })
        .error(function(error){
            q.reject(error);
        })
        
        return q.promise;
        
    }
    this.savePayment = function(paid, date, time){
        
        var q = $q.defer();
        $rootScope.loading = true;
        $http.post('api/payment/create',{paid:paid,date:date,time:time})
        .success(function(response){
            q.resolve(response);
            $rootScope.loading = false;
        })
        .error(function(error){
            q.reject(error);
        })
        
        return q.promise;
        
    }
    
});