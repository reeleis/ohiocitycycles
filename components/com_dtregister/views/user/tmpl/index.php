<?php 

/**
* @version 2.7.2
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $Itemid, $show_group_members, $cb_integrated, $registrant_name,$registrant_show_avatar, $button_color, $registrant_cb_linked, $xhtml,$cb_integrated, $registrant_username, $registrant_registered_date, $userpanelmessage, $currency_code,$xhtml_url;

$config = $this->getModel('config');

$mfield = $this->getModel('field');

$tfield = $mfield->table;

$tfield->pivotFields();

$fields = $tfield->arrangeheader($tfield->attendeelistfields());

$this->assign('fields',$fields);

$muser = $this->getModel('user');

$tuser = $muser->table;

$dir = Jrequest::getVar('filter_order_Dir','desc');

$order = Jrequest::getVar('filter_order','register_date');

$this->assign('muser',$muser);

$document	=& JFactory::getDocument();

$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/dt_jquery.js');

$html = '<tr>

	              <td colspan="7">

				   '.JText::_('DT_NO_REG_RECORDS').'

				  </td>

	            </tr>';

if(count($this->users)>0){

	   $html = "";

	}

$k=0;

foreach($this->users as $user){

	$tuser->load($user->userId);

	$tuser->TableEvent->overrideGlobal($tuser->eventId);

	$amount = DTreg::displayRate($tuser->TableFee->fee,$currency_code);

	$due = DTreg::displayRate(($tuser->TableFee->fee - $tuser->TableFee->paid_amount ),$currency_code);

	if(($tuser->TableFee->fee - $tuser->TableFee->paid_amount) > 0  && $tuser->status!=-1){ 

	    if($tuser->is_payable()){

		$payment = JHtml::link(JRoute::_("index.php?option=com_dtregister&controller=user&task=due&userId=".$tuser->userId."&Itemid=".$Itemid,$xhtml_url) ,JText::_( 'DT_MAKE_PAYMENT'));

		 }else{

		    $payment = "";

		 }

	  }else{

	     $payment = JText::_( 'DT_PAID'); 

	  }

	 $edit = "";

	  if( $config->getGlobal('upanel_edit_show',0) && $tuser->is_editable()){

		 $edit = JHtml::link(JRoute::_("index.php?option=com_dtregister&controller=user&task=edit&userId=".$tuser->userId."&Itemid=".$Itemid,$xhtml_url),'<img border="0"  src="'.JURI::root(true).'/images/M_images/edit.png" alt="'.JText::_( 'DT_EDIT').'" />');

	  }else{

	     $edit = "";

	  }	 

	  if($tuser->isCancelable()){

 	    $link = '<img border="0" src="'.JURI::root(true).'/components/com_dtregister/assets/images/publish_x.png" alt="'.JText::_( 'DT_CANCEL').'" />';

	    $cancel_link = '<a href="'. JRoute::_('index.php?option=com_dtregister&controller=user&Itemid='.$Itemid.'&task=cancel&userId='.$tuser->userId,$xhtml_url ).'" >'.$link .'

</a>';

	  }else{

	     $cancel_link = "&nbsp;";

	  }

	  if($k == 0){$bgRow='eventListRow1';}else{$bgRow='eventListRow2';}

	    $html .= '<tr class="'.$bgRow.'">

	              <td style="width:200px;">'.$tuser->TableEvent->displayTitle().' </td>';
				  
				  /*if($config->getGlobal('registrant_username',0)){
				  	$html .= '<td>'.$tuser->TableJUser->username.'</td>';
				  }*/

				  if($config->getGlobal('upanel_edit_show',0)){  
					$html .= '<td align="center">'.$edit.'</td>';
					}
				  if($config->getGlobal('upanel_amount_show',0)){  
					$html .= '<td align="center">'.$amount.'</td>';
				   }
				   if($config->getGlobal('upanel_due_show',0)){  
					$html .= '<td align="center">'.$due.'</td>';
				   }
				   // if($config->getGlobal('registrant_registered_date',0)){
					$html .= '<td align="center">'.DTreg::showDate($tuser->register_date).'</td>';
				   // }
				  if($config->getGlobal('upanel_pay_show',0)){  
					$html .= '<td align="center">'.$payment.'</td>';
				   }
				   if($config->getGlobal('upanel_cancel_show',0)){  
					$html .= '<td align="center">'.$cancel_link.'</td>';
				   }
				   if($config->getGlobal('upanel_status_show',0)){
					$html .= '<td align="center">'.$tuser->statustxt[$tuser->status].'</td>';
				   }
		$html .= '</tr>';
	  
	  $tuser->TableEvent->resumeGlobal($tuser->eventId);

   $k=1-$k;

}

