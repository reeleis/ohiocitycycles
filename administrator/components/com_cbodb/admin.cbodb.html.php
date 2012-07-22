<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class HTML_cbodb
{

// moved to CbodbItem
//static $itemBikeStyleArray = array("Not specified", "Road", "Hybrid", "Mountain", "City", "Cruiser", "BMX", "Kids");
//static $itemStatusArray = array("Not specified", "Perfect", "Ready for Sale", "Ready for Rent", "Needs Repair");
//static $itemLocationArray = array("Not specified", "Sales Floor", "LSR", "EAB Shed", "Rental Shed", "Rental cabinet", "Currently Out", "Lost");
//static $itemBikeSizeUnitArray = array("Not specified", "cm", "in");
//static $itemBikeTireStyleArray = array("Not specified", "Smooth", "Kinda Knobby", "Knobby");
//static $itemBikeDrivetrainArray = array("Not specified", "F&R Derailer", "Rear Derailer", "Hub Gears", "Singlespeed", "Fixed Gear", "Unispeed");
//static $itemSourceArray = array("Not specified", "Individual Donation", "Bike shop collection", "Police", "Purchased new");
//static $itemBikeFrameStyleArray = array("Not specified", "Diamond", "Mixte", "Step-through", "Tandem");
//static $commissionMechanics = array(0 => "No one", 1180 => "Al");

static $adminTransactionTypeArray = array(1001 => "Purchase", 1002 => "Credits Added", 1004 => "Volunteer time addition", 2001 => "Comment", 1005 => "Bike Credit");
static $transactionTypeArray = array(
     1 => "Volunteering",
     2 => "Personal",
     3 => "Taking class",
	   4 => "Staff",
	   5 => "Ride",
	1001 => "Purchase",
	1002 => "Credits Added",
	1003 => "Membership Renewal",
	1004 => "Volunteer time addition",
	2001 => "Comment",
	1005 => "Bike Credit",
	3001 => "Task check-out",
	4001 => "Taking a Class",
	4002 => "Teaching a Class");
static $taskTypeArray = array(0 => "Please choose a type",1 => "Bicycle repair", 2 => "Bicycle strip", 3 => "Other bicycle task", 4 => "Cleaning", 5 => "Organization", 6 => "Parts work", 7 => "General office work", 8 => "Skilled office labor", 9 => "Online work", 10 => "Other");

// moved to CbodbMember
//static $memberGroupArray = array(
//  1 => "Class graduate or test-out",
//  2 => "Skilled mechanic",
//  3 => "Super volunteer",
//  4 => "Staff",
//  5 => "Trustee",
//  6 => "New volunteer",
//  7 => "Current student",
//  8 => "Key volunteer");

static $memberRenewalTermArray = array(31 => "One Month", 62 => "Three Months", 366 => "One year", 732 => "Two years");

function translateTransactionType($typeCode)
{
  if (array_key_exists($typeCode, HTML_cbodb::$transactionTypeArray))
  {
    return HTML_cbodb::$transactionTypeArray[$typeCode];
  } else {
    return "Unknown ($typeCode)";
  }
}

function dropdownFromArray( $name, $options, $selectedKey, $disabled=false )
{
  $disabledStr = $disabled ? ' disabled="disabled"' : '';
	echo "<select name=\"$name\"$disabledStr>";
	foreach ($options as $key => $value) {
	  $selectedStr = ($key == $selectedKey) ? 'selected="selected" ' : '';
	  echo "<option ${selectedStr}value=\"$key\">$value</option>";
	}
	echo '</select>';
}

function showMainMenu( $option, $loggedincount )
{
	global $mainframe;
	jimport('joomla.utilities.date');
  $date = new JDate('now');
  $tzoffset	= $mainframe->getCfg('offset');
  $date->setOffset($tzoffset);
  $timeStr = $date->toFormat("%l:%M %P");
  $dateStr = $date->toFormat("%A, %B %e, %G");
	//$tzEST = new DateTimeZone('America/New_York');
	//$date = new DateTime("now", $tzEST);
	//$date = new DateTime("now");
	//$timeStr = $date->format("g:i a");
	//$dateStr = $date->format("l, F jS Y");
	
	$ipset = CheckAccess();
	echo '<h1>Ohio City Bicycle Co-op Member Database</h1>';
	echo "<h2>There are currently $loggedincount members clocked in at $timeStr on $dateStr.</h2>\n";
//	echo '<h2>Access '.($ipset ? '<font color="green">is enabled</font>' : '<font color="red">is NOT enabled</font>'). ' from your location.';
  	echo '<form action="index.php" method="post" name="adminForm">';
	echo '<input type="hidden" name="option" value="'.$option.'">';
	echo '<input type="hidden" name="task" value="" />';
  	echo '<input type="hidden" name="boxchecked" value="0" />';
	echo '</form>';
}

function showMembers( $option, &$rows )
{
  ?>
  <form action="index.php" method="post" name="adminForm">
  <?php
  echo '<h2>Members</h2>';
  echo '<h2>Show: &nbsp;&nbsp;' ;
  $filters = array("Recent","Active","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
  foreach ( $filters as $filter )
		{
			$link = JRoute::_('index.php?option=' . $option . '&task=showfiltermembers&filter='.$filter);
			echo "<a href=\"".$link."\">".$filter."</a>&nbsp;&nbsp;";
		}
	echo '</h2>';
  /*echo '<strong>Filter:</strong> Name: <select name="saleFilter">';
  echo '<h2>Sort by: &nbsp;&nbsp;';
  $memberFilters = array('Size' => "bikeSize1", 'Brand' => "bikeBrand", "Color" => "bikeColor", "Price" => "priceSale", "Style" => "bikeStyle", "Serial Number" => "bikeSerial");
  foreach ( $memberFilters as $key => $filter )
		{
			$link = JRoute::_('index.php?option=' . $option . '&task=showfiltermembers&sortby='.$filter);
			echo "&bull; <a href=\"".$link."\">".$key."</a>&nbsp;&nbsp;";
		}
  echo '&bull;</h2>';*/
  ?>
  <table class="adminlist">
    <thead>
      <tr>
        <th width="20px">
          <input type="checkbox" name="toggle" 
               value="" onclick="checkAll(<?php echo 
               count( $rows ); ?>);" />
        </th>
        <th width="20%">Name</th>
        <th width="20%">Address</th>
        <th width="15%">Email</th>
        <th width="10%">Emergency Phone</th>
        <th width="5%">Member?</th>
        <th width="10%">Membership Expiration</th>
        <th width="10%">Clock out</th>
        <th width="10%">Other options</th>
      </tr>
    </thead>

    <?php
    $k = 0;
    for ($i=0, $n=count( $rows ); $i < $n; $i++) 
    {
      $row = &$rows[$i];
      $checked = JHTML::_('grid.id', $i, $row->id );
      $link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=edit&cid[]='. $row->id );
      ?>
      <tr class="<?php echo "row$k"; ?>">
        <td>
          <?php echo $checked; ?>
        </td>
        <td>
          <a href="<?php echo $link; ?>"><?php echo $row->nameFirst . ' ' . $row->nameLast; ?></a>
        </td>
        <td>
          <?php echo ($row->address1 != null && $row->address1 != '' ? $row->address1 . ', ':'') . ($row->address2 != null && $row->address2 != '' ? $row->address2 . ', ':'') . ($row->city != null && $row->city != '' ?$row->city . ', ':'') . ($row->state != null && $row->state != ''  ? $row->state . ' ' : '') . $row->zip ?> 
        </td>
        <td>
          <?php echo $row->emailAddress; ?>
        </td>
        <td>
          <?php echo $row->phoneEmerg; ?>
        </td>
        <td align="center">
          <?php echo $row->isMember ? JHTML::image('administrator/images/tick.png','yes') : JHTML::image('administrator/images/publish_x.png','yes');?> 
        </td>
        <td>
          <?php echo $row->membershipExpire; ?>
        </td>
	<td>
	</td>
	<td>
	Log out at time
	</td>
      </tr>
      <?php
      $k = 1 - $k;
    }
    ?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  </form>
  <?php
}

function showBicycles( $option, &$rows, $pageNav, $saleFilter )
{
  ?>
  <form action="index.php" method="post" name="adminForm">
  <?php
  echo '<h2>Sort by: &nbsp;&nbsp;' ;
  $bikeFilters = array('Size' => "bikeSize1", 'Brand' => "bikeBrand", "Color" => "bikeColor", "Price" => "priceSale", "Style" => "bikeStyle", "Serial Number" => "bikeSerial", "Tag Number" => "tag");
  foreach ( $bikeFilters as $key => $filter )
		{
			$link = JRoute::_('index.php?option=' . $option . '&task=showfilterbicycles&filter='.$filter);
			echo "&bull; <a href=\"".$link."\">".$key."</a>&nbsp;&nbsp;";
		}
	echo '&bull;</h2>';
  ?>
  <strong>Filter:</strong> Is Sold: <select name="saleFilter">
    <option value="" <?php if($saleFilter == 'none') echo 'selected="selected"';  ?> ></option>
    <option value="true" <?php if($saleFilter == 'true') echo 'selected="selected"'?>>Show Sold</option>
    <option value="false" <?php if($saleFilter == 'false') echo 'selected="selected"'?>>Show Unsold</option>
  </select>
  <input type="submit" name="Submit" value="Filter" />
  <table class="adminlist">
    <thead>
      <tr>
        <th width="20px">
          <input type="checkbox" name="toggle" 
               value="" onclick="checkAll(<?php echo 
               count( $rows ); ?>);" />
        </th>
	<th width="7%">Tag number</th>
        <th width="10%">Brand</th>
        <th width="10%">Model</th>
        <th width="10%">Color</th>
        <th width="4%">Price</th>
        <th width="10%">Size</th>
        <th width="10%">Style</th>
        <th width="10%">Drivetrain</th>
        <th width="10%">Tire style</th>
        <th width="10%">Frame style</th>
	<th width="10%">Serial Number</th>
        <th width="4%">Ready</th>
        <th width="4%">Sold</th>
      </tr>
    </thead>

    <?php
    $k = 0;
    for ($i=0, $n=count( $rows ); $i < $n; $i++) 
    {
      $row = &$rows[$i];
      $checked = JHTML::_('grid.id', $i, $row->id );
      $link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=edit&cbodb_mode=bicycle&cid[]='. $row->id );
      ?>
      <tr class="<?php echo "row$k"; ?>">
        <td>
          <?php echo $checked; ?>
        </td>
        <td>
          <a href="<?php echo $link; ?>"><?php echo $row->tag; ?></a>
          <?php
            if ($row->isForSale && $row->isReady && !$row->isSold) {
            	$purchase_this_bicycle_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=add&cbodb_mode=transaction&type=1001&itemID='. $row->tag . '&cash=' . $row->priceSale . '&comment=' . urlencode($row->description));
            	$purchase_this_bicycle_link_markup = "<br /><a href=\"$purchase_this_bicycle_link\" title=\"Purchase $row->tag - $row->description\">Purchase this bicycle</a>";
            	echo $purchase_this_bicycle_link_markup;
	    }
          ?>
        </td>
        <td>
          <a href="<?php echo $link; ?>"><?php echo $row->bikeBrand; ?></a>
        </td>
        <td>
          <?php echo $row->bikeModel; ?>
        </td>
        <td>
          <?php echo $row->bikeColor; ?>
        </td>
        <td>
        	<?php echo $row->priceSale; ?>
        </td>
        <td>
        	<?php echo $row->bikeSize1.'x'.$row->bikeSize2.' '.CbodbItem::$itemBikeSizeUnitArray[$row->bikeSizeUnit]; ?>
        </td>
        <td>
        	<?php echo CbodbItem::$itemBikeStyleArray[$row->bikeStyle]; ?>
        </td>
        <td>
        	<?php echo CbodbItem::$itemBikeDrivetrainArray[$row->bikeDrivetrain]; ?>
        </td>
        <td>
        	<?php echo CbodbItem::$itemBikeTireStyleArray[$row->bikeTireStyle]; ?>
        </td>
        <td>
        	<?php echo CbodbItem::$itemBikeFrameStyleArray[$row->bikeFrameStyle]; ?>
        </td>
        <td>
        	<?php echo $row->bikeSerial; ?>
        </td>
        <td align="center">
          <?php echo $row->isReady ? JHTML::image('administrator/images/tick.png','yes') : JHTML::image('administrator/images/publish_x.png','yes');?> 
	</td>
        <td align="center">
          <?php echo $row->isSold ? JHTML::image('administrator/images/tick.png','yes') : JHTML::image('administrator/images/publish_x.png','yes');?> 
	</td>
      </tr>
      <?php
      $k = 1 - $k;
    }
    ?>
  </table>
<?php echo $pageNav->getListFooter(); ?>
  <input type="hidden" name="option" 
                    value="<?php echo $option;?>" />
  <input type="hidden" name="task" value="showbicycles" />
  <input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="cbodb_mode" value="bicycle" />
  </form>
  <?php
}

