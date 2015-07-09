angular.module('app_orders',['ngResource'])
.factory('Orders', ['$resource', function($resource, range) {
return $resource('http://52.64.118.158/mage-api/orders-json.php?range=week&status=processing');
}])
.service('orderService',function($http, $q, $rootScope, $resource, Orders){
    this.saveOrders = function(range){
        //var data = null;
        var ul = document.getElementById("message-log");
        ul.innerHTML = '';
        Orders.query().$promise.then(function (results) {            
            data = JSON.stringify(results);
            id_str = '';
            angular.forEach(results, function (result) {
                sku = result.sku;
                product = result.product;
                var x = document.createElement("LI");
                var t = document.createTextNode(sku + ' - ' + product);
                x.appendChild(t);
                document.getElementById("message-log").appendChild(x);
            });
            $http.post('api/generate/orders',{range:range,data:data})
            .success(function(response){
                $rootScope.loading = false;
            })
            .error(function(error){
            })
        });

         var q = $q.defer();
        return q.promise;
        
    }
    
});