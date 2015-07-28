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
				 <!--  <img class="qcode_top" src="{{ asset('/images/bar-code.png') }}" > -->
				</div>
  			</td>
  		</tr>
  	</table>	
  </div>
  <div class="main-content">
  	<table>
  		<tr>
  			<td>
  				 @include('generate.pdfcontent')
		  	</td>
		  	<!-- 2nd Column here -->
		  	<td>
  				@include('generate.pdfcontent')
		  	</td>
	  	</tr>
  	</table>
  </div>
</body>
</html>