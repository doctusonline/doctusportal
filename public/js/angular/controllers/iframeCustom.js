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
   
    $scope.optionsContainer = false;
    $scope.height = '400px';
    $scope.width = '100%';
    $scope.activeTemplate = $sce.trustAsResourceUrl('https://doctus.youcanbook.me/?noframe=true&skipHeaderFooter=true');
     iframe.addEventListener('load', function() {
      $('.loading').hide();
      // var document_html = iframe.contentWindow.document;
      // console.log(document_html.body.offsetHeight);
    });

    };
})
.directive('continueClick', function($http) {
  return function(scope, element) {
    element.bind('click', function() {        
      $('.loading').show();
      // get html on iframe

      
      //console.log($('#iframe').contents());
      
      // var document_html = iframe.contentWindow.document;
      // var inner_html = document_html.getElementsByTagName('span')[0].innerHTML;



      // var data = inner_html.split(' ');
      // time = data[0];
      // date = data[1];
      time = '9:00';
      date = '07-15-2015';
      paid = 45;
      $http.post('api/booking/create',{date:date,time:time})
      .success(function(response){
        scope.checkoutContainer = true;
        //scope.iframeContainer = false;
        $('.loading').hide();
        objDate = Date.parse(date.replace(/-/g, "/"));;
        scope.date = getDateString(new Date(objDate), "d M y");
        scope.time = time;
        scope.paid = paid;
        scope.bookingID = response;
        scope.height = '130px';
        scope.continueBtn = false;
        console.log('success');
      })
      .error(function(error){
        alert(error);
        console.log('error');
      });

      $http.post('api/payment/create',{paid:paid,date:date,time:time})
      .success(function(response){
        scope.paymentID = response;
        console.log('success');
      })
      .error(function(error){
        alert(error);
        console.log('error');
      });

    });
  };
})
.directive('checkoutClick', function($http, $sce) {
    return function(scope, element) {
      element.bind('click', function() {   
        $('.loading').show(); 
        $('#checkout-wrapper').addClass('disabled');
        var data = $('#eway-form').serializeArray();
        var json = JSON.stringify(data);
        $http.post('api/checkout',{data:json})
        .success(function(response){  
          scope.iframeContainer = false;  
          $('.loading').hide();
          if(response == 'success'){
            scope.checkoutContainer = false;
            scope.thankyouContainer = true;
            console.log(response);
          }else{
            scope.message_content = $sce.trustAsHtml(response);
            $('.message').fadeIn(300).delay(5000).fadeOut(500);
            $('#checkout-wrapper').removeClass('disabled');
            console.log(response);
          }
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