function showBicycleTransactions ( $option, &$rows )
{
  // Generally to be displayed at the bottom of the editBicycle page
  ?>  
	<fieldset class="adminform">
	<legend>Bicycle Transaction History</legend>
  <table class="adminlist">
    <thead>
      <tr>
        <th>Transaction ID</th>
        <th>Member</th>
        <th>Date/Time</th>
        <th>Credits</th>
        <th>Cash</th>
        <th>Type</th>
        <th>Comment</th>
      </tr>
    </thead>
  
    <?php
    $k = 0;
    for ($i=0, $n=count( $rows ); $i < $n; $i++)
    {
      $row = &$rows[$i];
      $edit_transaction_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=editMember&cbodb_mode=transaction&cid='. $row->id );
      ?>
      <tr class="<?php echo "row$k"; ?>">
        <td>
          <a href="<?php echo $edit_transaction_link; ?>" title="Edit transaction #<?php echo $row->id; ?>"><?php echo $row->id; ?></a>
        </td>
        <?php
          $member_name = $row->nameFirst . ' ' . $row->nameLast;

          $member_details_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=edit&cid[]='. $row->memberID );
          $member_details_link_markup = "<a href=\"$member_details_link\" title=\"Member details for $member_name\">$member_name</a>";

          $member_transactions_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=transactions&member_id='. $row->memberID );
          $member_transactions_link_markup = "<a href=\"$member_transactions_link\" title=\"List transactions for $member_name\">transactions</a>";
        ?>
        <td>
          <?php echo $member_details_link_markup; ?> (<?php echo $member_transactions_link_markup; ?>)
        </td>
        <td>
          <?php echo $row->dateClosed; ?>
        </td>
        <td>
          <?php echo $row->credits; ?>
        </td>
        <td>
          <?php echo $row->cash; ?>
        </td>
        <td>
          <?php echo HTML_cbodb::translateTransactionType($row->type); ?>
        </td>
        <td>
          <?php echo $row->comment; ?>
        </td>
      </tr>
      <?php
      $k = 1 - $k;
    }
    ?>
  </table>
  
  </fieldset>
  
  <?php
}

function editBicycle( $item, $option ) 
{
	JHTML::_('behavior.calendar');
	?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend>Bicycle Details</legend>
	<table class="admintable">
	<tr>
		<td width="100" align="right" class="key">Tag Number:</td>
		<td><input class="text_area" type="text" name="tag" id="tag" value="<?php echo $item->tag; ?>"></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">Brand:</td>
		<td><input class="text_area" type="text" name="bikeBrand" id="bikeBrand" size="20" maxlength="50" value="<?php echo $item->bikeBrand;?>" /></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">Model:</td>
		<td><input class="text_area" type="text" name="bikeModel" id="bikeModel" size="20" maxlength="50" value="<?php echo $item->bikeModel;?>" /></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">Color:</td>
		<td><input class="text_area" type="text" name="bikeColor" id="bikeColor" size="50" maxlength="250" value="<?php echo $item->bikeColor;?>" /></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">Serial:</td>
		<td><input class="text_area" type="text" name="bikeSerial" id="bikeSerial" size="50" maxlength="250" value="<?php echo $item->bikeSerial;?>" /></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">Sale Price:</td>
		<td><input class="text_area" type="text" name="priceSale" id="priceSale" size="50" maxlength="250" value="<?php echo $item->priceSale;?>" /></td>	
	</tr>
	<tr>
		<td width="100" align="right" class="key">Is it for sale?</td>
		<td><input type="checkbox" name="isForSale" id="isForSale" <?php echo ($item->isForSale ? "checked" : "");?> /></td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">Is it ready?</td>
		<td><input type="checkbox" name="isReady" id="isReady" <?php echo ($item->isReady ? "checked" : "");?> /></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">Is it sold?</td>
		<td>
			<input type="checkbox" name="isSold" id="isSold" <?php echo ($item->isSold ? "checked" : "");?> />
          <?php
            if ($item->isForSale && $item->isReady && !$item->isSold) {
            	$purchase_this_bicycle_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=add&cbodb_mode=transaction&type=1001&itemID='. $item->tag . '&cash=' . $item->priceSale . '&comment=' . urlencode($item->description));
            	$purchase_this_bicycle_link_markup = "<a href=\"$purchase_this_bicycle_link\" title=\"Purchase $item->tag - $item->description\">Purchase this bicycle</a>";
            	echo $purchase_this_bicycle_link_markup;
	    }
          ?>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">Size:</td>
		<td>
		  <input class="text_area" type="text" name="bikeSize1" id="bikeSize1" size="5" maxlength="250" value="<?php echo $item->bikeSize1;?>" /> x
			<input class="text_area" type="text" name="bikeSize2" id="bikeSize2" size="5" maxlength="250" value="<?php echo $item->bikeSize2;?>" /> x
			<input class="text_area" type="text" name="bikeSize3" id="bikeSize3" size="5" maxlength="250" value="<?php echo $item->bikeSize3;?>" /> &nbsp;
			<?php HTML_cbodb::dropdownFromArray("bikeSizeUnit",CbodbItem::$itemBikeSizeUnitArray,$item->bikeSizeUnit); ?>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">Location:</td>
		<td><?php HTML_cbodb::dropdownFromArray("location",CbodbItem::$itemLocationArray,$item->location); ?></td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">Style:</td>
		<td><?php HTML_cbodb::dropdownFromArray("bikeStyle",CbodbItem::$itemBikeStyleArray,$item->bikeStyle); ?></td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">Drivetrain:</td>
		<td><?php HTML_cbodb::dropdownFromArray("bikeDrivetrain",CbodbItem::$itemBikeDrivetrainArray,$item->bikeDrivetrain); ?></td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">Frame style:</td>
		<td><?php HTML_cbodb::dropdownFromArray("bikeFrameStyle",CbodbItem::$itemBikeFrameStyleArray,$item->bikeFrameStyle); ?></td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">Tire Style:</td>
		<td><?php HTML_cbodb::dropdownFromArray("bikeTireStyle",CbodbItem::$itemBikeTireStyleArray,$item->bikeTireStyle); ?></td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">Source:</td>
		<td><?php HTML_cbodb::dropdownFromArray("source",CbodbItem::$itemSourceArray,$item->source); ?></td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">Commission:</td>
		<td><?php HTML_cbodb::dropdownFromArray("commissionUserID",CbodbItem::$commissionMechanics,$item->commissionUserID); ?></td>
	</tr>		

	<tr>
		<td width="100" align="right" class="key">Record Last Updated:</td>
		<td><?php echo $item->timeChanged;?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">Do Another?</td>
		<td><input type="checkbox" name="another" checked></td>
	</tr>
	</table>
	<input type="submit" name="addbutton" value="Save Bike" />
	</fieldset>
	<input type="hidden" name="id" value="<?php echo $item->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="cbodb_mode" value="bicycle" />
	<input type="hidden" name="isBike" value="on" />
	</form>
	<?php
}

