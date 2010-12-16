<?php



/**

* @version 2.6.3

* @package Joomla 1.5

* @subpackage DT Register

* @copyright Copyright (C) 2006 DTH Development

* @copyright contact dthdev@dthdevelopment.com

* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL

*/



/*******************************************************************************



 *                      PHP Paypal IPN Integration Class



 *  DESCRIPTION:



 *



 *      This file provides a neat and simple method to interface with paypal and



 *      The paypal Instant Payment Notification (IPN) interface.  This file is



 *      NOT intended to make the paypal integration "plug 'n' play". It still



 *      requires the developer (that should be you) to understand the paypal



 *      process and know the variables you want/need to pass to paypal to



 *      achieve what you want.



 *



 *      This class handles the submission of an order to paypal aswell as the



 *      processing an Instant Payment Notification.



 *



 *      This code is based on that of the php-toolkit from paypal.  I've taken



 *      the basic principals and put it in to a class so that it is a little



 *      easier--at least for me--to use.  The php-toolkit can be downloaded from



 *      http://sourceforge.net/projects/paypal.



 *



 *      To submit an order to paypal, have your order form POST to a file with:



 *



 *          $p = new paypal_class;



 *          $p->add_field('business', 'somebody@domain.com');



 *          $p->add_field('first_name', $_POST['first_name']);



 *          ... (add all your fields in the same manor)



 *          $p->submit_paypal_post();



 *



 *      To process an IPN, have your IPN processing file contain:



 *



 *          $p = new paypal_class;



 *          if ($p->validate_ipn()) {



 *          ... (IPN is verified.  Details are in the ipn_data() array)



 *          }



 *



 *



 *      In case you are new to paypal, here is some information to help you:



 *



 *      1. Download and read the Merchant User Manual and Integration Guide from



 *         http://www.paypal.com/en_US/pdf/integration_guide.pdf.  This gives



 *         you all the information you need including the fields you can pass to



 *         paypal (using add_field() with this class) aswell as all the fields



 *         that are returned in an IPN post (stored in the ipn_data() array in



 *         this class).  It also diagrams the entire transaction process.



 *



 *      2. Create a "sandbox" account for a buyer and a seller.  This is just



 *         a test account(s) that allow you to test your site from both the



 *         seller and buyer perspective.  The instructions for this is available



 *         at https://developer.paypal.com/ as well as a great forum where you



 *         can ask all your paypal integration questions.  Make sure you follow



 *         all the directions in setting up a sandbox test environment, including



 *         the addition of fake bank accounts and credit cards.



 *



 *******************************************************************************



*/



defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once( JPATH_SITE.'/components/com_dtregister/lib/class.payment.php');

class paypal extends Payment{



   var $last_error;                 // holds the last error encountered



   var $ipn_log;                    // bool: log IPN results to text file?



   var $ipn_log_file;               // filename of the IPN log



   var $ipn_response;               // holds the IPN response from paypal



   var $ipn_data = array();         // array contains the POST values for IPN



   var $fields = array();           // array holds the fields to submit to paypal

   

   var $bywebservice =  false ;

   

   function __construct() {



      // initialization constructor.  Called when class is created.

      parent::__construct();
      
      $this->paypal_url = ($this->paymentmode=='test')?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';



      $this->last_error = '';



      $this->ipn_log_file = 'ipn_log.txt';

      $this->ipn_log_file = dirname(__FILE__)."/ipnlog.txt";
	  //pr($this->ipn_log_file);


      $this->ipn_log = true;



      $this->ipn_response = '';

	  

      $this->add_field('rm','2');           // Return method = POST

	  // $this->add_field('item_name',$this->confirmNum);
	  
	  

      $this->add_field('cmd','_xclick');

	  

	 // $this->add_field('button_subtype','services');

	  $this->add_field('no_shipping','1');

	  //$this->add_field('bn','PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted');
      $this->add_field('charset', "utf-8");
	  

	  

	  

	  



   }



   function add_field($field, $value) {



      $this->fields["$field"] = $value;



   }

   

   function process(){

	   global $currency_code , $paypalid,$Itemid;

	   $mosConfig_live_site = JURI::root( false );

	   if($currency_code==""){$currency_code='USD';}

	   $this->paypal_url = ($this->paymentmode=='test')?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr'; 

	   $session_id = $this->saveSession();

	  

	   $this->add_field('business', "$paypalid");

	   $this->add_field('return', "{$mosConfig_live_site}components/com_dtregister/success.php?return=$session_id&Itemid=$Itemid&task=restore");

	   $this->add_field('cancel_return', "{$mosConfig_live_site}components/com_dtregister/success.php?return=$session_id&Itemid=$Itemid&task=cancel");

	   $this->add_field('notify_url', "{$mosConfig_live_site}components/com_dtregister/success.php?return=$session_id&Itemid=$Itemid&task=notification");
	   
	   $this->add_field('item_name',$this->description);

	    if($this->paymentmode=='test'){



		   $this->add_field('test_ipn', 1);



	    }

	   $this->add_field('amount', $this->cart->getAmount());

	   $this->add_field('currency_code', "$currency_code");

	   $this->add_field('custom', "test|session=$session_id");

	   $this->submit_paypal_post();

	   

	      

   }

   

