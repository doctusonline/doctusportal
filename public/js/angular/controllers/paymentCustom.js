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
  $scope.checkoutContainer = true;
  $scope.loadTemplate = function() {

    $scope.iframeContainer = true;
    $scope.continueBtn = true;
    $scope.checkoutContainer = true;
    $scope.optionsContainer = false;

    };
})

.directive('checkoutClick', function($http, $sce) {
    return function(scope, element) {
      element.bind('click', function() {   
        scope.loading = true;
        var cardNumber = eCrypt.encryptValue($('#txtCardNumber').val());
        var cvv = eCrypt.encryptValue($('#txtCVN').val());

        $('#checkout-wrapper').addClass('disabled');
        var data = $('#eway-form').serializeArray();
        var json = JSON.stringify(data);
        console.log('formdata='+json)
        $http.post('../api/checkout',{data:json,cardNumber:cardNumber,cvv:cvv})
        .success(function(response){  
          //scope.iframeContainer = false;  
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
          scope.message_content = $sce.trustAsHtml('Error to checkout');
            $('.message').fadeIn(300).delay(5000).fadeOut(500);
            setTimeout(6000,$('#checkout-wrapper').removeClass('disabled'));
          console.log('error');
        });
      });
    };
  });