function showLoggedInMembers( $option, &$rows )
{
	global $mainframe;
	jimport('joomla.utilities.date');
  $date = new JDate('now');
  $tzoffset	= $mainframe->getCfg('offset');
  $date->setOffset($tzoffset);
  $timeStr = $date->toFormat("%l:%M %P");
  $dateStr = $date->toFormat("%A, %B %e, %G");
	//$tzEST = new DateTimeZone('America/New_York');
	//$date = new DateTime("now", $tzEST);
	//$date = new DateTime("now");
	//$timeStr = $date->format("g:i a");
	//$dateStr = $date->format("l, F jS Y");
  ?>
  <h2>There are currently <?php print count($rows); ?> members clocked in at <?php print "$timeStr on $dateStr"; ?></h2>
  <form action="index.php" method="post" name="adminForm" id="adminForm">
  <input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="task" value="" />
Clock out time:
		<?php
		echo "<select name=\"hour\">";
		for ($q=1;$q<24;$q++) {echo "<option "; if ($q==21) {echo "selected ";} echo "value=\"".$q."\">".$q;}
		echo "</select><select name=\"minute\"><option value=\"0\">00</option>";
		for ($q=1;$q<4;$q++) {echo "<option value=\"".(15*$q)."\">".(15*$q)."</option>";}
		?>
	</select><br>
  <table class="adminlist">
    <thead>
      <tr>
        <th width="20px">
          <input type="checkbox" name="toggle" 
               value="" onclick="checkAll(<?php echo 
               count( $rows ); ?>);" />
        </th>
        <th width="50%">Name</th>
        <th width="15%">Email</th>
        <th width="10%">Emergency Phone</th>
	<th width="10%">Time in</th>
	<th width="10%">For</th>
        <th width="5%">Member?</th>
      </tr>
    </thead>

    <?php
    $k = 0;
    for ($i=0, $n=count( $rows ); $i < $n; $i++) 
    {
      $row = &$rows[$i];
      $checked = JHTML::_('grid.id', $i, $row->transid );
      $link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=edit&cid[]='. $row->id );
      ?>
      <tr class="<?php echo "row$k"; ?>">
        <td>
          <?php echo $checked; ?>
        </td>
        <td>
          <a href="<?php echo $link; ?>"><?php echo $row->nameFirst . ' ' . $row->nameLast; ?></a>
        </td>
        <td>
          <?php echo $row->emailAddress; ?>
        </td>
        <td>
          <?php echo $row->phoneEmerg; ?>
        </td>
        <td>
          <?php echo $row->dateOpen; ?>
        </td>
        <td>
        </td>
        <td align="center">
          <?php echo $row->isMember ? JHTML::image('administrator/images/tick.png','yes') : JHTML::image('administrator/images/publish_x.png','yes');?> 
        </td>
      </tr>
      <?php
      $k = 1 - $k;
    }
    ?>
  </table>
  </form>
  <?php
}

function showTransactions( $option, &$rows, &$pageNav, &$lists, $member_id, $dateStart, $dateEnd )
{
	JHTML::_('behavior.calendar');
	
  $numCols = 10;
  if (empty($member_id)) {
    $title = "Transactions";
  } else {
    $member = new CbodbMember($member_id);
    $title = "Transactions for <em>".$member->nameFirst." ".$member->nameLast."</em> (member #$member_id)";
    $numCols--;
  }
  ?>
  <h2><?php print $title; ?></h2>
  <form action="index.php" method="post" name="adminForm">
  
  <table>
		<tr>
			<td align="left" width="100%">
	    	<strong>Filter:</strong>
        <span style="margin: 0 1em;">
				  Transaction Type: <?php echo $lists['transaction_type']; ?>
        </span>
        <span style="margin: 0 1em;">
          Start Date: <input class="inputbox" type="text" name="dateStart" id="dateStart" size="11" dateStart="10" value="<?php echo $dateStart; ?>" />
          <input type="reset" class="button" value="..." onclick="return showCalendar('dateStart','%Y-%m-%d');" />
        </span>
        <span style="margin: 0 1em;">
          End Date: <input class="inputbox" type="text" name="dateEnd" id="dateEnd" size="11" maxlength="10" value="<?php echo $dateEnd; ?>" />
          <input type="reset" class="button" value="..." onclick="return showCalendar('dateEnd','%Y-%m-%d');" />
        </span>
        <input type="reset" class="button" value="clear dates" onclick="document.adminForm.dateEnd.value=''; document.adminForm.dateStart.value=''; return false;" />
        <input type="submit" name="Submit" value="Filter" />
			</td>
		</tr>
	</table>
  
  <table class="adminlist">
    <thead>
      <tr>
        <th width="20px">
          <input type="checkbox" name="toggle" 
               value="" onclick="checkAll(<?php echo 
               count( $rows ); ?>);" />
        </th>
        <th>T.ID</th>
        <?php if (empty($member_id)): ?>
          <th>Member</th>
        <?php endif; ?>
        <th>Time Open</th>
        <th>Time Closed</th>
        <th>Duration</th>
        <th>Credits</th>
        <th>Cash</th>
        <th>Type</th>
        <th>Comment</th>
      </tr>
    </thead>
  	<tfoot>
  		<tr>
  			<td colspan="<?php echo $numCols; ?>">
  				<?php echo $pageNav->getListFooter(); ?>
  			</td>
  		</tr>
  	</tfoot>

    <?php
    $k = 0;
    for ($i=0, $n=count( $rows ); $i < $n; $i++) 
    {
      $row = &$rows[$i];
      $checked = JHTML::_('grid.id', $i, $row->id );
      $edit_transaction_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=editMember&cbodb_mode=transaction&cid='. $row->id );
      ?>
      <tr class="<?php echo "row$k"; ?>">
        <td>
          <?php echo $checked; ?>
        </td>
        <td>
          <a href="<?php echo $edit_transaction_link; ?>" title="Edit transaction #<?php echo $row->id; ?>"><?php echo $row->id; ?></a>
        </td>
        <?php if (empty($member_id)): ?>
          <?php
            $member_name = $row->nameFirst . ' ' . $row->nameLast;
            $member_transactions_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=transactions&member_id='. $row->memberID );
            $member_transactions_link_markup = "<a href=\"$member_transactions_link\" title=\"List transactions for $member_name\">$member_name</a>";
          ?>
          <td>
            <?php echo $member_transactions_link_markup; ?>
          </td>
        <?php endif; ?>
        <td>
          <?php echo $row->dateOpen; ?>
        </td>
        <td>
          <?php echo $row->dateClosed; ?>
        </td>
        <td>
          <?php echo show_transaction_totaltime($row->isOpen, $row->totalTime); ?>
        </td>
        <td>
          <?php echo $row->credits; ?>
        </td>
        <td>
          <?php echo $row->cash; ?>
        </td>
        <td>
          <?php echo HTML_cbodb::translateTransactionType($row->type); ?>
        </td>
        <td>
          <?php echo $row->comment; ?>
        </td>
      </tr>
      <?php
      $k = 1 - $k;
    }
    ?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="task" value="transactions" />
  <input type="hidden" name="cbodb_mode" value="transaction" />
  <input type="hidden" name="list_query_limit" value="<?php echo $pageNav->limit;?>" />
  <input type="hidden" name="list_query_limitstart" value="<?php echo $pageNav->limitstart;?>" />
  <input type="hidden" name="list_query_member_id" value="<?php echo $member_id;?>" />
  <input type="hidden" name="list_query_dateStart" value="<?php echo $dateStart;?>" />
  <input type="hidden" name="list_query_dateEnd" value="<?php echo $dateEnd;?>" />
  <input type="hidden" name="boxchecked" value="0" />
  </form>
  <?php
}

function showTasks( $option, &$rows )
{
  ?>
  <form action="index.php" method="post" name="adminForm">
  <table class="adminlist">
    <thead>
      <tr>
        <th width="20px">
          <input type="checkbox" name="toggle" 
               value="" onclick="checkAll(<?php echo 
               count( $rows ); ?>);" />
        </th>
        <th width="5%">id</th>
        <th width="10%">Type</th>
        <th>Description</th>
        <th width="10%">Time Added</th>
        <th width="5%">Checked out</th>
        <th width="5%">Done</th>
        <th width="5%">Active</th>
      </tr>
    </thead>

    <?php
    $k = 0;
    for ($i=0, $n=count( $rows ); $i < $n; $i++) 
    {
      $row = &$rows[$i];
      $checked = JHTML::_('grid.id', $i, $row->id );
      $link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&cbodb_mode=task&task=edit&cid[]='. $row->id );
      ?>
      <tr class="<?php echo "row$k"; ?>">
        <td>
          <?php echo $checked; ?>
        </td>
        <td><?php echo $row->id; ?></td>
        <td><?php echo HTML_cbodb::$taskTypeArray[$row->type]; ?></td>
        <td>
          <a href="<?php echo $link; ?>"><?php echo $row->description; ?></a>
        </td>
        <td>
          <?php echo $row->timeAdded; ?>
        </td>
        <td>
          <?php echo $row->isOpen ? JHTML::image('administrator/images/tick.png','yes') : JHTML::image('administrator/images/publish_x.png','yes');?> 
        </td>
        <td>
          <?php echo "<a href=\"/administrator/index.php?option=$option&task=toggletaskflag&flag=isDone&taskID=$row->id\">";
		echo ($row->isDone) ? JHTML::image('administrator/images/tick.png','yes') : JHTML::image('administrator/images/publish_x.png','yes');
		echo "</a>"; ?>
        </td>
        <td>
          <?php echo "<a href=\"/administrator/index.php?option=$option&task=toggletaskflag&flag=active&taskID=$row->id\">";
		echo ($row->active) ? JHTML::image('administrator/images/tick.png','yes') : JHTML::image('administrator/images/publish_x.png','yes');
		echo "</a>"; ?>
        </td>
      </tr>
      <?php
      $k = 1 - $k;
    }
    ?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="cbodb_mode" value="task" />
  </form>
  <?php
}

