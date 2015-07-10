var iframe = document.getElementById('iframe');
var app = angular.module('plunker', ['ngSanitize']);

var time = '';
var date = '';
var paid = 45;

app.controller('MainCtrl', function($scope, $sce, $http) {
  var iframeclass = '';
  $scope.height = '1px';
  $scope.optionsContainer = true;
  $scope.loading = false;
  $scope.continueBtn = false;
  $scope.loadTemplate = function() {

    $scope.iframeContainer = true;
    $scope.loading = true;
    $scope.continueBtn = true;
    iframe.addEventListener('load', function() {
      $('.loading').hide();
    });
    $scope.optionsContainer = false;
    $scope.height = '260px';
    $scope.width = '100%';
    $scope.activeTemplate = $sce.trustAsResourceUrl('http://localhost/doctusportal/public/booking/iframe');
      
    };
})
.directive('continueClick', function($http) {
  return function(scope, element) {
    element.bind('click', function() {        
      $('.loading').show();
      // get html on iframe
      var document_html = iframe.contentWindow.document;
      var inner_html = document_html.getElementsByTagName('span')[0].innerHTML;
      var data = inner_html.split(' ');
      time = data[0];
      date = data[1];
      paid = 45;
      $http.post('api/booking/create',{date:date,time:time})
      .success(function(response){
        scope.checkoutContainer = true;
        scope.iframeContainer = false;
        $('.loading').hide();
        objDate = Date.parse(date.replace(/-/g, "/"));;
        scope.date = getDateString(new Date(objDate), "d M y");
        scope.time = time;
        scope.paid = paid;
        console.log('success');
      })
      .error(function(error){
        alert(error);
        console.log('error');
      });

      $http.post('api/payment/create',{paid:paid,date:date,time:time})
      .success(function(response){
        console.log('success');
      })
      .error(function(error){
        alert(error);
        console.log('error');
      });

    });
  };
})
.directive('checkoutClick', function($http) {
    return function(scope, element) {
      element.bind('click', function() {       
        $('.loading').show(); 
        var data = $('#eway-form').serializeArray();
        var json = JSON.stringify(data);
        $http.post('api/checkout',{data:json})
        .success(function(response){
          $('.loading').hide();
          scope.checkoutContainer = false;
          scope.thankyouContainer = true;
          console.log('success');
        })
        .error(function(error){
          alert(error);
          console.log('error');
        });
      });
    };
  });






var  getDateString = function(date, format) {
    var months = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"],
    getPaddedComp = function(comp) {
        return ((parseInt(comp) < 10) ? ('0' + comp) : comp)
    },
    formattedDate = format,
    o = {
        "y+": date.getFullYear(), // year
        "M+": months[date.getMonth()], //month
        "d+": getPaddedComp(date.getDate()), //day
        "h+": getPaddedComp((date.getHours() > 12) ? date.getHours() % 12 : date.getHours()), //hour
         "H+": getPaddedComp(date.getHours()), //hour
        "m+": getPaddedComp(date.getMinutes()), //minute
        "s+": getPaddedComp(date.getSeconds()), //second
        "S+": getPaddedComp(date.getMilliseconds()), //millisecond,
        "b+": (date.getHours() >= 12) ? 'PM' : 'AM'
    };

    for (var k in o) {
        if (new RegExp("(" + k + ")").test(format)) {
            formattedDate = formattedDate.replace(RegExp.$1, o[k]);
        }
    }
    return formattedDate;
};