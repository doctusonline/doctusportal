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
});