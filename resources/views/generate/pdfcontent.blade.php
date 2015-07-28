<div class="column">
  	<label class="med-num">Patient's Medicare No:</label>
  	<table width="100%" class="detail-form">
  		<tr>
  			<td>
  				<label>Pharmaceutical<br />benefits<br />entitlement no.</label>
  			</td>
  			<td><input style="width:300px" type="text" id="entitlement_no" /></td>
  		</tr>
  		<tr>
  			<td>
  				<label></label>
  			</td>
  			<td>
  				<table>
  					<tr>
  						<td><input type="text" id="safety_net" style="width:25px"></td>
  						<td>
  							<span style="font-size: 10px">PBS Safey Net entitlement cardholder (cross relevant box)</span>
  						</td>
  						<td><input type="text" id="safety_net" style="width:25px"></td>
  						<td>
  							<span style="font-size: 10px">PBS Safey Net entitlement cardholder (cross relevant box)</span>
  						</td>
  					</tr>
  				</table>
  			</td>
  		</tr>
  	</table>
  	<table width="100%" class="detail-form">
  		<tr>
  			<td>
  				<label>Patient's name</label>
  			</td>
  			<td width="90%"><strong>{{$data[0]['name']}}</strong></td>
  		</tr>
  		<tr>
  			<td valign="top">
  				<label>Address</label>
  			</td>
  			<td width="90%">{{ $data[0]['street'] }} <br />{{ $data[0]['city'] }} 
  			<br /> {{ $data[0]['country']}} , {{$data[0]['region']}} {{$data[0]['postcode']}}

  			</td>
  		</tr>
  	</table>
  	<table width="100%" class="detail-form">
  		<tr>
  			<td>
  				<label>Date</label>
  			</td>
  			<td width="90%">14/07/2015</td>
  			<td>
  				<label>Script ID:</label>
  			</td>
  			<td width="90%">257769</td>
  		</tr>
  	</table>
  	<table width="100%" class="detail-form">				  		
  		<tr>
  			<td valign="center">
  				<label>PBS</label>
  			</td>
  			<td>XXXXXXXXXX</td>
  			<td>
					<input type="text" id="safety_net" style="width:25px"></td>
				<td>
					<span style="font-size: 12px"><strong>Brand substitution not permitted</strong></span>
				</td>
  		</tr>
  	</table>
  	<table style="margin-top:10px;" width="100%" class="detail-form">
  		@foreach($data as $item)		
  			@if($item['type']=='simple')  		
	  		<tr>
	  			<td width="20%">
	  				
	  			</td>
	  			<td width="80%">
	  				<strong>{{ $item['product'] }}</strong> <br />
	  				Quantity 1 - x repeats
	  			</td>
	  		</tr>
	  		@else
	  		<tr>
	  			<td width="20%">
	  				
	  			</td>
	  			<td width="80%">
	  				<strong>{{ $item['product'] }}</strong> <br />
	  			</td>
	  		</tr>
	  		@endif
  		@endforeach
  	</table>
  	<table style="margin-top:50px;" width="100%" class="detail-form">				  		
  		<tr>
  			<td width="20%">
  				
  			</td>
  			<td width="80%">
  				<strong>Dr Rodney Beckwith</strong> <br />
  				MBBS FRACGP 
  			</td>
  		</tr>
  	</table>
  	<!-- <img class="qcode_bottom" src="images/er_code.png" > -->
	</div>