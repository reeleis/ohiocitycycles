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
$database = &JFactory::getDBO();
$tables = $database->getTableList();
$table_name = $database->getPrefix()."dtregister_rollback_group_event";
$rollbackthere = in_array($table_name,$tables);
?>
<form action="index.php" method="post" name="adminForm" >
	<table width="90%" border="0" cellpadding="2" cellspacing="2" class="adminform">
	
		<tr>
			<td width="65%" valign="top">
				<div id="cpanel">
				<?php				

				$link = "index.php?option=$option&controller=config";
				$this->cpanelbutton( $link, "icon-48-config.png", JText::_('DT_CONFIGURATION') ,"/administrator/components/com_dtregister/assets/images/");

				$link = "index.php?option=$option&controller=category";
				$this->cpanelbutton( $link, "icon-48-categories.png", JText::_('DT_REGISTER_CATEGORIES')  ,"/administrator/components/com_dtregister/assets/images/");

				$link = "index.php?option=$option&controller=field";
				$this->cpanelbutton( $link, "icon-48-fields.png", JText::_('DT_FIELD_MANAGEMENT')  ,"/administrator/components/com_dtregister/assets/images/");

				$link = "index.php?option=$option&controller=user";
				$this->cpanelbutton( $link, "icon-48-users.png", JText::_('DT_RECORDS') ,"/administrator/components/com_dtregister/assets/images/");
				
				//$link = "index.php?option=$option&task=config.edit";
				// new version
				$link = "index.php?option=$option&controller=discountcode";
				$this->cpanelbutton( $link, "icon-48-discounts.png", JText::_('DT_DISCOUNT_CODE_MANAGEMENT') ,"/administrator/components/com_dtregister/assets/images/");
				
				$link = "index.php?option=$option&controller=event";
				$this->cpanelbutton( $link, "icon-48-events.png", JText::_('DT_EVENTS') ,"/administrator/components/com_dtregister/assets/images/");
				
				$link = "index.php?option=$option&controller=location";
				$this->cpanelbutton( $link, "icon-48-locations.png", JText::_('DT_LOCATIONS') ,"/administrator/components/com_dtregister/assets/images/");
				
				$link = "index.php?option=$option&controller=payoption";
				$this->cpanelbutton( $link, "icon-48-payments.png", JText::_('DT_PAY_OPTIONS') ,"/administrator/components/com_dtregister/assets/images/");
				
				$link = "index.php?option=$option&controller=permission";
				$this->cpanelbutton( $link, "icon-48-permissions.png", JText::_('DT_PERMISSIONS') ,"/administrator/components/com_dtregister/assets/images/");

               $link = "index.php?option=$option&controller=registrantemail";   
			   $this->cpanelbutton( $link, "icon-48-email.png", JText::_('DT_EMAIL_REGISTRANTS') ,"/administrator/components/com_dtregister/assets/images/");
			   $link = "index.php?option=$option&controller=export";
			   $this->cpanelbutton( $link, "icon-48-csv.png", JText::_('DT_CSV_EXPORT_UTILITY') ,"/administrator/components/com_dtregister/assets/images/");
			   
			   $link = "index.php?option=$option&controller=migration&task=nojeventSync";
			   $this->cpanelbutton( $link, "icon-48-nojevents.png", JText::_('DT_REMOVE_JEVENT_SYNC') ,"/administrator/components/com_dtregister/assets/images/");
			   if($rollbackthere)       {
			   $link = "index.php?option=$option&controller=migration&task=index";
			   $this->cpanelbutton( $link, "icon-48-migrate.png", JText::_('DT_MIGRATE') ,"/administrator/components/com_dtregister/assets/images/");
          }
				?>
				
				</div>
			</td>
			<td width="35%" valign="top">
				<p><img src="/administrator/components/com_dtregister/assets/images/dtregister_logo140.jpg" alt="DT Register" style="border: 0px; padding: 0px 0px 10px 10px; float: right;"><?php echo JText::_('DT_CPANEL_TEXT'); ?>:<br /></p>
				<p><table style="border:0px; padding:2px;">
					<tr><td><div><strong><?php echo JText::_('DT_CPANEL_VIDEO_TUTORIALS'); ?>:</strong>  </td><td><a href="http://www.youtube.com/dthdevelopment" target="_blank">[<?php echo JText::_('DT_CPANEL_CLICK_HERE'); ?>]</a></div></td></tr>
				    <tr><td><div><strong><?php echo JText::_('DT_CPANEL_PDF_MANUAL'); ?>:</strong>  </td><td><a href="http://www.dthdevelopment.com/images/stories/techdocs/DTRegister_27x_Manual.pdf" target="_blank">[<?php echo JText::_('DT_CPANEL_CLICK_HERE'); ?>]</a></div></td></tr>
				    <tr><td><div><strong><?php echo JText::_('DT_CPANEL_SUPPORT_FORUM'); ?>:</strong>  </td><td><a href="http://www.dthdevelopment.com/index.php?option=com_jfusion&Itemid=91&jfile=viewforum.php&f=518" target="_blank">[<?php echo JText::_('DT_CPANEL_CLICK_HERE'); ?>]</a></div></td></tr>
				    <tr><td><div><strong><?php echo JText::_('DT_CPANEL_SUPPORT_TICKETS'); ?>:</strong>  </td><td><a href="https://www.dthdevelopment.com/index.php?option=com_rstickets&Itemid=112" target="_blank">[<?php echo JText::_('DT_CPANEL_CLICK_HERE'); ?>]</a></div></td></tr>
				    <tr><td><div><strong><?php echo JText::_('DT_CPANEL_DTH_NEWS'); ?>:</strong>  </td><td><a href="http://www.dthdevelopment.com/dth-news/" target="_blank">[<?php echo JText::_('DT_CPANEL_CLICK_HERE'); ?>]</a><br /></div></td></tr>
				    <tr><td><div><strong><?php echo JText::_('DT_CPANEL_DTH_WEBSITE'); ?>:</strong>  </td><td><a href="http://www.dthdevelopment.com" target="_blank">[<?php echo JText::_('DT_CPANEL_CLICK_HERE'); ?>]</a><br /></div></p></td></tr>
				</table>
				<p><div><strong><?php echo JText::_('DT_CPANEL_INSTALLED_VERSION'); ?>:</strong>  2.7.2c</div></p>
				<p><div>©2006 DTH Development. All rights reserved.</div></p>
			</td>
		</tr>
  </table>
 
  <input type="hidden" name="task" value="index" />
  <input type="hidden" name="controller" value="cpanel" />
  <input type="hidden" name="option" value="<?php echo "com_dtregister"; ?>" />
</form>