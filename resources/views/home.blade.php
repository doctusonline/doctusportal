@extends('defaultportal')

@section('headtitle') 
    Profile
@endsection
@section('content')
<div class="">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
				<p><img width="100px" src="{{$filename}}" /><br />
					Profile
					</p>

					<p><strong>Priorities:</strong></p>

					<p>There are @{{awaiting_count}} orders awaiting for your review</p>

					<p><strong>Recent Activity</strong></p>
					<ul>
					@foreach($tracks as $item)
				        <li>Dr. {{$item->user[0]->last_name}} <span class="capitalize">{{str_replace('_',' ',$item->status_code)}}</span> Order #{{$item->order_id_mage}} - {{$item->created_at}}</li>
				    @endforeach
				    </ul>
					<p>Dr Beckwith Approved Archie’s STD Prescription order request <br />
					- 7 days ago</p>

					<p>Dr Beckwith Approved Archie’s STD Prescription order request <br />
					- 7 days ago</p>


				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('/js/angular/controllers/profile.js') }}"></script>
@endsection
