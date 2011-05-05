<?php

/**
* @version 2.7.3
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

	$document =& JFactory::getDocument();

	$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/dt_jquery.js');

	$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/validate.js');
	$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/validationmethods.js');
   
    $row = $this->row;
	$currency= $this->getModel('currency');
 
 $config = $this->getModel('config');
 $paymentmethod = $this->getModel('paymentmethod');
 $cardtype = $this->getModel('cardtype');
 $paylater = $this->getModel('paylater');
  
 ?>
<script type="text/javascript">

 
 DTjQuery(function(){
   //DTjQuery.validator.messages.required = " ";

    DTjQuery(document.adminForm).validate({
		    rules :{
			      "data[paylater][]"	: {
					   uniquevalue : true ,
					   required : true
					  }
			},
	        success: function(label) {
				label.addClass("success");
			}

	});

 })

function submitbutton(pressbutton){
    if(pressbutton != 'cancel'){
		if(DTjQuery(document.adminForm).valid()){
		 submitform(pressbutton);
		}
	}else{
	  submitform(pressbutton);	
	}

}

</script>  

<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

<table class="adminform" width="100%" cellpadding="10" cellspacing="10">
 <tr>

      <td><strong><?php echo JText::_( 'DT_PAYMENT_NAME'); ?></strong></td>

       <td><input type="text" size="30" name="data[payment][name]" value="<?php echo $row->name?>" />
           <input type="hidden" size="30" name="data[payment][id]" value="<?php echo $row->id?>" /> 
           <input type="hidden" size="30" name="data[payment][default]" value="<?php echo $row->default; ?>" />
           </td>
       
       <td><?php echo JHTML::tooltip((JText::_( 'DT_PAYMENT_NAME_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

       <td rowspan="3"> </td>

   </tr>
   
    <tr align="center" valign="middle">
	
	  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_CURRENCY_CODE' );?>:</strong></td>

      <td align="left" valign="top">

		<?php			

			$options=DtHtml::options($currency->getCurrency());

			if(!isset($row->config['currency_code']) || $row->config['currency_code']==""){
				$currency_code='USD';
			}else{

			   $currency_code = $row->config['currency_code'];

			}

			echo JHTML::_('select.genericlist', $options,'data[config][currency_code]','','value','text',$currency_code);

         ?>

	  </td>

      <td><?php echo JHTML::tooltip((JText::_( 'DT_CURRENCY_CODE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

    </tr>
    
    <tr align="center" valign="middle">
	
	    <td align="left" valign="top"><strong><?php echo JText::_( 'CURRENCY_SEPARATOR' );?>:</strong></td>

		<td align="left" valign="top">

                <?php

                   	$options=array();
					$options[]=JHTML::_('select.option', '0', JText::_( 'NONE' ));
					$options[]=JHTML::_('select.option', '1', JText::_( 'COMMA' )." ( , )");

					$options[]=JHTML::_('select.option', '2', JText::_( 'DOT' )." ( . )");
                     if(!isset($row->config['currency_separator']) || $row->config['currency_separator']==""){
						 $currency_separator=2;
					}else{

			             $currency_separator = $row->config['currency_separator'];

			         }
					echo JHTML::_('select.genericlist', $options, 'data[config][currency_separator]',' ', 'value','text', $currency_separator);

				?>

		</td>

		<td><?php echo JHTML::tooltip((JText::_( 'CURRENCY_SEPARATOR_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

    </tr>
                 <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'DT_GENERAL_PAY_OPTIONS' ); ?></td></tr>

								 <!-- ********** General Payment Options ******************	-->
<tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PAYMENT_MODE' );?>:</strong></td>

							    <td align="left" valign="top">

							    <?php

								    $options=array();

								    $options[]=JHTML::_('select.option', 'test', JText::_( 'DT_TEST' ));

								    $options[]=JHTML::_('select.option', 'live', JText::_( 'DT_LIVE' ));

								    echo JHTML::_('select.genericlist', $options,'data[config][paymentmode]','','value','text',$row->config['paymentmode']);

							     ?>

							    </td>

								  <td><?php echo JHTML::tooltip((JText::_( 'DT_PAYMENT_MODE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
								
								<td rowspan="2" valign="top">&nbsp;</td>

							  </tr>
							   <tr align="center" valign="middle">

                                 <td width="210" align="left" valign="top"><strong><?php echo JText::_( 'PAYMENT_METHOD' ); ?>:</strong></td>

							     <td width="200" align="left" valign="top">

							     <!-- Here we will need to select payment methods-->

							     <?php
                                   
                                   //Create the selected array
								  
                                    $options=DtHtml::options($paymentmethod->getMethods());
									
									echo JHTML::_('select.genericlist', $options,'data[config][paymentmethod][]',' multiple=true ', 'value','text',isset($row->config['paymentmethod'])?$row->config['paymentmethod']:array());

							     ?>

							     </td>

								   <td width="40"><?php echo JHTML::tooltip((JText::_( 'DT_PAYMENT_METHOD_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							   </tr>

							   <!-- *************** Authorize.net Options **************** -->

                 <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'AUTH_NET' ); ?></td></tr>

	 						 	 <tr align="center" valign="middle">

                     <td align="left" valign="top">

										 <strong><?php echo JText::_( 'DT_MERCHANT_ID' ); ?>:</strong>

										 </td>

									   <td align="left" valign="top"> <input type="text" name="data[config][merchid]" size="30" value="<?php echo  $row->config['merchid']; ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_MERCHANT_ID' )), '', 'tooltip.png', '', ''); ?> </td>
										 									   
									   <td valign="top" rowspan="3"><?php echo JText::_( 'DT_NOTES_AUTHNET' ) ;?></td>

								 </tr>

								 <tr align="center" valign="middle">

                     <td align="left" valign="top"><strong><?php echo JText::_( 'DT_TRANS_KEY' ); ?>:</strong></td>

									   <td align="left" valign="top">	<input type="text" name="data[config][transkey]" size="30" value="<?php echo  $row->config['transkey']; ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_TRANS_KEY' )), '', 'tooltip.png', '', ''); ?> </td>

								</tr>

								<tr align="center" valign="middle">  
									
								<td align="left" valign="top"><strong><?php echo JText::_( 'DT_CARD_TYPE' ); ?>:</strong></td>

							    <td align="left" valign="top">
                                <?php
								 echo DtHtml::checkboxList('data[config][cardtype]',$cardtype->gettypes(),$row->config['cardtype']);
								?>
                               </td>

									<td><?php echo JHTML::tooltip((JText::_( 'DT_CARD_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							  </tr>
							  
							  <!-- *************** Google Checkout Options ***************	-->
							  
							  <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'DT_GOOGLE_CHECKOUT' ); ?></td></tr>
                                 
                 <tr align="center" valign="middle">

                     <td align="left" valign="top">

										 <strong><?php echo JText::_( 'DT_GOOGLE_MERCHANT_ID' ); ?>:</strong>

										 </td>

									   <td align="left" valign="top"> <input type="text" name="data[config][googlemerchid]" size="30" value="<?php echo $row->config['googlemerchid'] ; ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_GOOGLE_MERCHANT_ID_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
										 
										 <td valign="top" rowspan="2"><?php echo JText::_( 'DT_NOTES_GOOGLE_CHECKOUT' ) ;?></td>

								 </tr>
                                 
                 <tr align="center" valign="middle">

                     <td align="left" valign="top"><strong><?php echo JText::_( 'DT_GOOGLE_TRANS_KEY' ); ?>:</strong></td>

									   <td align="left" valign="top">	<input type="text" name="data[config][googleapikey]" size="30" value="<?php echo $row->config['googleapikey']; ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_GOOGLE_TRANS_KEY_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

								 </tr>

                      
          <!-- *************** Paypal Pro Options ***************	-->
							  
							  <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'DT_PAYPAL_PRO' ); ?></td></tr>
                                 
                 <tr align="center" valign="middle">

                     <td align="left" valign="top">

										 <strong><?php echo JText::_( 'DT_PAYPAL_API_USER' ); ?>:</strong>

										 </td>

									   <td align="left" valign="top"> <input type="text" name="data[config][paypal_api_user]" size="30" value="<?php echo isset($row->config['paypal_api_user'])?$row->config['paypal_api_user']:'' ; ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_PAYPAL_API_USER_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
										 
										 <td valign="top" rowspan="4"><?php echo JText::_( 'DT_NOTES_PAYPAL_PRO' ) ;?></td>

								 </tr>
                                 
                 <tr align="center" valign="middle">

                     <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PAYPAL_API_PASSWORD' ); ?>:</strong></td>

									   <td align="left" valign="top">	<input type="text" name="data[config][paypal_api_password]" size="30" value="<?php echo isset($row->config['paypal_api_password'])?$row->config['paypal_api_password']:''; ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_PAYPAL_API_PASSWORD_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

								 </tr>
                   
                     <tr align="center" valign="middle">

                     <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PAYPAL_API_SIGNATURE' ); ?>:</strong></td>

									   <td align="left" valign="top">	<input type="text" name="data[config][paypal_api_signature]" size="30" value="<?php echo isset($row->config['paypal_api_signature'])?$row->config['paypal_api_signature']:''; ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_PAYPAL_API_SIGNATURE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

								 </tr>


<tr align="center" valign="middle">

                     <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PAYPAL_PRO_COUNTRY' ); ?>:</strong></td>

									   <td align="left" valign="top">	
                                       <?php
                                        $options=DtHtml::options($paymentmethod->paypal_country_codes());
									
									echo JHTML::_('select.genericlist', $options,'data[config][paypal_pro_country]',' ', 'value','text',isset($row->config['paypal_pro_country'])?$row->config['paypal_pro_country']:'');
                                       ?>
                                      </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_PAYPAL_PRO_COUNTRY_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

								 </tr>        
		  					<!-- *************** PayPal Options ***************	-->

							  <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'PAYPAL' ); ?></td></tr>

								<tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'PAYPAL_ID' ); ?>:</strong></td>

							    <td align="left" valign="top"><input type="text" name="data[config][paypalid]" size="30" value="<?php echo stripslashes($row->config['paypalid']); ?>"></td>

								  <td><?php echo JHTML::tooltip((JText::_( 'PAYPAL_ID_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
								  
								  <td valign="top"><?php echo JText::_( 'DT_NOTES_PAYPAL' ); ?></td>

							  </tr>
                                         <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'DT_SAFER_PAY' ); ?></td></tr>
  <tr align="center" valign="middle">

                     <td align="left" valign="top">

										 <strong><?php echo JText::_( 'DT_SAFER_PAY_ACCOUNT_ID' ); ?>:</strong>

										 </td>

									   <td align="left" valign="top"> <input type="text" name="data[config][safe_pay_account_id]" size="30" value="<?php echo isset($row->config['safe_pay_account_id'])?$row->config['safe_pay_account_id']:''; ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_SAFER_PAY_ACCOUNT_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
										 									   
									   <td valign="top" rowspan="1"><?php echo JText::_( 'DT_NOTES_SAFER_PAY' ) ;?></td>

								 </tr>
                                 
                                 
                                  <!-- *********** PSIGate Payment options ***********  -->
                                 

                                 <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'DT_PSIGATE' ); ?></td>
                                 </tr>
                                 <tr align="center" valign="middle">
                                 	<td align="left" valign="top">
										 <strong><?php echo JText::_( 'DT_PSIGATE_MERCHANT_ID' ); ?>:</strong>
									</td>
                                    <td align="left" valign="top"> <input type="text" name="data[config][psi_merchantId]" size="30" value="<?php echo $row->config['psi_merchantId']; ?>" />
                                    </td>
                                    <td><?php echo JHTML::tooltip((JText::_( 'DT_PSIGATE_MERCHANT_ID_HELP' )), '', 'tooltip.png', '', ''); ?>
                                    </td>
                                    <td valign="top" rowspan="5"><?php echo JText::_( 'DT_NOTES_PSIGATE' ) ;?></td>
								 </tr>
                                 <tr align="center" valign="middle">
                                 	<td align="left" valign="top">
										 <strong><?php echo JText::_( 'DT_PSIGATE_PASS_PHRASE' ); ?>:</strong>
									</td>
                                    <td align="left" valign="top"> <input type="text" name="data[config][psi_passphrase]" size="30" value="<?php echo $row->config['psi_passphrase']; ?>" />
                                    </td>
                                    <td><?php echo JHTML::tooltip((JText::_( 'DT_PSIGATE_PASS_PHRASE_HELP' )), '', 'tooltip.png', '', ''); ?>
                                    </td>
                                    
								 </tr>
                                 <tr align="center" valign="middle">
                                 	<td align="left" valign="top">
										 <strong><?php echo JText::_( 'DT_PSIGATE_STORE_ID' ); ?>:</strong>
									</td>
                                    <td align="left" valign="top"> <input type="text" name="data[config][psi_storeid]" size="30" value="<?php echo $row->config['psi_storeid']; ?>" />
                                    </td>
                                    <td><?php echo JHTML::tooltip((JText::_( 'DT_PSIGATE_STORE_ID_HELP' )), '', 'tooltip.png', '', ''); ?>
                                    </td>
                                    
								 </tr>
                                 
                                 <tr align="center" valign="middle">
                                 	<td align="left" valign="top">
										 <strong><?php echo JText::_( 'DT_PSIGATE_LIVE_URL' ); ?>:</strong>
									</td>
                                    <td align="left" valign="top"> <input type="text" name="data[config][psi_live_url]" size="30" value="<?php echo $row->config['psi_live_url']; ?>" />
                                    </td>
                                    <td><?php echo JHTML::tooltip((JText::_( 'DT_PSIGATE_LIVE_URL_HELP' )), '', 'tooltip.png', '', ''); ?>
                                    </td>
                                    
								 </tr>
								
								 <tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PSIGATE_TYPE' );?>:</strong></td>

							    <td align="left" valign="top">

							    <?php

								    $options=array();

								    $options[]=JHTML::_('select.option', 'hosted', JText::_( 'DT_SHARED' ));//

								    $options[]=JHTML::_('select.option', 'live', JText::_( 'DT_HOSTED' ));

								    echo JHTML::_('select.genericlist', $options,'data[config][psitype]','','value','text',(isset($row->config['psitype']))?$row->config['psitype']:'live');

							     ?>

							    </td>

								  <td><?php echo JHTML::tooltip((JText::_( 'DT_PSIGATE_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							  </tr>

                                 
                                 <!-- *********** PSIGate Payment options ***********  -->
                                 
                                 
 <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'DT_EWAY' ); ?></td></tr>
                                 
                <tr align="center" valign="middle">

                     <td align="left" valign="top">

										 <strong><?php echo JText::_( 'DT_EWAY_CUSTOMERID' ); ?>:</strong>

										 </td>

									   <td align="left" valign="top"> <input type="text" name="data[config][eway_customerid]" size="30" value="<?php echo (isset($row->config['eway_customerid']))?$row->config['eway_customerid']:''; ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_EWAY_CUSTOMERID_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
										 
										 <td valign="top" rowspan="2"><?php echo JText::_( 'DT_NOTES_EWAY' ) ;?></td>

								 </tr>
                             
                <tr align="center" valign="middle">  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_EWAY_TYPE' );?>:</strong></td>

							    <td align="left" valign="top">

							    <?php

								    $options=array();

								    $options[]=JHTML::_('select.option', 'hosted', JText::_( 'DT_SHARED' ));//

								    $options[]=JHTML::_('select.option', 'live', JText::_( 'DT_HOSTED' ));

								    echo JHTML::_('select.genericlist', $options,'data[config][ewaytype]','','value','text',(isset($row->config['ewaytype']))?$row->config['ewaytype']:'live');

							     ?>

							    </td>

								  <td><?php echo JHTML::tooltip((JText::_( 'DT_EWAY_TYPE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							  </tr>
                              
                            <!-- **************** USAEPAY Options *************	-->
                            
                            <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'DT_USAEPAY' ); ?></td></tr>
                            <tr align="center" valign="middle">
                            	<td align="left" valign="top">
                                	<strong><?php echo JText::_( 'DT_USAEPAY_KEY' ); ?>:</strong>
								</td>
                                <td align="left" valign="top"> <input type="text" name="data[config][usaepay_key]" size="30" value="<?php echo (isset($row->config['usaepay_key']))?$row->config['usaepay_key']:''; ?>" /> </td>
                                <td><?php echo JHTML::tooltip((JText::_( 'DT_USAEPAY_KEY_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
                                <td valign="top" rowspan="1"><?php echo JText::_( 'DT_NOTES_USAEPAY' ) ;?></td>
							</tr>
                           
                            
							<!-- **************** iDeal Mollie Options *************	-->

                <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'DT_PAY_IDEAL_MOLLIE' ); ?></td></tr>

								<tr align="center" valign="middle">

                  <td align="left" valign="top"><strong><?php echo JText::_( 'IDEAL_ID' ); ?>:</strong></td>

							    <td align="left" valign="top"><input type="text" name="data[config][partner_id]" size="30" value="<?php echo stripslashes($row->config['partner_id']); ?>"></td>

								  <td><?php echo JHTML::tooltip((JText::_( 'IDEAL_ID_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
								  
								  <td valign="top" rowspan="1"> </td>

							  </tr>
		  
                <!--- ************************* Ideal Rabobank Lite ************************* -->

                <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'DT_PAY_IDEAL_LITE' ); ?></td></tr>

								<tr align="center" valign="middle">

                  <td align="left" valign="top"><strong><?php echo JText::_( 'IDEAL_LITE_MERCHANT_ID' ); ?>:</strong></td>

							    <td align="left" valign="top"><input type="text" name="data[config][idealLiteMerchantId]" size="30" value="<?php echo stripslashes($row->config['idealLiteMerchantId']); ?>"></td>

								  <td><?php echo JHTML::tooltip((JText::_( 'IDEAL_LITE_MERCHANT_ID_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
								  
								  <td valign="top" rowspan="2"> </td>

							  </tr>
                              
                <tr align="center" valign="middle">

                  <td align="left" valign="top"><strong><?php echo JText::_( 'IDEAL_LITE_HASH_KEY' ); ?>:</strong></td>

							    <td align="left" valign="top"><input type="text" name="data[config][idealLiteHashKey]" size="30" value="<?php echo stripslashes($row->config['idealLiteHashKey'])  ?>"></td>

								  <td><?php echo JHTML::tooltip((JText::_( 'IDEAL_LITE_HASH_KEY_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

							  </tr>

								 <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'DT_SAGE' ); ?></td></tr>
                                 
                 <tr align="center" valign="middle">

                     <td align="left" valign="top">

										 <strong><?php echo JText::_( 'DT_SAGE_M_ID' ); ?>:</strong>

										 </td>

									   <td align="left" valign="top"> <input type="text" name="data[config][sage_M_id]" size="30" value="<?php echo isset($row->config['sage_M_id'])?$row->config['sage_M_id']:'';  ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_SAGE_M_ID_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
										 
										 <td valign="top" rowspan="2"><?php echo JText::_( 'DT_NOTES_SAGE' ) ;?></td>

								 </tr>
                                 
                 <tr align="center" valign="middle">

                     <td align="left" valign="top"><strong><?php echo JText::_( 'DT_SAGE_M_KEY' ); ?>:</strong></td>

									   <td align="left" valign="top">	<input type="text" name="data[config][sage_M_key]" size="30" value="<?php echo  isset($row->config['sage_M_key'])?$row->config['sage_M_key']:''; ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_SAGE_M_KEY_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

								 </tr>
    <!-- Net Deposit Options -->
                          
                            <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'DT_NETDEPOSIT' ); ?></td></tr>
                                 
                 <tr align="center" valign="middle">

                     <td align="left" valign="top">

										 <strong><?php echo JText::_( 'DT_NETDEPOSIT_CLIENTID' ); ?>:</strong>

										 </td>

									   <td align="left" valign="top"> <input type="text" name="data[config][netdeposit_clientid]" size="30" value="<?php echo $row->config['netdeposit_clientid']; ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_NETDEPOSIT_CLIENTID_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
										 
										 <td valign="top" rowspan="2"><?php echo JText::_( 'DT_NOTES_NETDEPOSIT' ) ;?></td>

								 </tr>
                                 
                 <tr align="center" valign="middle">

                     <td align="left" valign="top"><strong><?php echo JText::_( 'DT_NETDEPOSIT_CLIENTCODE' ); ?>:</strong></td>

									   <td align="left" valign="top">	<input type="text" name="data[config][netdeposit_clientcode]" size="30" value="<?php echo $row->config['netdeposit_clientcode']; ?>" /> </td>

										 <td><?php echo JHTML::tooltip((JText::_( 'DT_NETDEPOSIT_CLIENTCODE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

								 </tr>
							<!-- ******************* Pay Later Options ****************	-->

							   <?php
							   		
                                    $options=DtHtml::options($paylater->options);
									$selectedOptions=DtHtml::options($config->getGlobal('pay_later_options',array()));		

							   ?>

                <tr valign="middle"><td align="left" class="dt_heading" colspan="4"><?php echo JText::_( 'DT_PAYLATER_OFFLINE' ); ?></td></tr>

				 <tr align="center" valign="middle">

                  <td align="left" valign="top"><strong><?php echo JText::_( 'DT_PAY_LATER_OPTIONS' ) ;?>:</strong></td>

							    <td>
                                  
                                   <a href="#" id="addmore">Add more</a>
                                     <br/>
                                     <span class="container">
                                     <?php
                                        echo DtHtml::paylatercheckboxlist('data[config][pay_later_options]',$paylater->options,isset($row->config['pay_later_options'])?$row->config['pay_later_options']:array());
									  ?>
                                     </span>
                                     <br />
                                     <label for="data[paylater][]" generated="true" class="error" style="display:none"></label>
                                   </td>
								  <td><?php echo JHTML::tooltip((JText::_( 'DT_PAY_LATER_OPTIONS_HELP' )), '', 'tooltip.png', '', ''); ?> </td>
								  
								  <td valign="top"><?php echo JText::_( 'DT_NOTES_PAYLATER' ) ;?></td>

							  </tr>
                              
	 						 </table>
      <input type="hidden" name="option" value="com_dtregister" />
      <input type="hidden" name="controller" value="payoption" />

      <input type="hidden" id="task" name="task" value="" />
</form>
 <span style="display:none">
  <span id="newelement">
     <span>
     <input type="checkbox" class="checkboxes" name="data[config][pay_later_options][]" value="" /> 
     <input type="text" name="data[paylater][]" class="inputbox" /><input type="hidden" name="data[paylaterIds][]" value="new" /> <a href="#" class="remove"><?php echo JText::_('DT_REMOVE'); ?></a>
     <br/>
     </span>
  </span>
</span>
<script type="text/javascript">
   DTjQuery(function(){
	   
	   DTjQuery("#addmore").click(function(){
		   DTjQuery('.container').append(DTjQuery("#newelement").html());
		   arrangeAddmoreValues();
		   return false;
	   });
		 
	   DTjQuery('.remove').live('click',function(){
         
		    if(DTjQuery(this).prev().val() != 'new'){
				   DTjQuery(this).prev().prev().rules("remove", "uniquevalue");
				   var ajaxcontext = this;
			       DTjQuery("form input[name='"+DTjQuery(this).prev().prev().attr('name')+"']").rules("add", { 
				   remote: {
					   url:"index.php?option=com_dtregister&controller=paylater&task=validate&no_html=1&value="+DTjQuery(this).prev().val(), 
					   error:function(){
						    DTjQuery("form input[name='"+DTjQuery(ajaxcontext).prev().prev().attr('name')+"']").rules("add", { uniquevalue: true});
							arrangeAddmoreValues();
						   },
					   success: function (data){
						    if(data == 'false'){
							    
					             DTjQuery(ajaxcontext).prev().prev().rules("remove", "remote");
				                 DTjQuery("form input[name='"+DTjQuery(ajaxcontext).prev().prev().attr('name')+"']").rules("add", { uniquevalue: true});
							}else{
								alert('<?php echo addslashes(JText::_('DT_PAYLATER_REMOVED'));?>');
					            DTjQuery(ajaxcontext).prev().prev().rules("remove", "remote");
				                DTjQuery("form input[name='"+DTjQuery(ajaxcontext).prev().prev().attr('name')+"']").rules("add", { uniquevalue: true});
					            DTjQuery(ajaxcontext).parent().remove();
							}
						    arrangeAddmoreValues();
						  }
					   }});
				   DTjQuery(document.adminForm).validate().element( DTjQuery(this).prev().prev());
				 	  
			}else{
			   	DTjQuery(this).parent().remove();
			}
       
		   arrangeAddmoreValues();
		   
		   return false;   
	   })
		   
   })
   
   function arrangeAddmoreValues(){
	   
	   DTjQuery.each(DTjQuery('.container').find(".checkboxes"),function(k,v){
		   
		   v.value = k;
		 
	  });
	      
   }
</script>
