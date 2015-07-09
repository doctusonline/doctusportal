

<div id="" class="date_activity form-group {{ $errors->has('date') ? 'has-error' : ''}}">
        {!! Form::label('date','Date:', ['class' => 'col-md-2 control-label']) !!}
        <div id="datetimepicker1" class="input-append input-group date col-md-10">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        {!! Form::text('date', null, ['class'=> 'form-control', 'data-format'=>'yyyy-MM-dd','ng-model'=>'date','required']) !!}
        {!! $errors->first('date', '<span class="help-block">:message</span>') !!} 
        </div>
</div>

<div id="" class="date_activity form-group {{ $errors->has('time') ? 'has-error' : ''}}">
        {!! Form::label('time','Time:', ['class' => 'col-md-2 control-label']) !!}
        <div  class="input-append input-group date col-md-10 timepicker">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-time"></span>
        </span> 
        {!! Form::text('time', null, ['class'=> 'form-control', 'data-format'=>'hh:mm:ss', 'ng-model'=>'time', 'required']) !!}
        {!! $errors->first('time', '<span class="help-block">:message</span>') !!} 
        </div>
</div>

<div class="col-md-2"> </div>
<div class="form-group col-md-8">
    {!! Form::submit('Save',  ['class'=> 'btn btn-primary']) !!}
</div>