    
<!-- <div class="form-group row">
        {!! Form::label('username','Username:', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
          <input type="text" id="username" value="@{{username}}" class="form-control" />
        </div>
   </div> -->

   <div class="form-group row">
        {!! Form::label('first_name','First Name:', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
        <input type="text" id="first_name" value="@{{first_name}}" class="form-control" />
        </div>
   </div>

      <div class="form-group row">
        {!! Form::label('last_name','Last Name:', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
        <input type="text" id="last_name" value="@{{last_name}}" class="form-control" />
        </div>
   </div>

   <div class="form-group row">
        {!! Form::label('email','Email:', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
        <input type="text" id="email" value="@{{email}}" class="form-control" />
        </div>
   </div>  
<!--
   <div class="form-group row {{ $errors->has('password') ? 'has-error' : ''}}">
        {!! Form::label('password','Password:', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
        {!! Form::password('password', ['class'=> 'form-control']) !!}
        {!! $errors->first('password', '<span class="help-block">:message</span>') !!} 
        </div>
   </div>

     <div class="form-group row {{ $errors->has('confirmpass') ? 'has-error' : ''}}">
        {!! Form::label('password_confirmation','Confirm Password:', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
        {!! Form::password('password_confirmation', ['class'=> 'form-control']) !!}
        {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!} 
        </div>
   </div>-->
 <div class="form-group row">
        {!! Form::label('role', 'Role',['class'=>'col-md-3 control-label']) !!}
              <div class="col-md-6">   
              {!! Form::select('role', $roles, $selected_role,['class'=>'form-control']) !!}
              </div>
            </div>
   <div class="form-group row">
      <div class="col-md-12" align="center">
        <input type="button" id="save_btn" value="Save" class="btn btn-primary"/>
        </div>
   </div>
 