function viewMember( $member, $option ) 
{
	JHTML::_('behavior.calendar');
	
	$member_name = $member->nameFirst." ".$member->nameLast;
  
  $member_mailchimp_info_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=viewMemberMailChimpInfo&cid[]='. $member->id );
  $member_mailchimp_info_link_markup = "<a href=\"$member_mailchimp_info_link\" title=\"MailChimp subscription info for $member_name\">MailChimp Info</a>";
	?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend>Member Details</legend>
	<table class="admintable">
	<tr>
	<tr>
		<td width="100" align="right" class="key">
			Name:
		</td>
		<td>
			<?php echo $member_name;?>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Email Address:
		</td>
		<td>
			<?php echo $member->emailAddress;?>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Primary Phone:
		</td>
		<td>
			<?php echo $member->phoneMain;?>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Alternate Phone:
		</td>
		<td>
			<?php echo $member->phoneAlt;?>
		</td>	
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Emergency Phone:
		</td>
		<td>
			<?php echo $member->phoneEmerg;?>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			E-mail Subscriptions:
		</td>
		<td>
		  <?php echo $member_mailchimp_info_link_markup; ?>
		</td>
	</tr>		
    <!--
	<tr>
		<td width="100" align="right" class="key">
			Receive Email Status Reports?
		</td>
		<td>
			<?php echo ($member->emailStatus ? "Yes" : "No");?>
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			Receive Email News?
		</td>
		<td>
			<?php echo ($member->emailNews ? "Yes" : "No");?>
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			Receive Email Volunteer Opportunities?
		</td>
		<td>
			<?php echo ($member->emailVolunteerOpps ? "Yes" : "No");?>
		</td>
	</tr>
	-->
	<tr>
		<td width="100" align="right" class="key">
			Current Member?
		</td>
		<td>
			<?php echo $member->isMember ? JHTML::image('administrator/images/tick.png','yes') : JHTML::image('administrator/images/publish_x.png','yes');?> <a href="something">Renew</a>
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			Membership Expires:
		</td>
		<td>
			<?php echo $member->membershipExpire;?>
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			Groups:
		</td>
		<td>
		</td>
	</tr>
	
	<?php
	 // list all group associations
	 foreach (CbodbMember::$memberGroupArray as $groupNum => $groupName)
	 {
	  ?>
	   <tr>
	     <td width="100" align="right" class="key">
	       <?php echo $groupName; ?>
	     </td>
	     <td>
	       <?php echo ($member->isInGroup($groupNum) ? "Yes" : "No");?>
       </td>
     </tr>	
	   <?php
	 }
	?>

	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Class 1: Intro";?>
		</td>
		<td>
			<?php echo ($member->custom1 ? "Yes" : "No");?>
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Class 2: Wheels";?>
		</td>
		<td>
			<?php echo ($member->custom2 ? "Yes" : "No");?>
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Class 3: Brakes";?>
		</td>
		<td>
			<?php echo ($member->custom3 ? "Yes" : "No");?>
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Class 4: Gears";?>
		</td>
		<td>
			<?php echo ($member->custom4 ? "Yes" : "No");?>
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Bike Driver's Ed";?>
		</td>
		<td>
			<?php echo ($member->custom5 ? "Yes" : "No");?>
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			Record Last Updated:
		</td>
		<td>
			<?php echo $member->timeChanged;?>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Member ID:
		</td>
		<td>
			<?php echo $member->id;?>
		</td>
	</tr>
	</table>
	</fieldset>
	<input type="hidden" name="id" value="<?php echo $member->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="cbodb_mode" value="member" />
	</form>
	<?php
}


function editMember( $member, $option ) 
{
	JHTML::_('behavior.calendar');
	
	$member_name = $member->nameFirst." ".$member->nameLast;
	
  $member_transactions_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=transactions&member_id='. $member->id );
  $member_transactions_link_markup = "<a href=\"$member_transactions_link\" title=\"List transactions for $member_name\">$member_name's transactions</a>";

  $member_mailchimp_info_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=viewMemberMailChimpInfo&cid[]='. $member->id );
  $member_mailchimp_info_link_markup = "<a href=\"$member_mailchimp_info_link\" title=\"MailChimp raw subscription info for $member_name\">MailChimp Raw</a>";

  $member_subscriptions_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=editMailingListSubscription&cid[]='. $member->id );
  $member_subscriptions_link_markup = "<a href=\"$member_subscriptions_link\" title=\"Mailing list subscriptions info for $member_name\">Subscription Info</a>";
	?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend>Member Details</legend>
	<table class="admintable">
	<tr>
	<tr>
		<td width="100" align="right" class="key">
			First Name:
		</td>
		<td>
			<input class="text_area" type="text" name="nameFirst" id="nameFirst" size="20" maxlength="50" value="<?php echo $member->nameFirst;?>" />
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Last Name:
		</td>
		<td>
			<input class="text_area" type="text" name="nameLast" id="nameLast" size="20" maxlength="50" value="<?php echo $member->nameLast;?>" />
		</td>
	</tr>
        <tr>
                <td width="100" align="right" class="key">
                        Address 1:
		</td>
                <td>
                        <input class="text_area" type="text" name="address1" id="address1" size="20" maxlength="50" value="<?php echo $member->address1;?>"/>
                </td>
        </tr>
        <tr>
                <td width="100" align="right" class="key">
                       Address 2:
                </td>
                <td>
			<input class="text_area" type="text" name="address2" id="address2" size="20" maxlength="50" value="<?php echo $member->address2;?>"/>
		</td>
        </tr>
        <tr>
                <td width="100" align="right" class="key">
			City:
                </td>
                <td>
                        <input class="text_area" type="text" name="city" id="city" size="20" maxlength="50" value="<?php echo $member->city;?>"/>
                </td>
        </tr>

	<tr>
		<td width="100" align="right" class="key">
			State:
                </td>
                <td>
                        <input class="text_area" type="text" name="state" id="state" size="20" maxlength="50" value="<?php echo $member->state;?>"/>
                </td>
        </tr>
        <tr>
		<td width="100" align="right" class="key">
			Zip:
		</td>
		<td>
			<input class="text_area" type="text"name="zip" id="zip" size="20" maxlength="50" value="<?php echo $member->zip ?>"/>
		</td>
        </tr>
	<tr>
		<td width="100" align="right" class="key">
			Email Address:
		</td>
		<td>
			<input class="text_area" type="text" name="emailAddress" id="emailAddress" size="50" maxlength="250" value="<?php echo $member->emailAddress;?>" />
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Primary Phone:
		</td>
		<td>
			<input class="text_area" type="text" name="phoneMain" id="phoneMain" size="50" maxlength="250" value="<?php echo $member->phoneMain;?>" />
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Alternate Phone:
		</td>
		<td>
			<input class="text_area" type="text" name="phoneAlt" id="phoneAlt" size="50" maxlength="250" value="<?php echo $member->phoneAlt;?>" />
		</td>	
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Emergency Phone:
		</td>
		<td>
			<input class="text_area" type="text" name="phoneEmerg" id="phoneEmerg" size="50" maxlength="250" value="<?php echo $member->phoneEmerg;?>" />
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Transactions
		</td>
		<td>
			See <?php echo $member_transactions_link_markup; ?>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			E-mail Subscriptions:
		</td>
		<td>
		  <?php echo $member_subscriptions_link_markup; ?> (<?php echo $member_mailchimp_info_link_markup; ?>)
		</td>
	</tr>		
    <!--
	<tr>
		<td width="100" align="right" class="key">
			Receive Email Status Reports?
		</td>
		<td>
			<input type="checkbox" name="emailStatus" id="emailStatus" <?php echo ($member->emailStatus ? "checked" : "");?> />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			Receive Email News?
		</td>
		<td>
			<input type="checkbox" name="emailNews" id="emailNews" <?php echo ($member->emailNews ? "checked" : "");?> />
		</td>
	</tr>		
  <tr>
  	<td width="100" align="right" class="key">
  		Receive Email Volunteer Opportunities?
  	</td>
  	<td>
			<input type="checkbox" name="emailVolunteerOpps" id="emailVolunteerOpps" <?php echo ($member->emailVolunteerOpps ? "checked" : "");?> />
  	</td>
  </tr>
  -->
	<tr>
		<td width="100" align="right" class="key">
			Current Member?
		</td>
		<td>
			<?php echo $member->isMember ? JHTML::image('administrator/images/tick.png','yes') : JHTML::image('administrator/images/publish_x.png','yes');?> <a href="/administrator/index.php?option=com_cbodb&task=renewmember&memberID=<?php echo $member->id;?>">Renew</a>
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			Membership Expires:
		</td>
		<td>
			<?php echo $member->membershipExpire;?>
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			Groups:
		</td>
		<td>
		</td>
	</tr>
	
	<?php
	 // list all group associations
	 foreach (CbodbMember::$memberGroupArray as $groupNum => $groupName)
	 {
    ?>
     <tr>
       <td width="100" align="right" class="key">
     	   <?php echo $groupName; ?>
       </td>
       <td>
     	   <input type="checkbox" name="isGroup<?php echo $groupNum; ?>" id="isGroup<?php echo $groupNum; ?>" <?php echo ($member->isInGroup($groupNum) ? "checked" : "");?> />
       </td>
     </tr>
	   <?php
	 }
	?>
	
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Class 1: Intro";?>
		</td>
		<td>
			<input type="checkbox" name="custom1" id="custom1" <?php echo ($member->custom1 ? "checked" : "");?> />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Class 2: Wheels";?>
		</td>
		<td>
			<input type="checkbox" name="custom2" id="custom2" <?php echo ($member->custom2 ? "checked" : "");?> />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Class 3: Brakes";?>
		</td>
		<td>
			<input type="checkbox" name="custom3" id="custom3" <?php echo ($member->custom3 ? "checked" : "");?> />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Class 4: Gears";?>
		</td>
		<td>
			<input type="checkbox" name="custom4" id="custom4" <?php echo ($member->custom4 ? "checked" : "");?> />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Bike Driver's Ed";?>
		</td>
		<td>
			<input type="checkbox" name="custom5" id="custom5" <?php echo ($member->custom5 ? "checked" : "");?> />
		</td>
	</tr>		
	
	<tr>
		<td width="100" align="right" class="key">
			Record Last Updated:
		</td>
		<td>
			<?php echo $member->timeChanged;?>
		</td>
	</tr>
	</table>
	</fieldset>
	<input type="hidden" name="id" value="<?php echo $member->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="cbodb_mode" value="member" />
	</form>
	<?php
}

