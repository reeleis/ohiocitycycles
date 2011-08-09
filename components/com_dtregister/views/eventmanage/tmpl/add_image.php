<?php

/**
* @version 2.7.5
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

$document =& JFactory::getDocument();

$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/dt_jquery.js');

$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/form.js');
$config = $this->getModel('config');
?>
<script>
  var html = '<img src="<?php echo JUri::root() ?>index.php?option=com_dtregister&controller=file&task=thumb&w=<?php echo $config->getGlobal('event_thumb_width',100) ?>&h=<?php echo $config->getGlobal('event_thumb_height',100); ?>&filename=images/dtregister/eventpics/[path]" border="0" alt= "[path]" />&nbsp;<a class="removeimage" href="#">X</a>';
  DTjQuery(document).ready(function(){
            DTjQuery(".ajax").click(function(event){

					        event.preventDefault();

						    element = this;

					    	DTjQuery.get(DTjQuery(this).attr('href'), function(data){
								DTjQuery('#FileId').val('');
								DTjQuery(element).prev().remove();
								DTjQuery(element).remove();

						    });

						    return false;

					});
            DTjQuery('#uploadFile').click(function(){     
               
                var frm = this.form;
                var prevtask = DTjQuery('form[name="'+this.form.name+'"] input[name="task"]').val();
                var prevcontroller = DTjQuery('form[name="'+this.form.name+'"] input[name="controller"]').val();
                
               // DTjQuery('form[name="'+this.form.name+'"] input[name="task"]').val("upload");
                
               // DTjQuery('form[name="'+this.form.name+'"] input[name="controller"]').val("file");
            
                 var options = { 
            
                type :'POST',
            
               // target : '#debug',
                data : {name:'event',filetypesevent:'png,jpg,jpeg,gif',filesizeevent:1000000,field_id:'',eventpic:1,'controller':'file','task':'upload'},
                url:        'index.php?no_html=1', 
            
              //  iframe : true ,
            
                dataType : 'script',
            
                success :function(response){
                  
                    var $out = DTjQuery('#debug');
            //$out.html('Form success handler received: <strong>' + typeof response + '</strong>');
            if (typeof response == 'object' && data.nodeType)
                response = elementToString(response.documentElement, true);
            else if (typeof response == 'object')
                response = objToString(response);
          //  $out.append('<div><pre>'+ response +'</pre></div>');

                 ///  DTjQuery("#debug").html(data.Error);
                   
                  if(data.Error==""){
                     DTjQuery('#FileId').val(data.path);
					 var image = html.replace('[path]',data.path);
                     DTjQuery('#filename').html(image);
                    // DTjQuery('#Field<?php //echo $this->id;?>').next().addClass('success');
                    // DTjQuery('#Field<?php //echo $this->id;?>').next().hide();
                     
                     //DTjQuery('#Field<?php //echo $this->id;?>').parent().append("<br />"+data.message);
                   }else{
                     alert(data.Error);
                   }
                 //  DTjQuery('form[name="'+frm.name+'"] input[name="task"]').val(prevtask);
                
                   // DTjQuery('form[name="'+frm.name+'"] input[name="controller"]').val(prevcontroller);
                   //DTjQuery(frm).validate().element('#Field<?php //echo $this->id;?>' );
                }
            
               }; 
            
            // pass options to ajaxForm 
            
               DTjQuery(frm).ajaxSubmit(options);
            
               return false;
            
            });
			DTjQuery('.removeimage').click(function(){
			     element = this;
				 DTjQuery('#FileId').val('');
				 DTjQuery(element).prev().remove();
				 DTjQuery(element).remove();
		    });
        
         });
</script>
<tr>
 <td>
  <?php echo JText::_('DT_EVENT_IMAGE');?>
 </td>
 <td>
    <?php
	 
	 if($this->row->imagepath != ""){
		
		$image = '<img src="'.JUri::root().'index.php?option=com_dtregister&controller=file&task=thumb&w='.$config->getGlobal('event_thumb_width',100).'&h='.$config->getGlobal('event_thumb_height',100).'&filename=images/dtregister/eventpics/'.$this->row->imagepath .'" border="0" alt= "'.$this->row->imagepath.'" />&nbsp;
		<a class="ajax" href="index.php?option=com_dtregister&task=removeimage&eventId='.$this->row->slabId.'" >X</a>';
     }else{
	    $image = "";	 
	 }
	  
     echo "<input id='FileField' class='inputbox' name='file_event' value='' type='file' /> <button class='cancel' id='uploadFile'>".JText::_( 'DT_UPLOAD' )."</button><input type='hidden'  name='data[event][imagepath]' id='FileId' value='".$this->row->imagepath."' />&nbsp;<span id='filename'>".$image.'</span><label for="FileId" style="display:none" generated="true" class="error"></label>'
	?><span id="debug"></span>
 </td>
  <td colspan="2" align="left">&nbsp;&nbsp;<?php echo JHTML::tooltip((JText::_( 'DT_EVENT_IMAGE_HELP' )), '', 'tooltip.png', '', ''); ?></td>

</tr>