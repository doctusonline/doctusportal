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


<div class="dp-main-content" ng-app="doctusApp2" >
    <div class="col-md-2">
        
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a href="#"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span> Orders</a></li>
            <li role="presentation"><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Patient List</a></li>
            
        </ul>
        
    </div>
    
    <div class="col-md-10" ng-controller="ordersCtrl2" >
        
        <ul>
            <li > 
                <table st-table="rowCollection" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Medication</th>
                            <th>Status</th>
                        </tr>
                    </thead>    
                    
                    <tbody>
                    <tr ng-repeat="x in orders">
                            <td>@{{x.name}}</td>
                            <td>@{{x.street}} @{{x.region}} @{{x.postcode}}, @{{ x.country }}</td>
                            <td>@{{x.telephone}}</td>
                            <td>@{{x.email}}</td>
                            <td>@{{x.product}}</td>
                            <td>@{{x.status}}</td>
                            <td ng-repeat="y in x.options">
                                @{{ y.label }}
                            </td>
                    </tr>
                 
                    </tbody>                    
                </table>
                <div class="spinner" ng-show="loading">Loading...</div>
                
                
                <br />
                
            </li>
        </ul>
      
    </div>
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
    },30000);
    });

</script>

    
@endsection