function addMember( $member, $option, $mailing_list_groups ) 
{
	//JHTML::_('behavior.calendar');
	?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend>Member Details</legend>
	<table class="admintable">
	<tr>
	<tr>
		<td width="100" align="right" class="key">
			First Name:
		</td>
		<td>
			<input class="text_area" type="text" name="nameFirst" id="nameFirst" size="20" maxlength="50" />
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Last Name:
		</td>
		<td>
			<input class="text_area" type="text" name="nameLast" id="nameLast" size="20" maxlength="50" />
		</td>
	</tr>
	<tr>
                <td width="100" align="right" class="key">
			Address 1:
                </td>
                <td>
                        <input class="text_area" type="text" name="address1" id="address2" size="20" maxlength="50" />
                </td>
        </tr>
	<tr>
                <td width="100" align="right" class="key">
			Address 2:
                </td>
                <td>
                        <input class="text_area" type="text" name="address2" id="address2" size="20" maxlength="50" />
                </td>
        </tr>
	<tr>
                <td width="100" align="right" class="key">
			City:
                </td>
                <td>
                        <input class="text_area" type="text" name="city" id="city" size="20" maxlength="50" />
                </td>
        </tr>
	<tr>
                <td width="100" align="right" class="key">
			State:
                </td>
                <td>
                        <input class="text_area" type="text" name="state" id="state" size="20" maxlength="50" />
                </td>
        </tr>
	<tr>
                <td width="100" align="right" class="key">
			Zip:
                </td>
                <td>
                        <input class="text_area" type="text" name="zip" id="zip" size="20" maxlength="50" />
                </td>
        </tr>

	<tr>
		<td width="100" align="right" class="key">
			Email Address:
		</td>
		<td>
			<input class="text_area" type="text" name="emailAddress" id="emailAddress" size="50" maxlength="250" />
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Primary Phone:
		</td>
		<td>
			<input class="text_area" type="text" name="phoneMain" id="phoneMain" size="50" maxlength="250" />
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Alternate Phone:
		</td>
		<td>
			<input class="text_area" type="text" name="phoneAlt" id="phoneAlt" size="50" maxlength="250" />
		</td>	
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Emergency Phone:
		</td>
		<td>
			<input class="text_area" type="text" name="phoneEmerg" id="phoneEmerg" size="50" maxlength="250" />
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Groups:
		</td>
		<td>
		</td>
	</tr>

	<?php
	 // list all group associations
	 foreach (CbodbMember::$memberGroupArray as $groupNum => $groupName)
	 {
    ?>
	  <tr>
	    <td width="100" align="right" class="key">
	      <?php echo $groupName; ?>
	    </td>
	    <td>
	      <input type="checkbox" name="isGroup<?php echo $groupNum; ?>" id="isGroup<?php echo $groupNum; ?>" />
	    </td>
	  </tr>
	  <?php
	 }
	?>
	
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Class 1: Intro";?>
		</td>
		<td>
			<input type="checkbox" name="custom1" id="custom1" />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Class 2: Wheels";?>
		</td>
		<td>
			<input type="checkbox" name="custom2" id="custom2" />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Class 3: Brakes";?>
		</td>
		<td>
			<input type="checkbox" name="custom3" id="custom3" />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Class 4: Gears";?>
		</td>
		<td>
			<input type="checkbox" name="custom4" id="custom4" />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo "Bike Driver's Ed";?>
		</td>
		<td>
			<input type="checkbox" name="custom5" id="custom5" />
		</td>
	</tr>
	</table>
	</fieldset>
	<?php HTML_cbodb::listMailingListSubscriptionOptions ( $mailing_list_groups ); ?>
	<input type="hidden" name="id" value="<?php echo $member->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="cbodb_mode" value="member" />
	<input type="hidden" name="new_member" value="1" />
	</form>
	<?php
}

function viewMemberMailChimpInfo ( $member, $option )
{
  /*
   * Show "raw" MailChimp subscription data for member (based on email address.)
   * This is mostly for debugging.
   */
  $mc_info = $member->getMemberMailChimpInfo();
	$member_name = $member->nameFirst." ".$member->nameLast;
  if (is_array($mc_info))
  {
    ?>
	  <fieldset class="adminform">
	  <legend>MailChimp Details for <?php echo $member_name ?></legend>
    <table class="admintable">
    <?php
    foreach($mc_info as $key => $value)
    {
      echo "<tr>\n";
      echo "<td width=\"100\" align=\"right\" class=\"key\">$key:</td>\n";
      echo "<td>";
      if (is_array($value)) // MailChimp "merges" on member data
      {
        echo "<table class=\"admintable\">\n";
        foreach($value as $l=>$w) {
          echo "<tr>\n";
          echo "<td width=\"100\" align=\"right\" class=\"key\">$l:</td><td>$w</td></tr>\n";
        }
        echo "</table>\n";
      }
      else {
        echo "$value";
      }
      echo "</td></tr>\n";
    }
    echo "</table>\n";
    echo "</fieldset>\n";
  }
  else {
    // if it's not an array, it's an error message
    JError::raiseNotice(100, $mc_info);
  }
}

/*
// Not working -- guessing something to do with the two API calls...
function editMemberEmailSubscriptions ( $member, $option )
{
  $mc_interest_groups = $member->getMailChimpInterestGroups();
  $mc_member_subscribed_groups = $member->getMemberMailChimpGroupSubscriptions();
  
  if (!is_array($mc_interest_groups))
  {
    // Failed getting list of groups. Can't do anything more.
    JError::raiseNotice(100, $mc_interest_groups);
    return;
  }
  
	$member_name = $member->nameFirst." ".$member->nameLast;
	
  ?>
	<fieldset class="adminform">
	<legend>Email List Subscriptions for <?php echo $member_name ?></legend>
  <table class="admintable">
  <?php

	foreach($mc_interest_groups as $group)
	{
	  print_r($mc_member_subscribed_groups);
    echo "<tr>\n";
    echo "<td width=\"100\" align=\"right\" class=\"key\">$group:</td>\n";
    echo "<td>";
	  $checked = in_array($group, $mc_member_subscribed_groups) ? ' checked="checked"' : '';
		echo "<input type=\"checkbox\" name=\"ig\" value=\"$group\"$checked />\n";
    echo "</td></tr>\n";
	}
  echo "</table>\n";
  echo "</fieldset>\n";
}
*/

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
  
	<fieldset class="adminform">
	  <legend>Mailing List</legend>
    <table class="admintable">
      <tr>
        <td width="100" align="right" class="key">Subscribe:</td>
        <td>
          <input type="checkbox" name="listSubscribe" value="listSubscribe" id="listSubscribe" checked="checked" />
          Subscribing is an agreement to receive emails regarding one's membership status: free classes, renewal, etc.
        </td>
      </tr>
    </table>
    <fieldset style="margin-top: 1em" class="adminform" id="mailingListGroups">
	    <legend>Interested in...</legend>
	    <p>...receiving periodic updates about:</p>
	    <table class="admintable">
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
	  </fieldset>
  </fieldset>

  <script type="text/javascript">
    // Show groups when Subscribe is checked; else hide them.
    $('listSubscribe').addEvent('click', function(){
    	if (this.getProperty('checked')==true) {
    		$('mailingListGroups').setStyle('display','block')
    	} else {
    	  $('mailingListGroups').setStyle('display','none')
    	}
    });
  </script>
  
  <?php
}

