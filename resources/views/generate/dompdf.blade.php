<html>
<head>
<style>
html{	
  margin: 5px;
  margin-left: 12px;
  margin-right: 12px;
}
body{
  font-family: Helvetica;
  font-size: 13px;
  border:;
  /*border: 1px solid #000;*/
}
ul.main-info{
  list-style: none;
  margin-bottom: 5px;
}
/*.prescriber_no{
	border-bottom: 1px solid #000;
}*/

.header{
	border-bottom: 1px solid #000;
}
.main-content{
	padding-top: 10px;
}

.main-content label{
	margin-bottom: 4px;
	margin-top: 4px;
	display: block;
	line-height: 12px;
	font-size: 12px;
}
.detail-form td{
	padding: 0;
}
.detail-form label{	
	width: 90px;
}

input[type="text"]{
	border: 1px solid #000;
    height: 25px;
    margin-top: 2px;
}
#header-col-1,
#header-col-2{
    width: 400px;
    height: 118px;
    position: relative;
}
table{	
	border-collapse: collapse;
}
.column{
    width: 400px;
}
.qcode_top{
	position: absolute;
    right: 8px;
    top: 20px;
}
.qcode_bottom{
	margin-top: 10px;
}
</style>
</head>

<body>

  <div class="header">
  	<table>
  		<tr>
  			<td>
  				<div id="header-col-1">
			  	  <ul class="main-info">
				    <li><strong>Dr Rodney Beckwith</strong></li>
				    <li>Riverside ParkOffice Tower</li>
				    <li>69 Central Coast Hwy</li>
				    <li>West Gosford 2250</li>
				    <li>Ph: 0243041333</li>
				    <li>Prescriber No: 2123963</li>
				  </ul>
				</div>
  			</td>
  			<td>
  				<div id="header-col-2">
			  	  <ul class="main-info">
				    <li><strong>Dr Rodney Beckwith</strong></li>
				    <li>Riverside ParkOffice Tower</li>
				    <li>69 Central Coast Hwy</li>
				    <li>West Gosford 2250</li>
				    <li>Ph: 0243041333</li>
				    <li>Prescriber No: 2123963</li>
				  </ul>
				  <img class="qcode_top" src="images/bar-code.png" >
				</div>
  			</td>
  		</tr>
  	</table>	
  </div>
  <div class="main-content">
  	<table>
  		<tr>
  			<td>
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
				  		<tr>
				  			<td width="20%">
				  				
				  			</td>
				  			<td width="80%">
				  				<strong>Product Name</strong> <br />
				  				Quantity 12 - 2 repeats
				  			</td>
				  		</tr>
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
				  	<img class="qcode_bottom" src="images/er_code.png" >
			  	</div>
		  	</td>
		  	<!-- 2nd Column here -->
		  	<td>
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
				  		<tr>
				  			<td width="20%">
				  				
				  			</td>
				  			<td width="80%">
				  				<strong>Product Name</strong> <br />
				  				Quantity 12 - 2 repeats
				  			</td>
				  		</tr>
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
				  	<img class="qcode_bottom" src="images/er_code.png" >
			  	</div>
		  	</td>
	  	</tr>
  	</table>
  </div>
</body>
</html>