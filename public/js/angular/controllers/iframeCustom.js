var app = angular.module('plunker', ['ngSanitize']);

app.controller('MainCtrl', function($scope, $sce) {
  var iframeclass = '';
  $scope.height = '1px';
  $scope.optionsContainer = true;
  $scope.loading = false;
  $scope.loadTemplate = function() {
    $scope.loading = true;
    var iframe = document.getElementById('iframe');
    iframe.addEventListener('load', function() {
      $('.loading').hide();
    });
    $scope.optionsContainer = false;
    //iframe.classList.add(iframeclass);
    $scope.height = '600px';
    $scope.width = '100%';
    $scope.activeTemplate = $sce.trustAsResourceUrl('//widget2.appointuit-staging.com/prac_11070');
      
    };
});