   function submit_paypal_post() {



      //echo "<html>\n";



     // echo "<head><title>Processing Payment...</title></head>\n";



     // echo "<body onLoad=\"document.form.submit();\">\n";



      echo "<center><h3>".JText::_( 'DT_PAYPAL_REDIRECT_MSG')."</h3></center>\n";



      echo "<form method=\"post\" name=\"formRegister\" action=\"".$this->paypal_url."\">\n";



      foreach ($this->fields as $name => $value) {



         echo "<input type=\"hidden\" name=\"$name\" value=\"$value\">";



      }



      // Uncomment the following line to change the default PayPal currency to something else



      // echo "<input type=\"hidden\" name=\"currency_code\" value=\"USD\">";



?>



		<script language="javascript">



			function rg_direc_to_paypal(){



				document.formRegister.submit();



			}



			setTimeout("rg_direc_to_paypal()",5000);



		</script>



<?php



      echo "</form>\n";



      //echo "</body></html>\n";



   }



   function validate_ipn() {



      // parse the paypal URL



      $url_parsed=parse_url($this->paypal_url);



      $post_string = '';



      foreach ($_POST as $field=>$value) {



         $this->ipn_data["$field"] = $value;



         $post_string .= $field.'='.urlencode($value).'&';



      }



      $post_string.="cmd=_notify-validate"; // append ipn command



      // open the connection to paypal
file_put_contents($this->ipn_log_file,"\n$this->paypal_url\n",FILE_APPEND);
      file_put_contents($this->ipn_log_file,"\n$post_string\n",FILE_APPEND);

      $fp = fsockopen($url_parsed[host],"80",$err_num,$err_str,30);



      if(!$fp) {



         // could not open the connection.  If loggin is on, the error message



         // will be in the log.



         $this->last_error = "fsockopen error no. $errnum: $errstr";



         $this->log_ipn_results(false);



         return false;



      } else {



         // Post the data back to paypal



         fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n");



         fputs($fp, "Host: $url_parsed[host]\r\n");



         fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");



         fputs($fp, "Content-length: ".strlen($post_string)."\r\n");



         fputs($fp, "Connection: close\r\n\r\n");



         fputs($fp, $post_string . "\r\n\r\n");



         // loop through the response from the server and append to variable



         while(!feof($fp)) {



            $this->ipn_response .= fgets($fp, 1024);



         }



         fclose($fp); // close connection



      }



     if (eregi("VERIFIED",$this->ipn_response)) {



         // Valid IPN transaction.



         $this->log_ipn_results(true);



       return true;



      } else {



         // Invalid IPN transaction.  Check the log for details.



         $this->last_error = 'IPN Validation Failed.';



         $this->log_ipn_results(false);



         return true;



      }



   }



   function log_ipn_results($success) {



      if (!$this->ipn_log) return;  // is logging turned off?



      // Timestamp



      $text = '['.date('m/d/Y g:i A').'] - ';



      // Success or failure being logged?



      if ($success) $text .= "SUCCESS!\n";



      else $text .= 'FAIL: '.$this->last_error."\n";



      // Log the POST variables



      $text .= "IPN POST Vars from Paypal:\n";



      foreach ($this->ipn_data as $key=>$value) {



         $text .= "$key=$value, ";



      }



      // Log the response from the paypal server



      $text .= "\nIPN Response from Paypal Server:\n ".$this->ipn_response;



      // Write to log



      $fp=fopen($this->ipn_log_file,'a');



      fwrite($fp, $text . "\n\n");



      fclose($fp);  // close file



   }



   function dump_fields() {



      echo "<h3>paypal_class->dump_fields() Output:</h3>";



      echo "<table width=\"95%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\">



            <tr>



               <td bgcolor=\"black\"><b><font color=\"white\">Field Name</font></b></td>



               <td bgcolor=\"black\"><b><font color=\"white\">Value</font></b></td>



            </tr>";



      ksort($this->fields);



      foreach ($this->fields as $key => $value) {



         echo "<tr><td>$key</td><td>".urldecode($value)."&nbsp;</td></tr>";



      }



      echo "</table><br>";



   }
   
   function notify(){
	   
	   if($this->validate_ipn() && ($_REQUEST['payment_status']=='Completed' || $_REQUEST['payment_status']=='Pending' || $_REQUEST['payment_status']=='Processed')){
		   $this->transactionId = $_REQUEST['txn_id'];
		   DT_Session::set('register.payment.transactionId', $this->transactionId);
		   return true ;
	   }else{
		   return true;
	   }
	      
   }


}

