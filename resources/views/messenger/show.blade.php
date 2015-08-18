@extends('master')

@section('content')
    <div class="col-md-6">
        <h1>{!! $thread->subject !!}</h1>
        <div class="message-wrapper">
        @foreach($thread->messages as $message)

            <div class="media {!! ($message->user->id == Auth::user()->id) ? 'mine':'' !!}">
               <!--  <a class="pull-left" href="#" title="{!! $message->user->first_name !!}">
                    <img width="35px" src="{!!get_avatar($message->user->id)!!}" title="{!! $message->user->first_name !!}" alt="{!! $message->user->first_name !!}" class="img-circle">
                </a> -->
                <div class="media-body">
                    <!-- <h5 class="media-heading">{!! $message->user->first_name !!}</h5> -->
                    <p>{!! $message->body !!}</p>
                    <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                </div>
            </div>
        @endforeach
        </div>
        <!-- <h2>Add a new message</h2> -->
        {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
        <!-- Message Form Input -->
        <div class="form-group message-box">
            {!! Form::textarea('message', null, ['class' => 'form-control', 'rows'=>2, 'placeholder'=>'Write a reply...']) !!}
            {!! Form::submit('Send', ['class' => 'btn btn-primary form-control']) !!}
        </div>

        @if($users->count() > 0)
        <div class="checkbox">
            @foreach($users as $user)
                <label title="{!! $user->first_name !!}"><input type="checkbox" name="recipients[]" value="{!! $user->id !!}">{!! $user->first_name !!}</label>
            @endforeach
        </div>
        @endif

        <!-- Submit Form Input -->
       <!--  <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
        </div> -->
        {!! Form::close() !!}
    </div>
@stop