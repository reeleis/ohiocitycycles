 <tr>

      <td colspan="9">

      <b>NOTE:</b>  To setup registration details for an event, click the NEW button above.<br />

      The Filter on this page will ONLY show events that have already been setup in DT Register.

      </td>

    </tr>

	  <tr>

	  <td colspan="9" align="left"><b>DT Register</b> is a tool that works in conjunction with the JEvents component to enable you to take online registrations for your events, paid or unpaid.

	  You can setup individual and group registration rates, set late fees, etc.  Fees are then paid with a credit card and processed through your Authorize.net payment gateway OR through a PayPal account.<br />

	  </td>
	  
	</tr>

	<tr>

	  <td colspan="9" align="left">

    <p style="background: #d3e8c1; padding:5px;">

    To get JEvents, <a href="http://joomlacode.org/gf/project/jevents/frs" target="_blank">click here</a>.  We recommend using version 1.5.2 or later. The JEvents modules and plugins are completely optional.<br /><br />
    
    <?php
	   $database =& JFactory::getDBO();

     $database->setQuery('Describe #__events');
     // retrieving a single row as an object
     $database->loadObject();
	 
	   if($database->getErrorNum()) {
	   
	   }else{

	  ?>

    If you have migrated events from JEvents 1.4.x to JEvents 1.5 in addition to upgrading to DT Register 2.5.x, please check and see if your events and records in DT Register are still correct.  

    It is possible that the EventIDs could have changed and may need re-synced.  <b><a href="index.php?option=com_dtregister&task=sync">CLICK HERE</a></b> to check your events.
  <?php }
  
   ?>
    </p>

    </td>

	</tr>

	  <td colspan="9" align="left">For tutorials, support and more information, go to <b><a href="http://www.DTHDevelopment.com" target="_blank">http://www.DTHDevelopment.com</a></b>.<br />

&copy;2006 DTH Development</td>

	</tr>