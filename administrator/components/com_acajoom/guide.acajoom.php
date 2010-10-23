<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true );
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php


function createGuide() {
	global $my;

	$xf = new xonfig();
	$option= mosGetParam($_REQUEST, 'option', '');
	$guide='';
	 if ( $option != 'com_installer') {
		$guide .= '<div width="80%"><center><fieldset class="menubackgr" style="padding: 10px; text-align: left">' ;
		$guide .="<legend><img src='images/support.png' border='0' align='absmiddle' alt='acajoom guide' style='width: 35px; height: 35px;' hspace='6'>" ;
		$guide .= "<strong>Acajoom". _ACA_GUIDE ."</strong></legend>";

		if ($GLOBALS[ACA.'act_totallist0'] <= 0 ) {
				$guide .= _HI.' '.$my->username."!"._ACA_GUIDE_FIRST_ACA_STEP;
				$guide .= '<strong><u>'._ACA_STEP.'1</u></strong><br />';
				if (($GLOBALS[ACA.'news1'] == 1
				OR $GLOBALS[ACA.'news2'] == 1
				OR $GLOBALS[ACA.'news3'] == 1) AND $option<>'com_installer') 	$guide .= _ACA_GUIDE_FIRST_ACA_STEP_UPGRADE;
				$guide .= _ACA_GUIDE_FIRST_ACA_STEP_DESC;
				$guide .= "<a href='index2.php?option=com_acajoom&act=list&task=new'>";
				$guide .= "<img src='images/new_f2.png' border='0' align='absmiddle' alt='acajoom guide' style='width: 26px; height: 26px;' hspace='6'>";
				$guide .= "</a>";

		} elseif ( $GLOBALS[ACA.'act_totalmailing0']  <= 0 ) {
		       if ($GLOBALS[ACA.'act_totallist1'] == 1) {
			       	$type_list = _ACA_NEWSLETTER;
					$link = '<a href="index2.php?option=com_acajoom&act=mailing&listype=1">'._ACA_GUIDE_SECOND_ACA_STEP_NEWS.'</a>';
				 } else {
			       	$type_list = _ACA_AUTORESP;
					$link = '<a href="index2.php?option=com_acajoom&act=mailing&listype=2">'._ACA_GUIDE_SECOND_ACA_STEP_AUTO.'</a>';
				 }
				$guide .= '<strong><u>'._ACA_STEP.'2</u></strong><br />';
				$guide .= sprintf (_ACA_GUIDE_SECOND_ACA_STEP, $type_list);
				$guide .= $link;
				$guide .= sprintf (_ACA_GUIDE_SECOND_ACA_STEP_FINAL, $type_list, $type_list);
				$guide .= "<img src='images/new_f2.png' border='0' align='absmiddle' alt='acajoom guide' style='width: 26px; height: 26px;' hspace='6'>";

		} elseif ($GLOBALS[ACA.'act_totalmailing0'] < 2 AND $GLOBALS[ACA.'mod_pub']==0) {


				acajoom::resetUpgrade();
			    if ($GLOBALS[ACA.'firstmailing'] == 2) {
					$guide .= '<strong><u>'._ACA_STEP.'3</u></strong><br />';
					$guide .= _ACA_GUIDE_THRID_ACA_STEP_AUTOS;
					if ($GLOBALS[ACA.'mod_pub']==0) $guide .= _ACA_GUIDE_MODULE;
				 } else {
					$guide .= '<strong><u>'._ACA_STEP.'3</u></strong><br />';
					$guide .= _ACA_GUIDE_THRID_ACA_STEP_NEWS;
					if ($GLOBALS[ACA.'mod_pub']==0) $guide .= _ACA_GUIDE_MODULE;
					$guide .= _ACA_GUIDE_THRID2_ACA_STEP_NEWS;
					$guide .= "<img src='images/forward_f2.png' border='0' align='absmiddle' alt='acajoom guide' style='width: 26px; height: 26px;' hspace='6'>";
				 }

		} elseif (($GLOBALS[ACA.'mod_pub']==1 OR $GLOBALS[ACA.'act_totallist0'] > 1) AND ($GLOBALS[ACA.'act_totalmailing0'] < 2)) {

			    if ($GLOBALS[ACA.'firstmailing'] == 1) {
					$guide .= '<strong><u>'._ACA_STEP.'4</u></strong><br />';
					if ($GLOBALS[ACA.'listype2'] == 1) $guide .= _ACA_GUIDE_FOUR_ACA_STEP_NEWS.'<br />'._ACA_GUIDE_THRID_ACA_STEP_AUTOS;
				 } else {
					$guide .= '<strong><u>'._ACA_STEP.'4</u></strong><br />';
					$guide .= _ACA_GUIDE_FOUR_ACA_STEP_AUTOS.'<br />'._ACA_GUIDE_THRID_ACA_STEP_NEWS;
				 }
				$guide .= _ACA_GUIDE_FOUR_ACA_STEP;
		} else {

			$guide .= '<strong>'._ACA_GUIDE_TURNOFF.'</strong>';
			$config = array();
			$config['show_guide'] = '0';
			$xf->saveConfig($config);
		}

	$guide .= '</fieldset></center></div>';
	 }
	return $guide;
}


