<?php
 defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
global $_VERSION, $mainframe;
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php

$mainframe->registerEvent( 'acajoombot_editabs', 'acajoombot_content_editab' );
$mainframe->registerEvent( 'acajoombot_transformall', 'acajoombot_content_transformall' );
$mainframe->registerEvent( 'acajoombot_transformall', 'acajoombot_jcalpro_transformall' );
$mainframe->registerEvent('acajoombot_transformfinal', 'acajoombot_class_transformfinal');

 function acajoombot_content_editab() {
 	 $content_items = acajoombot_content_getitems();
 	 ob_start();
?>
<script type="text/javascript">
<!--

function selectFormFB(){
	if(!document.adminForm){
		return 'mosForm';
	}else{
		return 'adminForm';
	}
}

function selectFB(variable){
	var formname = selectFormFB();
	return eval('document.'+formname+'.'+variable);
}

function acajoombot_content_update_output() {
	// get the info
	var form = document.adminForm;
	if(!form){
		form = document.mosForm;
	}
	var content_id = form.content_id.options[form.content_id.selectedIndex].value;

    //changed to use radio instead of checkbox - p0stman911
    for (i=0;i<form.content_type.length;i++) {
        if (form.content_type[i].checked) {
             var content_type = form.content_type[i].value;
        }
    }
    // output the tag
	form.content_tag.value = "{contentitem:" + content_id + "|" + content_type + "}";
} // end function
//-->
</script>
<table class="acajoomcss_bots" width="100%">
	<tr>
		<td style="vertical-align: top;">
				<span class="editlinktip">
			    <?php
				$tip =  _ACA_TITLE_ONLY_TIPS ;
               $title = _ACA_TITLE_ONLY;
			    $title_only = "<span class=\"editlinktip\">" . compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 ) . "</span>";
				$tip = _ACA_INTRO_ONLY_TIPS;
				$title =  _ACA_INTRO_ONLY;
				$intro_only = "<span class=\"editlinktip\">" . compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 ) . "</span>";
                $tip =  _ACA_FULL_ARTICLE_TIPS;
				$title =  _ACA_FULL_ARTICLE ;
				$full_article = "<span class=\"editlinktip\">" . compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 ) . "</span>";
				?>
				</span>
				<br /><br />
				<span class="editlinktip">
                <input type="radio" name="content_type" value="0" checked="checked" onclick="acajoombot_content_update_output();" /><?php echo $full_article; ?>
                <input type="radio" name="content_type" value="1" onclick="acajoombot_content_update_output();" /><?php echo $intro_only; ?>
                <input type="radio" name="content_type" value="2" onclick="acajoombot_content_update_output();" /><?php echo $title_only; ?>
                </span>
			<br /><br />
				<span class="editlinktip">
				<?php
					$tip = _ACA_TAGS_TITLE_TIPS;
					$title = _ACA_TAGS_TITLE.': ';
					echo compa::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			<input type="text" name="content_tag" class="inputbox" size="20" onfocus="this.select();" />
			<br /><br />
			<select name="content_id" class="inputbox" size="30" onchange="acajoombot_content_update_output();">
			<?php
				 if(sizeof($content_items) > 0) {
					 foreach ($content_items AS $content_item) {
						 echo '<option value="' . $content_item->id . '">' . $content_item->section . '/' . $content_item->category . '/'. $content_item->title . '</option>' . "\n";
					 }
				 }
			?>
			</select>
		</td>
	</tr>
</table>

