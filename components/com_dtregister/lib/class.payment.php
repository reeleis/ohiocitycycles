<?php

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class Payment {

    var $module;

	var $component_tasks =  array('registeration'=>'payment','duepay'=>'due_payment','change'=>'paymentchanges','cancel'=>'paymentchanges');

	var $retryFields = array();

	function Payment(){

		global $paymentmode;

		$this->paymentmode = $paymentmode;

		$this->cart = new DT_Cart();
		
		$this->init_data();

	}
	
	function init_data(){
		
		 $fieldTable = new TableField();
       
	   
	   if (count(DT_Session::get('register.User')) == 1) {
		    foreach(DT_Session::get('register.User') as $user){
							      		
				break;				
			}
			
		    $firstname = $fieldTable->fingbyName('firstname');
		    if($firstname){
			   $this->firstname = $user['fields'][$firstname->id];
	        }
		   
		    $lastname = $fieldTable->fingbyName('lastname');
		    if($lastname){
			   $this->lastname = $user['fields'][$lastname->id];
	        }
			
			$address = $fieldTable->fingbyName('address');
		    if($address){
			   $this->address = $user['fields'][$address->id];
	        }
			
			$state = $fieldTable->fingbyName('state');
		    if($state){
			   $fieldType =  DtrModel::getInstance('Fieldtype','DtregisterModel');
               $fieldTypes =  $fieldType->getTypes();
			   $class = "Field_".$fieldTypes[$state->type];
			  
               $stateTable = new $class();
			   $stateTable->load($state->id);
			   
			   $this->state = $stateTable->viewHtml($user) ;
			   
	        }
			
			$city = $fieldTable->fingbyName('city');
		    if($address){
			   $this->city = $user['fields'][$city->id];
	        }
			
			$zip = $fieldTable->fingbyName('zip');
		    if($address){
			   $this->zip = $user['fields'][$zip->id];
	        }
			$email = $fieldTable->fingbyName('email');
		    if($email){
			   $this->email = $user['fields'][$email->id];
	        }
		   
	   }
			
	}

	function success(){
	  
	  return true;	
	}

	function setUsers(){

	}

	function billingform(){

	     ob_start();

				?>

		        <tr><td colspan="2" ><strong><?php echo JText::_( 'DT_PAYMENT_INFORMATION' );?></strong></td></tr>

                <tr><td colspan="2" >&nbsp;</td></tr>

			<?php
			if (count(DT_Session::get('register.User')) == 1) {
			?>
             <tr>
                	<td><?php echo JText::_( 'DT_SAME_BILLING_INFO' );?></td>
                	<td><input type="checkbox" class="inputbox" name="same" id="same" value="1" /></td>
             </tr>
            <?php
			}
			?>

		        <tr>

                	<td width="31%"  ><?php echo JText::_( 'DT_CARD_HOLDER_FIRSTNAME' ); ?>:<span class="required">  *  </span></td>

                    <td width="69%" align="left" > <input id="billingFirstname"  class="inputbox required" type="text" name="billing[firstname]" value="<?php echo isset($this->firstname)?$this->firstname:'' ?>" /> </td>

                 </tr>

                   <tr>

                	<td width="31%"  ><?php echo JText::_( 'DT_CARD_HOLDER_LASTNAME' ); ?>:<span class="required">  *  </span></td>

                    <td width="69%" align="left" > <input id="billingLastname" class="inputbox required" type="text" name="billing[lastname]" value="<?php echo isset($this->lastname)?$this->lastname:'' ?>" /> </td>

                 </tr>

                   <tr>

                	<td width="31%"  ><?php echo JText::_( 'DT_BILLING_ADDRESS' ); ?>:<span class="required">  *  </span></td>

                    <td width="69%" align="left" > <input id="billingAddress" class="inputbox required" type="text" name="billing[address]" value="<?php echo isset($dt_user->address)?$dt_user->address:'' ?>" /> </td>

                 </tr>

                   <tr>

                	<td width="31%"  ><?php echo JText::_( 'DT_CITY' ); ?>:<span class="required">  *  </span></td>

                    <td width="69%" align="left" ><input id="billingCity" class="inputbox required" type="text" name="billing[city]" value="<?php echo isset($this->city)?$this->city:'' ?>" />  </td>

                 </tr>

                   <tr>

                	<td width="31%"  ><?php echo JText::_( 'DT_STATE' ); ?>:<span class="required">  *  </span></td>

                    <td width="69%" align="left" > <input  id="billingState" class="inputbox required" type="text" name="billing[state]" value="<?php echo isset($this->state)?$this->state:'' ?>" /> </td>

                 </tr>
<?php

       $countylist = new TableField();
       
	   $field = $countylist->fingbyName('country');
	   
	  // pr($field->id);
       
	   $paymentmethod = DtrModel::getInstance('paymentmethod','DtregisterModel');
	   
	   global $paypal_pro_country;
	  
	   if(get_class($this) == 'paypal_pro'){
        
		   $value = (isset($this->country))?$this->country:$paypal_pro_country;
		   $dropDownDatas = $paymentmethod->paypal_country_codes();
		   $countrydropdown = JHTML::_('select.genericlist', DtHtml::options($dropDownDatas, JText::_("DT_SELECT_COUNTRY")),'billing[country]',$value,'value','text',array($value));
		   // pr($value); pr($countrydropdown); exit;
		   
	   }else{
	   
		 if($field){
			 
			 $dropDownDatas=explode("|",$field->values);
			 $value = (isset($this->country))?$this->country:$field->selected;
			 $countrydropdown = JHTML::_('select.genericlist', DtHtml::options($dropDownDatas, JText::_("DT_SELECT_COUNTRY")),'billing[country]',' ','value','text',$value);			 
		 }
		 
	   }
	   
	   ?>
        <tr>
			   <td>
				 <?php echo  JText::_('DT_COUNTRY');?>
			   </td>
			   <td>
				 <?php echo $countrydropdown; ?>
			   </td>
		</tr>
                  <tr>

                	<td width="31%"><?php echo JText::_( 'DT_ZIPCODE' ); ?>:<span class="required">  *  </span></td>

                    <td width="69%" align="left"> <input id="billingZipcode" class="inputbox required" type="text" name="billing[zipcode]" value="<?php echo isset($this->zipcode)?$this->zipcode:'' ?>" /> </td>

                 </tr>

                   <tr>

                	<td width="31%"><?php echo JText::_( 'DT_EMAIL' ); ?>:<span class="required">  *  </span></td>

                    <td width="69%" align="left"> <input id="billingEmail" class="inputbox required" type="text" name="billing[email]" value="<?php echo isset($this->email)?$this->email:'' ?>" /> </td>

                 </tr>

				<script language="javascript" type="text/javascript">

                    //<![CDATA[
							<?php
							   foreach(DT_Session::get('register.User') as $user){
							      		
										break;						
							   }
							   $field = $countylist->fingbyName('firstname');
							?>
							var billing_firstname = "<?php echo ($field)?$user['fields'][$field->id]:'' ; ?>";
							<?php
							  $field = $countylist->fingbyName('lastname');
							?>
							var billing_lastname = "<?php echo ($field)?$user['fields'][$field->id]:'' ; ?>";
							<?php
							  $field = $countylist->fingbyName('address');
							?>
							var billing_address = "<?php echo ($field)?$user['fields'][$field->id]:'' ; ?>";
							<?php
							  $field = $countylist->fingbyName('city');
							?>
							var billing_city = "<?php echo ($field)?$user['fields'][$field->id]:'' ; ?>";
							<?php
							  $field = $countylist->fingbyName('state');
							?>
							var billing_state = "<?php echo (isset($this->state))?$this->state:'' ; ?>";
							<?php
							  $field = $countylist->fingbyName('zip');
							?>
							var billing_zipcode = "<?php echo ($field)?$user['fields'][$field->id]:'' ; ?>";
							<?php
							  $field = $countylist->fingbyName('email');
							?>
							var billing_email = "<?php echo ($field)?$user['fields'][$field->id]:'' ; ?>";
		
							DTjQuery(function(){
								DTjQuery("#same").click(function(){
									
									if(this.checked) {
										DTjQuery("#billingFirstname").val(billing_firstname);
										DTjQuery("#billingLastname").val(billing_lastname);
										DTjQuery("#billingAddress").val(billing_address);
										DTjQuery("#billingCity").val(billing_city);
										DTjQuery("#billingState").val(billing_state);
										DTjQuery("#billingZipcode").val(billing_zipcode);
										DTjQuery("#billingEmail").val(billing_email);
									} else {
										DTjQuery("#billingFirstname").val('');
										DTjQuery("#billingLastname").val('');
										DTjQuery("#billingAddress").val('');
										DTjQuery("#billingCity").val('');
										DTjQuery("#billingState").val('');
										DTjQuery("#billingZipcode").val('');
										DTjQuery("#billingEmail").val('');
									}
		
								});
							});
                    
							//]]>

                   </script>

                <?php 

	    $data =  ob_get_clean();

		return $data;

	}

	function getLoginUserData(){

	   global $cb_integrated,$ptc;

	   $database = &JFactory::getDBO();

	   $user = &JFactory::getUser();

	   $this->credircardNo = "";

	   $this->credircardExp = "";

	   $this->cardtype = "";

	   if($cb_integrated ==1 ){

	       $userId=$user->id;

		   if ($userId){

						//Get the information from cb

						$sql="Select * From #__comprofiler where user_id=$userId";

						$database->setQuery($sql);

						$rowProfile = $database->loadObject();

						if($rowProfile)

						{

					      $ptc->ToDecode=$rowProfile->cb_creditcardnumber;

							$ptc->Decode();

							if($ptc->Decoded!=-1)

							$this->credircardNo=$ptc->Decoded;

							$ptc->ToDecode=$rowProfile->cb_expdate;

							$ptc->Decode();

							if($ptc->Decoded!=-1)

							$this->credircardExp=$ptc->Decoded;

							$this->cardtype = $rowProfile->cb_cardtype;

						}

			}

	   }

	}

	function setBillinginfo($info){
       
	    if(is_array($info))

		foreach($info as $key => $value){

		    $this->$key = $value;

		}

	}

	function setData($data= array()){

		foreach($data as $key => $value){

		   $this->$key = $value;

		}

	}

	function generateconfirmNum(){

	   global $confirm_number_type , $confirm_number_prefix , $confirm_number_start ;

	   $x_invoice_num1 = "";

	   if($confirm_number_type=='random'){

	       $chars = "0123456789";

		   srand((double)microtime()*1000000);

			for($i=0; $i<7; $i++){

				$x_invoice_num1 .= $chars[rand()%strlen($chars)];

			}

	   }else{

	       $x_invoice_num1 = $confirm_number_start+1;

	   }

	   return $this->confirmNum = $confirm_number_prefix.$x_invoice_num1;

	}

	function formatfields(){

		 $fields = "";

//pr($this->fields);
         foreach( $this->fields as $key => $value ){ 

		    if(trim($value)!="")

		    $fields .= "$key=" . urlencode( $value ) . "&";

		 }

	     return $fields;

	 }

	function showform($options){

	    $this->setformData();

	  return  $this->drawform($options);

	}

	function add_field($name,$value){

	   $this->add_field($name,$value);

	}

	function addItem($name, $description, $quantity, $price){

		 $this->addItem($name, $description, $quantity, $price);

	}

	function saveSession(){

	$database = &JFactory::getDBO();
$data = $_SESSION;
	   $sql = "INSERT INTO #__dtregister_session (`session_id` ,`data`, `user_id`,`processed`)VALUES ( ".$database->Quote(session_id()).",".$database->Quote(serialize($data)).",'0','0')";

		$database->setQuery($sql);

	    $database->query();

        echo $database->getErrorMsg();

		return $database->insertid();

	}

	function setPaymentType($type){

	    $this->paymentType = $type;

	}

    function beforepayment(){

	   return true;

	}

	 function afterpayment(){

	   return true;

	}

	function afterFailed(){

	   $this->tryagaintask = "billinginfo";	

    }

	function tryagain(){

	    global $Itemid;

		ob_start();

		?>

    <form id="frmBack" name="frmBack" method="POST" action="index.php?option=com_dtregiter&Itemid=<?php echo $Itemid; ?>">

	<input type="hidden" name="try_again" value="1" />

	<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

	<input type="hidden" name="option" value="com_dtregister" />

    <input type="hidden" name="controller" value="payment" />

	<input type="hidden" name="task" value="<?php echo $this->tryagaintask ?>" />

	<input type="hidden" name="type" value="<?php echo get_class($this); ?>" />

		<!-- Other field in bank account info-->

      <?php

      foreach($this->retryFields as $key=>$value){

		  ?>

          <input type="hidden" name="<?php echo $key; ?> value="<?php echo $value; ?>" /> 

          <?php

	  }

	  ?>

		<input type="submit" value="<?php echo JText::_( 'DT_TRY_AGAIN' ); ?>" />

	</form>

		<?php

		return ob_get_clean();

	}
	
	function markprocessed($id,$userId=0){
	   $database = &JFactory::getDBO();
	   
       $data = $_SESSION;
	   $sql = "update #__dtregister_session set `data`= ".$database->Quote(serialize($data))." , processed=1 where id=".$id;
	    $database->setQuery($sql);
	    $database->query();
	   
	}

}

?>