function editMailingListSubscription ( $member, $option, $mc_member_subscription_info )
{
  /* 
   * Combining listMailingListSubscriptionOptions() and editMemberEmailSubscriptions()
   *
   * Allow Subscribing to mailing list, and to particular Interest Groups.
   * Initially, Subscribe is checked and groups left unchecked.
   * This is currently only used where the form is shown on its own, (not on the new member form...)
   */
  if (!is_array($mc_member_subscription_info))
  {
    JError::raiseNotice(100, $mc_member_subscription_info);
    return;
  }
  
  $fieldset_title = "Mailing List Subscription";
  
  //echo "<pre>";
  //print_r($mc_member_subscription_info);
  //echo "</pre>";

  if ($member->id > 0) {
    // existing member -- on a form by itself
	  $fieldset_title .= " for $member->nameFirst $member->nameLast";
	  echo '<form action="index.php" method="post" name="adminForm" id="adminForm">';
	  $hide_groups_fieldset_str = $mc_member_subscription_info['subscribed'] ? "" : " display: none;";
  }
  else
  {
    // new member
    $groups_with_subscriptions = array();
    $mc_member_subscription_info['subscribed'] = true; // default for new user form
  }
  $listSubscribeCheckedStr = $mc_member_subscription_info['subscribed'] ? ' checked="checked"' : '';
  ?>
	
	<fieldset class="adminform">
	  <legend><?php echo $fieldset_title; ?></legend>
    <table class="admintable">
      <tr>
        <td width="100" align="right" class="key">Subscribe:</td>
        <td>
          <input type="checkbox" name="listSubscribe" value="listSubscribe" id="listSubscribe"<?php echo $listSubscribeCheckedStr; ?> />
          Subscribing is an agreement to receive emails regarding one's membership status: free classes, renewal, etc.
        </td>
      </tr>
    </table>
    <fieldset style="margin-top: 1em;<?php echo $hide_groups_fieldset_str; ?>" class="adminform" id="mailingListGroups">
	    <legend>Interested in...</legend>
	    <p>...receiving periodic updates about:</p>
	    <table class="admintable">
      <?php
	    //echo "<pre>";
	    //print_r($mc_member_subscription_info);
	    //echo "</pre>";
	    foreach($mc_member_subscription_info['groups'] as $group => $group_subscribed)
	    {
	      $groupSubscribeCheckedStr = $group_subscribed ? ' checked="checked"' : '';
        echo "<tr>\n";
        echo "<td width=\"100\" align=\"right\" class=\"key\">$group:</td>\n";
        echo "<td>";
	    	echo "<input type=\"checkbox\" name=\"interestGroups[]\" value=\"$group\"$groupSubscribeCheckedStr />\n";
        echo "</td></tr>\n";
	    }
	    ?>
	    </table>
	  </fieldset>
  </fieldset>

  <script type="text/javascript">
    // Show groups when Subscribe is checked; else hide them.
    $('listSubscribe').addEvent('click', function(){
    	if (this.getProperty('checked')==true) {
    		$('mailingListGroups').setStyle('display','block')
    	} else {
    	  $('mailingListGroups').setStyle('display','none')
    	}
    });
  </script>
  
  <?php if ($member->id > 0): // own form, not part of new member form... ?>
	  <input type="hidden" name="memberId" value="<?php echo $member->id; ?>" />
	  <input type="hidden" name="option" value="<?php echo $option;?>" />
	  <input type="hidden" name="task" value="save" />
	  <input type="hidden" name="cbodb_mode" value="mailingsubscriptions" />
	  </form>
  <?php endif; ?>
  
  <?php
}

/*
// Deprecated for new editMemberEmailSubscription()
function editMemberEmailSubscriptions ( $member, $option )
{
  $mc_member_subscription_list = $member->getMemberMailingListSubscriptionInfo();
  //$mc_member_subscription_list = $member->getGroupSubscriptionListForMember();
  
  if (!is_array($mc_member_subscription_list)) {
    JError::raiseNotice(100, $mc_member_subscription_list);
    return;
  }
	
  ?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend>Mailing List Subscriptions for <?php echo $member->nameFirst." ".$member->nameLast ?></legend>
  <table class="admintable">
  <?php
  
	//echo "<pre>";
	//print_r($mc_member_subscription_list);
	//echo "</pre>";

	foreach($mc_member_subscription_list as $group => $in_group)
	{
    echo "<tr>\n";
    echo "<td width=\"100\" align=\"right\" class=\"key\">$group:</td>\n";
    echo "<td>";
	  $checked = $in_group ? ' checked="checked"' : '';
		echo "<input type=\"checkbox\" name=\"interestGroups[]\" value=\"$group\"$checked />\n";
    echo "</td></tr>\n";
	}
  echo "</table>\n";
  echo "</fieldset>\n";
  ?>
	<input type="hidden" name="memberId" value="<?php echo $member->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="cbodb_mode" value="mailingsubscriptions" />
	</form>
  <?php
}
*/

function editTask( $option, $task, $item ) 
{
	JHTML::_('behavior.calendar');
	$editor =& JFactory::getEditor();	
	?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend>Task Details</legend>
	<table class="admintable">
	
	<tr>
		<td width="100" align="right" class="key">
			Task id:
		</td>
		<td>
			<?php if ($task->id > 0) echo $task->id; else echo "New task";?>
			<input type="hidden" name="id" id="id" value="<?php echo $task->id ?>" />
		</td>
	</tr>

	<tr>
		<td width="100" align="right" class="key">
			Checked Out:
		</td>
		<td>
			<input type="checkbox" name="isOpen" id="isOpen" <?php echo ($task->isOpen ? "checked" : "");?> />
		</td>
	</tr>

	<tr>
		<td width="100" align="right" class="key">
			Done:
		</td>
		<td>
			<input type="checkbox" name="isDone" id="isDone" <?php echo ($task->isDone ? "checked" : "");?> />
		</td>
	</tr>

	<tr>
		<td width="100" align="right" class="key">
			Recurring:
		</td>
		<td>
			<input type="checkbox" name="recurring" id="recurring" <?php echo ($task->recurring ? "checked" : "");?> /> (use this for regular, repeating jobs)
		</td>
	</tr>

	<tr>
		<td width="100" align="right" class="key">
			Active:
		</td>
		<td>
			<input type="checkbox" name="active" id="active" <?php echo (($task->id > 0) ? ($task->active ? "checked" : "") : "checked");?> /> (if this box is unchecked, no one can see it)
		</td>
	</tr>

	<tr>
		<td width="100" align="right" class="key">
			Short Description:
		</td>
		<td>
			<input type="text" name="description" id="description" size="60" value="<?php echo $task->description;?>" />
		</td>
	</tr>
	
	<tr>
		<td width="100" align="right" class="key">
			Comments:
		</td>
		<td>
			<?php echo $editor->display( 'comment',  $task->comment , 
                                     '100%', '250', '40', '10' ) ;?>
		</td>
	</tr>
	
	<tr>
		<td width="100" align="right" class="key">
			Type:
		</td>
		<td>
			<?php HTML_cbodb::dropdownFromArray("type",HTML_cbodb::$taskTypeArray,$task->type); ?>
		</td>
	</tr>
	
	<tr>
		<td width="100" align="right" class="key">
			Tag number of item:
		</td>
		<td>
			<input type="text" name="itemID" id="itemID" size="20" value="<?php echo $task->itemID;?>" />
		</td>	
	</tr>

	<tr>
		<td width="100" align="right" class="key">
			Item Description:
		</td>
		<td>
			<?php echo (($item == NULL) ? "No item found" : $item->description);?>
		</td>	
	</tr>


	<tr>
		<td width="100" align="right" class="key">
			<b>Groups:</b>
		</td>
		<td>Checked groups see the task, unchecked do not</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			<?php echo CbodbMember::$memberGroupArray[1]; ?>
		</td>
		<td>
			<input type="checkbox" name="forGroup1" id="forGroup1" <?php echo ($task->forGroup1 ? "checked" : "");?> />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo CbodbMember::$memberGroupArray[2]; ?>
		</td>
		<td>
			<input type="checkbox" name="forGroup2" id="forGroup2" <?php echo ($task->forGroup2 ? "checked" : "");?> />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo CbodbMember::$memberGroupArray[3]; ?>
		</td>
		<td>
			<input type="checkbox" name="forGroup3" id="forGroup3" <?php echo ($task->forGroup3 ? "checked" : "");?> />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo CbodbMember::$memberGroupArray[4]; ?>
		</td>
		<td>
			<input type="checkbox" name="forGroup4" id="forGroup4" <?php echo ($task->forGroup4 ? "checked" : "");?> />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo CbodbMember::$memberGroupArray[5]; ?>
		</td>
		<td>
			<input type="checkbox" name="forGroup5" id="forGroup5" <?php echo ($task->forGroup5 ? "checked" : "");?> />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo CbodbMember::$memberGroupArray[6]; ?>
		</td>
		<td>
			<input type="checkbox" name="forGroup6" id="forGroup6" <?php echo ($task->forGroup6 ? "checked" : "");?> />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo CbodbMember::$memberGroupArray[7]; ?>
		</td>
		<td>
			<input type="checkbox" name="forGroup7" id="forGroup7" <?php echo ($task->forGroup7 ? "checked" : "");?> />
		</td>
	</tr>		
	<tr>
		<td width="100" align="right" class="key">
			<?php echo CbodbMember::$memberGroupArray[8]; ?>
		</td>
		<td>
			<input type="checkbox" name="forGroup8" id="forGroup8" <?php echo ($task->forGroup8 ? "checked" : "");?> />
		</td>
	</tr>		



	</table>
	</fieldset>
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="cbodb_mode" value="task" />
	</form>
	<?php
}



