@extends('defaultbooking')

@section('headtitle') 
    Video Consultations Brief
@endsection

@section('content')
    <div ng-app="plunker">
      <div ng-controller="MainCtrl">
          <div class="loading" ng-show="loading"></div>
          <div class="message" ng-bind-html="message_content"></div>
          <div class="iframe-container" ng-show="iframeContainer">
            <iframe id="iframe" frameborder="0" width="@{{width}}" height="@{{height}}" ng-src="@{{activeTemplate}}">
            </iframe>
            <!-- <div class="continue-btn" ng-show="continueBtn"><input type="button" continue-click class="btn btn-primary" value="Pay Now"/></div> -->
          </div>
          <div class="options-wrapper" ng-show="optionsContainer">
             @include('booking.firstpage')
          </div>
          <div id="checkout-wrapper" class="options-wrapper" ng-show="checkoutContainer">
             @include('booking.checkout')
          </div>
          <div class="options-wrapper" ng-show="thankyouContainer">
             @include('booking.thankyou')
          </div>
        </div>
    </div>
<script src="{{ asset('/js/angular/controllers/iframeCustom.js') }}"></script>

@endsection

