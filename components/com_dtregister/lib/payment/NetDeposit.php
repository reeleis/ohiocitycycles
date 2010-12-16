<?php

require_once( JPATH_SITE.'/components/com_dtregister/lib/class.payment.php');

class NetDeposit extends Payment{

     

	 var $clientId ;

	 var $clientCode ;

	 var $acctNum ;

	 var $credircardNo = '';

	 var $credircardExp = '' ;

	 var $cardtype = '' ;

	 var $url = 'https://secure.modpay.com/payonline/postPayment.cfm';

	 var $bywebservice =  true ;

	 var $godaddy_hosting =  0 ;

	 var $component_tasks =  array('registeration'=>'payment','duepay'=>'due_payment','change'=>'paymentchanges','cancel'=>'paymentchanges');

	 

	 

	 function NetDeposit(){

	     

		  global $netdeposit_clientid , $netdeposit_clientcode ,$netdeposit_acctnum , $godaddy_hosting;

		  parent::__construct();

		  $this->clientId = $netdeposit_clientid ;

		  $this->clientCode = $netdeposit_clientcode ;

		//  $this->acctNum = $netdeposit_acctnum ;

		  

		  $this->godaddy_hosting = $godaddy_hosting ;

		 

	 }

	 

	 function beforepayment(){

	    

	 }

	 

	 function setfields(){

	  

	   $expiry =  explode('/',$this->x_exp_date);

	   $this->fields['clientId'] = $this->clientId ;

	   $this->fields['clientCode'] = $this->clientCode ;

	   $this->fields['paymentMethod'] = 'CR' ;

	   $this->fields['amountOwed'] = $this->cart->getAmount() ;

	   $this->fields['CreditCardNum'] = $this->x_card_num ;

	   $this->fields['CardHolder'] = $this->firstname.' '.$this->lastname ;

	   $this->fields['ExpMonth'] =  $expiry[0];

	   $this->fields['ExpYear'] = "20". $expiry[1];

	   $this->fields['acctNum'] = (!isset($this->confirmNum)|| $this->confirmNum=="")?'':$this->confirmNum;

//	   $this->fields['CompanyName'] = $this->organization ;

	   $this->fields['FirstName'] = $this->firstname ;

	  // $this->fields['MiddleInitial'] = $this->clientId ;

	   $this->fields['LastName'] = $this->lastname ;

	   $this->fields['Address'] = $this->address ;

	   $this->fields['City'] = $this->city ;

	   $this->fields['State'] = $this->state ;

	   $this->fields['ZipCode'] = $this->zipcode ;

	  // $this->fields['Phone'] = $this->phone ;

	   $this->fields['Email'] = $this->email ;

	   //$this->fields['DateOfBirth'] = $this->clientId ;

	   //$this->fields['Credit'] = 0 ;

	   

	   

	   

	 }

	 

	 

	 function formatPostfields(){

	     

		 $fields = "";



         foreach( $this->fields as $key => $value ){ 

		    if(trim($value)!="")

		    $fields .= "$key=" . urlencode( $value ) . "&";

		 }

	     return $fields ;

	 }

	 

	 

	 

	 function process(){

	    

		$this->setfields();

		

		$fields =  $this->formatPostfields();
		$ch = curl_init($this->url);

		

		if($this->godaddy_hosting){



			curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);

		

			curl_setopt ($ch, CURLOPT_PROXY,"http://proxy.shr.secureserver.net:3128");

		

		}

		

		curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response

        

