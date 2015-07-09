@extends('defaultbooking')

@section('headtitle') 
    Video Consultations Brief
@endsection

@section('content')
    <div ng-app="plunker">
      <div ng-controller="MainCtrl">
        <div class="iframe-container">
          <div class="loading" ng-show="loading"></div>
          <iframe id="iframe" frameborder="0" width="@{{width}}" height="@{{height}}" ng-src="@{{activeTemplate}}" sandbox="allow-same-origin allow-scripts">

          </iframe>
        </div>
        <div class="options-wrapper" ng-show="optionsContainer">
            <div id="getHelp">
                <p class="titlebar">Get help from real doctors 24/7<span>Choose one:</span></p>
                <ul>
                    <li class="skype"><a href="javascript:void(0)" ng-click="loadTemplate()"><span class="title">SKYPE CALL</span>Consult your doctor specialist<span class="cost">Cost: $45</span><span class="arrow">&gt;</span></a></li>
                    <li class="questionnaire"><a href="#"><span class="title">QUESTIONNAIRE</span>Consult <strong>immediately</strong><span class="cost">Cost: $35</span><span class="arrow">&gt;</span></a></li>
                </ul>
             </div><!-- END getHelp -->
             
             <div id="rating" class="clearfix">
                <img src="{{ asset('/images/doctor-pic.jpg') }}" alt="" class="image"/>
                <div class="info">
                    <span class="name">Dr. Rodney Beckwith</span>
                    <span class="type">Family Medicine</span>
                    <p class="stars"><span></span><span></span><span></span><span></span><span></span></p>
                    <span class="location">Reliance GP Super</span>
                </div>
             </div><!-- END rating -->
             
             <div id="satisfication">
                <p>100% Satisfaction Guarenteed<span>*Prices very for psychatrc consults</span></p>
             </div><!-- END satisfication -->
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

