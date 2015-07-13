
<div id="appointment">
	Appointment date is
	<span class="date">@{{date}}<br/>@{{time}}</span>
	with
	<img src="images/doctor-pic.jpg" alt="" class="image"/>
	<p class="name"><span>Dr. Rodney Beckwith</span><em>Family Medicine</em></p>
</div><!-- END appointment -->

<div id="pricing">
	<p><span>$@{{paid}}</span>100% Satisfaction Guarenteed</p>
</div><!-- END pricing -->

<div id="billing" class="clearfix">
	<form id="eway-form" method="POST">
		<p class="titlebar">Enter credit card details</p>
		 <label class="textbox name">
	        Customer Details
	    </label><br />
		<select placeholder="Title" id="ddlTitle" name="ddlTitle" class="textbox">
	        <option></option>
	        <option value="Mr." selected="selected">Mr.</option>
	        <option value="Miss">Miss</option>
	        <option value="Mrs.">Mrs.</option>
        </select>
		<!-- <input type="text" placeholder="Name on card" class="textbox name"/>
		<input type="text" placeholder="Card number" class="textbox card"/>
		<input type="text" placeholder="Expiry date (mm/yy)" class="textbox expiry"/>
		<input type="text" placeholder="CVV" class="textbox cvv"/> -->
		<input id="txtCustomerRef" placeholder="Customer Reference" class="textbox" name="txtCustomerRef" type="text" value="A12345" />
		    
        <input id="txtFirstName" placeholder="First Name" class="textbox" name="txtFirstName" type="text" value="John" />

        <input id="txtLastName" placeholder="Last Name" class="textbox" name="txtLastName" type="text" value="Doe" />
        <label class="textbox name">
	        Customer Address
	    </label><br />
        <input id="txtStreet" placeholder="Street" class="textbox" name="txtStreet" type="text" value="15 Smith St" />
        <input id="txtCity" placeholder="City" class="textbox" name="txtCity" type="text" value="Phillip" />
        <input id="txtState" placeholder="State" class="textbox" name="txtState" type="text" value="ACT" />
    	<input id="txtPostalcode" placeholder="Post Code" class="textbox" name="txtPostalcode" type="text" value="2602" />
    	<input id="txtCountry" placeholder="Country" class="textbox" name="txtCountry" type="text" value="au" maxlength="2" />
    	<input id="txtEmail" placeholder="Email" class="textbox" name="txtEmail" type="text" value="" />
    	<input id="txtMobile" placeholder="Mobile" class="textbox" name="txtMobile" type="text" value="1800 10 10 65" />
    	<textarea id="txtComments" placeholder="Comments" class="textbox" name="txtComments"/>Some comments here</textarea>
    
	    <label class="card textbox">
	        Customer Card Details
	    </label><br />
	    <input type='text' placeholder="Card Holder" class="textbox" name='txtCardName' id='txtCardName' value="TestUser" />
	    <input type='text' placeholder="Card Number" class="textbox" name='txtCardNumber' id='txtCardNumber' value="4444333322221111" />
	    <label class="card textbox" for="ddlCardExpiryMonth">
            Expiry Date</label><br />
        <select class="textbox" ID="ddlCardExpiryMonth" name="ddlCardExpiryMonth">
            <?php
                $expiry_month = date('m');
                for($i = 1; $i <= 12; $i++) {
                    $s = sprintf('%02d', $i);
                    echo "<option value='$s'";
                    if ( $expiry_month == $i ) {
                        echo " selected='selected'";
                    }
                    echo ">$s</option>\n";
                }
            ?>
        </select>
        <select  class="textbox" ID="ddlCardExpiryYear" name="ddlCardExpiryYear">
            <?php
                $i = date("y");
                $j = $i+11;
                for ($i; $i <= $j; $i++) {
                    echo "<option value='$i'>$i</option>\n";
                }
            ?>
        </select>
        <br />
         <label class="card textbox">
	        CVN
	    </label><br />
	    <input type='text' placeholder="CVN" class="textbox" name='txtCVN' id='txtCVN' value="123" maxlength="4" /> <!-- This field is optional but highly recommended -->
	    

		<div class="transactioncustomer">
		    <div class="header first">
		        Request Options
		    </div>
		    <div class="fields">
		        <label for="ddlSandbox">API Sandbox</label>
		        <select id="ddlSandbox" name="ddlSandbox">
		        <option value="1" selected="selected">Yes</option>
		        <option value="">No</option>
		        </select>
		    </div>
		    <div class="fields">
		        <label for="ddlMethod">Payment Method</label>
		        <select id="ddlMethod" name="ddlMethod" style="width: 140px" onchange="onMethodChange(this.options[this.options.selectedIndex].value)">
		            <option value="ProcessPayment">ProcessPayment</option>
		            <option value="TokenPayment">TokenPayment</option>
		            <option value="CreateTokenCustomer">CreateTokenCustomer</option>
		            <option value="UpdateTokenCustomer">UpdateTokenCustomer</option>
		            <option value="Authorise">Authorise</option>
		        </select>
		    </div>
		    <script>
		        function onMethodChange(v) {
		            if (v == 'ProcessPayment' || v == 'Authorise' || v == 'TokenPayment') {
		                jQuery('#payment_details').show();
		            } else {
		                jQuery('#payment_details').hide();
		            }
		        }
		    </script>

		  <div id='payment_details'>
		    <div class="header">
		        Payment Details
		    </div>
		    <div class="fields">
		        <label for="txtAmount">Amount &nbsp;<img src="../assets/Images/question.gif" alt="Find out more" id="amountTipOpener" border="0" /></label>
		        <input id="txtAmount" name="txtAmount" type="text" value="100" />
		    </div>
		    <div class="fields">
		        <label for="txtCurrencyCode">Currency Code </label>
		        <input id="txtCurrencyCode" name="txtCurrencyCode" type="text" value="AUD" />
		    </div>
		    <div class="fields">
		        <label for="txtInvoiceNumber">Invoice Number</label>
		        <input id="txtInvoiceNumber" name="txtInvoiceNumber" type="text" value="Inv 21540" />
		    </div>
		    <div class="fields">
		        <label for="txtInvoiceReference">Invoice Reference</label>
		        <input id="txtInvoiceReference" name="txtInvoiceReference" type="text" value="513456" />
		    </div>
		    <div class="fields">
		        <label for="txtInvoiceDescription">Invoice Description</label>
		        <input id="txtInvoiceDescription" name="txtInvoiceDescription" type="text" value="Individual Invoice Description" />
		    </div>
		    <!-- <div class="header">
		        Custom Fields
		    </div>
		    <div class="fields">
		        <label for="txtOption1">Option 1</label>
		        <input id="txtOption1" name="txtOption1" type="text" value="Option1" />
		    </div>
		    <div class="fields">
		        <label for="txtOption2">Option 2</label>
		        <input id="txtOption2" name="txtOption2" type="text" value="Option2" />
		    </div>
		    <div class="fields">
		        <label for="txtOption3">Option 3</label>
		        <input id="txtOption3" name="txtOption3" type="text" value="Option3" />
		    </div> -->
		  </div> <!-- end for <div id='payment_details'> -->
		</div>
		<div class="transactioncard">

		    <div class="fields hide">
		        <label for="txtTokenCustomerID">Token Customer ID &nbsp;<img src="../assets/Images/question.gif" alt="Find out more" id="tokenCustomerTipOpener" border="0" /></label>
		        <input id="txtTokenCustomerID" name="txtTokenCustomerID" type="text" />
		    </div>
		        

		    
		    <div class="fields hide">
		        <label for="ddlStartMonth">
		            Valid From Date</label>
		        <select ID="ddlStartMonth" name="ddlStartMonth">
		            <?php
		                $expiry_month = "";//date('m');
		                echo  "<option></option>";

		                for($i = 1; $i <= 12; $i++) {
		                    $s = sprintf('%02d', $i);
		                    echo "<option value='$s'";
		                    if ( $expiry_month == $i ) {
		                        echo " selected='selected'";
		                    }
		                    echo ">$s</option>\n";
		                }
		            ?>
		        </select>
		        /
		        <select ID="ddlStartYear" name="ddlStartYear">
		            <?php
		                $i = date("y");
		                $j = $i-11;
		                echo  "<option></option>";
		                for ($i; $i >= $j; $i--) {
		                    $year = sprintf('%02d', $i);
		                    echo "<option value='$year'>$year</option>\n";
		                }
		            ?>
		        </select>
		    </div>
		    <div class="fields hide">
		        <label for="txtIssueNumber">
		            Issue Number</label>
		        <input type='text' name='txtIssueNumber' id='txtIssueNumber' value="22" maxlength="2" style="width:40px;"/> <!-- This field is optional but highly recommended -->
		    </div>
		    <div class="hide">
			    <div class="header">
			        Others
			    </div>
			    <div class="fields">
			        <label for="ddlTransactionType">Transaction Type</label>
			        <select id="ddlTransactionType" name="ddlTransactionType" style="width:140px;">
			        <option value="Purchase">Ecommerce</option>
			        <option value="MOTO">MOTO</option>
			        <option value="Recurring">Recurring</option>
			        </select>
			    </div>
		    </div>
		</div>
	</form>
</div><!-- END billing -->

<input type="button" checkout-click value="Checkout" class="redBtn"/>

<div id="paymentMethods">
	<ul>
		<li><img src="images/visa-card.png" alt=""/></li>
		<li><img src="images/master-card.png" alt=""/></li>
		<li><img src="images/e-way.png" alt=""/></li>
	</ul>
</div><!-- END paymentMethods -->

	<div id="maincontent">
		
	</div>