function editTransaction( $option, $transaction, $member, $memberCredits ) 
{
	JHTML::_('behavior.calendar');
	
	$member_name = $member->nameFirst." ".$member->nameLast;
  
  $member_details_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=edit&cid[]='. $member->id );
  $member_details_link_markup = "<a href=\"$member_details_link\" title=\"Member details for $member_name\">$member_name</a>";
	
  $member_transactions_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=transactions&member_id='. $member->id );
  $member_transactions_link_markup = "<a href=\"$member_transactions_link\" title=\"List transactions for $member_name\">member transactions</a>";
  
	?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend>Transaction Details</legend>
	<table class="admintable">
	<tr>
		<td width="100" align="right" class="key">
			Member:
		</td>
		<td>
			<?php echo $member_details_link_markup; ?> (see <?php echo $member_transactions_link_markup; ?>)
			<input type="hidden" name="memberID" id="memberID" value="<?php echo $member->id; ?>">
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Member Credits Available:
		</td>
		<td>
			<?php echo sprintf("%.2F",$memberCredits); ?>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
		Transaction Time:
		</td>
		<td>
			<?php echo $transaction->dateOpen;?>
			<input type="hidden" name="dateOpen" id="dateOpen" value="<?php echo $transaction->dateOpen; ?>">
			<input type="hidden" name="dateClosed" id="dateClosed" value="<?php echo $transaction->dateClosed; ?>">
		</td>
	</tr>
	<tr>
		<td class="key">Transaction Type</td>
		<td><?php HTML_cbodb::dropdownFromArray("type",HTML_cbodb::$adminTransactionTypeArray,1002);?></td>
	</tr>
	<tr>
		<td class="key">Credits</td>
		<td><input name="credits" id="credits" value="<?php echo $transaction->credits; ?>"></td>
	</tr>
	<tr>
		<td class="key">Cash</td>
		<td><input name="cash" id="cash" value="<?php echo $transaction->cash; ?>"></td>
	</tr>
	<tr>
		<td class="key">Item or Bike tag number</td>
		<td>
		    <?php $itemDropdownList = CbodbItem::itemList(); ?>
        <select name="itemID">
        <option value="0">Choose a Item or Bike tag number below...</option>
        <?php
        	foreach ($itemDropdownList as $bikeTag ) {
			$selectedStr = ($bikeTag->tag == $transaction->itemID) ? 'selected="selected" ' : '';
        		echo "<option ${selectedStr}value=\"$bikeTag->tag\">$bikeTag->tag</option>";
        	}
        ?>
        </select>
		</td>
		<!-- <td><input name="itemID" id="itemID" value="<?php echo $transaction->itemID; ?>"></td> -->
	</tr>
	<tr>
		<td class="key">Comment</td>
		<td><input name="comment" id="comment" value="<?php echo $transaction->comment; ?>" size="100"></td>
	</tr>
	</table>
	</fieldset>
	<input type="hidden" name="id" value="<?php echo $transaction->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="cbodb_mode" value="transaction" />
  <input type="hidden" name="list_query_member_id" value="<?php echo $list_query_member_id;?>" />
  <input type="hidden" name="list_query_dateStart" value="<?php echo $list_query_dateStart;?>" />
  <input type="hidden" name="list_query_dateEnd" value="<?php echo $list_query_dateEnd;?>" />
	</form>
	<?php
}



function newProvisionalTransaction( $option, $transaction, $member, $memberCredits ) 
{
	JHTML::_('behavior.calendar');

	if ($member->id) {
	  $memberChosen = true;
	  $member_name = $member->nameFirst." ".$member->nameLast;
  
    $member_details_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=edit&cid[]='. $member->id );
    $member_details_link_markup = "<a href=\"$member_details_link\" title=\"Member details for $member_name\">$member_name</a>";
	  
    $member_transactions_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=transactions&member_id='. $member->id );
    $member_transactions_link_markup = "<a href=\"$member_transactions_link\" title=\"List transactions for $member_name\">member transactions</a>";
  } else {
	  $memberChosen = false; 
  }
	?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend>Transaction Details</legend>
	<table class="admintable">
	<tr>
		<td width="100" align="right" class="key">
			Member:
		</td>
		<td>
		  <?php if($memberChosen): ?>
			  <?php echo $member_details_link_markup; ?> (see <?php echo $member_transactions_link_markup; ?>)
			  <input type="hidden" name="memberID" id="memberID" value="<?php echo $member->id; ?>">
		  <?php else: ?>
		    <?php $dropdownList = CbodbMember::dropdownMemberList(); ?>
        <select name="memberID">
        <option value="0">Choose member's name below...</option>
        <?php
        	foreach ($dropdownList as $memberRow ) {
        		echo "<option value=\"$memberRow->id\">$memberRow->nameLast, $memberRow->nameFirst</option>";
        	}
        ?>
        </select>
		  <?php endif; ?>
		</td>
	</tr>
	<?php if($memberChosen): ?>
	  <tr>
	  	<td width="100" align="right" class="key">
	  		Member Credits Available:
	  	</td>
	  	<td>
	  		<?php echo sprintf("%.2F",$memberCredits); ?>
	  	</td>
	  </tr>
  <?php endif; ?>
	<tr>
		<td width="100" align="right" class="key">
		Transaction Time:
		</td>
		<td>
			<?php echo $transaction->dateOpen;?>
			<input type="hidden" name="dateOpen" id="dateOpen" value="<?php echo $transaction->dateOpen; ?>">
			<input type="hidden" name="dateClosed" id="dateClosed" value="<?php echo $transaction->dateClosed; ?>">
		</td>
	</tr>
	<tr>
		<td class="key">Transaction Type</td>
		<td>
			<?php
			$type = $transaction->type;
			if (!$type) {
				$type = 1002;
			}
			HTML_cbodb::dropdownFromArray("type",HTML_cbodb::$adminTransactionTypeArray,$type);
			?>
		</td>
	</tr>
	<tr>
		<td class="key">Credits</td>
		<td><input name="credits" id="credits" value="<?php echo $transaction->credits; ?>"></td>
	</tr>
	<tr>
		<td class="key">Cash</td>
		<td><input name="cash" id="cash" value="<?php echo $transaction->cash; ?>"></td>
	</tr>
	<tr>
		<td class="key">Item or Bike tag number</td>
		<td><input name="itemID" id="itemID" value="<?php echo $transaction->itemID; ?>"></td>
	</tr>
	<tr>
		<td class="key">Comment</td>
		<td><input name="comment" id="comment" value="<?php echo $transaction->comment; ?>" size="100"></td>
	</tr>
	</table>
	</fieldset>
	<input type="hidden" name="id" value="<?php echo $transaction->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="cbodb_mode" value="transaction" />
  <input type="hidden" name="list_query_member_id" value="<?php echo $list_query_member_id;?>" />
  <input type="hidden" name="list_query_dateStart" value="<?php echo $list_query_dateStart;?>" />
  <input type="hidden" name="list_query_dateEnd" value="<?php echo $list_query_dateEnd;?>" />
	</form>
	<?php
}

function newTimeTransaction( $option, $transaction, $member ) 
{
	if ($member->id) {
	  $memberChosen = true;
	  $member_name = $member->nameFirst." ".$member->nameLast;
  
    $member_details_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=edit&cid[]='. $member->id );
    $member_details_link_markup = "<a href=\"$member_details_link\" title=\"Member details for $member_name\">$member_name</a>";
	  
    $member_transactions_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=transactions&member_id='. $member->id );
    $member_transactions_link_markup = "<a href=\"$member_transactions_link\" title=\"List transactions for $member_name\">member transactions</a>";
  } else {
	  $memberChosen = false; 
  }
	$member_name = $member->nameFirst." ".$member->nameLast;
  
  $member_details_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=edit&cid[]='. $member->id );
  $member_details_link_markup = "<a href=\"$member_details_link\" title=\"Member details for $member_name\">$member_name</a>";
	
  $member_transactions_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=transactions&member_id='. $member->id );
  $member_transactions_link_markup = "<a href=\"$member_transactions_link\" title=\"List transactions for $member_name\">member transactions</a>";
  
	?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend>Time-based Transaction</legend>
	<table class="admintable">
	<tr>
		<td width="100" align="right" class="key">
			Member:
		</td>
		<td>
		  <?php if($memberChosen): ?>
			  <?php echo $member_details_link_markup; ?> (see <?php echo $member_transactions_link_markup; ?>)
			  <input type="hidden" name="memberID" id="memberID" value="<?php echo $member->id; ?>">
		  <?php else: ?>
		    <?php $dropdownList = CbodbMember::dropdownMemberList(); ?>
        <select name="memberID">
        <option value="0">Choose member's name below...</option>
        <?php
        	foreach ($dropdownList as $memberRow ) {
        		echo "<option value=\"$memberRow->id\">$memberRow->nameLast, $memberRow->nameFirst</option>";
        	}
        ?>
        </select>
		  <?php endif; ?>
		</td>
	</tr>
	<tr>
		<td class="key">Transaction Type</td>
		<td><?php HTML_cbodb::dropdownFromArray("type", HTML_cbodb::$transactionTypeArray, $transaction->type, false); ?></td>
	</tr>
	<tr>
		<td class="key">Date Open</td>
		<td><input name="dateOpen" id="dateOpen" value="<?php echo $transaction->dateOpen; ?>"></td>
	</tr>
	<tr>
		<td class="key">Date Closed</td>
		<td><input name="dateClosed" id="dateClosed" value="<?php echo $transaction->dateClosed; ?>"></td>
	</tr>
	<tr>
		<td class="key">Duration</td>
		<td><?php echo format_time_duration($transaction->totalTime, true); ?></td>
	</tr>
	<tr>
		<td class="key">Credits</td>
		<td><?php echo ($transaction->credits > 0) ? $transaction->credits : 0; ?></td>
	</tr>
	<tr>
		<td class="key">Comment</td>
		<td><input name="comment" id="comment" value="<?php echo $transaction->comment; ?>" size="100"></td>
	</tr>
	</table>
	</fieldset>
	<input type="hidden" name="id" value="<?php echo $transaction->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="cbodb_mode" value="transaction" />
	</form>
	<?php
}


