@extends('default')

@section('headtitle') 
    Doctor's Portal
@endsection

@section('content')


<!-- <div ng-app="refresh_div" ng-controller="refresh_control">
  @{{message}}
  <input type="button" ng-click="killtimer()" value="Kill me">
  <div class="spinner" ng-show="loading2">Loading...</div>
</div> -->

<div ng-app="app_orders">
    <div ng-controller="orderController">

    <ul>
    @foreach($tracks as $item)
        <li>{{$item->user[0]->first_name}}--{{$item->order_id_mage}}--{{$item->status_code}}--{{$item->created_at}}</li>
    @endforeach
    </ul>

        <form ng-submit="migrateOrders(range)">
            <select ng-model="range">
                <option value="day">Day</option>
                <option value="week">Week</option>
                <option value="month">Month</option>
            </select>
            <button type="submit" class="btn btn-default" >Day</button>
            <button type="submit" class="btn btn-default" >Week</button>
            <button type="submit" class="btn btn-default" >Month</button>
            <div style="clear:both"> </div>
        </form>  
        <ul id="message-log"></div>
        <div class="spinner" ng-show="loading">Loading...</div>
    </div>
</div>

<script src="{{ asset('/js/angular/services/orderService.js') }}"></script>
<script src="{{ asset('/js/angular/controllers/orderController.js') }}"></script>

<script>
    
    
    // var app = angular.module('doctusApp2',[]);
    
    // app.controller('ordersCtrl2', function($scope, $http){
    //     $scope.loading = true;
    //     $http.get('http://52.64.118.158/mage-api/orders-json.php?range=week&status=processing')
    //     .success(function(response){
    //         $scope.orders = response;
    //     }).finally(function() {
    //         // called no matter success or failure
    //         $scope.loading = false;
    //       });
    // });
    

    // var app2=angular.module('refresh_div',[])
    //     .controller('refresh_control',function($scope,$interval){
    //         $scope.loading2 = true;
    //         var c=0;
    //         $scope.message="This DIV is refreshed "+c+" time.";
    //         $interval(function(){
    //             $scope.message="This DIV is refreshed "+c+" time.";
    //             c++;
    //         },1000);
    //     });

</script>

    
@endsection