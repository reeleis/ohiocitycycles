<?php

/**
* @version 2.7.7
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

    jimport('joomla.html.pane');

	jimport('joomla.html.select');

	$pane =& JPane::getInstance('tabs');

	$editor =& JFactory::getEditor();

    $editor->_loadEditor();

?>

<form action="index.php" method="post" name="adminForm" autocomplete="off">

  <table cellpadding="4" cellspacing="0" border="0" width="100%">

  <tr><td width="100%" class="sectionname">

  </td></tr>

  </table>

  <table width="100%">

 			<tr>

 				<td width="100%">

 					<?php	

					//jimport('joomla.application.component.model');

					//include( JPATH_SITE.'/administrator/components/com_dtregister/models/jomsocial.php');

					echo $pane->startPane('dtregister');

 						//$tabs->startTab(JText::_( 'DT_REGISTER_GENERAL' ),'dtregister1');

 						echo $pane->startPanel(JText::_( 'DT_REGISTER_GENERAL' ),'dtregister1');

 					?>

 						<div class="dtTabs" id='general'>

                        </div>

	 					<?php

	 						echo $pane->endPanel();
                          
                            echo $pane->startPanel(JText::_( 'DT_EVENT_LISTING' ),'dtregister6');

							?>

                               <div class="dtTabs" id='event_listing'>

                               </div>					  

                            <?php

                            echo $pane->endPanel();

                            echo $pane->startPanel(JText::_( 'DT_CALENDAR' ),'dtregister10');
							?>
                              <div class="dtTabs" id='calendar'>
                                 
                              </div>
                            <?php
							echo $pane->endPanel();

	 						echo $pane->startPanel(JText::_( 'DT_REGISTER_EMAIL' ),'dtregister2');

	 					    ?>

                                <div class="dtTabs1 html" id='message'>

                                    <?php
 include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'config'.DS.'tmpl'.DS.'tab.message.php');

		 ?>

                               </div>		

	 					<?php

	 						echo $pane->endPanel();

	 						echo $pane->startPanel(JText::_( 'DT_EMAILS' ),'dtregister9');

	 					?>

                          <div class="dtTabs1" id='email'>

                             <?php
		    include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'config'.DS.'tmpl'.DS.'tab.email.php');

		 ?>

                          </div>	

	 					<?php

	 						echo $pane->endPanel();

	 						//echo $pane->startPanel(JText::_( 'DT_REGISTER_PAYMENT' ),'dtregister3');

	 					?>

	 					<?php

	 						echo $pane->endPanel();

	 						//echo $pane->startPanel(JText::_( 'DT_REGISTER_FIELDS' ),'dtregister4');

	 					?>

	 					<?php

	 					//	echo $pane->endPanel();

							echo $pane->startPanel(JText::_( 'DT_REGISTER_REGISTRANTS' ),'dtregister5');

							?>

                                 <div class="dtTabs1" id='registrant'>

                                      <?php
		   include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'config'.DS.'tmpl'.DS.'tab.registrant.php');

		 ?>                

                            </div>	

                              <?php

							echo $pane->endPanel();

                            echo $pane->startPanel(JText::_( 'DT_USER_PANEL' ),'dtregister6');

							              ?>

                                   <div class="dtTabs1" id='userpanel'>

 <?php
		  include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'config'.DS.'tmpl'.DS.'tab.userpanel.php');

		 ?>

                                     </div>	

                            <?php

							echo $pane->endPanel();

						echo $pane->startPanel(JText::_( 'DT_PROFILE_SYNC' ),'dtregister7');

                            ?>

                            <?php

                         //   $model = & JModel::getInstance('Model','Jomsocial');

							$options = array();

							 // $options = $model->getFieldsOption();

							?>

                             <div class="dtTabs1" id='fieldmap'>

                                <?php

 include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'config'.DS.'tmpl'.DS.'tab.fieldmap.php');

		 ?>                         

                             </div>

                            <?php

							echo $pane->endPanel();

                            echo $pane->startPanel(JText::_( 'DT_BARCODE' ),'dtregister3');

							?>  

                          <div class="dtTabs1" id='fieldmap'>

                             <?php
		  include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'views'.DS.'config'.DS.'tmpl'.DS.'tab.barcode.php');

		 ?>  

                             </div>	 

							<?php

							echo $pane->endPanel();
                          
	 						echo $pane->endPane();

	 					?>

	 				</td>

	 			</tr>

	 		</table>

  <input name="task" type="hidden" value="edit" />

  <input type="hidden" name="controller" value="config" />

  <input name="option" type="hidden" value="<?php echo DTR_COM_COMPONENT; ?>" />

</form>

 <?php  

           $document =& JFactory::getDocument();

		   JHTML::script('dt_jquery.js','components/com_dtregister/assets/js/');

    ?>

   <script type="text/javascript">

      DTjQuery(function(){
         
		  DTjQuery(document.adminForm).validate({
                        success: function(label) {
                            label.addClass("success");
                        }
              
                });
		 
         var nohtml;

	     DTjQuery('.dtTabs').each(function(){

			 if(DTjQuery(this).hasClass('html')){

			    nohtml = '';

			 }else{

			   nohtml = '&no_html=1';

			 }
             DTjQuery(this).load("index.php?option=com_dtregister&controller=config"+nohtml+"&task=loadtab&type="+DTjQuery(this).attr('id'));

		 });

	  });

      function submitbutton(pressbutton){
    		
			DTjQuery('.taberror').removeClass('taberror');
			
			if(pressbutton == "cancel"){
				submitform(pressbutton);
				return;
			}
			
			if(DTjQuery(document.adminForm).valid()){
				
				submitform(pressbutton);
				
			}else{
			  var index =  DTjQuery('.error:input').parents('.current').children().index(DTjQuery('.error:input').parents('dd'));
			  index++;
			  DTjQuery('.tabs dt:nth-child('+index+')').addClass('taberror');
			  DTjQuery('.tabs dt:nth-child('+index+')').css({'background':'#ff0000'});
			}	
			  
			return false;
		
		}

	  function loadeditor(){

		 <?php

		// include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_dtregister'.DS.'view'.DS.'config'.DS.'tab.loadeditor.php');

		 ?>

	  }

   </script>
