<?php

global $Itemid , $calendar_startDay ,$calendar_showCat,$calendar_eventTitle_wrap,$calendar_showTime;
$lang =& JFactory::getLanguage();
$document =& JFactory::getDocument();

$document->addStyleSheet('components/com_dtregister/assets/css/calendar/dailog.css');

$document->addStyleSheet('components/com_dtregister/assets/css/calendar/calendar.css');

$document->addStyleSheet('components/com_dtregister/assets/css/calendar/dp.css');

$document->addStyleSheet('components/com_dtregister/assets/css/calendar/alert.css');

$document->addStyleSheet('components/com_dtregister/assets/css/calendar/main.css');

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/jquery.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/Common.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/datepicker_lang_US.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/jquery.datepicker.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/jquery.alert.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/jquery.ifrmdailog.js");

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/wdCalendar_lang_US.php?lang=".$lang->_lang);

$document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/calendar/jquery.calendar.js");



?>

 <div>



      <div id="calhead" style="padding-left:1px;padding-right:1px;">          

            <div class="cHead"><div class="ftitle"><?php echo  JText::_('DT_MY_CALENDAR')?></div>

            <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;"><?php echo  JText::_('DT_LOADING_DATA')?></div>

             <div id="errorpannel" class="ptogtitle loaderror" style="display: none;"><?php echo  JText::_('DT_LOADING_ERROR_TRY_AGAIN')?></div>

            </div>          

            

            <div id="caltoolbar" class="ctoolbar">

             <!-- <div id="faddbtn" class="fbutton">

                <div><span title='Click to Create New Event' class="addcal">



                New Event                

                </span></div>

            </div> -->

            <div class="btnseparator"></div>

             <div id="showtodaybtn" class="fbutton">

                <div><span title='<?php echo  JText::_('DT_CLICK_TODAY')?> ' class="showtoday">

                <?php echo  JText::_('DT_TODAY')?></span></div>

            </div>



              <div class="btnseparator"></div>



            <div id="showdaybtn" class="fbutton">

                <div><span title='Day' class="showdayview"><?php echo  JText::_('DT_DAY')?></span></div>

            </div>

              <div  id="showweekbtn" class="fbutton">

                <div><span title='Week' class="showweekview"><?php echo  JText::_('DT_WEEK')?></span></div>

            </div>



              <div  id="showmonthbtn" class="fbutton fcurrent">

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

<br />
<?php
  if($calendar_showCat){
	  echo $this->loadTemplate('category');
  }
  $datafeedurl = JRoute::_('index.php?option=com_dtregister&Itemid='.$Itemid.'&controller=calendar&format=raw&cat='.$this->cat)."&";
  
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
?>
<script type="text/javascript" >

 DTjQuery(document).ready(function() {     

           var view="month";          

           

            var DATA_FEED_URL = "<?php echo $datafeedurl; ?>";

            var op = {

                view: view,

                theme:3,
                weekstartday : <?php echo ($calendar_startDay-1);?>,
                showday: new Date(),

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
				    
					
					DTjQuery('#gridcontainer').find('span:contains("'+v[1]+'")').parent().css('backgroundColor',v[5]).parent().css('backgroundColor',v[5]).parent().css('backgroundColor',v[5])
					   
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

                    DTjQuery("#txtdatetimeshow").text(p.datestrshow);

                }



            });

            //next date range

            DTjQuery("#sfnextbtn").click(function(e) {

                var p = DTjQuery("#gridcontainer").nextRange().BcalGetOp();

                if (p && p.datestrshow) {

                    DTjQuery("#txtdatetimeshow").text(p.datestrshow);

                }

            });

            

        });

    </script>    