?>

<form name="frmcart" method="post">

  <table border="0" width="100%">

     <tr>

       <td colspan="2">

         <?php echo stripslashes($userpanelmessage); ?>

       </td>

     </tr>

     <tr>

      <td align="left">

       <?php 

	     $options[]=JHTML::_('select.option',"",JText::_( 'DT_SELECT_PAYMENT_STATUS'));

	     $options[]=JHTML::_('select.option',1,JText::_( 'DT_PAID'));

		 $options[]=JHTML::_('select.option',0,JText::_( 'DT_NOT_PAID'));
         $paymentVerified = JRequest::getVar('paymentVerified','');
		 echo JHTML::_('select.genericlist',$options,"paymentVerified","class=\"evt_new\" onchange='document.frmcart.submit();'","value","text",$paymentVerified);

	     ?>

      </td>

      <td align="left">
         <?php $keyword = JRequest::getVar('keyword',''); ?>
         <input type="text" name="keyword" value="<?php echo $keyword; ?>" />&nbsp;&nbsp;

         <input type="submit" name="search_submit" value="<?php echo  JText::_( 'DT_SEARCH'); ?>" />

      </td>

    </tr>

    </table>

    <br />

 <table>

     <tr>

      <th>

        <?php echo DtHtml::sort(JText::_( 'DT_EVENT'), 'title', $dir,$order,'index'); ?>

      </th>
      
      <?php 

		/*if($config->getGlobal('registrant_username',0)){

			echo '<th class="coltitle" align="left">'.JText::_( 'DT_USERNAME' ). '</th>';

		}*/
		
	  ?>

      <?php 

		if($config->getGlobal('upanel_edit_show',0)){

			echo '<th class="coltitle" align="left">'.JText::_( 'DT_EDIT' ). '</th>';

		}
		
	  ?>
	
      <?php 

		if($config->getGlobal('upanel_amount_show',0)){

			echo '<th class="coltitle" align="left">'.DtHtml::sort(JText::_( 'DT_AMOUNT'), 'fee', $dir,$order,'index'). '</th>';

		}
		
	  ?>

      <?php 

		if($config->getGlobal('upanel_due_show',0)){

			echo '<th class="coltitle" align="left">'.DtHtml::sort(JText::_( 'DT_AMOUNT_DUE'), 'amount_due', $dir,$order,'index'). '</th>';

		}
		// if($config->getGlobal('registrant_registered_date',0)){
	  ?>

      <th>

        <?php echo DtHtml::sort(JText::_( 'DT_REGISTRATION')." ".JText::_( 'DT_DATE'), 'register_date', $dir,$order,'index'); ?>  

      </th>

      <?php
		// }

		if($config->getGlobal('upanel_pay_show',0)){

			echo '<th class="coltitle" align="left">'.DtHtml::sort(JText::_( 'DT_PAYMENTS'), 'feestatus', $dir,$order,'index'). '</th>';

		}
		
	  ?>

      <?php 

		if($config->getGlobal('upanel_cancel_show',0)){

			echo '<th class="coltitle" align="left">'.JText::_( 'DT_CANCEL' ). '</th>';

		}
		
	  ?>

      <?php 

		if($config->getGlobal('upanel_status_show',0)){

			echo '<th class="coltitle" align="left">'.DtHtml::sort(JText::_( 'DT_STATUS'), 'status', $dir,$order,'index'). '</th>';

		}
		
	  ?>

     </tr>

     <?php echo $html; ?>

</table>

<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform adminlist">

<?php echo $this->pageNav->getListFooter() ;?>

</table>

<input type="hidden" name="option" value="<?php echo DTR_COM_COMPONENT;?>" />

<input type="hidden" name="controller" value="user" />

<input type="hidden" name="task" value="" />

<input type="hidden" name="limitstart" value="" />

<input type="hidden" name="filter_order" value="<?php echo Jrequest::getVar('filter_order','name');?>" />

<input type="hidden" name="filter_order_Dir" value="<?php echo Jrequest::getVar('filter_order_Dir','asc');?>" />

</form>

<script type="text/javascript">

 //<![CDATA[

  function tableOrdering( order, dir, task ) {

	var form = document.frmcart;

	form.filter_order.value	= order;

	form.filter_order_Dir.value	= dir;

	submitform( task );

}

function submitform(pressbutton){

	if (pressbutton) {

		document.frmcart.task.value=pressbutton;

	}

	if (typeof document.frmcart.onsubmit == "function") {

		document.frmcart.onsubmit();

	}

	document.frmcart.submit();

}

//]]>

</script>