function editTimeTransaction( $option, $transaction, $member ) 
{	
	$member_name = $member->nameFirst." ".$member->nameLast;
  
  $member_details_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=edit&cid[]='. $member->id );
  $member_details_link_markup = "<a href=\"$member_details_link\" title=\"Member details for $member_name\">$member_name</a>";
	
  $member_transactions_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=transactions&member_id='. $member->id );
  $member_transactions_link_markup = "<a href=\"$member_transactions_link\" title=\"List transactions for $member_name\">member transactions</a>";
  
	?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend>Time-based Transaction</legend>
	<table class="admintable">
	<tr>
		<td width="100" align="right" class="key">
			Member:
		</td>
		<td>
			<?php echo $member_details_link_markup; ?> (see <?php echo $member_transactions_link_markup; ?>)
			<input type="hidden" name="memberID" id="memberID" value="<?php echo $member->id; ?>">
		</td>
	</tr>
	<tr>
		<td class="key">Transaction Type</td>
		<td><?php HTML_cbodb::dropdownFromArray("type", HTML_cbodb::$transactionTypeArray, $transaction->type, true); ?></td>
	</tr>
	<tr>
		<td class="key">Date Open</td>
		<td><input name="dateOpen" id="dateOpen" value="<?php echo $transaction->dateOpen; ?>"></td>
	</tr>
	<tr>
		<td class="key">Date Closed</td>
		<td><input name="dateClosed" id="dateClosed" value="<?php echo $transaction->dateClosed; ?>"></td>
	</tr>
	<tr>
		<td class="key">Duration</td>
		<td><?php echo format_time_duration($transaction->totalTime, true); ?></td>
	</tr>
	<tr>
		<td class="key">Credits</td>
		<td><?php echo ($transaction->credits > 0) ? $transaction->credits : 0; ?></td>
	</tr>
	<tr>
		<td class="key">Comment</td>
		<td><input name="comment" id="comment" value="<?php echo $transaction->comment; ?>" size="100"></td>
	</tr>
	</table>
	</fieldset>
	<input type="hidden" name="id" value="<?php echo $transaction->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="cbodb_mode" value="transaction" />
	</form>
	<?php
}

function renewMember( $option, $transaction, $member, $memberCredits ) 
{
	JHTML::_('behavior.calendar');
	?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend>Membership Renewal</legend>
	<table class="admintable">
	<tr>
	<tr>
		<td width="100" align="right" class="key">
			Member Name:
		</td>
		<td>
			<?php echo $member->nameFirst." ".$member->nameLast; ?>
			<input type="hidden" name="memberID" id="memberID" value="<?php echo $member->id; ?>">
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Member Credits Available:
		</td>
		<td>
			<?php echo sprintf("%.2F",$memberCredits); ?>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
			Member Expiration:
		</td>
		<td>
			<?php echo $member->membershipExpire; ?>
		</td>
	</tr>

	<tr>
		<td width="100" align="right" class="key">
		Transaction Time:
		</td>
		<td>
			<?php echo $transaction->dateOpen;?>
			<input type="hidden" name="dateOpen" id="dateOpen" value="<?php echo $transaction->dateOpen; ?>">
			<input type="hidden" name="dateClosed" id="dateClosed" value="<?php echo $transaction->dateClosed; ?>">
		</td>
	</tr>
	<tr>
		<td class="key">Transaction Type</td>
		<td>Renew Member<input type="hidden" name="type" id="type" value="1003"></td>
	</tr>
	<tr>
		<td class="key">Credits</td>
		<td><input name="credits" id="credits" value="<?php echo $transaction->credits; ?>"></td>
	</tr>
	<tr>
		<td class="key">Cash</td>
		<td><input name="cash" id="cash" value="<?php echo $transaction->cash; ?>"></td>
	</tr>
	<tr>
		<td class="key">Membership term (starts now or on the expire date, whichever is later)</td>
		<td><?php HTML_cbodb::dropdownFromArray("term",HTML_cbodb::$memberRenewalTermArray,366);?></td>
	</tr>
	<tr>
		<td class="key">Comment</td>
		<td><input name="comment" id="comment" value="<?php echo $transaction->comment; ?>" size="100"></td>
	</tr>
	</table>
	</fieldset>
	<input type="hidden" name="id" value="<?php echo $transaction->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="cbodb_mode" value="transaction" />
	</form>
	<?php
	}

function showEmailQueries( $option, &$rows, $resultCounts )
{
  ?>
  <form action="index.php" method="post" name="adminForm">
  <table class="adminlist">
    <thead>
      <tr>
        <th width="20px">
          <input type="checkbox" name="toggle" 
               value="" onclick="checkAll(<?php echo 
               count( $rows ); ?>);" />
        </th>
        <th width="5%">id</th>
        <th>Description</th>
        <th width="10%">SQL</th>
	<th width="10%">Recipients</th>
        <th width="5%">Last updated</th>
      </tr>
    </thead>

    <?php
    $k = 0;
    for ($i=0, $n=count( $rows ); $i < $n; $i++) 
    {
      $row = &$rows[$i];
      $checked = JHTML::_('grid.id', $i, $row->id );
      $link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=composeemail&cid[]='. $row->id );
      ?>
      <tr class="<?php echo "row$k"; ?>">
        <td>
          <?php echo $checked; ?>
        </td>
        <td><?php echo $row->id; ?></td>
        <td>
          <a href="<?php echo $link; ?>"><?php echo $row->description; ?></a>
        </td>
        <td>
          <?php echo $row->sql;?> 
        </td>
	<td>
	  <?php echo $resultCounts[$row->id];?>
	</td>
        <td>
          <?php echo $row->timeUpdated; ?>
        </td>
      </tr>
      <?php
      $k = 1 - $k;
    }
    ?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="task" value="composeemail" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="cbodb_mode" value="email" />
  </form>
  <?php
}

	function composeEmail( $option, $query, $results ) 
	{
	?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	<legend>Send emails</legend>
	Subject: <input type="text" name="subject" id="subject" width="80"><Br>
	To: <?php echo $results." recipient".($results == 1 ? "" : "s")."; $query->description"; ?>
	<?php  $editor =& JFactory::getEditor();
	echo $editor->display( 'body',  "" , '100%', '250', '40', '10' ) ;?>
	<br><br>
	<input type="submit" name="Submit" value="Send mail">
	<input type="hidden" name="id" id="id" value="<?php echo $query->id; ?>">
	<input type="hidden" name="from" id="from" value="info@ohiocitycycles.org">
	<input type="hidden" name="option" id="option" value="<?php echo $option; ?>">
	<input type="hidden" name="task" id="task" value="sendemail">
	<?php 
	
	}
	
	function showStaffTotals( $option, &$rows, $dateStart, $dateEnd )
	{
	  JHTML::_('behavior.calendar');
	  ?>
    <h2>Staff Totals: <?php echo "$dateStart => $dateEnd"; ?></h2>
    
    <form action="index.php" method="post" name="adminForm">
    
      <table>
	    	<tr>
	    		<td align="left" width="100%">
	    		  <strong>Filter:</strong>
            <span style="margin: 0 1em;">
              Start Date: <input class="inputbox" type="text" name="dateStart" id="dateStart" size="11" dateStart="10" value="<?php echo $dateStart; ?>" />
              <input type="reset" class="button" value="..." onclick="return showCalendar('dateStart','%Y-%m-%d');" />
            </span>
            <span style="margin: 0 1em;">
              End Date: <input class="inputbox" type="text" name="dateEnd" id="dateEnd" size="11" maxlength="10" value="<?php echo $dateEnd; ?>" />
              <input type="reset" class="button" value="..." onclick="return showCalendar('dateEnd','%Y-%m-%d');" />
            </span>
            <input type="submit" name="Submit" value="Go" />
	    		</td>
	    	</tr>
	    </table>
    
      <input type="hidden" name="option" value="<?php echo $option;?>" />
      <input type="hidden" name="task" value="showstafftotals" />
    </form>
    
    <table class="adminlist">
      <thead>
        <tr>
          <th width="">Name</th>
          <th width="">Staff Hours</th>
          <th width=""># Clock-ins</th>
          <th width="">Longest Clock-in</th>
          <th width="">Avg Clock-in</th>
          <th width="">Show Transactions</th>
          <th width="">Commission Cash</th>
          <th width="">Commission Credits</th>
        </tr>
      </thead>
      <?php
      $k = 0;
      for ($i=0, $n=count( $rows ); $i < $n; $i++) 
      {
        $row = &$rows[$i];
        $checked = JHTML::_('grid.id', $i, $row->memberID );
        
        $member_name = $row->nameFirst . ' ' . $row->nameLast;
        
        $member_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . '&task=edit&cid[]='. $row->memberID );
        $member_link_markup = "<a href=\"$member_link\" title=\"$member_name edit\">$member_name</a>";
        
        // @TODO: use $transactionTypeArray instead of hardcoding "4"
        $transactions_link = JFilterOutput::ampReplace( 'index.php?option=' .$option . 
          '&task=transactions&member_id='. $row->memberID .'&transaction_type=4&dateStart='.$dateStart.'&dateEnd='.$dateEnd);
        $transactions_link_markup = "<a href=\"$transactions_link\" title=\"Go to this period's transactions for $member_name\">$row->nameFirst's staff transactions</a>";
        ?>
        <tr class="<?php echo "row$k"; ?>">
          <td>
            <?php echo $member_link_markup; ?>
          </td>
          <td>
            <?php echo format_time_duration($row->totalTimeSeconds, false); ?>
          </td>
          <td>
            <?php echo $row->clockins; ?>
          </td>
          <td>
            <?php echo format_time_duration($row->longestClockIn, true); ?>
          </td>
          <td>
            <?php echo format_time_duration($row->avgClockIn, true); ?>
          </td>
          <td>
            <?php echo $transactions_link_markup; ?>
          </td>
          <td>
            <?php
              if ($row->commissionCash) {
                setlocale(LC_MONETARY, 'en_US');
                echo money_format('%n', $row->commissionCash) .' / 10 = '. money_format('%n', $row->commissionCash  / 10);
              }
            ?>
          </td>
          <td>
            <?php echo $row->commissionCredits; ?>
          </td>
        </tr>
        <?php
        $k = 1 - $k;
      }
      ?>
    </table>
    <?php
	}
	
}
