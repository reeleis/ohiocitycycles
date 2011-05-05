<?php

/**
* @version 2.7.4
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license Commercial
*/

global $Itemid,$calendar_startDay,$calendar_showCat,$calendar_eventTitle_wrap,$calendar_showTime,$now,$xhtml_url ,$calendar_show_popup;
$lang =& JFactory::getLanguage();
$document =& JFactory::getDocument();

$document->addStyleSheet('components/com_dtregister/assets/css/calendar/dailog.css');

$document->addStyleSheet('components/com_dtregister/assets/css/calendar/calendar.css');

$document->addStyleSheet('components/com_dtregister/assets/css/calendar/dp.css');

$document->addStyleSheet('components/com_dtregister/assets/css/calendar/alert.css');

$document->addStyleSheet('components/com_dtregister/assets/css/calendar/main.css');

$document->addStyleSheet(JURI::root(true).'/components/com_dtregister/assets/css/south-street/jquery-ui.css');

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/dt_jquery.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/Common.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/datepicker_lang_US.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/jquery.datepicker.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/jquery.alert.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/jquery.ifrmdailog.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/wdCalendar_lang_US.php?lang=".$lang->_lang);

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/jquery.calendar.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/jquery-ui.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/tooltip.js");

$fcurrentmonth = "";
$fcurrentweek = "";
$fcurrentday = "";
$calview = JRequest::getVar('calview','month');
${"fcurrent".$calview} = "fcurrent";

?>

<?php
	if($calendar_showCat == '1' || $calendar_showCat == '3'){
		echo $this->loadTemplate('category');
		echo '<br /><br />';
	}
?>

 <div>

      <div id="calhead" style="padding-left:1px;padding-right:1px;">          

            <div class="cHead"><div class="ftitle"><?php echo  JText::_('DT_MY_CALENDAR')?></div>

            <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;"><?php echo  JText::_('DT_LOADING_DATA')?></div>

             <div id="errorpannel" class="ptogtitle loaderror" style="display: none;"><?php echo  JText::_('DT_LOADING_ERROR_TRY_AGAIN')?></div>

            </div>          

            <div id="caltoolbar" class="ctoolbar">

            <div class="btnseparator"></div>

             <div id="showtodaybtn" class="fbutton">

                <div><span title='<?php echo  JText::_('DT_CLICK_TODAY')?> ' class="showtoday">

                <?php echo  JText::_('DT_TODAY')?></span></div>

            </div>

              <div class="btnseparator"></div>

            <div id="showdaybtn" class="fbutton <?php echo  $fcurrentday; ?>">

                <div><span title='Day' class="showdayview"><?php echo  JText::_('DT_DAY')?></span></div>

            </div>

              <div id="showweekbtn" class="fbutton <?php echo  $fcurrentweek; ?>">

                <div><span title='Week' class="showweekview"><?php echo  JText::_('DT_WEEK')?></span></div>

            </div>

              <div id="showmonthbtn" class="fbutton <?php echo  $fcurrentmonth; ?>">

                <div><span title='Month' class="showmonthview"><?php echo  JText::_('DT_MONTH')?></span></div>

            </div>

            <div class="btnseparator"></div>

              <div  id="showreflashbtn" class="fbutton">

                <div><span title='Refresh view' class="showdayflash"><?php echo  JText::_('DT_REFRESH')?></span></div>

                </div>

             <div class="btnseparator"></div>

            <div id="sfprevbtn" title="Prev"  class="fbutton">

              <span class="fprev"></span>

            </div>

            <div id="sfnextbtn" title="Next" class="fbutton">

                <span class="fnext"></span>

            </div>

            <div class="fshowdatep fbutton">

                    <div>

                        <input type="hidden" name="txtshow" id="hdtxtshow" />

                        <span id="txtdatetimeshow"><?php echo  JText::_('DT_LOADING_DATA')?></span>

                    </div>

            </div>

            <div class="clear"></div>

            </div>

      </div>

      <div style="padding:1px;">

        <div class="t1 chromeColor">

            &nbsp;</div>

        <div class="t2 chromeColor">

            &nbsp;</div>

        <div id="dvCalMain" class="calmain printborder">

            <div id="gridcontainer" style="overflow-y: visible;">

            </div>

        </div>

        <div class="t2 chromeColor">

            &nbsp;</div>

        <div class="t1 chromeColor">

            &nbsp;

        </div>   

        </div>

  </div>

