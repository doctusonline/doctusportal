@extends('default')

@section('headtitle') 
    Doctor's Portal
@endsection

@section('content')

<div class="dp-main-content" ng-app="doctusApp" >
    <div class="col-md-2">
        
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a href="#"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span> Orders</a></li>
            <li role="presentation"><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Patient List</a></li>
            
        </ul>
        
    </div>
    
    <div class="col-md-10" ng-controller="ordersCtrl" >
        
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
                
                
                
              
                
                <br />
                
            </li>
        </ul>
      
    </div>
</div>    

<script>
    
    
    var app = angular.module('doctusApp',[]);
    
    app.controller('ordersCtrl', function($scope, $http){
        $http.get('http://52.64.118.158/mage-api/orders-json.php?range=week&status=processing')
        .success(function(response){
            $scope.orders = response;
        })
    });
    

</script>

    
@endsection