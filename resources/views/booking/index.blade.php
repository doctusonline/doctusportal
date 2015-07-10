@extends('defaultbooking')

@section('headtitle') 
    Video Consultations Brief
@endsection

@section('content')
    <div ng-app="plunker">
      <div ng-controller="MainCtrl">
          <div class="loading" ng-show="loading"></div>
          <div class="iframe-container" ng-show="iframeContainer">
            <iframe id="iframe" frameborder="0" width="@{{width}}" height="@{{height}}" ng-src="@{{activeTemplate}}" sandbox="allow-same-origin allow-scripts">
            </iframe>
            <div class="continue-btn" ng-show="continueBtn"><input type="button" continue-click class="btn btn-primary" value="Continue"/></div>
          </div>
          <div class="options-wrapper" ng-show="optionsContainer">
             @include('booking.firstpage')
          </div>
          <div class="options-wrapper" ng-show="checkoutContainer">
             @include('booking.checkout')
          </div>
          <div class="options-wrapper" ng-show="thankyouContainer">
             @include('booking.thankyou')
          </div>
        </div>
    </div>
     <!-- Modal -->
     <!--  <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
              <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div> -->

<script src="{{ asset('/js/angular/controllers/iframeCustom.js') }}"></script>
<script type="text/javascript">
    // var iframe = document.getElementById('iframe');
    // iframe.addEventListener('load', function() {
    //   document.body.classList.remove("loading-iframe");
    // });
    // var app = angular.module('plunker', ['ngSanitize']);

    // app.controller('MainCtrl', function($scope, $sce) {
    //     var iframeclass = '';
    //     $scope.height = '1px';
    //     $scope.loadTemplate = function() {
    //         document.body.classList.add("loading-iframe");
            
    //       //iframe.classList.add(iframeclass);
    //       $scope.height = '600px';
    //       $scope.width = '100%';
    //       $scope.activeTemplate = $sce.trustAsResourceUrl('//widget2.appointuit-staging.com/prac_11070');
            
    //       };


    //   $scope.player = $sce.trustAsHtml('<iframe id="iframe-skype" frameborder="0" width="100%" height="600px" src="//widget2.appointuit-staging.com/prac_11070"></iframe>');
    // });
</script>

@endsection