<?php
	if($calendar_showCat == '2' || $calendar_showCat == '3'){
		echo '<br />';
		echo $this->loadTemplate('category');
	}
  $datafeedurl = JRoute::_('index.php?option=com_dtregister&Itemid='.$Itemid.'&controller=calendar&format=raw&cat='.$this->cat,$xhtml_url)."&";
  
  if($calendar_eventTitle_wrap){
	 $wrapTitle = "true";  
  }else{
	 $wrapTitle = "false"; 
  }
  
   if($calendar_showTime){
	 $showTime = "true";  
  }else{
	 $showTime = "false"; 
  }
  if(isset($_REQUEST['showby'])){
	  
	  switch($_REQUEST['showby']){
		  case 0:
		     $showday = Jrequest::getVar('showday',$now->toFormat('%m/%d/%Y'));
		  break;
		  case 1:
		     $showday = $now->toFormat('%m/%d/%Y');
		  break;
	 }
	  
  }else{
	  $showday = Jrequest::getVar('showday',$now->toFormat('%m/%d/%Y'));
  }
  
?>
<script type="text/javascript">

 DTjQuery(document).ready(function() {     

            var view="<?php echo JRequest::getVar('calview','month'); ?>";          

            var DATA_FEED_URL = "<?php echo $datafeedurl; ?>";

            var op = {

                view: view,

                theme:3,
                weekstartday : <?php echo ($calendar_startDay-1);?>,
                showday: new Date('<?php echo $showday; ?>'),

                //EditCmdhandler:Edit,

                DeleteCmdhandler:Delete,

                ViewCmdhandler:View,    

                onWeekOrMonthToDay:wtd,

                onBeforeRequestData: cal_beforerequest,

                onAfterRequestData: cal_afterrequest,

                onRequestDataError: cal_onerror, 

                autoload:true,

                url: DATA_FEED_URL + "task=events",  

                quickAddUrl: DATA_FEED_URL + "task=add", 

                quickUpdateUrl: DATA_FEED_URL + "task=update",

                quickDeleteUrl: DATA_FEED_URL + "task=remove",
				wrapTitle : <?php echo $wrapTitle; ?>,
				showTime : <?php echo $showTime; ?>   

            };

            var $dv = DTjQuery("#calhead");

            var _MH = document.documentElement.clientHeight;

            var dvH = $dv.height() + 2;

            op.height = _MH - dvH;

            // To add height to the boxes inside of the month view, comment the line above, then uncomment the line below. 
            // Modify the +20 number to add pixels to the height calculation.

            // op.height = _MH - dvH +20;

            op.eventItems =[];

            var p = DTjQuery("#gridcontainer").bcalendar(op).BcalGetOp();

            if (p && p.datestrshow) {

                DTjQuery("#txtdatetimeshow").text(p.datestrshow);

            }

            DTjQuery("#caltoolbar").noSelect();

            DTjQuery("#hdtxtshow").datepicker({ picker: "#txtdatetimeshow", showtarget: DTjQuery("#txtdatetimeshow"),

            onReturn:function(r){                          

                            var p = DTjQuery("#gridcontainer").gotoDate(r).BcalGetOp();

                            if (p && p.datestrshow) {

                                DTjQuery("#txtdatetimeshow").text(p.datestrshow);

                            }

                     } 

            });

            function cal_beforerequest(type)

            {

                var t="<?php echo  JText::_('DT_LOADING_DATA')?>";

                switch(type)

                {

                    case 1:

                        t="<?php echo  JText::_('DT_LOADING_DATA')?>";

                        break;

                    case 2:                      

                    case 3:  

                    case 4:    

                        t="<?php echo  JText::_('DT_REQUEST_BEING_PROCESSED')?>";                                   

                        break;

                }

                DTjQuery("#errorpannel").hide();

                DTjQuery("#loadingpannel").html(t).show();    

            }

            function cal_afterrequest(type)

            {
                
			   DTjQuery.each(this.eventItems,function(k,v){		
					DTjQuery('#gridcontainer').find('span:contains("'+v[1]+'")').parent().css('backgroundColor',v[5]).parent().css('backgroundColor',v[5]).parent().css('backgroundColor',v[5])<?php if($calendar_show_popup) { ?>.tooltip({content:function(){
						
						var str = '<div class="event_title">'+v[1]+'</div>';
					
			   // Display of tooltip options start here //
						
						var config = v[13];
						if(config.calendar_show_image != "0" && v[12] != ""){
							 str += '<center><img border="0" alt="" style="padding:0px" src="<?php echo  JRoute::_('index.php?option=com_dtregister&controller=file&task=thumb&w=120&h=120&filename=images%2Fdtregister%2Feventpics%2F') ;?>'+v[12]+' /></center>';
						}
						
						if(config.calendar_show_date != "0" && v[14] != ""){
							 str += '<br /><?php echo JText::_('DT_DATE')?>:&nbsp;'+v[14]+'';
						}
						if(config.calendar_show_time != "0" && v[22] != ""){
							 str += '<br /><?php echo JText::_('DT_TIME')?>:&nbsp;'+v[22]+'';
						}
						if(config.calendar_show_location != "0" && v[18] != ""){
							 str += '<br /><?php echo JText::_('DT_LOCATION')?>:&nbsp;'+v[18]+'';
						}
						if(config.calendar_show_moderator != "0" && v[20] != ""){
							 str += '<br /><?php echo JText::_('DT_MODERATOR')?>:&nbsp;'+v[20]+'';
						}
						if(config.calendar_show_price != "0" && v[15] != ""){
							 str += '<br /><?php echo JText::_('DT_PRICE')?>:&nbsp;'+v[15]+'';
						}
						if(config.calendar_show_capacity != "0" && v[16] != ""){
							 str += '<br /><?php echo JText::_('DT_CAPACITY')?>:&nbsp;'+v[16]+'';
						}
						if(config.calendar_show_registered != "0" && v[17] != ""){
							 str += '<br /><?php echo JText::_('DT_REGISTERED')?>:&nbsp;'+v[17]+'';
						}
						if((config.calendar_show_available_spots == "1" ) && v[19] != ""){
							 str += '<br /><?php echo JText::_('DT_AVAILABLE_SPOTS')?>:&nbsp;'+v[19]+'';
						}
			  // Display of tooltip options end here //
			
						 return str;
						 
						 }})
						 <?php }?>
					   
			   })
                switch(type)

                {

                    case 1:

                        DTjQuery("#loadingpannel").hide();

						DTjQuery("#txtdatetimeshow").text(p.datestrshow);

                        break;

                    case 2:

                    case 3:

                    case 4:

                        DTjQuery("#loadingpannel").html("Success!");

                        window.setTimeout(function(){ DTjQuery("#loadingpannel").hide();},2000);

						DTjQuery("#txtdatetimeshow").text(p.datestrshow);

                    break;

                }              

            }

            function cal_onerror(type,data)

            {

                DTjQuery("#errorpannel").show();

            }

            function Edit(data)

            {

               var eurl="edit.php?id={0}&start={2}&end={3}&isallday={4}&title={1}";   

                if(data)

                {

                    var url = StrFormat(eurl,data);

                    OpenModelWindow(url,{ width: 600, height: 400, caption:"Manage  The Calendar",onclose:function(){

                       DTjQuery("#gridcontainer").reload();

                    }});

                }

            }    

            function View(data)

            {

                var str = "";
               
				if(data[10] != ""){
					window.location = data[10];
				}
				
                DTjQuery.each(data, function(i, item){

                    str += "[" + i + "]: " + item + "\n";

                });

				//hiAlert(str);

               // DTjQuery.alerts.alert(str);               

            }    

            function Delete(data,callback)

            {           

                DTjQuery.alerts.okButton="Ok";  

                DTjQuery.alerts.cancelButton="Cancel";  

                hiConfirm("Are You Sure to Delete this Event", 'Confirm',function(r){ r && callback(0);});           

            }

            function wtd(p)

            {

               if (p && p.datestrshow) {

                    DTjQuery("#txtdatetimeshow").text(p.datestrshow);

                }

                DTjQuery("#caltoolbar div.fcurrent").each(function() {

                    DTjQuery(this).removeClass("fcurrent");

                })

                DTjQuery("#showdaybtn").addClass("fcurrent");

            }

            //to show day view

            DTjQuery("#showdaybtn").click(function(e) {

                //document.location.href="#day";

                DTjQuery("#caltoolbar div.fcurrent").each(function() {

                    DTjQuery(this).removeClass("fcurrent");

                })

                DTjQuery(this).addClass("fcurrent");

                var p = DTjQuery("#gridcontainer").swtichView("day").BcalGetOp();
                 DTjQuery(".add_date").each(function(k,v){
						
						
						DTjQuery.data(this,'calview','day');
						
						
				})
                if (p && p.datestrshow) {

                    DTjQuery("#txtdatetimeshow").text(p.datestrshow);

                }

            });

            //to show week view

            DTjQuery("#showweekbtn").click(function(e) {

                //document.location.href="#week";

                DTjQuery("#caltoolbar div.fcurrent").each(function() {

                    DTjQuery(this).removeClass("fcurrent");

                })

                DTjQuery(this).addClass("fcurrent");

                var p = DTjQuery("#gridcontainer").swtichView("week").BcalGetOp();
                DTjQuery(".add_date").each(function(k,v){
						
						
						DTjQuery.data(this,'calview','week');
						
						
						
				})
                if (p && p.datestrshow) {

                    DTjQuery("#txtdatetimeshow").text(p.datestrshow);

                }

            });

            //to show month view

            DTjQuery("#showmonthbtn").click(function(e) {

                //document.location.href="#month";

                DTjQuery("#caltoolbar div.fcurrent").each(function() {

                    DTjQuery(this).removeClass("fcurrent");

                })

                DTjQuery(this).addClass("fcurrent");

                var p = DTjQuery("#gridcontainer").swtichView("month").BcalGetOp();
                 DTjQuery(".add_date").each(function(k,v){
						
						
						DTjQuery.data(this,'calview','month');
						
						
				})
                if (p && p.datestrshow) {

                    DTjQuery("#txtdatetimeshow").text(p.datestrshow);

                }

            });

            DTjQuery("#showreflashbtn").click(function(e){

                DTjQuery("#gridcontainer").reload();

            });

            //Add a new event

            DTjQuery("#faddbtn").click(function(e) {

                var url ="edit.php";

                OpenModelWindow(url,{ width: 500, height: 400, caption: "Create New Calendar"});

            });

            //go to today

            DTjQuery("#showtodaybtn").click(function(e) {

                var p = DTjQuery("#gridcontainer").gotoDate().BcalGetOp();

                if (p && p.datestrshow) {
                    
                    DTjQuery("#txtdatetimeshow").text(p.datestrshow);

                }

            });

            //previous date range

            DTjQuery("#sfprevbtn").click(function(e) {

                var p = DTjQuery("#gridcontainer").previousRange().BcalGetOp();

                if (p && p.datestrshow) {
                     
					DTjQuery(".add_date").each(function(k,v){
						
						var link = DTjQuery(this).attr('attr');
						
						link += "&showday="+p.showday.format("m/d/yyyy");
						
						DTjQuery(this).attr('href',link);
						
						DTjQuery.data(this,'showday',p.showday.format("m/d/yyyy"));
						
					})
					
                    DTjQuery("#txtdatetimeshow").text(p.datestrshow);

                }

            });

            //next date range

            DTjQuery("#sfnextbtn").click(function(e) {

                var p = DTjQuery("#gridcontainer").nextRange().BcalGetOp();

                if (p && p.datestrshow) {
                    
					DTjQuery(".add_date").each(function(k,v){
						
						var link = DTjQuery(this).attr('attr');
						
						link += "&showday="+p.showday.format("m/d/yyyy");
						DTjQuery.data(this,'showday',p.showday.format("m/d/yyyy"));
						DTjQuery(this).attr('href',link);
						
					})
                    DTjQuery("#txtdatetimeshow").text(p.datestrshow);

                }

            });
			
			DTjQuery(".add_date").click(function(){
				
				var showday = DTjQuery.data(this, "showday");
				var calview = DTjQuery.data(this, "calview");
				//console.log(calview);
				var link = DTjQuery(this).attr('attr');
				
				if(showday != undefined){
					link += "&showday="+showday;
				}
				if(calview != undefined){
					link += "&calview="+calview;
				}
				DTjQuery(this).attr('href',link);
				return true;
				
			});

        });

    </script>    