		//curl_setopt($ch, CURLOPT_VERBOSE, 1);

		

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)

		

		curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $fields, "& " )); // use HTTP POST to send form data

		

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response. ###

		

		$resp = curl_exec($ch); //execute post and get results

		//var_dump($resp);

		

		$gatewaydata = $this->parseResponse($resp);

		

		//prd($gatewaydata);

		

		if($gatewaydata['Return_Code']==0){

		   $this->transactionId = $gatewaydata['TransactionID'] ;
		   DT_Session::set('register.payment.transactionId',$this->transactionId);

		   return 1 ;

		}else{

		   //$this->transactionId = $gatewaydata['TransactionID'] ;

		    return false ;

		}

		



		

		

		

	 }

	 

	 function parseResponse($resp){

	     

		$return =  preg_match("/(?<=\<body.>)(.*)(?=\<\/body\>)/sm",$resp,$matches);

		 

		

		 

		 $array = explode('<br>',trim($matches[0]," \t\n\r\0\x0B"));

		

	

		 $gatewaydata =  array();

		 foreach($array as $value){

		   

		     $data = explode('=',$value,2);

			
            if(isset($data[1]) &&trim($data[1]) != "" && str_replace(" ","_",trim($data[0])) != "")
			 @$gatewaydata[str_replace(" ","_",trim($data[0]))] = trim($data[1]);

			 

			

		 }

		 return $gatewaydata ;

	 }

	 

	 

	 

	 function setformData(){

	     $this->billing_form = $this->billingform();

		 $this->getLoginUserData();

	 }

	 

	 function billingform(){

	    

		

		 $form =  parent::billingform();

		 ob_start();

		 ?>

             <tr>



		          <td width="31%" ><?php echo JText::_( 'CARD_NUMBER' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>



		         <td width="69%" align="left" ><input type="text" name="billing[x_card_num]" onKeyUp="chknumber(this)" class="inputbox" value="<?php echo isset($this->credircardNo)?$this->credircardNo:''; ?>" />



		              <br />



		            <?php echo JText::_( 'CARD_NUMBER_EXPLANATION' );?></td>



		        </tr>

                

                 <tr>



		          <td width="31%" ><?php echo JText::_( 'CARD_EXPIRY_DATE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>



		          <td width="69%" align="left" ><input type="text" name="billing[x_exp_date]" value="<?php echo isset($this->credircardExp)?$this->credircardExp:''; ?>" class="inputbox" />



		            &nbsp;&nbsp;(mm/yy)</td>



		        </tr>

                

                 <tr>



		          <td width="31%" ><?php echo JText::_( 'CVV_CODE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>



		         <td width="69%" align="left" ><input type="text" name="billing[x_card_code]" size="10" onKeyUp="chknumber(this)" class="inputbox" value="<?php echo isset($this->x_card_code)?$this->x_card_code:'' ; ?>" />



		            <?php echo JText::_( 'CVV_CODE_EXPLANATION' );?> </td>



		        </tr>

            

                

		 <?php

		 $html = ob_get_clean();

		 

		 return $form.$html ; 

		 	 

	 }

	 

	 function drawform(){

	    

		global $cardtype ,$save_payment_info ,$cardtype ,$cb_integrated ;

		

		ob_start();

		 

		 ?>

         

           <table>

             <?php

                 echo  $this->billingform();

			 ?>

		     

                 <tr>



		          <td width="31%" ><?php echo JText::_( 'CARD_NUMBER' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>



		         <td width="69%" align="left" ><input type="text" name="x_card_num" onKeyUp="chknumber(this)" class="inputbox" value="<?php echo isset($this->credircardNo)?$this->credircardNo:''; ?>" />



		              <br />



		            <?php echo JText::_( 'CARD_NUMBER_EXPLANATION' );?></td>



		        </tr>

                

                 <tr>



		          <td width="31%" ><?php echo JText::_( 'CARD_EXPIRY_DATE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>



		          <td width="69%" align="left" ><input type="text" name="x_exp_date" value="<?php echo isset($this->credircardExp)?$this->credircardExp:''; ?>" class="inputbox" />



		            &nbsp;&nbsp;(mm/yy)</td>



		        </tr>

                

                 <tr>



		          <td width="31%" ><?php echo JText::_( 'CVV_CODE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>



		         <td width="69%" align="left" ><input type="text" name="x_card_code" size="10" onKeyUp="chknumber(this)" class="inputbox" value="<?php echo ($this->x_card_code)?$this->x_card_code:'' ; ?>" />



		            <?php echo JText::_( 'CVV_CODE_EXPLANATION' );?> </td>



		        </tr>

                <?php



				$my = &JFactory::getUser();



				if ($cb_integrated == 1 && $save_payment_info == 1 && $my->id){?>



	    		<tr>



			    	<td><?php echo JText::_( 'DT_SAVE_INFO' ); ?>: </td>



			    	<td> <input type="checkbox" name="ckb_save_info" value="1" /> <?php echo JText::_( 'DT_SAVE_INFO_FUTURE' );?> </td>



			    </tr>



				<?php } ?>

                

                 <tr>



		          <td>



                  <input type="button" onclick="this.form.type.value='back';this.form.submit();" class="button" value="<?php echo JText::_('DT_BACK'); ?>" id="next" name="billingInfo"/>



                  <input type="button" name="send" value="<?php echo JText::_('DT_NEXT_BUTTON'); ?>" class="button" onclick="sendPayment();" /></td>



		          <td align="left" >
                 

                  

                  </td>



		        </tr>



		        </table>



		        </form>

          

         

          	<script language="javascript" type="text/javascript">

                    //<![CDATA[

					function chknumber(txtname){



						var num = txtname.value



					    if(isNaN(num)){



							alert("<?php echo JText::_( 'DT_NUMBERS_ONLY' ); ?>");



							txtname.value = "";



					    	txtname.focus();



						}



					}



					function sendPayment(){



						var form=document.frmcart;



						<?php



						if($_SESSION['register']['memtot']==1){



						?>



						if(form.billing_firstname.value==""){



							alert ("<?php echo JText::_( 'DT_CARD_FIRSTNAME_ERROR' ); ?>");



							form.billing_firstname.focus();



							return ;



						}



						if(form.billing_address.value==""){



							alert ("<?php echo JText::_( 'DT_ADDRESS_ERROR' ); ?>");



							form.billing_address.focus();



							return ;



						}



						if(form.billing_city.value==""){



							alert ("<?php echo JText::_( 'DT_CITY_ERROR' ); ?>");



							form.billing_city.focus();



							return ;



						}



						if(form.billing_state.value==""){



							alert ("<?php echo JText::_( 'DT_STATE_ERROR' ); ?>");



							form.billing_state.focus();



							return ;



						}



						if(form.billing_zipcode.value==""){



							alert ("<?php echo JText::_( 'DT_ZIP_ERROR' ); ?>");



							form.billing_zipcode.focus();



							return ;



						}



						if(form.billing_email.value==""){



							alert ("<?php echo JText::_( 'DT_EMAIL_ERROR' ); ?>");



							form.billing_email.focus();



							return ;



						}



						<?php



						}



						?>



						



						



						if(form.x_card_num.value==""){



							alert ("<?php echo JText::_( 'DT_CARD_NUMBER' ); ?>");



							form.x_card_num.focus();



							return ;



						}



						if(form.x_exp_date.value==""){



							alert ("<?php echo JText::_( 'DT_CARD_EXPIRE_DATE' ); ?>");



							form.x_exp_date.focus();



							return ;



						}



						if(form.x_card_code.value==""){



							alert ("<?php echo JText::_( 'DT_CARD_CODE' ); ?>");



							form.x_card_code.focus();



							return ;



						}



						confirmText = "<?php echo JText::_( 'DT_CONFIRM_CC_INFO' ); ?>\n\n";



						

						

						

						confirmText = confirmText+"<?php echo JText::_( 'CARD_NUMBER' ); ?>: "+form.x_card_num.value+"\n";



						confirmText = confirmText+"<?php echo JText::_( 'CARD_EXPIRY_DATE' ); ?>: "+form.x_exp_date.value+"\n";



						confirmText = confirmText+"<?php echo JText::_( 'CVV_CODE' ); ?>:\t "+form.x_card_code.value+"\n";

						

						confirmText = confirmText+"<?php echo JText::_( 'DT_AMOUNT' ); ?>:\t <?php echo $this->amount; ?>";



						var answer = confirm(confirmText);



						if (answer){



							form.submit();



						}



					}



				</script>

          

          

                

        <?php

		return ob_get_clean();

		

	 }

	

	 

}

?>