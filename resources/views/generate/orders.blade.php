@extends('default')

@section('headtitle') 
    Doctor's Portal
@endsection

@section('content')


<div ng-app="refresh_div" ng-controller="refresh_control">
  @{{message}}
  <input type="button" ng-click="killtimer()" value="Kill me">
  <div class="spinner" ng-show="loading2">Loading...</div>
</div>

 

<script>
    
    
    var app = angular.module('doctusApp2',[]);
    
    app.controller('ordersCtrl2', function($scope, $http){
        $scope.loading = true;
        $http.get('http://52.64.118.158/mage-api/orders-json.php?range=week&status=processing')
        .success(function(response){
            $scope.orders = response;
        }).finally(function() {
            // called no matter success or failure
            $scope.loading = false;
          });
    });
    

    var app2=angular.module('refresh_div',[])
        .controller('refresh_control',function($scope,$interval){
            $scope.loading2 = true;
            var c=0;
            $scope.message="This DIV is refreshed "+c+" time.";
            $interval(function(){
                $scope.message="This DIV is refreshed "+c+" time.";
                c++;
            },1000);
        });

</script>

    
@endsection