<?php

	 $return = ob_get_contents();
	 ob_end_clean();
	 return array(_ACA_CONTENT_ITEM, $return);
 }

 function acajoombot_content_getitems() {
	 global $database;

	 $query = "SELECT a.id as id, a.title as title, b.title as section, c.title as category FROM #__content as a, #__sections as b, #__categories as c WHERE a.sectionid = b.id AND a.catid = c.id";
	 $database->setQuery($query);
	 $contentitems = $database->loadObjectList();
	 return $contentitems;
 }

 function acajoombot_content_transformall($html, $text) {
	 global  $mainframe;

 	 $content_items = array();
	 preg_match_all('/\{contentitem:(.{1,8})\|(.{1})}/', $html, $content_items, PREG_SET_ORDER);
	 foreach ($content_items as $content_item) {

		 $Itemid = $mainframe->getItemId($content_item[1]);
		 if(empty($Itemid)){
		 	$Itemid = $GLOBALS[ACA.'itemidAca'];
		 }
		 $replacement = acajoombot_content_getitem($content_item[1]);
		 if ($GLOBALS[ACA.'show_author'] == 1){
		 		$author = '<br />'.$replacement->created_by_alias;
	 	}
	 	else{
	 		$author = '';
	 	}

		 if ($content_item[2] == 0) {
			 $html = str_replace($content_item[0], '<div class="contentpaneopen_nws"><span class="contentheading_nws">' . $replacement->title . '</span>' . "\r\n" . $author .'<br />' . $replacement->introtext . '<br />' . "\r\n" . $replacement->fulltext . "\r\n".'</div>', $html);
		 } else {

			 if ($GLOBALS[ACA.'use_sef'] == '1' AND $GLOBALS['mosConfig_sef'] == '1' AND function_exists('sefRelToAbs')) {
			 	$link = sefRelToAbs('index.php?option=com_content&task=view&id='.$content_item[1].'&Itemid='.$Itemid );
			 } else {
			 	$link = $GLOBALS['mosConfig_live_site'].'/index.php?option=com_content&task=view&id='.$content_item[1].'&Itemid='.$Itemid;
			 }

             if ($content_item[2] == 1) {
			    $html = str_replace($content_item[0], '<div class="contentpaneopen_nws"><span class="contentheading_nws">' . $replacement->title . '</span>' . "\r\n" . $author . '<br />' . $replacement->introtext . '<br />' . "\r\n" . '<a href="' . $link . '"><span class="readon_nws">' . JText::_('Read more') . '</span></a>' . "\r\n".'</div>', $html);
             }
             else {
			    $html = str_replace($content_item[0], '<a href="' . $link . '"><span class="contentheading_nws">' . $replacement->title . '</span></a>', $html);
             }
        }

		 $images = acajoombot_content_getimage($replacement->images);
		 foreach($images as $image) {
			 $image_string = '<img src="' . $GLOBALS['mosConfig_live_site'] . '/images/stories/' . $image['image'] . '" align="' . $image['align'] . '" alt="' . $image['alttext'] . '" border="' . $image['border'] . '" />';
			 $html = preg_replace('/{mosimage}/', $image_string, $html, 1);
		 }
	 }
	 $content_items = array();
	 preg_match_all('/\{contentitem:(.{1,5})\|(.{1})}/', $text, $content_items, PREG_SET_ORDER);
	 foreach ($content_items as $content_item) {

		 $Itemid = $mainframe->getItemId($content_item[1]);
		 if(empty($Itemid)){
		 	$Itemid = $GLOBALS[ACA.'itemidAca'];
		 }
		 $replacement = acajoombot_content_getitem($content_item[1]);
 		if ($GLOBALS[ACA.'show_author'] == 1){
		 	$author = "\r\n".$replacement->created_by_alias;
	 	}
	 	else{
	 		$author = '';
	 	}

		 $replacement->title = strtoupper(acajoom_mail::htmlToText($replacement->title));
		 $replacement->introtext = acajoom_mail::htmlToText($replacement->introtext);
		 $replacement->fulltext = acajoom_mail::htmlToText($replacement->fulltext);
		 if ($content_item[2] == 0) {
			 $text = str_replace($content_item[0], $replacement->title . $author . "\r\n" . $replacement->introtext . "\r\n" . $replacement->fulltext . "\r\n", $text);
		 } else {
			 if ($GLOBALS[ACA.'use_sef'] == '1' AND $GLOBALS['mosConfig_sef'] == '1' AND function_exists('sefRelToAbs')) {
			 	$link = sefRelToAbs('index.php?option=com_content&task=view&id=' . $content_item[1].'&Itemid='.$Itemid);
			 } else {
			 	$link = $GLOBALS['mosConfig_live_site'].'/index.php?option=com_content&task=view&id=' . $content_item[1].'&Itemid='.$Itemid;
			 }

             if ($content_item[2] == 1) {
			    $text = str_replace($content_item[0], $replacement->title . $author . "\r\n" . $replacement->introtext . "\r\n" . '* ' . JText::_('Read more') . ' ( '. $link . ' )' . "\r\n", $text);
             }
             else {
			    $text = str_replace($content_item[0], $replacement->title . ' ( ' . $link . ' )', $text);
             }
         }
		 $text = str_replace('{mosimage}', '', $text);
	 }

	 $html = str_replace('{mospagebreak}', '<div style="clear: both;" ></div>', $html);
	 $text = str_replace('{mospagebreak}', "\r\n \r\n", $text);

 }
 function acajoombot_content_getitem($id) {
	global $database;
	$erro = new xerr( __FILE__ , __FUNCTION__ );
	$query = "SELECT a.title as title, a.sectionid as sectionid, a.catid as catid, a.introtext as introtext, b.name as name, a.created_by_alias as created_by_alias, a.fulltext as `fulltext`, a.images as images FROM #__content as a, #__users as b WHERE a.id = $id AND a.created_by = b.id";
	$database->setQuery($query);
	$database->loadObject($content_item);
	$erro->err = $database->getErrorMsg();
	$erro->show();

	if($content_item->created_by_alias == ''){$content_item->created_by_alias = $content_item->name;}

	 if (!$erro->E(__LINE__ ,  '8011')	) {
		return false;
	} else {
		if(get_magic_quotes_runtime()) {
			$content_item->title = stripslashes($content_item->title);
			$content_item->introtext = stripslashes($content_item->introtext);
			$content_item->fulltext = stripslashes($content_item->fulltext);
			$content_item->images = stripslashes($content_item->images);
			$content_item->created_by_alias = stripslashes($content_item->created_by_alias);
		}
		return $content_item;
	}
 }
 function acajoombot_content_getimage($images) {

	$first = @explode("\n",$images);

	for($i=0, $n=count($first); $i < $n; $i++) {
		$second = explode('|',$first[$i] . '|||');
		$third[$i]['image'] = $second[0];
		$third[$i]['align'] = $second[1];
		$third[$i]['alttext'] = $second[2];
		$third[$i]['border'] = $second[3];
	}
	return $third;
 }

 function acajoombot_jcalpro_transformall($html, $text) {
 global  $database;

	$Itemid = $GLOBALS[ACA.'itemidAca'];

 	preg_match_all('#{jcalevent:.{7,15}}#', $html.$text, $tags);
 	$replace = array();
 	$replacebyHTML = array();
 	$replacebyText = array();
 	if(!empty($tags[0])){
 		foreach ($tags[0] as $tag){
			$isolate = explode(':',$tag);
			if(count($isolate)!=2) continue;
			$parameters = explode('|',$isolate[1]);
			if(count($parameters)!=4) continue;
			if(!empty($replace[$tag])) continue;
			$replace[$tag] = $tag;
			$query = 'SELECT `title`, `description`, `end_date`, `start_date`, `extid` from #__jcalpro_events where `extid` = '.intval($parameters[0]);
			$database->setQuery($query);
			$database->loadObject($event);

			if(empty($event->extid)){
				$replacebyHTML[$tag] = '';
				$replacebyText[$tag] = '';
				continue;
			}

			$eventhtml = '';
			if($parameters[2]){
				$eventhtml .= '<div class="eventpaneopen_nws">';
			}
			$eventhtml .=  '<span class="eventheading_nws">' . $event->title . '</span>';
			$eventtext = strtoupper(acajoom_mail::htmlToText($event->title));

			if($parameters[1]){
				$start_date_array = (explode('-',$event->start_date));
				$start_time_array = (explode(':',substr($event->start_date,10,15)));
				$date = strftime(_DATE_FORMAT_LC, mktime($start_time_array[0], $start_time_array[1], 0, $start_date_array[1], $start_date_array[2], $start_date_array[0]));
				$eventhtml.= '<br/>'.$date;
				$eventtext.= "\r\n".$date;
			}
			if($parameters[2]){
				$eventhtml.= '<br/>'.$event->description;
				$eventtext.= "\r\n".acajoom_mail::htmlToText($event->description);
			}
			if($parameters[3]){
	 			if ($GLOBALS[ACA.'use_sef'] == '1' AND $GLOBALS['mosConfig_sef'] == '1' AND function_exists('sefRelToAbs')) {
				 	$link = sefRelToAbs('index.php?option=com_jcalpro&extmode=view&extid='.$event->extid.'&Itemid='.$Itemid);
				 } else {
				 	$link = $GLOBALS['mosConfig_live_site'].'/index.php?option=com_jcalpro&extmode=view&extid='.$event->extid.'&Itemid='.$Itemid;
				 }

				$eventhtml.= '<br/><a href="' . $link . '"><span class="readon_nws">' . JText::_('Read more') . '</span></a>';
				$eventtext.= "\r\n".' * ' . JText::_('Read more') . ' ( '. $link . ' )';
			}

			if($parameters[2]){
				$eventhtml .= '</div>';
			}

			$replacebyHTML[$tag] = $eventhtml;
			$replacebyText[$tag] = $eventtext;
 		}
 	}
 	$html = str_replace($replace,$replacebyHTML,$html);
	$text = str_replace($replace,$replacebyText,$text);
 }

 function acajoombot_class_transformfinal($html, $text,$params = null) {
	 global  $database;
	 $replace = array();
	 $replaceby = array();
	 $i = 0;
	 if(!empty($params)){
		 foreach($params as $class => $style){
			if(preg_match('#class_#',$class) AND !empty($style)){
				$class = str_replace('class_','',$class);
				$replace[$i] = 'class="'.$class.'"';
				$replaceby[$i] = 'style="'.$style.'"';
				$i++;
			}
		}
	}

	$html = str_replace($replace,$replaceby,$html);
 }