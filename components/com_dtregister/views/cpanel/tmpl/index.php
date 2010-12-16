<?php 

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$option = "com_dtregister";

?>

<form action="index.php" method="post" name="adminForm">
	<table width="90%" border="0" cellpadding="2" cellspacing="2" class="adminForm">
	
		<tr>
			<td width="65%" valign="top">
				<div id="cpanel">
				<?php 

				$link = "index.php?option=$option&controller=category";
				$this->cpanelbutton( $link, "icon-48-categories.png", JText::_('DT_REGISTER_CATEGORIES')  ,"/administrator/components/com_dtregister/assets/images/");

				$link = "index.php?option=$option&controller=field";
				$this->cpanelbutton( $link, "icon-48-fields.png", JText::_('DT_FIELD_MANAGEMENT')  ,"/administrator/components/com_dtregister/assets/images/");
				
				//$link = "index.php?option=$option&task=config.edit";
				// new version
				$link = "index.php?option=$option&controller=discountcode";
				$this->cpanelbutton( $link, "icon-48-discounts.png", JText::_('DT_DISCOUNT_CODE_MANAGEMENT') ,"/administrator/components/com_dtregister/assets/images/");
				
				$link = "index.php?option=$option&controller=eventmanage";
				$this->cpanelbutton( $link, "icon-48-events.png", JText::_('DT_EVENTS') ,"/administrator/components/com_dtregister/assets/images/");
				
				$link = "index.php?option=$option&controller=location";
				$this->cpanelbutton( $link, "icon-48-locations.png", JText::_('DT_LOCATIONS') ,"/administrator/components/com_dtregister/assets/images/");
				
				$link = "index.php?option=$option&controller=payoption";
				$this->cpanelbutton( $link, "icon-48-payments.png", JText::_('DT_PAY_OPTIONS') ,"/administrator/components/com_dtregister/assets/images/");

			  // $link = "index.php?option=$option&controller=export";
			  // $this->cpanelbutton( $link, "icon-48-csv.png", JText::_('DT_CSV_EXPORT_UTILITY') ,"/administrator/components/com_dtregister/assets/images/");

				?>
				
				</div>
			</td>
			
		</tr>
  </table>
 
  <input type="hidden" name="task" value="index" />
  <input type="hidden" name="controller" value="cpanel" />
  <input type="hidden" name="option" value="<?php echo "com_dtregister"; ?>" />
</form>
<style>
#cpanel div.icon {
float:left;
margin-bottom:5px;
margin-right:5px;
text-align:center;
}
#cpanel div.icon a {
border:1px solid #F0F0F0;
color:#666666;
display:block;
float:left;
height:97px;
text-decoration:none;
vertical-align:middle;
width:108px;
}
#cpanel div.icon a:hover {
background:none repeat scroll 0 0 #F9F9F9;
border-color:#EEEEEE #CCCCCC #CCCCCC #EEEEEE;
border-left:1px solid #EEEEEE;
border-style:solid;
border-width:1px;
color:#0B55C4;
}
#cpanel img {
margin:0 auto;
padding:10px 0;
}
#cpanel span {
display:block;
text-align:center;
}
</style>