@extends('defaultbooking')

@section('headtitle') 
    Video Consultations Brief
@endsection

@section('content')
   <div ng-app="plunker">
      <div ng-controller="MainCtrl">
          <div class="loading" ng-show="loading"></div>
          <div class="message" ng-bind-html="message_content"></div>
          
          <div id="checkout-wrapper" class="options-wrapper" ng-show="checkoutContainer">
             @include('booking.checkout')
          </div>
          
          <div class="options-wrapper" ng-show="thankyouContainer">
             @include('booking.thankyou')
          </div>
        </div>
    </div>
<script src="{{ asset('/js/angular/controllers/paymentCustom.js') }}"></script>

@endsection

