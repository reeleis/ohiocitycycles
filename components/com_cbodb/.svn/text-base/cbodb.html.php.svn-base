<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class HTML_cbodb
{
	public static $taskOn = 1;
	public static $cbodb_user_logintypes = array(1 => 'Volunteer', 2=> 'Work on your own bike', 3=> 'Take a class', 4=> 'Staff login');
	public static $cbodb_user_loggedintypes = array(1 => 'Volunteering', 2=> 'Own Bike', 3=> 'Class', 4=> 'Staff');	
	public static $transactionTypeArray = array(1 => "Volunteering", 2 => "Personal", 3=> "Taking class", 4 => "Staff", 5 => "Ride", 1001 => "Purchase", 1002 => "Credits Added", 1003 => "Membership Renewal", 1004 => "Volunteer time addition", 2001 => "Comment", 1005 => "Bike Credit", 3001 => "Task check-out", 4001 => "Class");
	public static $cbodb_classtypes = array(0 => 'Please choose a class...', 1 => 'Shop Class A', 2=>'Shop Class B', 3=>'Shop Class C', 4=>'Shop Class D', 5=>'Bike Driver\'s Ed', 6=>'Earn A Bike Intro', 7=>'Earn A Bike A', 8=>'Earn A Bike B', 9=>'Earn A Bike C', 10=>'Earn A Bike D', 11=>'Bike Driver\'s Ed Intro', 101=>'Special', 201=>'Shop Class A (no flag)',202=>'Shop Class B (no flag)',203=>'Shop Class C (no flag)',204=>'Shop Class D (no flag)');


function dropdownFromArray( $name, $options, $selectedKey=1, $disabled=false )
{
  $disabledStr = $disabled ? ' disabled="disabled"' : '';
	echo "<select name=\"$name\"$disabledStr>";
	foreach ($options as $key => $value) {
	  $selectedStr = ($key == $selectedKey) ? 'selected="selected" ' : '';
	  echo "<option ${selectedStr}value=\"$key\">$value</option>";
	}
	echo '</select>';
}

	function header( ) 
	{
		//echo '<div class="componentheading">Member Database</div>';
		//echo '<a name="top"></a>';
	}

	function showMemberInfo( $option, $member, $credits )
	{
	$expireTime = strtotime($member->membershipExpire);
	$membershipCost = 40;
	?><h3>Your Membership Information</h3>
	<table style="padding: 10px;">
		<tr><td>Name:</td><td>&nbsp;<?php echo $member->nameFirst." ".$member->nameLast; ?></td></tr>
		<tr><td>Member:</td><td>&nbsp;<?php echo $member->isMember ? 'Current' : 'Not current'; ?></td></tr>
		<tr><td>Membership expires:</td><td>&nbsp;<?php echo ($expireTime > 10) ? date("Y-m-d H:i:s",$expireTime) : 'N/A'; ?></td></tr>
		<tr><td>Credits:</td><td>&nbsp;<?php echo sprintf('%.2F',$credits); ?></td></tr>
		<tr><td>Classes Taken:</td><td>&nbsp;<?php 
			echo ($member->custom1 ? '1' : '').' ';
			echo ($member->custom2 ? '2' : '').' ';
			echo ($member->custom3 ? '3' : '').' ';
			echo ($member->custom4 ? '4' : '').' ';
		?></td>
	</table>
	<br><Br>
	<?php 

	if (!($member->isMember))
	{
		echo "Your membership appears to be out of date. If this is a mistake, send us an email or drop by. If not, you can renew using credits, by visiting OCBC and paying in person, or by using the paypal button below.<br><br>";
		if (!($member->custom1 && $member->custom2 && $member->custom3 && $member->custom4))
		{
			$membershipCost = 80 - ($member->custom1 ? 20 : 0)- ($member->custom2 ? 20 : 0)- ($member->custom3 ? 20 : 0)- ($member->custom4 ? 20 : 0);
			echo "You don't seem to have taken all of the classes. Your membership renewal rate has been adjusted accordingly to $".$membershipCost.". This will pay in advance for your remaining classes and once you have taken them you will be a member for a year. If you <em>have</em> taken all of the classes, please contact us to update your records.<br><br>";
		}
	} else
	{ 
	echo "Your membership is up to date, but if you'd like to tack on another year anyway, you can use the buttons below.";
	} ?>
		<table>
		<tr>
			<td>Renew with Paypal ($<?php echo $membershipCost; ?>)</td>
			<td><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business" value="webmaster@ohiocitycycles.org">
				<input type="hidden" name="item_name" value="Membership Renewal for member #<?php echo $member->id; ?>">
				<input type="hidden" name="amount" value="<?php echo $membershipCost; ?>.00">
				<input type="hidden" name="no_shipping" value="0">
				<input type="hidden" name="no_note" value="1">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="lc" value="US">
				<input type="hidden" name="bn" value="PP-BuyNowBF">
				<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				</form>
			</td>
		</tr>
		<tr>
			<td>Renew and Donate - choose this button and pay more than $<?php echo $membershipCost; ?>. Whatever additional amount you pay will be counted as a donation. If you pay less than $<?php echo $membershipCost; ?>, we'll just consider it a donation (thanks!).</td><td>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="webmaster@ohiocitycycles.org">
<input type="hidden" name="item_name" value="Renew and donate for member #<?php echo $member->id; ?> (at least $<?php echo $membershipCost; ?> to renew).">
<input type="hidden" name="no_shipping" value="0">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="bn" value="PP-BuyNowBF">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
</form>
</td>
</tr>
		<tr>
			<td>Renew with hours (<?php echo $membershipCost; ?> credits)</td>
			<td align="center">
				<?php if ($credits >= $membershipCost)
					{	?>
						<form action="index.php" method="post" name="loginForm">
						<input type="submit" name="renew" value="Renew">
						<input type="hidden" name="memberID" value="<?php echo $member->id; ?>" />
  						<input type="hidden" name="option" value="<?php echo $option; ?>" />
  						<input type="hidden" name="task" value="renewmember" />
						<input type="hidden" name="isOpen" value="0">
  						<input type="hidden" name="credits" value="-<?php echo $membershipCost; ?>" />
						</form>
					<?php } else { echo "N/A"; } ?>
			</td>
		</tr>
		</table>
		<?php
		if ($credits < $membershipCost) { echo "<br><em>You don't have enough credits to use them to renew, sorry!</em><br>"; }
	}
	
	function showOptions( $option, $rows, $taskTransactions, $dropdownList )
	{
		echo '<h1>Please type your LAST name and hit enter to begin</h1>
		<br>';
		?><form action="index.php#top" method="post" name="nameForm">
  		<input type="hidden" name="option" value="<?php echo $option; ?>" />
  		<input type="hidden" name="task" value="listnamesbylastname" />
		<input type="text" name="namelast" length="30" />
		<input type="submit" name="Login" value="Login">
		</form>
		<br>
		Or, choose from the list...
		<form action="index.php#top" method="post" name="dropdownForm">
  		<input type="hidden" name="option" value="<?php echo $option; ?>" />
  		<input type="hidden" name="task" value="memberoptions" />
		<input type="hidden" name="timeOpen" value="<?php echo time(); ?>">
		<input type="hidden" name="isOpen" value="1">
		<select name="memberID">
		<option value="0">Choose your name below...</option>
		<?php
			foreach ( $dropdownList as $memberRow )
			{
				echo "<option value=\"$memberRow->id\">$memberRow->nameLast, $memberRow->nameFirst</option>";
			}
		?>
		</select>
			<input type="submit" name="logintype" value="Login"><br>
		</form>
		<?php
		/*$letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		foreach ( $letters as $letter )
		{
			$link = JRoute::_('index.php?option=' . $option . '&task=listnames&firstletter='.$letter);
			echo "<a href=\"".$link."\">".$letter."</a>&nbsp;";
		}*/
		echo '</h1><br><h1>Or <a href="/index.php?option=com_cbodb&task=newmember#top">Create an account</a>!<br><Br></h1>';
		echo '
		Currently Logged in:
		<table class="loggedInList">
		<tr><th width="150px">Name</th><th width="100px">Working on</th><th>Since</th><th>Credits</th><th></th></tr>';
		$timezone = new DateTimeZone(getConfigValue("timeZone"));
			foreach ($rows as $row )
			{
				$dateOpen = new DateTime($row->dateOpen,new DateTimeZone("UTC"));
				date_timezone_set($dateOpen,$timezone);
				echo '<tr><Td>'.$row->nameFirst." ".$row->nameLast.'</td>
				<td>'.HTML_cbodb::$cbodb_user_loggedintypes[$row->type].'</td>
				<td>'.date_format($dateOpen,"n/d/Y H:i").'</td>
				<Td>&nbsp;&nbsp;'.sprintf("%.2F",CbodbTransaction::getMemberCredits($row->id)).'</td>
				<Td>
					<form action="index.php#top" method="post" name="loginForm">
					<input type="submit" name="logout" value="Options">
					<input type="hidden" name="memberID" value="'.$row->id.'" />
  					<input type="hidden" name="option" value="'.$option.'" />
  					<input type="hidden" name="task" value="memberoptions" />  					
					</form>
				</td>';
				/*if ($row->isGroup2) {*/			
				echo '</tr>';
			}
		echo '</table>';
	}

	function showMessage ( $option, $message )
	{
		echo "<h3>".$message."</h3>";
		echo '<form action="index.php#top" method="post" name="loginForm">
		<input type="submit" name="viewtasks" value="Go Back">
  		<input type="hidden" name="option" value="'.$option.'" />
  		<input type="hidden" name="task" value="shop" />
  		<input type="hidden" name="key" value="3b767559374f5132236f6e68256b2529" />
		</form>';
	}
	function listMemberNames( $option, $rows )
	{
		echo '<h1>Click your name to continue</h1>';
		for ($i=0, $n=count( $rows ); $i < $n; $i++) 
		{
			$row = &$rows[$i];
			$checked = JHTML::_('grid.id', $i, $row->id );
			$link = JRoute::_('index.php?option=' . $option . '&task=memberoptions&memberID='.$row->id.'#top');
			?>
			<div style="margin: 10px; float: left;">
			<a href="<?php echo $link; ?>"><?php echo $row->nameFirst . ' ' . $row->nameLast; ?></a>
			</div>
			<?php
		}
		?><br><Br><div style="clear: left; float: left;"><h2>Or re-enter your name if it isn't on the list (try a different spelling):</h2>
		<div style="clear: left; float: left;">
		<form action="index.php#top" method="post" name="nameForm">
  		<input type="hidden" name="option" value="<?php echo $option; ?>" />
  		<input type="hidden" name="task" value="listnamesbylastname" />
		<input type="text" name="namelast" length="30" />
		</form></div><br>
		<br><br><h2>or <a href="http://ohiocitycycles.org/index.php?option=com_cbodb&task=shop&key=3b767559374f5132236f6e68256b2529#top">Go Back</a></h2>
 <?php
	}

	function listMemberOptions( $option, $id, $member, $memberCredits, $isLoggedIn, $taskTransactionID )
	{
		$link = JRoute::_('index.php?option=' . $option . '&task=login&memberID='.$row->id.'&logintype=');
		?>
		
		<h2>Hello, <?php echo $member->nameFirst; ?>, what would you like to do?</h2>
		
		<p>You currently have <?php echo sprintf('%.2F',$memberCredits); ?> credits.
			<!--and your membership is <?php echo (($member->isMember) ? "up to date" : "expired (or you have never been a member, or our records need to be updated)")."."; ?> -->
		</p>
			
			<?php if (!$isLoggedIn) { ?>
			  <form action="index.php#top" method="post" name="loginForm">
			    <input type="submit" name="logintype" value="<?php echo HTML_cbodb::$cbodb_user_logintypes[1]; // Volunteer ?>"><br /><br />
			    <input type="submit" name="logintype" value="<?php echo HTML_cbodb::$cbodb_user_logintypes[2]; // Work on your own bike ?>"><br /><br />
			    <input type="submit" name="logintype" value="<?php echo HTML_cbodb::$cbodb_user_logintypes[3]; // Take a class ?>"><br /><br />
			    <?php if ($member->hasRole("Staff")) { ?>
			      <input type="submit" name="logintype" value="<?php echo HTML_cbodb::$cbodb_user_logintypes[4]; // Staff login ?>"><br />
			    <?php } ?>
			    <input type="hidden" name="timeOpen" value="<?php echo time(); ?>">
			    <input type="hidden" name="isOpen" value="1">
			    <input type="hidden" name="memberID" value="<?php echo $id;?>" />
			    <input type="hidden" name="option" value="<?php echo $option;?>" />
			    <input type="hidden" name="task" value="login" />
			    <input type="hidden" name="boxchecked" value="0" />		
			  </form>
			  <br />
			<?php
			  } else {  // $isLoggedIn == true
			?>
				<form action="index.php#top" method="post" name="logoutForm">
				  <input type="submit" name="logout" value="Log Out">
				  <input type="hidden" name="memberID" value="<?php echo $member->id; ?>" />
				  <input type="hidden" name="option" value="<?php echo $option; ?>" />
				  <input type="hidden" name="task" value="logout" />  					
				</form>
				<br />
				<?php 
				  if ($taskTransactionID > 0) {
			  ?>
					<form action="index.php#top" method="post" name="loginForm">
					  <input type="submit" name="gettask" value="View Task">
					  <input type="hidden" name="memberID" value="<?php echo $member->id ?>" />
  				  <input type="hidden" name="option" value="<?php echo $option ?>" />
				    <input type="hidden" name="transactionID" value=<?php echo $taskTransactionID ?>" />
  				  <input type="hidden" name="task" value="checkintask" />  					
				  </form>
				<?php
				  } else {
			  ?>
				  <form action="index.php#top" method="post" name="loginForm">
				    <input type="submit" name="gettask" value="Get Task">
				    <input type="hidden" name="memberID" value="<?php echo $member->id ?>" />
  			    <input type="hidden" name="option" value="<?php echo $option ?>" />
  			    <input type="hidden" name="task" value="listtasks" />  					
				  </form>
				  <?php
            if ($member->hasRole("Key volunteer")) { // "Enter a Bicycle" option
			    ?>
  		      <br />
  		      <form action="index.php#top" method="post" name="loginForm">
  		        <input type="submit" name="submit" value="Enter a Bicycle">
    	      	<input type="hidden" name="option" value="<?php echo $option ?>" />
    	      	<input type="hidden" name="task" value="addbicycle" />
    	      	<input type="hidden" name="memberID" value="<?php echo $member->id ?>" />
  		      </form>
				  <?php
  	        }
				  }
			    echo '<br />';
			  } // END if~else (!$isLoggedIn)
		
		echo '<form action="index.php#top" method="post" name="loginForm">
		<input type="submit" name="viewtasks" value="View Your Recent Activity">
  		<input type="hidden" name="option" value="'.$option.'" />
  		<input type="hidden" name="task" value="listmembertransactions" />
  		<input type="hidden" name="memberID" value="'.$member->id.'" />
		</form><br />';
		if ($member->hasRole("Super volunteer")) { 
		  echo '<form action="index.php#top" method="post" name="loginForm">
		  <input type="submit" name="viewtasks" value="Teach a Class">
  	  	<input type="hidden" name="option" value="'.$option.'" />
  	  	<input type="hidden" name="task" value="startclass" />
  	  	<input type="hidden" name="memberID" value="'.$member->id.'" />
		  </form><br />';
		}
		echo '<br /><br /><h1>or <a href="http://ohiocitycycles.org/index.php?option=com_cbodb&task=shop&key=3b767559374f5132236f6e68256b2529#top">Go Back</a></h1>';
	} /* closes the function */

function addBicycle( $option, $memberID ) {
?>
  <h2>Enter a Bicycle</h2>
  <p>Use this form to enter the bicycle you've been working on into our database system. When you're done, press "Save and Finish", and the system will give a tag number to write on the bicycle's paper tag.</p>
  <form action="index.php#top" method="post" name="addbicycleform">
  <table>
    <tr>
    	<td width="200" align="right" class="key">Bike Brand:</td>
    	<td><input class="text_area" type="text" name="bikeBrand" id="bikeBrand" size="20" maxlength="50" value="" /></td>
    </tr>
    <tr>
    	<td width="200" align="right" class="key">Bike Model:</td>
    	<td><input class="text_area" type="text" name="bikeModel" id="bikeModel" size="20" maxlength="50" /></td>
    </tr>
    <tr>
    	<td width="200" align="right" class="key">Color:</td>
    	<td><input class="text_area" type="text" name="bikeColor" id="bikeColor" size="20" maxlength="50" /></td>
    </tr>
    <tr>
    	<td width="200" align="right" class="key">Bike Serial Number:</td>
    	<td><input class="text_area" type="text" name="bikeSerial" id="bikeSerial" size="20" maxlength="50" /></td>
    </tr>
	  <tr>
	  	<td width="100" align="right" class="key">Sale Price:</td>
	  	<td><input class="text_area" type="text" name="priceSale" id="priceSale" size="50" maxlength="250" /></td>	
	  </tr>
	  <tr>
	  	<td width="100" align="right" class="key">Is it for sale?</td>
	  	<td><input type="checkbox" name="isForSale" id="isForSale" /></td>
	  </tr>		
	  <tr>
	  	<td width="100" align="right" class="key">Is it ready?</td>
	  	<td><input type="checkbox" name="isReady" id="isReady" /></td>
	  </tr>
	  <tr>
	  	<td width="100" align="right" class="key">Size:</td>
	  	<td>
	  	  <input class="text_area" type="text" name="bikeSize1" id="bikeSize1" size="5" maxlength="250" /> x
	  		<input class="text_area" type="text" name="bikeSize2" id="bikeSize2" size="5" maxlength="250" /> x
	  		<input class="text_area" type="text" name="bikeSize3" id="bikeSize3" size="5" maxlength="250" /> &nbsp;
	  	</td>
	  </tr>
	  <tr>
	  	<td width="100" align="right" class="key">Location:</td>
	  	<td><?php HTML_cbodb::dropdownFromArray("location", CbodbItem::$itemLocationArray, 0); ?></td>
	  </tr>		
	  <tr>
	  	<td width="100" align="right" class="key">Style:</td>
	  	<td><?php HTML_cbodb::dropdownFromArray("bikeStyle", CbodbItem::$itemBikeStyleArray, 0); ?></td>
	  </tr>		
	  <tr>
	  	<td width="100" align="right" class="key">Drivetrain:</td>
	  	<td><?php HTML_cbodb::dropdownFromArray("bikeDrivetrain", CbodbItem::$itemBikeDrivetrainArray, 0); ?></td>
	  </tr>		
	  <tr>
	  	<td width="100" align="right" class="key">Frame style:</td>
	  	<td><?php HTML_cbodb::dropdownFromArray("bikeFrameStyle", CbodbItem::$itemBikeFrameStyleArray, 0); ?></td>
	  </tr>		
	  <tr>
	  	<td width="100" align="right" class="key">Tire Style:</td>
	  	<td><?php HTML_cbodb::dropdownFromArray("bikeTireStyle", CbodbItem::$itemBikeTireStyleArray, 0); ?></td>
	  </tr>
	  <tr>
	  	<td width="100" align="right" class="key">Commission:</td>
	  	<td><?php HTML_cbodb::dropdownFromArray("commissionUserID", CbodbItem::$commissionMechanics, 0); ?></td>
	  </tr>
  </table>
  <br />	
  <input type="submit" name="membersubmit" value="Save and Finish">
  <input type="hidden" name="memberID" value="<?php echo $memberID;?>">
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="task" value="savenewbicycle" />
  <input type="hidden" name="isBike" value="on" />
  </form>
<?php
}

	function newMemberPurchase( $option, $postRow=NULL )
	{?>
	<h2>Sign up with Bike Purchase</h2>
	Entering your information below will let you access the serial number of your bike in case it is stolen, and allow us to credit you with your free Bicycle Basics class, and notify you of other benefits, like your free bike check-over.
	<?php 
	if (isset($postRow[option])) {
	echo 'Sorry, but you must enter both a first name and emergency phone number to sign up!';
	} else
	{
	} ?>
	<form action="index.php#top" method="post" name="newmemberform">
	<table>
	<tr>
		<td width="200" align="right" class="key">
		Bike number:
		</td>
		<td>
			<input class="text_area" type="text" name="itemID" id="itemID" size="6" maxlength="50" value="" />
			&nbsp;&nbsp;
			Price: <input class="text_area" type="text" name="cash" id="cash" size="10" maxlength="50" value="" />
		</td>
	</tr>
	<tr>
		<td width="200" align="right" class="key">
			First Name:
		</td>
		<td>
			<input class="text_area" type="text" name="nameFirst" id="nameFirst" size="20" maxlength="50" value="<?php echo $postRow->nameFirst;?>" />
		</td>
	</tr>
	<tr>
		<td width="200" align="right" class="key">
			Last Name:
		</td>
		<td>
			<input class="text_area" type="text" name="nameLast" id="nameLast" size="20" maxlength="50" value="<?php echo $postRow->nameLast;?>" />
		</td>
	</tr>
	<tr>
		<td width="200" align="right" class="key">
			Email Address:
		</td>
		<td>
			<input class="text_area" type="text" name="emailAddress" id="emailAddress" size="50" maxlength="250" value="<?php echo $postRow->emailAddress;?>" />
		</td>
	</tr>
        <tr>
                <td width="200" align="right" class="key">
                Phone Number (to be notified of your bike benefits if you don't want to use email):</font>
                </td>
                <td>
                        <input class="text_area" type="text" name="phoneMain" id="phoneMain" size="50" maxlength="250" value="<?php echo $postRow->phoneMain;?>" />
                </td>
        </tr>
        <tr>
                <td width="200" align="right" class="key">
                Birthdate (if under 18):</font>
                </td>
                <td>
                        <input class="text_area" type="text" name="birthdate" id="birthdate" size="50" maxlength="250" value="<?php echo $postRow->birthdate;?>" />
                </td>
        </tr>
        <tr>
                <td width="200" align="right" class="key">
                        Emergency Phone (if you plan to volunteer later)</font>:
                </td>
                <td>
                        <input class="text_area" type="text" name="phoneEmerg" id="phoneEmerg" size="50" maxlength="250" value="<?php echo $postRow->phoneEmerg;?>" />
                </td>
        </tr>
	<tr>
		<td colspan="2" align="left" class="key">
Email is the main way we communicate with our members and customers. We will not share your address, and you can unsubscribe or change how much email you get from us any time. If you don't have email but would like to, <a href="http://mail.google.com">Google</a> has a good free service. You can sign up for a Google mail account first and then use the address here.&nbsp;&nbsp;&nbsp;&nbsp;

		</td>
	</tr>		
	</table>
	<br>
	<input type="submit" name="membersubmit" value="Save and Finish">
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="savenewmemberpurchase" />
	<input type="hidden" name="purchase" value="1" />
	</form>
	<?php
	}

	function oldMemberPurchase( $option, $dropdownList )
	{
	  ?>
	  <h2>Bike Purchase for existing member</h2>
	  <form action="index.php#top" method="post" name="newmemberform">
	    <select name="memberID">
	      <option value="0">Choose member's name below...</option>
	      <?php
	      	foreach ( $dropdownList as $memberRow ) {
	      		echo "<option value=\"$memberRow->id\">$memberRow->nameLast, $memberRow->nameFirst</option>";
	      	}
	      ?>
	    </select>
      <br /><br />
	    <table>
	      <tr>
	      	<td width="200" align="right" class="key">Bike number:</td>
	      	<td>
	      		<input class="text_area" type="text" name="itemID" id="itemID" size="6" maxlength="50" value="" />&nbsp;&nbsp;
	      		Price: <input class="text_area" type="text" name="cash" id="cash" size="10" maxlength="50" value="" />
	      	</td>
	      </tr>
	    </table>
	    <br />
	    <input type="submit" name="membersubmit" value="Save and Finish">
	    <input type="hidden" name="option" value="<?php echo $option;?>" />
	    <input type="hidden" name="task" value="saveoldmemberpurchase" />
	    <input type="hidden" name="purchase" value="1" />
	  </form>
	  <?php
	}


        function newMember( $option, $mailing_list_groups, $postRow=NULL )
        {?>
        <h2>Sign up to volunteer</h2>
        <?php
        if (isset($postRow['option'])) {
            echo 'Sorry, but you must enter both a first name and emergency phone number to sign up!';
        }
        ?>
        <form action="index.php#top" method="post" name="newmemberform">
        <table>
        <tr>
                <td width="150" align="right" class="key">
                        First Name:
                </td>
                <td>
                        <input class="text_area" type="text" name="nameFirst" id="nameFirst" size="20" maxlength="50" value="<?php if (isset ($postRow->nameFirst)) echo $postRow->nameFirst;?>" />
                </td>
        </tr>
        <tr>
                <td width="150" align="right" class="key">
                        Last Name:
                </td>
                <td>
                        <input class="text_area" type="text" name="nameLast" id="nameLast" size="20" maxlength="50" value="<?php if (isset ($postRow->nameLast)) echo $postRow->nameLast;?>" />
                </td>
        </tr>
        <tr>
                <td width="150" align="right" class="key">
                        Email Address:
                </td>
                <td>
                        <input class="text_area" type="text" name="emailAddress" id="emailAddress" size="50" maxlength="250" value="<?php if (isset ($postRow->emailAddress)) echo $postRow->emailAddress;?>" />
                </td>
        </tr>
        <tr>
                <td width="150" align="right" class="key">
                        Primary Phone:
                </td>
                <td>
                        <input class="text_area" type="text" name="phoneMain" id="phoneMain" size="50" maxlength="250" value="<?php if (isset ($postRow->phoneMain)) echo $postRow->phoneMain;?>" />
                </td>
        </tr>
        <tr>
                <td width="150" align="right" class="key">
                        Alternate Phone:
                </td>
                <td>
                        <input class="text_area" type="text" name="phoneAlt" id="phoneAlt" size="50" maxlength="250" value="<?php if (isset ($postRow->phoneAlt)) echo $postRow->phoneAlt;?>" />
                </td>
        </tr>
        <tr>
                <td width="150" align="right" class="key">
                        Emergency Phone <font color="Red">(required)</font>:
                </td>
                <td>
                        <input class="text_area" type="text" name="phoneEmerg" id="phoneEmerg" size="50" maxlength="250" value="<?php if (isset ($postRow->phoneEmerg)) echo $postRow->phoneEmerg;?>" />
                </td>
        </tr>
        <!--
        <tr>
                <td colspan="2" align="left" class="key">
                        Would you like to get email from us? (You can change this later)&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="emailNews" id="emailNews" <?php if (isset ($postRow->emailNews) && $postRow->emailNews) echo 'checked="checked"';?> />
                </td>
        </tr>
        -->
        </table>
        
	    <?php HTML_cbodb::listMailingListSubscriptionOptions ( $mailing_list_groups ); ?>
        
        <br>
        <input type="submit" name="membersubmit" value="Save and Finish">
        <input type="hidden" name="option" value="<?php echo $option;?>" />
        <input type="hidden" name="task" value="savenewmember" />
        </form>
        <?php
        }

function listMailingListSubscriptionOptions ( $groups )
{
    /*
     * Allow Subscribing to mailing list, and to particular Interest Groups.
     * Initially, Subscribe is checked and groups left unchecked.
     * This is currently just used as part of the Add Member form.
     */
    if (!is_array($groups))
    {
      JError::raiseNotice(100, $groups);
      return;
    }
    ?>
  
    <h2>Mailing List</h2>
        <table>
          <tr>
            <td width="150" align="right" class="key">Subscribe:</td>
            <td>
              <input type="checkbox" name="listSubscribe" value="listSubscribe" id="listSubscribe" checked="checked" />
              Send me info about my membership status: free classes, membership renewal, etc.
            </td>
          </tr>
          <tr>
            <td width="150" align="right" class="key"><span id="mailingListGroupsLbl">Let me know about:</span></td>
            <td>
                <table class="admintable" id="mailingListGroups">
                <?php
	            //echo "<pre>";
	            //print_r($mc_interest_groups);
	            //echo "</pre>";
	            foreach($groups as $group)
	            {
                    echo "<tr>\n";
                    echo "<td width=\"100\" align=\"right\" class=\"key\">$group:</td>\n";
                    echo "<td>";
	                echo "<input type=\"checkbox\" name=\"interestGroups[]\" value=\"$group\" />\n";
                    echo "</td></tr>\n";
	            }
	            ?>
	            </table>
            </td>
          </tr>
        </table>

    <script type="text/javascript">
      // Show groups when Subscribe is checked; else hide them.
      $('listSubscribe').addEvent('click', function(){
      	if (this.getProperty('checked')==true) {
      		$('mailingListGroups').setStyle('display','block')
      		$('mailingListGroupsLbl').setStyle('display','block')
      	} else {
      	  $('mailingListGroups').setStyle('display','none')
      	  $('mailingListGroupsLbl').setStyle('display','none')
      	}
      });
    </script>
  
    <?php
}


	function listTasks( $option, $memberID, $taskList )
	{
		echo '<h2>Tasks available to you:</h2>';
		echo '<table>';
		foreach ($taskList as $row )
		{
			echo '<tr><Td>'.$row->description.'</td>
			<Td>
				<form action="index.php#top" method="post" name="loginForm">
				<input type="submit" name="viewtask" value="View Task">
				<input type="hidden" name="memberID" value="'.$memberID.'" />
				<input type="hidden" name="taskID" value="'.$row->id.'" />
				<input type="hidden" name="itemID" value="'.$row->itemID.'" />
  				<input type="hidden" name="option" value="'.$option.'" />
  				<input type="hidden" name="task" value="viewtask" />
				</form>
			</td>
			</tr>';
		}
		echo '</table>';
		echo '<br><br><h1>or <a href="http://ohiocitycycles.org/index.php?option=com_cbodb&task=shop&key=3b767559374f5132236f6e68256b2529#top">Go Back</a></h1>';
	}	

	function viewTask( $option, $memberID, $task, $item )
	{

	$itemDescription = ($item == NULL) ? "No item for this task" : $item->description;

	echo '<h2>'.$task->description.'</h2>';
	echo '<table cellpadding=20><tr>';
	echo '<td width=100px>Description</td>';
	echo '<td>'.$task->comment.'</td>';
	echo '</tr>';
	echo '<tr><td>Item</td><td>'.$itemDescription.'</td></tr>';
	echo '</table>
		<form action="index.php#top" method="post" name="loginForm">
		<input type="submit" name="checkouttask" value="Check out this task">
		<input type="hidden" name="memberID" value="'.$memberID.'" />
		<input type="hidden" name="taskID" value="'.$task->id.'" />
		<input type="hidden" name="itemID" value="'.$task->itemID.'" />
  		<input type="hidden" name="option" value="'.$option.'" />
  		<input type="hidden" name="task" value="checkouttask" />
		</form>
		<form action="index.php#top" method="post" name="loginForm">
		<input type="submit" name="viewtasks" value="Back to the list">
  		<input type="hidden" name="option" value="'.$option.'" />
		<input type="hidden" name="memberID" value="'.$memberID.'" />
  		<input type="hidden" name="task" value="listtasks" />
		</form>';
		echo '<br><br><h1> <a href="http://ohiocitycycles.org/index.php?option=com_cbodb&task=shop&key=3b767559374f5132236f6e68256b2529#top">Back to start</a></h1>';

	}

	function checkInTask( $option, $memberID, $transaction, $task, $item )
	{
	$itemDescription = ($item == NULL) ? "No item for this task" : $item->description;
echo '		<form action="index.php#top" method="post" name="loginForm">';

	echo '<h2>Check In Task</h2>';
	echo '<h3>'.$task->description.'</h3>';
	echo '<table cellpadding=20><tr>';
	echo '<td width=100px>Description</td>';
	echo '<td>'.$task->comment.'</td>';
	echo '</tr>';
	echo '<tr><td>Item</td><td>'.$itemDescription.'</td></tr>';
	echo '<tr><td>What you did</td><td><textarea name="comment" id="comment"></textarea></td></tr>';
	echo '<tr><td>Is this task done?</td><td><input type="checkbox" name="isDone" id="isDone" checked></td></tr>';
	echo '</table>
		<input type="submit" name="checkouttask" value="Check in this task">
		<input type="hidden" name="memberID" value="'.$memberID.'" />
		<input type="hidden" name="taskID" value="'.$task->id.'" />
		<input type="hidden" name="transactionID" value="'.$transaction->id.'" />
  		<input type="hidden" name="option" value="'.$option.'" />
  		<input type="hidden" name="task" value="savetask" />
		</form>';
		echo '<br><br><h1> <a href="http://ohiocitycycles.org/index.php?option=com_cbodb&task=shop&key=3b767559374f5132236f6e68256b2529#top">Cancel and go back to start</a></h1>';
	}
	function listMemberTransactions($transactionList, $memberID, $page)
	{
		$timezone = new DateTimeZone(getConfigValue("timeZone"));
		echo ($page > 1) ? '<h2>Page '.$page.' of your history</h2>' : '<h2>Your most recent activity</h2>';
		echo '<table class="cbodbTrans">';
		echo '<tr><th>Date</th><th>Type</th><th>Credits</th><th>Cash</th><th>Comment</th></tr>
		';
		$rowType = 1;
		foreach ($transactionList as $transaction)
		{
		$time = new DateTime($transaction->dateOpen,new DateTimeZone("UTC"));
		date_timezone_set($time,$timezone);
			echo '<tr class="cbodbRow'.$rowType.'">';
		echo '<td>'.date_format($time,"m/d/Y H:i").'</td>
		<td>'.HTML_Cbodb::$transactionTypeArray[$transaction->type].'</td>
		<td>'.sprintf('%.2F',$transaction->credits).'</td>
		<td>$'.sprintf('%.2F',$transaction->cash).'</td>
		<td>'.$transaction->comment.'</td>
		</tr>';
		$rowType = $rowType ? 0 : 1;
		}
		
		echo '</table><br>';	
		if ($page > 1) echo '<a href="/index.php?option=com_cbodb&task=listmembertransactions&memberID='.$memberID.'&page='.($page-1).'#top">Newer Transactions</a> &nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<a href="/index.php?option=com_cbodb&task=listmembertransactions&memberID='.$memberID.'&page='.($page+1).'#top">Older Transactions</a>';
		echo '<br><br><h2><a href="http://ohiocitycycles.org/index.php?option=com_cbodb&task=shop&key=3b767559374f5132236f6e68256b2529#top">Go Back</a></h2>';

	}

	function startClass( $option, $rows, $memberID, $error=NULL )
	{
		?><h1>Starting class</h1>
		<?php if ($error) echo '<h2 style="color: red;">ERROR: '.$error.'</h2>'; ?>
		<form action="index.php#top" method="post" name="classForm">
  		<input type="hidden" name="option" value="<?php echo $option; ?>" />
  		<input type="hidden" name="task" value="saveclass" />
		<input type="hidden" name="memberID" value="<?php echo $memberID; ?>" />
		<?php
		echo '<h2>Class:</h2>';
		HTML_cbodb::dropdownFromArray(classID,HTML_cbodb::$cbodb_classtypes,0);
		echo '<p><br>Class length: <input type="text" value="2" name="duration" size="5"> hours<br>';
		echo '<h2>Date:</h2>';
		echo 'Today? <input type="checkbox" name="startsnow"> (or leave unchecked and enter a date below)';
		echo '<p>
		<select name="classdate[year]">
		<option value="2003">2003</option>
		<option value="2004">2004</option>
		<option value="2005">2005</option>
		<option value="2006">2006</option>
		<option value="2007">2007</option>
		<option selected value="2008">2008</option>
		<option value="2009">2009</option>
		<option value="2010">2010</option>
		<option value="2011">2011</option>
		<option value="2012">2012</option>
		</select>&nbsp;';
echo '<SELECT NAME="classdate[month]">
<OPTION value="1">Jan</OPTION>
<OPTION value="2">Feb</OPTION>
<OPTION value="3">Mar</OPTION>
<OPTION value="4">Apr</OPTION>
<OPTION value="5">May</OPTION>
<OPTION value="6">Jun</OPTION>
<OPTION value="7">Jul</OPTION>
<OPTION value="8">Aug</OPTION>
<OPTION value="9">Sep</OPTION>
<OPTION value="10">Oct</OPTION>
<OPTION value="11">Nov</OPTION>
<OPTION value="12">Dec</OPTION>
</SELECT>&nbsp';
		echo '<select name="classdate[day]">';
		for ($day = 0 ; $day < 32 ; $day++) {
			echo "<option value=\"$day\">$day</option>";
		}
		echo '</select>';
		echo '
		<h2>Students:</h2>
		(Uncheck box for students not taking this class)<br><br>
		<table class="loggedInList">
		<tr><th></th><th width="150px">Name</th><th>Since</th><th width="80px">Credits</th><th width="80px">Member</th><th>Paid Cash</th><th>Paid Credits</th></tr>';
		$timezone = new DateTimeZone(getConfigValue("timeZone"));
			foreach ($rows as $row )
			{
				if ($row->type == 3) {
				$dateOpen = new DateTime($row->dateOpen,new DateTimeZone("UTC"));
				date_timezone_set($dateOpen,$timezone);
				echo '<tr>';
				echo '<td><input type="checkbox" name="students['.$row->id.'][inclass]" id="inclass"></td>';
				echo '<Td>'.$row->nameFirst." ".$row->nameLast.'</td>
				<td>'.date_format($dateOpen,"n/d/Y H:i").'</td>
				<Td>&nbsp;&nbsp;'.sprintf("%.2F",CbodbTransaction::getMemberCredits($row->id)).'</td>';
				echo '<td>'.($row->isMember ? 'Yes' : 'No').'</td>';
				echo '<td><input type="text" name="students['.$row->id.'][paidcash]" size="5"></td>';
				echo '<td><input type="text" name="students['.$row->id.'][paidcredits]" size="5"></td>';
				/*if ($row->isGroup2) {*/			
				echo '</tr>';
				}
			}
		echo '</table>';
		echo '<br><br><input class="bigbutton" type="submit" name="startclass" value="Start Class">';
		echo '</form>';
		echo '<br><br><h2>or <a href="http://ohiocitycycles.org/index.php?option=com_cbodb&task=shop&key=3b767559374f5132236f6e68256b2529#top">Go Back</a></h2>';
	}
	
}
