<?php 
  $TableUser     =  $this->getModel('user')->table; 
  $events        = $TableUser->TableEvent->optionslist(null,'dtstart desc');
  $eventoptions  =  DtHtml::options($events,JText::_("DT_SELECT_EVENT"));
 
  $status = isset($this->search['status'])?$this->search['status']:'';
  $attend = isset($this->search['attend'])?$this->search['attend']:'-1';
  $fee_status = isset($this->search['fee_status'])?$this->search['fee_status']:'';
  $event_archive = isset($this->search['event_archive'])?$this->search['event_archive']:'';
  $query = isset($this->search['query'])?$this->search['query']:'';
   
?>
<table class="adminheading" border="0" width="100%">

		<tr>
      <td colspan="12">
      <table>
      <tr>
			<th colspan="4" style="width:250px;"><?php echo JText::_( 'DT_REGISTRATION_MANAGER' ); ?></th>

			<td><?php echo JText::_( 'DT_SELECT_EVENT' ); ?>:</td>

			<td><?php     echo JHTML::_('select.genericlist', $eventoptions,'search[eventId]','onchange="submit()"','value','text',$this->eventId);;?></td>

			<td><?php echo JText::_( 'DT_SHOW_FAILED' ); ?>:</td>

			<td><?php  echo JHTML::_('select.genericlist', DtHtml::options(array(JText::_('NO'),JText::_('YES')),JText::_("DT_SHOW_FAILED")),'search[fee_status]',' onchange="submit()" ','value','text',$fee_status)?></td>
      <td><?php echo JText::_( 'DT_ATTENDED' ); ?>:</td>

			<td><?php  echo JHTML::_('select.genericlist', DtHtml::options(array('-1'=>Jtext::_('DT_NONE'),0=>JText::_('NO'),1=>JText::_('YES'))),'search[attend]',' onchange="submit()" ','value','text',$attend)?></td>
      <td><?php  echo JHTML::_('select.genericlist', DtHtml::options($TableUser->statustxt,JText::_('DT_SELECT_STATUS')),'search[status]',' onchange="submit()" ','value','text',$status)?></td>
      <td>
      <?php

		  $options=array();

      $options[]=JHTML::_('select.option',"0",JText::_( 'DT_HIDE_ARCHIVE' ));

	    $options[]=JHTML::_('select.option',"1",JText::_( 'DT_SHOW_ARCHIVE' ));

	    $options[]=JHTML::_('select.option',"-1",JText::_( 'DT_ALL_EVENT' ));

      $archive = JRequest::getVar('archive',0) ;

	    echo JHTML::_('select.genericlist', $options,"search[event_archive]",' onchange="submit()" ',"value","text",$event_archive);

			?>
      </td>
      </tr>
      </table>
      </td>
		</tr>

		<tr>
      <td colspan="12">
      <table>
      <tr>
		  <td colspan="9">

		  <ul>

      <li>Use the "Select Event" dropdown filter above to show records from only a specific event.

      <li>To see records of failed Authorize.net registration attempts due to failed payments, select "Yes" on the "Show Failed Attempts" dropdown filter above.</li>

      <li>To add new records manually, click either "Group Registration" or "Individual Registration" in the top right after first selecting an event in the dropdown.</li>

      <li>To sort the records, click the column title.  Click it again to re-sort the opposite direction.</li>

      </ul>

		  </td>
          <td width="200px">
           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
          </td>
          <td colspan="2" >
           
            <?php echo JText::_('DT_SEARCH');?>:<input type="text" size="30" name="search[query]" value="<?php echo addslashes($query);?>" /><input type="submit" value="Go" />
          </td>
          </tr>
          </table>
          </td>
		</tr>

		</table>