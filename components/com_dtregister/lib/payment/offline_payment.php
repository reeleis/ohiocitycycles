<?php

/**
* @version 2.7.7
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once( JPATH_SITE.'/components/com_dtregister/lib/class.payment.php');

class offline_payment extends Payment{ 
	
	 var $bywebservice = true;
	 var $cardtype = "";
	 function __construct() {

		parent::__construct();

   }
   
     function billingform(){

	   global $cardtype;
       
	   $form = parent::billingform();
        ob_start();
	    $size = count($cardtype);
	   if($size ==1){

		  ?>

          <tr>

           <td>

           <input type="radio" style="display:none" name="billing[cardtype]" value="<?php echo $cardtype[0];?>"  <?php  echo "checked"; ?> /></td></tr>

          <?php

	   }else{

	   ?>

	    <tr>

             <td width="31%"><?php echo JText::_( 'CARD_TYPE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

          <td>

            <?php

			$options=DtHtml::options($cardtype);

			echo JHTML::_('select.genericlist', $options,'billing[cardtype]','','value','text',$this->cardtype);

			?>

          </td>

        </tr>

	   <?php

	   }

	   ?>

          <tr>

		          <td width="31%"><?php echo JText::_( 'CARD_NUMBER' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		         <td width="69%" align="left"><input type="text" name="billing[x_card_num]" class="inputbox" value="<?php echo isset($this->cb_creditcardnumber)?$this->cb_creditcardnumber:''?>" />

		              <br />

		            <?php echo JText::_( 'CARD_NUMBER_EXPLANATION' );?></td>

		        </tr>

           <tr>

		          <td width="31%"><?php echo JText::_( 'CARD_EXPIRY_DATE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		          <td width="69%" align="left"><input type="text" name="billing[x_exp_date]" value="<?php echo isset($this->cb_expdate)?$this->cb_expdate:''?>" class="inputbox" />

		            &nbsp;&nbsp;(mm/yy)</td>

		        </tr>

             <tr>

		          <td width="31%"><?php echo JText::_( 'CVV_CODE' );?>:<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span></td>

		         <td width="69%" align="left"><input type="text" name="billing[x_card_code]" size="10" class="inputbox" value="<?php echo isset($this->x_card_code)?$this->x_card_code:'' ;?>" />

		            <?php echo JText::_( 'CVV_CODE_EXPLANATION' );?></td>

		        </tr>

       <?php

	   $html = ob_get_clean();

	   return $form.$html;

   }	
   
     function process() {
	 	
		/*
		 session variables here only .
		*/
		DT_Session::set('register.payment.offline_process',true);
		return true;
		
	 }
	 
	 function after_user_save($user) {
		
		if(DT_Session::get('register.payment.offline_process')) {
			
			$billing = DT_Session::get('register.payment.billing');
			$billing['userId'] = $user->userId;
			$billing['status'] = 0;
			
			$user->TableCard->save($billing);
			
		}
		return;
	}
	
}
?>