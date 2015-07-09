@extends('default')

@section('headtitle') 
    Doctor's Portal
@endsection

@section('content')

<div ng-app="app_booking">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div ng-controller="bookingController">
            
            <div class="row">
            <h4>Booking</h4>
                <form class="form-horizontal" ng-submit="postBooking(date, time)">    
                       @include('booking.form')      
               </form>

            </div>

            <div class="row">
                <h4>Payment</h4>

               <form class="form-horizontal" ng-submit="postPayment(paid, date, time)">  
                    <div id="" class="date_activity form-group {{ $errors->has('paid') ? 'has-error' : ''}}">
                        {!! Form::label('paid','Paid:', ['class' => 'col-md-2 control-label']) !!}
                        <div id="" class="input-append input-group col-md-10">
                            
                        {!! Form::text('paid', null, ['class'=> 'form-control','ng-model'=>'paid','required']) !!}
                        {!! $errors->first('paid', '<span class="help-block">:message</span>') !!} 
                        </div>
                    </div>
                       @include('booking.form')      
               </form>
           </div>

                <ul id="message-log"></ul>
                <div class="spinner" ng-show="loading">Saving...</div>

            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
    <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
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
      </div>
</div>


<script src="{{ asset('/js/angular/services/bookingService.js') }}"></script>
<script src="{{ asset('/js/angular/controllers/bookingController.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.js') }}"></script>  
 
<script src="{{ asset('/js/bootstrap3/moment-with-locales.2.9.0.js') }}"></script>   
<script src="{{ asset('/js/bootstrap3/bootstrap-datetimepicker.4.7.14.js') }}"></script>  
<script type="text/javascript">



    $(function () {

        $('#datetimepicker1.input-group.date').datepicker({
            todayBtn: "linked",
            format: 'mm/dd/yyyy',
            autoclose: true
        }).on("changeDate", function(e){
            $('#date').trigger('change');
        });

        $('.timepicker').datetimepicker({
            format: 'LT'
        });
      

    });

    // function touch(e){
    //     jQuery(e).data('touched', true);
    // }

    // $(function(){
    //     $('#date').change(function(){
    //         jQuery(this).data('touched', true);
    //     });
    // });

</script>
@endsection