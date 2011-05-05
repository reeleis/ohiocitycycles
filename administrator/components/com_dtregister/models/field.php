<?php

/**
* @version 2.7.3
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelField extends DtrModel {

     var $_defaultFields =  array('firstname','lastname','email','country','state','zip','phone','address1','address2','organization','title');

     var $listingTypes;

     function __construct($config = array()){

       parent::__construct($config);

	   $this->listingTypes = array('memberlist'=>JText::_('DT_MEMBER_LIST'),'attendeelist'=>JText::_('DT_ATTENDEE_LIST'));
//'recordlist'=>JText::_('DT_RECORD_LIST')
	   
	   $this->combinedFields =  array('name'=>array('firstname','lastname'));
	   
	   $this->combinedFields = array();
	   
	   $this->table =  new TableField($this->getDBO());

	   $this->table->setCombineFields($this->combinedFields );
       
	   JHTML::_('behavior.tooltip','.DtTip'); 

	 }

}

class TableField extends DtrTable {

  var $id=null;

  var $name=null;

  var $label=null;

  var $field_size=null;

  var $description=null;

  var $ordering=99;

  var $published=1;

  var $required=0;

  var $type=0;

  var $values=null;

  var $selected=null;

  var $rows=null;

  var $cols=null;

  var $fee_field=null;

  var $fees=null;

  var $fee_type=1;

  var $new_line=0;

   var $textual='';

   var $usagelimit = ""; 

   var $filetypes = ""; 

   var $upload = ""; 

   var $filesize = ""; 

   var $hidden = "";

   var $allevent = "";

   var $group_behave = 0;

   var $showed = 0;

   var $maxlength = "";

   var $date_format = "";

   var $default = 0;

   var $confirmation_field = 0;

   var $parent_id = NULL;

   var $selection_values = array();

   var $listing;

   var $textareafee;

   var $showcharcnt = 0;
   
   var $textualdisplay = 0;
   
   var $applychangefee = 1;
   
   var $tag = '';
   
   var $all_tag_enable = 0;

    function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;

		parent::__construct( '#__dtregister_fields', 'id', $db );

		$this->virFieldsLabels = array('name'=>JText::_('DT_NAME'));

		$this->combinedFields =  array('name'=>array('firstname','lastname'));
        
		$this->combinedFields = array();
		$this->_defaultFields =  array('firstname','lastname','email','country','state','zip','phone','address1','address2','organization','title');

	     $this->mfieldType = &DtrModel::getInstance('fieldtype','dtregisterModel');
        
		$this->defaultListing =  array('firstname','lastname');
		
	    $fieldtype = &DtrModel::getInstance('fieldtype','dtregisterModel');

  }

  function fingbyName($name=""){

	  $data = $this->find(" name = '$name' ");  

	  return ($data)?$data[0]:false;

  }

  function findByTag($tag = ""){
	  
	  $data = $this->find(" tag = '$tag' ");  
      return ($data)?$data[0]:false;    
	  
  }
  
  function enableALLEvents(){
     $query = "delete  from #__dtregister_field_event where showed = 0 and field_id = ".$this->id ;
	 $this->db->setQuery($query);	
	// pr ($this->db->getQuery());
	 $this->db->query(); 
	  $error =  $this->db->getErrorMsg();
		 
		 if($error != ""){
			 echo $error; die;
		 }
     $query = " SELECT DISTINCT e.slabId

					FROM #__dtregister_group_event as e

					LEFT JOIN #__dtregister_field_event as d ON e.slabId = d.event_id

					AND d.field_id  = ".$this->id."

					WHERE 

					 e.publish =1 

					AND d.event_id IS NULL ";

	   $this->db->setQuery($query);		

	   $this->db->getQuery();

	   $data = $this->db->loadRowList();

	   if (count($data) > 0) {
		   foreach($data as $evtid){
	
			  $value = $evtid[0];
	
			  $query = "insert #__dtregister_field_event set event_id =".$value.", field_id =".$this->id.", showed = -1 , required = ".$this->required." , group_behave= ".$this->group_behave." ";
	
			  $this->db->setQuery($query);		
	
			  $this->db->query();	
	
			  $this->db->getErrorMsg();
	
		   }
	   }

  }

  function setCombineFields($combinefields =  array()){

	  $this->combinedFields = $combinefields;

  }

  function getDefaultFieldIds(){

	    $condition = '"'.implode('","',$this->_defaultFields).'"';

	    $fields = $this->find(' name in ('.$condition .') ');

		$temp =  array();

		if (count($fields) > 0) {
			foreach($fields as $field){
				$temp[] = $field->id;
			}
		}

		return $temp;

  }

  function store(){

	 // unset($this->combinedFields);

     if(is_array($this->selection_values)){

	    $this->selection_values = implode('|',$this->selection_values);

	 }

	  if(is_array($this->listing)){

	    $this->listing = implode('|',$this->listing);

	 }
	/* if(in_array($this->name,$this->defaultListing)){
		 $this->listing = array('memberlist','attendeelist','recordlist');
		 $this->listing = array('memberlist','recordlist');
		 $this->listing = implode('|',$this->listing);
	  }*/

      
	// $this->label = 

	return parent::store();

  }

	function memberlistfields(){

	  	 $listingtype = $this->db->Quote("%|memberlist|%");

		 $fields = $this->find(" CONCAT('|',listing,'|') like  $listingtype ",' ordering ');

		 return $fields;

	}

	function attendeelistfields($fields = array()){

	  	 $listingtype = $this->db->Quote("%|attendeelist|%" );
        
		
		 if($fields && count($fields)){
			 $fields = $this->find(" CONCAT('|',listing,'|') like  $listingtype  and (id in(".implode(",",$fields).") or parent_id in (".implode(",",$fields)."))",' ordering asc');
			// $fields = $this->find(" CONCAT('|',listing,'|') like  $listingtype ",' ordering asc');
		 }else{
		   
		   $fields = $this->find(" CONCAT('|',listing,'|') like  $listingtype ",' ordering asc');
		   
		 }

		 return $fields;

	}

	function arrangeheader($fields=array()){

		$combinefields = array();

		$temp =  array();
        
		if (count($fields) > 0) {
			foreach($fields as $field){
	
				$combine = $this->searchCombineFields($field->name);
	
				if($combine !==false){
	
					$combinefields[$combine][] = $field;
	
				}else{
	
					$temp[] = $field;
	
				}
	
			}
		}
         
		 if (count($combinefields) > 0) {
			 foreach($combinefields as $name=>$cfields){
	
			  $query = "";
	
			  $vitualField = new stdClass();
	
			  $vitualField->name = $name;
	
			  $vitualField->label = $this->virFieldsLabels[$name];

			 array_unshift($temp,$vitualField);
	
			 }
		 }

		  return $temp;

	}

	function mapIdtoName(){

	   $fields = $this->find();

	   $temp =  array();

	   if (count($fields) > 0) {
		   foreach($fields as $field){
			$temp[$field->id] = $field->name;
		   }
	   }

	   return $temp;

	}

	function mapNametoId(){

	   $fields = $this->find();

	   $temp = array();

	   if (count($fields) > 0) {
		   foreach($fields as $field){
			$temp[$field->name] = $field->id;
		   }
	   }

	   return $temp;

	}

    function pivotFields($prefix="uf"){  

	 $fields =  $this->find("");

	 // Case uf.field_id when 13 then uf.value end as testpivot 

	 $pivots = array();

	 $combinefields = array();

	 if (count($fields) > 0) {
		 foreach($fields as $key => $field){
	
			 $combine = $this->searchCombineFields($field->name);
	
			 if($combine !==false){
	
				 $combinefields[$combine][] = $field;
	
				  $pivots[$field->id] = "Case ".$prefix.".field_id when ".$field->id." then ".$prefix.".value end as ".$field->name." ";
	
			 }else{
	
			 $pivots[$field->id] = "Case ".$prefix.".field_id when ".$field->id." then ".$prefix.".value end as ".$field->name." ";
	
			 }
	
		 }
	 }

	 if (count($combinefields) > 0) {
		 foreach($combinefields as $name=>$cfield){
			 $query = "";
			foreach($cfield as $field){
			}
			//$pivots[$name] = $query;
	
		 }
	 }

	 return implode(" , \n ",$pivots);

  }

  function searchCombineFields($fieldname=""){

	  $return = false;

	  if (count($this->combinedFields) > 0) {
		  foreach($this->combinedFields as $name=>$fields){
			   if(in_array($fieldname,$fields)){
				   $return = $name;
				   break; 
			   }
		  }
	  }

	  return $return;

  }

  function check(){

      if(is_array($this->selection_values)){

	    $this->selection_values = implode('|',$this->selection_values);

	 }

	// $this->label = 

	 return parent::check();

  }
   function filter($val){
	   
  	  if($val==""){
	  	return false;
	  }else{
	  	return true;
	  }
  }
  function load($id=0){
	
	 parent::load($id);

     $this->label = stripslashes($this->label);
	 
	 if(!is_array($this->selected)){
	   $this->selected = stripslashes($this->selected);
	 }

	 if(!is_array($this->selection_values) && $this->selection_values !== "0" ){
       
	   $this->selection_values = array_filter(explode('|',$this->selection_values),array($this, 'filter'));

	 }elseif(!is_array($this->selection_values) && $this->selection_values == 0){
	    $this->selection_values =  array("0");
	 }

	 if(!is_array($this->selected) && $this->selected !== "0"){

	   $this->selected = array_filter(explode('|', stripslashes($this->selected)),array('TableField', 'filter'));

	 }elseif(!is_array($this->selected) && $this->selected == 0){
	    $this->selected =  array("0");
	 }

	 if(!is_array($this->fees) && $this->fees !== "0"){
       
	   $this->fees = array_filter(explode('|', stripslashes($this->fees)),array('TableField', 'filter'));

	 }elseif(!is_array($this->fees) && $this->fees == 0){
	    $this->fees =  array("0");
	 }

	 if(!is_array($this->listing) && $this->listing !== "0"){

	   $this->listing = array_filter(explode('|', stripslashes($this->listing)),array($this, 'filter'));

	 }elseif(!is_array($this->listing) && $this->listing == 0){
	    $this->listing =  array("0");
	 }
	 
	/* if(in_array($this->name,$this->defaultListing)){
	   $this->listing =  array('memberlist','attendeelist','recordlist');
	   $this->listing =  array('memberlist','recordlist');
	 }
    */
  }

  function getfeeByKey($key){
   
    if(isset($this->fees[$key])){
	   	return $this->fees[$key];
	}else{
	    return "";	
	}

  }

  function delete(){

	  echo "<br />".$sql="Delete From #__dtregister_field_event Where field_id=".$this->id;

	  //$database->setQuery($sql);

	  //$database->query();
	  $arrNotDelete = array('firstname','lastname','email');
      if(in_array($this->name,$arrNotDelete)){
		  $this->error = JText::_('DT_COMPULSARY_FIELD');
		  return false;
	  }else{
		  parent::delete();
	  }
	  return true;

  }

   function findall($eventId,$type,$hidden,$parent_id){

	   global $queryResults;

     if($type=='B' ||  $type=='M'){

	    $showed_sql  = " in(2,3) ";

		if($type=='B'){

		   if($parent_id > 0){

		      $group_behave_sql = "and ( df.group_behave in (2,3))";

		   }else{

		     $group_behave_sql = "and (fe.group_behave in(2,3) or (fe.showed =-1 and df.group_behave in (2,3)))";

		   }

		}

		if($type == 'M'){

		    if($parent_id > 0){

		      $group_behave_sql = "and ( df.group_behave in (1,3))";

		   }else{

		     $group_behave_sql = "and (fe.group_behave in(1,3) or (fe.showed =-1 and df.group_behave in (1,3)))";

			}

		}	

	 }else if($type=='I'){

	    $showed_sql  = " in(1,3) ";

		$group_behave_sql = "";

	 }

     if($parent_id == 0){

	   $event_sql = " fe.event_id=$eventId and ";

	 }else{

	   $event_sql = " fe.event_id=$eventId and  ";

	 }

	 $hidden_sql = "";

	 if(!$hidden){

	    $hidden_sql = "and df.hidden = 0";

	 }

	 if($parent_id >0){

	   $query = "Select df.* , df.id as key2 From #__dtregister_fields as df  where df.published=1 and ( df.showed $showed_sql) $hidden_sql $group_behave_sql and df.parent_id = $parent_id  order by df.ordering "  ;

	   $query = "Select df.* , df.id as key2 From #__dtregister_fields as df  where df.published=1  $hidden_sql  and df.parent_id = $parent_id  order by df.ordering ";

	 }else{

     $query="Select fe.id as key1,   fe.* , df.id as key2 , df.* , if(fe.showed =-1, fe.showed,fe.showed) as showed , if(fe.showed =-1, fe.required,fe.required) as required ,if(fe.showed =-1, fe.group_behave ,fe.group_behave ) as group_behave From #__dtregister_fields as df inner join #__dtregister_field_event as fe on fe.field_id = df.id where $event_sql df.published=1 and (fe.showed $showed_sql or (fe.showed =-1 and df.showed $showed_sql)) $hidden_sql $group_behave_sql and df.parent_id = $parent_id  order by df.ordering ";

	 }

      //$query = "Select * from #__dtregister_fields where parent_id=".$parent_id;

	 $this->db->setQuery($query);

	 //echo "<br />".$this->db->getQuery();

	 if(isset($queryResults[str_replace(" ","",$this->db->getQuery())])){

		  $data = $queryResults[str_replace(" ","",$this->db->getQuery())];

	  }else{

		 $data = $this->db->loadObjectList(); 

		 $queryResults[str_replace(" ","",$this->db->getQuery())] = $data;

	  }

	 //echo "<br />".$this->db->getErrorMsg();

	 // die;

     return $data;

  }

  function getAllFields($event,$type='I',$hidden=false,$parent_id=0,&$fields){

	 $flds = $this->findall($event->slabId,$type,$hidden,$parent_id);
	
	 if (count($flds) > 0) {
		 foreach($flds as $data){
	
			  // debug($data);
	
			  //$this->dependentReschedule($data['parent']);
	
			  $fields[] = $data;
	
			  $this->id = $data->key2;
	
			  $childs = $this->getchild();
	
			  if(count($childs) > 0){
	
				 foreach($childs as $child){
	
				   //debug($child);
	
				   $fields[] = $child;
	
				   $this->getAllFields($event,$type,$hidden,$child->id,$fields);
	
				 }

			  }
	
		   }
	 }

  }

   function findtree($parent_id=0,&$fields=array()){

    // $query = "Select * from #__dtregister_fields where published=1 and parent_id=".$parent_id;

	 $flds = $this->find(" published=1 and parent_id=".$parent_id." ");

	// $this->db->setQuery($query);

	 //$flds = $this->db->loadObjectList();

	  if (count($flds) > 0) {
	  foreach($flds as $data){

		  $fields[$data->id] = $data;

		  $this->id = $data->id;

		  $childs = $this->getchild();

		  if(count($childs) > 0){

		     foreach($childs as $child){

			   //debug($child);

			   $fields[$child->id] = $child;

			   $this->findtree($child->id,$fields);

			 }

		  }

	   }
	  }

  }

   function findtreeByEvent($eventid,$parent_id=0,&$fields=array()){

	 $eventsql = "";

	 if($parent_id == 0){

		 $eventsql = " and ef.event_id = '$eventid' ";

		 $query = "Select * , f.id from #__dtregister_fields f inner join #__dtregister_field_event ef on ef.field_id = f.id where f.published=1 and f.parent_id=".$parent_id.$eventsql;

	 }else{

		 $query = "Select * from #__dtregister_fields where published=1 and parent_id=".$parent_id.$eventsql;

	 }

	 $this->db->setQuery($query);

	 $flds = $this->db->loadObjectList();

	  if (count($flds) > 0) {
	  foreach($flds as $data){

		  $fields[$data->id] = $data;

		  $this->id = $data->id;

		  $childs = $this->getchild();

		  if(count($childs) > 0){

		     foreach($childs as $child){

			   //debug($child);

			   $fields[$child->id] = $child;

			   $this->findtreeByEvent($eventid,$child->id,$fields);

			 }

		  }

	   }
	  }

  }

  function hasChild(){

	$query = "Select count(*) from #__dtregister_fields where parent_id=".$this->id;

	$this->db->setQuery($query);

	//echo "<br />".$this->db->getErrorMsg();

	return ($this->db->loadResult()>0);

  }

  function getchild($published=0){

    // $query = "Select * from #__dtregister_fields where parent_id=".$this->id." order by ordering";

	  global $mainframe;
	  
	 $condition = "";
	 if($mainframe->isAdmin()){

	 }else{
		
		$condition = " and hidden = 0 ";
		if ($published == 1) $condition = " and hidden = 0 and published = 1 ";
			 
	 }

	 $data = $this->find(" parent_id=".$this->id." $condition ", ' ordering ');

	 //$this->db->setQuery($query);

	// echo "<br />".$this->db->getQuery();

	 //$data =  $this->db->loadObjectList();

	// echo "<br />".$this->db->getErrorMsg();

     return $data;

  }

}

class Field extends TableField{

	var $requiredJs  = "";

	var $javascript_valid_data = "";

	var $childJs = "";

	function __construct(){

    parent::__construct();

	}

	function getOptionLimit(){

		if(in_array($this->type,array(1,3,4))){

		  $usagelimit = $this->usagelimit;

		  $usagelimit = explode("|",$usagelimit);

		  return $usagelimit;

	  }

	}

	function individualOptionUsage($eventId = 0){

	  $type = $this->type;

	  if(in_array($type,array(1,3,4))){

		  $usagelimit = $this->usagelimit;

		  $values = $this->values;

		  $name = $this->name;

		  $values = explode("|",$values);

		  if (count($values) > 0) {
		  foreach($values as  $key=>$value){

			 $used_individual[$key] = $this->optionUsedByIndividual($key,$eventId );

		  }
		  }

		  return $used_individual;

	  }

	}

	function groupOptionUsage($eventId=0){ 

	     $type = $this->type;

	  if(in_array($type,array(1,3,4))){

		  $usagelimit = $this->usagelimit;

		  $values = $this->values;

		  $name = $this->name;

		  $values = explode("|",$values);

		  if (count($values) > 0) {
		  foreach($values as  $key=>$value){

			 $used_group[$key] = $this->optionUsedByGroup($key,$eventId );

		  }
		  }

		  return $used_group;

	  }

	}

	function optionUsedByGroup($option,$eventId){

	    global $queryResults;

	    $option = $this->db->Quote("%|".$option."|%");

		$query = "select * from #__dtregister_group_member as gm inner join #__dtregister_group as g on g.groupId= gm.groupUserId  inner join #__dtregister_user as u on u.userId = g.useid inner join #__dtregister_member_field_values v on v.member_id = gm.groupMemberId where v.field_id=".$this->id." and  CONCAT('|',v.`value`,'|') like ".$option." and u.payment_verified = 1  and u.eventId = ".$eventId." ";

		$this->db->setQuery($query);

       if(isset($queryResults[str_replace(" ","",$this->db->getQuery())])){

		  $data = $queryResults[str_replace(" ","",$this->db->getQuery())];

	  }else{

		 $this->db->query();

		 $data = $this->db->getNumRows(); 

		 echo $this->db->getErrorMsg();

		 $queryResults[str_replace(" ","",$this->db->getQuery())] = $data;

	  }

		return $data;

	}

	function optionUsedByIndividual($option,$eventId ){

       global $queryResults;

	   $option = $this->db->Quote("%|".$option."|%");

	   	$query = "select * from #__dtregister_user u inner join #__dtregister_user_field_values v on u.userId = v.user_id where v.field_id=".$this->id." and  CONCAT('|',v.`value`,'|') like ".$option." and u.payment_verified = 1 and u.eventId = ".$eventId." ";

		$this->db->setQuery($query);

		 if(isset($queryResults[str_replace(" ","",$this->db->getQuery())])){

		  $data = $queryResults[str_replace(" ","",$this->db->getQuery())];

	  }else{

		 $this->db->query();

		 $data = $this->db->getNumRows(); 

		 echo $this->db->getErrorMsg();

		 $queryResults[str_replace(" ","",$this->db->getQuery())] = $data;

	  }

		return $data;

	}

	function optionUsageByEvent($eventId=0){

	  $individual = $this->individualOptionUsage($eventId );  

	  $group = $this->groupOptionUsage($eventId );

      $usage = array();

	  if(is_array($group )){

	      foreach($group as $key=>$value){

			$usage[$key] = $value + $individual[$key];

		}

	   }else{

			   if (count($individual) > 0) {
			   foreach($individual as $key=>$value){

				  $usage[$key] = $individual[$key];

			   }
			   }

		}
		
		if(isset($_SESSION['__dtregister']['option_used'][$this->id]) && count($_SESSION['__dtregister']['option_used'][$this->id]) > 0  ){
			foreach($_SESSION['__dtregister']['option_used'][$this->id] as $key=>$used){

					if(isset($usage[$key])){
					 
						   $usage[$key] += $used;
		  
					}else{
						 $usage[$key] = $used; 
					}		
				
			}
		}
	
		return $usage;

     }

	function formhtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	  global $cbviewonly;

	  $serialobj = base64_encode(serialize($obj));

	  $this->javascript_valid_data = " ";

	  $this->label = addslashes($this->label);

	  $this->childJs = "";

	  $document =& JFactory::getDocument();

	  $document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/dt_jquery.js");
	  $document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/form.js"); 

	  $document->addScript("includes/js/joomla.javascript.js");

	  JHTML::_('behavior.calendar');

	   if($this->hasChild()){

	    // trigger the ajax;
	
		  ob_start();

		  if(!isset($_REQUEST['obj'])){

		   ?>

            var not_remove = [];     

            DTjQuery(function(){

           <?php

		}

		?>

          <?php

          if($this->type == '1'){

		    $field_js_event = "change";

		    ?> 

              DTjQuery("#Field<?php echo $this->id; ?>").live('change',function(){

            <?php

		  }else{

		     if($this->type==3){

			     $field_js_event = "click";

			 }else{

			     $field_js_event = "change";

			 }

		    ?>     

			 DTjQuery("#Field<?php echo $this->id; ?>").live('<?php echo $field_js_event; ?>',function(){

               if(this.checked){

                 this.selectedIndex = DTjQuery('input[id="Field<?php echo $this->id;?>"]').index(this) ;

               }else{

                 this.selectedIndex= '';

               }

                DTjQuery.each(DTjQuery('input[id="Field<?php echo $this->id;?>"]'),function(i){

                   if(this.checked){

                      not_remove.push(i);

                   }  

               });

			<?php

		  }		  

		  ?>

               DTjQuery.ajax({

                  type :'POST',

                  dataType :'html',

                  url : '<?php echo JRoute::_('index.php',false) ?>',

                  context : this ,

                  data :{no_html:1,field_id:<?php echo $this->id;?>,selection:this.selectedIndex,option:'com_dtregister',controller:'field',not_remove:not_remove,task:'getConditonField',eventId:<?php echo  $event->slabId; ?>,obj:"<?php echo $serialobj; ?>"},

                  success:function(data){

                    var scriptdata = "";

                     for (i=0; i < data.length; i++) {

                        if(data.charAt(i)=="\/"){

                           if(data.substr(i,15)=="\/*DTendScript*\/"){

                              break;

                           }else{

                              scriptdata +=data.charAt(i);

                           }

                        }else{

                           scriptdata +=data.charAt(i);

                        }

                        }

                   eval(scriptdata);

                     var DT_field = this;         

                     DTjQuery.each(elements,function(t,j){               

                         if(DTjQuery("#Field"+t).size()==0){           

                           parentf = insertorder(DTjQuery(DT_field).parent().parent(),t);

                           parentf.after(j);

                           JTooltips = new Tips($$('.FieldTip'+t), { maxTitleChars: 50, fixed: false});      

                           if(DTjQuery("#Field"+t).attr('type')=='radio' || DTjQuery("#Field"+t).attr('type')=='checkbox'){

                                 DTjQuery('input[id="Field'+t+'"]:checked').each(function(){

                                     DTjQuery(this).trigger('change');

                                 });

                           }else{

                               DTjQuery("#Field"+t).trigger('change');

                           }

                          }

                     });

                     function insertorder(parentf,field_id){

                        var beforefield = [];

                        DTjQuery.each(ordering,function(k,v){

                             if(field_id==k){

                                return false;

                             }

                             beforefield.push(k);

                        });

                       var reversefields = beforefield.reverse();

                        DTjQuery.each(reversefields,function(k,v){               

                            if(DTjQuery("#Field"+v).size()>0){

                               parentf =  DTjQuery("#Field"+v).parent().parent();

                               return false;

                            }

                        });

                        return parentf;

                     }

                      DTjQuery(remove_elements).each(function(i,j){

                        for(var t in j){

                          if(DTjQuery("#Field"+t).size() > 0){

                            DTjQuery("#Field"+t).parent().parent().remove();                

                          }

                        }                

                     });

                     not_remove = [];

                     if(DTjQuery.isFunction(updateFee)){
                        updateFee();
                    }

                  }

               });

			  });	   

		  <?php

		  if(!isset($_REQUEST['obj'])){

		   ?>

             <?php

           if($field_js_event=='click' || $this->type==4){

			  ?>

               DTjQuery.each(DTjQuery('input[id="Field<?php echo $this->id;?>"]:checked'),function(k,v){

                  DTjQuery(v).trigger('<?php echo $field_js_event; ?>');

                   <?php

					  if($this->type == 3){

					?>

                    if(DTjQuery(v).attr('checked')){

                 

                      DTjQuery(v).removeAttr('checked');	

                    }else{

                      DTjQuery(v).attr('checked',true); 

                    }

                    <?php

					}

					?>           

               });

              <?php  

			}else{

			  ?>

			    DTjQuery("#Field<?php echo $this->id; ?>").trigger('<?php echo $field_js_event; ?>');

            <?php

			}

             ?>

             })

           <?php } ?>

		  <?php 

		  $js = ob_get_clean();

		  $this->childJs = $js;

		 $document->addScriptDeclaration( $js );

	 }

   }

   function addChildValidation($user,$event,$form,$overlimitdisable){

	   $childs = $this->getchild();

	   $this->ChildValidationJs = "";

	   $fieldType = DtrModel::getInstance('Fieldtype','DtregisterModel');

	   $fieldTypes = $fieldType->getTypes();

	   if (count($childs) > 0) {
	   foreach($childs as $child){

	       $class = "Field_".$fieldTypes[$child->type];

		   $childTable = new $class();

		   $childTable->load($child->id);

		   if($child->required){

		        $childTable->formhtml($user,$event,$form,$overlimitdisable);
                if(isset($child->requiredJs))
		        $this->ChildValidationJs .= $child->requiredJs;

		   }

		   $this->ChildValidationJs .= $childTable->javascript_valid_data;

		   $this->ChildValidationJs .= $childTable->addChildValidation($user,$event,$form,$overlimitdisable);

	   }
	   }

	   return $this->ChildValidationJs;

   }

   function viewHtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	  return $obj['fields'][$this->id];

   }

}

class Field_Text extends Field{

	var $label = "";

	var $fieldhtml = "";

	function __construct(){

	   parent::__construct();

	}

	function formhtml($obj=null,$event=null,$form='',$overlimitdisable=false){  

	    parent::formhtml($obj,$event,$form,$overlimitdisable);

	     //Text box

			 $value = isset($obj['fields'][$this->id])?stripslashes($obj['fields'][$this->id]):'';

			 $this->requiredJs = "if ( typeof(document.frmcart.elements['Field[".$this->id."]']) != 'undefined' && document.frmcart.elements['Field[".$this->id."]'].value == ''){

                                       alert('{$this->label} ".JText::_('DT_ERROR_FIELD_REQUIRED')." ');

                                       document.frmcart.elements['Field[".$this->id."]'].focus();

                                       return;

                                    }";

			 $maxlength = ($this->maxlength !=0 && $this->maxlength != "")?"maxlength='".$this->maxlength."'":'';

			 $requiredClass = ($this->required)?'required':'';
			 $readonly = "";
			 
			 global $cbviewonly , $cb_integrated ,$map_cb_fields;
			 $my = &JFactory::getUser();
             if($value != "" &&  $cb_integrated > 0 && $cbviewonly==1 && $my->id && isset($map_cb_fields[$this->id])){
				 $readonly = "readonly='readonly'";
			 
			 }
			 if(isset($obj['groupMemberId']) && $obj['groupMemberId'] > 0){
			    $readonly = "";
			 }
			
             return "<input type='text' id='Field".$this->id."'$readonly  class='inputbox ".$requiredClass."' size='$this->field_size' $maxlength name='Field[".$this->id."]' value=\"".htmlentities($value,null,'UTF-8')."\" />";

	}

	 function viewHtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	  return isset($obj['fields'][$this->id])?stripslashes($obj['fields'][$this->id]):'';

   }

}

class Field_Dropdown extends Field{

	var $label = "";

	var $fieldhtml = "";

	function __construct(){

	   parent::__construct();

	}

	function formhtml($obj=null,$event=null,$form='',$overlimitdisable=false){

       $overlimitdisable = true;
	   
	   parent::formhtml($obj,$event,$form,$overlimitdisable);

	   $this->optionlimit = $this->getOptionLimit($event->slabId);

	   $this->optionused = $this->optionUsageByEvent($event->slabId);

	   $fieldSize=$this->field_size;

       $dropDownDatas=explode("|",$this->values);

       $options=array();

	   $value = isset($obj['fields'][$this->id])?$obj['fields'][$this->id]:$this->selected;

	   $options[]=JHTML::_('select.option',null,JText::_( 'DT_SELECT_ONE' ));

	   for($i=0,$n=count($dropDownDatas);$i<$n;$i++){

		 if(!is_array($this->optionlimit) ||(isset($this->optionlimit[$i]) && $this->optionlimit[$i]==0 ) ){	  

			 $options[]=JHTML::_('select.option',$i,trim($dropDownDatas[$i]));

		 }else{

			  if($this->optionlimit[$i] > $this->optionused[$i] ){

				  $options[]=JHTML::_('select.option',$i,trim($dropDownDatas[$i]));

			  }else{

				   $disabled = false;

				   if($overlimitdisable){

					  $disabled = true;

					  if(trim($dropDownDatas[$i])==$value){

						 $disabled = "";

					  }

					  $options[]=JHTML::_('select.option',$i,trim($dropDownDatas[$i]),'value', 'text',$disabled);

				   }else{

					  continue;

				   }

			  }

		 }

	   }

	   $this->requiredJs = "if (typeof(document.frmcart.elements['Field[".$this->id."]']) != 'undefined' && document.frmcart.elements['Field[".$this->id."]'].value == ''){

                                       alert('{$this->label} ".JText::_('DT_ERROR_FIELD_REQUIRED')."');

                                       document.frmcart.elements['Field[".$this->id."]'].focus();

                                       return;

                                    }";

	   $requiredClass = ($this->required)?'required':'';
	   $code = "";
	  
	   
	   global $mainframe ;
	  if($this->fee_field && !$mainframe->isAdmin()){
		  
	  
       $code = $html = <<<EOH
<script type="text/javascript">
DTjQuery(function(){
DTjQuery("#Field$this->id").live('change',function(){
		
	 if(DTjQuery.isFunction(updateFee)){
	   	updateFee();
    }
	
})
DTjQuery('input[id="Field$this->id"]').trigger('change');
})
</script>
EOH;
 }  
 
    if(!is_numeric($value)){
        $value =  $this->getkeyByValue($value);
     }
      global $cbviewonly , $cb_integrated , $map_cb_fields ;
	  $my = &JFactory::getUser();
     $disabled = "";
     if($value != "" &&  $cb_integrated > 0 && $cbviewonly==1 && $my->id && isset($map_cb_fields[$this->id])){
		   $disabled = "disabled='disabled'";

	   }
	   return JHTML::_('select.genericlist', $options,'Field['.$this->id.']',$disabled."style='width:".$fieldSize."px' class='inputbox ".$requiredClass."' ","value","text",$value,"Field".$this->id).$code;

	}

	 function viewHtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	   if(!is_array($this->values)){

		    $this->values = explode('|',$this->values);

		 }
       
	  return (isset($obj['fields'][$this->id]) && isset($this->values[$obj['fields'][$this->id]]))?$this->values[$obj['fields'][$this->id]]:'';

   }
   
    function getkeyByValue($value){
      
      if(!is_array($this->values)){
         $this->values = explode("|",$this->values);
      }
      if(is_array($value)){
         $value = array_pop($value);
      }
      return array_search($value,$this->values);
            
    }

}

class Field_Textarea extends Field{

	var $label = "";

	var $fieldhtml = "";

	function __construct(){

	   parent::__construct();

	}

	function formhtml($obj=null,$event=null,$form='',$overlimitdisable=false){

		parent::formhtml($obj,$event,$form,$overlimitdisable);

	     //Text box

		  $document =& JFactory::getDocument();

	     $document->addScript( JURI::root(true)."/components/com_dtregister/assets/js/textareaCounter.js");

		 $requiredClass = ($this->required)?'required':'';

			 $value = isset($obj['fields'][$this->id])?stripslashes($obj['fields'][$this->id]):'';

			 $this->requiredJs = "if ( typeof(document.frmcart.elements['Field[".$this->id."]']) != 'undefined' && document.frmcart.elements['Field[".$this->id."]'].value == ''){

                                       alert('{$this->label} ".JText::_('DT_ERROR_FIELD_REQUIRED')." ');

                                       document.frmcart.elements['Field[".$this->id."]'].focus();

                                       return;

                                    }";

			 $maxlength = ($this->maxlength != 0 && $this->maxlength != "")?"maxlength='".$this->maxlength."'":'';

			 $requiredClass = ($this->required)?'required':'';

			 $maxlength = ($this->maxlength=="")?-1:$this->maxlength;

			  if($this->fee_field){

				     if($this->showcharcnt){

						  $displayFormat = " , displayFormat : '#input ".JText::_('DT_CHARACTERS')."' ";

					  }else{

						  $displayFormat = " , displayFormat:''";

					  }

					 ob_start();

					 ?>

                     <script type="text/javascript">

				    var options = {   'originalStyle': 'originalDisplayInfo' ,'maxCharacterSize':<?php echo $maxlength ?> };  

                        DTjQuery('#Field<?php echo $this->id; ?>').textareaCount(options);  

					</script>

                     <?php

					$js = ob_get_clean();

					$counter = $js;

				 }else{
				    $counter = "";	 
			     }
			 
			 if( isset($this->id)) 
			 return "<textarea name='Field[".$this->id."]' class='inputbox ".$requiredClass."' id='Field".$this->id."' rows=$this->rows cols=$this->cols>$value</textarea>\n".$counter;

	}

	 function viewHtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	  return isset($obj['fields'][$this->id])?stripslashes($obj['fields'][$this->id]):'';

   }

   function getfeeByKey($key){

	$arrfee = explode('|',$this->textareafee);

	$retrunfee = 0;

	$count = strlen(stripslashes($key));

	if (count($arrfee) > 0) {
	foreach($arrfee as $feestr){

	   	$fee = explode("=",$feestr);

		$chrlimit = $fee[0];

		$retrunfee = $fee[1];

		if($chrlimit >= $count){

			break;

		}
		
	}
	}

	return $retrunfee;

  }

}

class Field_Checkbox extends Field{

	var $label = "";

	var $fieldhtml = "";

	function __construct(){

	   parent::__construct();

	}

	function formhtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	   parent::formhtml($obj,$event,$form,$overlimitdisable);

	     //Checkbox
		  
             $overlimitdisable = true;
			 $this->optionlimit = $this->getOptionLimit($event->slabId);

             $this->optionused = $this->optionUsageByEvent($event->slabId);

             $dropDownDatas=explode("|",$this->values);

			// pr($this->selected);

             if(isset($obj['groupMemberId']) && $obj['groupMemberId'] > 0 ){
			    $value = isset($obj['fields'][$this->id])?$obj['fields'][$this->id]:'';
			 }else{
				 $value = isset($obj['fields'][$this->id])?$obj['fields'][$this->id]:$this->selected;
			  }
			 
			if($value !='')
             $value = array_filter($this->getkeyByValue($value),'my_array_filter_fn');

             $outPut="";

			 $new_line=$this->new_line;
			             
             for($i=0,$n=count($dropDownDatas);$i<$n;$i++){

			      $disabled = "";

                  if(isset($this->optionlimit[$i]) && $this->optionlimit[$i]!=0 && $this->optionlimit[$i] <= $this->optionused[$i]){

                       //continue;

					   if($overlimitdisable){

					      $disabled = "disabled";

					   }else{

					      continue;

					   }

                  }
    
                  $data=trim($dropDownDatas[$i]);

				   $requiredClass = ($i==0 && $this->required)?'required':'';			 

				   $value = ($value=="")?array():$value;
				   global $cbviewonly , $cb_integrated , $map_cb_fields;
	 
                 $my = &JFactory::getUser();
                     
                 $disabled = "";
                     
                 if($value != "" &&  $cb_integrated > 0 && $cbviewonly==1 && $my->id && isset($map_cb_fields[$this->id])){
                           
                   $disabled = "disabled='disabled'";              
                      
                 }
				  if(isset($obj['groupMemberId']) && $obj['groupMemberId'] > 0){
			         $disabled = "";
			      }
				   $value = (!is_array($value))?array($value):$value;
                  
                  if(in_array($i,$value)){
				    
				     //$disabled = "";

                     if($new_line)

                         $outPut.="<input id='Field".$this->id."' name='Field[".$this->id."][]' ".$disabled." class='inputbox ".$requiredClass."' value='".$i."' checked type='checkbox' id='".$this->name.$i."' />&nbsp;&nbsp;$data&nbsp;&nbsp;<br />";

                     else

                          $outPut.="<input id='Field".$this->id."' name='Field[".$this->id."][]' ".$disabled." class='inputbox ".$requiredClass."' value='".$i."' checked type='checkbox' id='".$this->name.$i."' />&nbsp;&nbsp;$data&nbsp;&nbsp;";

                   }else{

                        if($new_line)

                           $outPut.="<input id='Field".$this->id."' name='Field[".$this->id."][]' ".$disabled." class='inputbox ".$requiredClass."' value='".$i."' type='checkbox' />&nbsp;&nbsp;$data&nbsp;&nbsp;<br />";

                        else

                           $outPut.="<input id='Field".$this->id."' name='Field[".$this->id."][]' ".$disabled." class='inputbox ".$requiredClass."' value='".$i."' type='checkbox'  />&nbsp;&nbsp;$data&nbsp;&nbsp;";

                    }

             }
            if(is_array($this->values)){
				$values = $this->values;
			}else{
				$values = explode("|",$this->values);
			}
			 
             $totalValues=count($values);

			$this->requiredJs ="var success=false;

                                  DTjQuery('input[id=\"Field".$this->id."\"]').each(function(index){

									   if(this.checked){

									      success = true;

										  return false;

									   }

								   }); 

                                   if(DTjQuery('input[id=\"Field".$this->id."\"]').size() > 0 && !success){

                                      alert('{$this->label} ".JText::_('DT_ERROR_FIELD_REQUIRED')."');

                                      return;

                                   }";

  $code = "";
	   global $mainframe;
	  if($this->fee_field && !$mainframe->isAdmin()){
	  
       $code = $html = <<<EOH
<script type="text/javascript">
DTjQuery(function(){
DTjQuery('input[id="Field$this->id"]').live('click',function(){
	 if(DTjQuery(this).attr('checked')){    

                     /*  DTjQuery(this).removeAttr('checked');	*/

                    }else{

                      /* DTjQuery(this).attr('checked',true); */

                    }
	if(DTjQuery.isFunction(updateFee)){
	   	updateFee();
    }
})
DTjQuery('input[id="Field$this->id"]:checked').trigger('click');
})
</script>
EOH;
 }  		 

              return $outPut.$code.'<label for="Field['.$this->id.'][]" style="display:none" generated="true" class="error"></label>

';

	}

	 function viewHtml($obj=null,$event=null,$form='',$overlimitdisable=false){

		 if(!is_array($this->values)){

		    $this->values = explode('|',$this->values);

		 }

		 $selected = array();
         
		 if(!isset($obj['fields'][$this->id])|| $obj['fields'][$this->id] ==  null){

			return false;

		 }

	     if (count($this->values) > 0) {
         foreach($this->values as $key=>$value){

		if(!is_array($obj['fields'][$this->id])){

		   	$obj['fields'][$this->id] = explode("|",$obj['fields'][$this->id]);

		}

		    if(in_array($key,$obj['fields'][$this->id])){

				$selected[] = $value;

		     }	 

		 }
         }
         
	     return implode(", ",$selected); 

   }
   
    function getkeyByValue($value=array()){
      
      if(!is_array($this->values)){
         $this->values = explode("|",$this->values);
      }
	  $temp = array();
      if(!is_array($value)){
          $value = explode("|",$value);
      }
      
	  if (count($value) > 0) {
      foreach($value as $val){
		 if(is_numeric($val)){
			$temp[] = $val; 
		}else{
			$temp[] = array_search($val,$this->values);
		}
	     
	  }
      }
      return $temp;

    }
    
    function getfeeByKey($key){
    
    if(isset($this->fees[$key])){
	   	return $this->fees[$key];
	}else{
	    return "";	
	}

  }
	
}

class Field_Radio extends Field{

	var $label = "";

	var $fieldhtml = "";

	function __construct(){

	   parent::__construct();

	}

	function formhtml($obj=null,$event=null,$form='',$overlimitdisable=false){
   
	   $overlimitdisable = true;   

	   parent::formhtml($obj,$event,$form,$overlimitdisable);

	    //Radio list
        
		$this->optionlimit = $this->getOptionLimit($event->slabId);

	    $this->optionused = $this->optionUsageByEvent($event->slabId);
     
             $dropDownDatas=explode("|",$this->values);

			 $value = isset($obj['fields'][$this->id])?$obj['fields'][$this->id]:$this->selected;

            if(!is_numeric($value)){
			   $value = $this->getkeyByValue($value);	
			}

             $outPut="";

			 $new_line=$this->new_line;
                
             for($i=0,$n=count($dropDownDatas);$i<$n;$i++){

                     $disabled = "";

                 if(isset($this->optionlimit[$i]) && $this->optionlimit[$i]!=0 && $this->optionlimit[$i] <= $this->optionused[$i]){

                    if($overlimitdisable){

					 }else{

					      continue;

					  }

                 }

                 $data=trim($dropDownDatas[$i]);

				 $requiredClass = ($i==0 && $this->required)?'required':'';
				 
                 global $cbviewonly , $cb_integrated , $map_cb_fields;
	 
                 $my = &JFactory::getUser();
                     
                 $disabled = "";
                     
                 if($value != "" &&  $cb_integrated > 0 && $cbviewonly==1 && $my->id && isset($map_cb_fields[$this->id])){
                           
                   $disabled = "disabled='disabled'";
      
                 }
                        
                  if(isset($obj['groupMemberId']) && $obj['groupMemberId'] > 0){
			         $disabled = "";
			      }
                     
                   if(isset($this->optionlimit[$i]) && $this->optionlimit[$i]!=0 && $this->optionlimit[$i] <= $this->optionused[$i]){
                      if($overlimitdisable){
                        
                        $disabled = "disabled='disabled'";         
                        
                     }
                 }
                 
                 if($value !== false && (int)$i === (int)$value ){ 

                      if($new_line) 

                         $outPut.="<input id='Field".$this->id."'  name='Field[".$this->id."]' ".$disabled."  class='inputbox ".$requiredClass."'  value='$i' type='radio' checked id='".$this->name.$i."' />&nbsp;&nbsp;$data&nbsp;&nbsp;<br />";

                      else

                         $outPut.="<input id='Field".$this->id."' name='Field[".$this->id."]' ".$disabled."  class='inputbox ".$requiredClass."' value='$i' type='radio' checked id='".$this->name.$i."' />&nbsp;&nbsp;$data&nbsp;&nbsp;";

                 }else{

                     if($new_line)

                        $outPut.="<input id='Field".$this->id."' name='Field[".$this->id."]' ".$disabled." class='inputbox ".$requiredClass."' value='$i' type='radio'  />&nbsp;&nbsp;$data&nbsp;&nbsp;<br />";

                     else

                        $outPut.="<input id='Field".$this->id."' name='Field[".$this->id."]' ".$disabled." class='inputbox ".$requiredClass."' value='$i' type='radio'  />&nbsp;&nbsp;$data&nbsp;&nbsp;";

                 }

             }

             if(!is_array($this->values)){
			   $values=explode("|",$this->values);
	         }else{
			   $values = $this->values;
			 }

             $totalValues=count($values);

			 $this->requiredJs ="var success=false;

			                       DTjQuery('input[id=\"Field".$this->id."\"]').each(function(index){

									   if(this.checked){

									      success = true;

										  return false;

									   }

								   }); 

                                   

                                   if(DTjQuery('input[id=\"Field".$this->id."\"]').size() > 0 && !success){

                                      alert('{$this->label} ".JText::_('DT_ERROR_FIELD_REQUIRED')."');

                                      return;

                                   }";

  $code = "";
	   global $mainframe;
	  if($this->fee_field && !$mainframe->isAdmin()){
	  
       $code = $html = <<<EOH
<script type="text/javascript">
DTjQuery(function(){
DTjQuery('input[id="Field$this->id"]').live('change',function(){
     
	 /* if(DTjQuery(this).attr('checked')){

                       DTjQuery(this).removeAttr('checked');	

                    }else{

                       DTjQuery(this).attr('checked',true);

                    }*/
     if(DTjQuery.isFunction(updateFee)){
	   	updateFee();
    }
	
})

//DTjQuery('input[id="Field$this->id"]:checked').trigger('change');
})
</script>
EOH;
 }  
			 
             return $outPut.$code.'<label for="Field['.$this->id.']" style="display:none" generated="true" class="error"></label>';

	}

	 function viewHtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	    if(!is_array($this->values)){

		    $this->values = explode('|',$this->values);

		 }

	  
	 if(isset($obj['fields'][$this->id]) && isset($this->values[$obj['fields'][$this->id]])){
        	return $this->values[$obj['fields'][$this->id]] ;
        }else{
        	return '';
        }
	
	  if (isset($this->values[$obj['fields'][$this->id]])) {
			return $this->values[$obj['fields'][$this->id]] ;
      }

   }
    function getkeyByValue($value){
      
      if(!is_array($this->values)){
         $this->values = explode("|",$this->values);
      }
	  if(is_array($value)){
		   $value = array_pop($value);
	  }
      return array_search($value,$this->values);    
  
    }

}

class Field_Date extends Field{

	var $label = "";
	
	var $fieldhtml = "";

	function __construct(){

	   parent::__construct();

	}

	function formhtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	   parent::formhtml($obj,$event,$form,$overlimitdisable);

	    //Date custom fields

		  $document =& JFactory::getDocument();

		  JHTML::_('behavior.calendar');

			 $requiredClass = ($this->required)?'required':'';

			$value = isset($obj['fields'][$this->id])?$obj['fields'][$this->id]:'';

            $format = ($this->date_format !='')?$this->date_format:'%Y-%m-%d';

			$outPut = '<input id="Field'.$this->id.'" class="inputbox '.$requiredClass.'" type="text" name="Field['.$this->id.']"

 size="25" maxlength="25"

value="'.$value.'" />

<input type="button" class="button" value="..."

onclick="return DTshowCalendar(\'Field'.$this->id.'\',\''.$format.'\');" /><label for="Field'.$this->id.'" generated="true" style="display:none;" class="error"></label>';

			$this->requiredJs = "if (typeof(document.frmcart.elements['Field[".$this->id."]']) != 'undefined' && document.frmcart.elements['Field[".$this->id."]'].value == ''){

                                       alert('{$this->label} ".JText::_('DT_ERROR_FIELD_REQUIRED')."');

                                       document.frmcart.elements['Field[".$this->id."]'].focus();

                                       return;

                                    }";

			$this->date_val  = str_replace("-","\-",$this->date_format);

			$this->date_val = str_replace('%d','dd',$this->date_val);

			$this->date_val = str_replace('%m','mm',$this->date_val);

			$this->date_val = str_replace('%Y','yyyy',$this->date_val);						

			$this->javascript_valid_data = "\n if (document.frmcart.elements['Field[".$this->id."]'].value != '' && !document.frmcart.elements['Field[".$this->id."]'].value.match(dateregex{$this->name})){

                                       alert('{$this->label} ".JText::_( 'DT_INVALID_DATE' )." ".$this->date_val."');

                                       document.frmcart.elements['Field[".$this->id."]'].focus();

                                       return;

                                    } \n ";

									ob_start();

			?>

          DTjQuery(function(){

                DTjQuery(document.<?php echo $form; ?>).validate({

                        success: function(label) {

                            label.addClass("success");

                        }

                });

              DTjQuery('#Field<?php echo $this->id ; ?>').rules('add','dateDT');

              DTjQuery('#Field<?php echo $this->id ; ?>').change(function(){

                alert('good');

              })

          })

            <?php

			$js = ob_get_clean();

			$document->addScriptDeclaration($js);

			$this->date_format;

			$this->date_regex  = str_replace(".","\.",$this->date_format);

			$this->date_regex  = str_replace("-","\-",$this->date_regex);

			$this->date_regex = str_replace('%d','[0-3]?[0-9]',$this->date_regex);

			$this->date_regex = str_replace('%m','[01]?[0-9]',$this->date_regex);

			$this->date_regex = str_replace('%Y','[12][90][0-9][0-9]',$this->date_regex);

			///^[0-3]?[0-9]\/[01]?[0-9]\/[12][90][0-9][0-9]$/

			$document =& JFactory::getDocument();

			$document->addScriptDeclaration(" var dateregexField".$this->id."= /^".$this->date_regex."$/ ;" );

			$document->addScript("includes/js/joomla.javascript.js");

			return $outPut;

	}

	 function viewHtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	  return $obj['fields'][$this->id];

   }

}

class Field_Textual extends Field{

	var $label = "";

	var $fieldhtml = "";

	function __construct(){

	   parent::__construct();

	}

	function formhtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	   return '<span id="Field'.$this->id.'">'.stripslashes($this->textual)."</span>";

	}

	function viewHtml(){

	   return stripslashes($this->textual); 

	}

}

class Field_Upload extends Field{

	var $label = "";

	var $fieldhtml = "";

	function __construct(){

	   parent::__construct();

	}

	function formhtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	     parent::formhtml($obj,$event,$form,$overlimitdisable);

	     $name =  $this->name;

		 $requiredClass = ($this->required)?'required':'';

		 $value = isset($obj['fields'][$this->id])?$obj['fields'][$this->id]:'';

		 $this->requiredJs = "if (typeof(document.frmcart.elements['Field[".$this->id."]']) != 'undefined' && document.frmcart.elements['Field[".$this->id."]'].value == ''){

							   alert('{$this->label} ".JText::_('DT_ERROR_FIELD_REQUIRED')."');

							   document.frmcart.elements['Field[".$this->id."]'].focus();

							   return;

							}";	  

		  $document =& JFactory::getDocument();
          
		  ob_start();

		  ?>

          DTjQuery(document).ready(function(){

            DTjQuery('#uploadField<?php echo $this->id; ?>').live('click',function(){

                var frm = this.form;

              /*  var prevtask = DTjQuery('form[name="'+this.form.name+'"] input[name="task"]').val(); */

               /* var prevcontroller = DTjQuery('form[name="'+this.form.name+'"] input[name="controller"]').val(); */

              /*  DTjQuery('form[name="'+this.form.name+'"] input[name="task"]').val("upload"); */

               /* DTjQuery('form[name="'+this.form.name+'"] input[name="controller"]').val("file"); */

                 var options = { 

                type :'POST',

                target : '#debug',

                data : {name:'<?php echo $name ;?>',filetypes<?php echo $name ?>:'<?php echo $this->filetypes ; ?>',filesize<?php echo $name ?>:<?php echo $this->filesize; ?>,field_id:<?php echo $this->id ?>,controller:'file',task:'upload'},

                url:        'index.php?no_html=1', 

               /* iframe : true , */

                dataType : 'script',

                success :function(response){
			
                    var $out = DTjQuery('#debug');
                    if(typeof response =="string"){
                    	eval(response);
                    }
            /* $out.html('Form success handler received: <strong>' + typeof response + '</strong>'); */

            if (typeof response == 'object' && data.nodeType)

                response = elementToString(response.documentElement, true);

            else if (typeof response == 'object')

                response = objToString(response);

                /* $out.append('<div><pre>'+ response +'</pre></div>'); */

                 /* DTjQuery("#debug").html(data.Error); */

                  if(data.Error==""){

                     DTjQuery('#Field<?php echo $this->id;?>').val(data.path);

                     DTjQuery('#filename<?php echo $this->id;?>').html(data.path);

                     DTjQuery('#Field<?php echo $this->id;?>').next().addClass('success');

                     DTjQuery('#Field<?php echo $this->id;?>').next().hide();           

                    DTjQuery('#Field<?php echo $this->id;?>').parent().append("<br />"+data.message);

                   }else{

                     alert(data.Error);

                   }

                  /* DTjQuery('form[name="'+frm.name+'"] input[name="task"]').val(prevtask); */

                

                  /* DTjQuery('form[name="'+frm.name+'"] input[name="controller"]').val(prevcontroller); */

                   DTjQuery(frm).validate().element('#Field<?php echo $this->id;?>' );

                }

               }; 

               DTjQuery(frm).ajaxSubmit(options);

               return false;

            });

         });

          <?php

		  $uploadJs = ob_get_clean();

		  /// $document->addScriptDeclaration($uploadJs );

		   return "<input id='FileField".$this->id."' class='inputbox' name='file_$name' value='' type='file' /> <button id='uploadField".$this->id."'>".JText::_( 'DT_UPLOAD' )."</button><input type='hidden' class='".$requiredClass."' name='Field[".$this->id."]' id='Field".$this->id."' value='".$value."' />&nbsp;<span id='filename".$this->id."'>".$value.'</span><label for="Field'.$this->id.'" style="display:none" generated="true" class="error"></label><script> '.$uploadJs.' </script>';

	}

	 function viewHtml($obj=null,$event=null,$form='',$overlimitdisable=false){
	
      if(isset($obj['fields'][$this->id])){
	    return $obj['fields'][$this->id];
	  }else{
		 return "";  
		}  

   }

}

class Field_Email extends Field{

	var $label = "";

	var $fieldhtml = "";

	function __construct(){

	   parent::__construct();

	}

	function formhtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	   global $amp, $xhtml;
       
	   parent::formhtml($obj,$event,$form,$overlimitdisable);

	   $fieldType =  DtrModel::getInstance('Fieldtype','DtregisterModel');

	   $fieldTypes =  $fieldType->getTypes();

	   require_once(JPATH_SITE."/components/com_dtregister/views/field/view.html.php");

	   $fieldView = new DtregisterViewField(array());

	   if (count($fieldView->_path['template']) > 0) {
	   foreach($fieldView->_path['template'] as $path){

	      if(file_exists($path)){

		     $basepath = $path;

			 break;

		  }

	   }
	   }

	   $file = $basepath."default.php";
        $this->requiredHtml = "";
	    if($this->required){

		    $this->label = $this->label." <span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span> ";
            $this->requiredHtml = "<span class='dtrequired'>&nbsp;&nbsp;*&nbsp;&nbsp;</span>" ;
			$this->required = true;

		  }

	   $requiredClass = ($this->required)?'required':''; 

	   $tpl = file_get_contents($file);

	   $constants = array('[label]','[value]','[description]');

	   $description =  (trim($this->description)!="")?JDTHTML::tooltip($this->description, '', 'tooltip.png', '', ''):'';

	   $value = isset($obj['fields'][$this->id])?$obj['fields'][$this->id]:'';

	   $maxlength = ($this->maxlength !=0 && $this->maxlength !="" )?"maxlength='".$this->maxlength."'":'';

	   $requiredClass = ($this->required)?'required email':'email';
	   $readonly = "";
        global $cbviewonly , $cb_integrated , $map_cb_fields;
	   $my = &JFactory::getUser();
	   if($value != "" &&  $cb_integrated > 0 && $cbviewonly==1 && $my->id && isset($map_cb_fields[$this->id])){
		   $readonly = "readonly='readonly'";
	  
	   }
	    if(isset($obj['groupMemberId']) && $obj['groupMemberId'] > 0){
			         $readonly = "";
			      }
	   
       $fieldhtml = "<input type='text' id='Field".$this->id."' class='inputbox ".$requiredClass."' ".$readonly." size='$this->field_size' $maxlength name='Field[".$this->id."]' value='$value' />";

	   $replace = array($this->label,$fieldhtml,$description);

	   $html = "";

	   $html .= str_replace($constants,$replace,$tpl);

	   $replace  = array(JText::_("DT_CONFIRM_EMAIL").$this->requiredHtml,"<input type='text' id='ConfirmField".$this->id."' class='inputbox ".$requiredClass."' size='$this->field_size' $maxlength name='ConfirmField[".$this->id."]' value='' />",'');
       global $mainframe;
	   $this->emailConfirmation =  false;
		if(!$mainframe->isAdmin() && $this->confirmation_field){
	     $html .= str_replace($constants,$replace,$tpl);
		 $this->emailConfirmation =  true;
		}

	   // confirmemail

	       $document = &JFactory::getDocument();

	   		ob_start();
           $dup_check = "";
		   if(isset($this->duplicate_check) && !$this->duplicate_check ){
			  $dup_check = "&dup_check=true";
		    }
			?>

          DTjQuery(function(){

                DTjQuery(document.<?php echo $form; ?>).validate({

                        success: function(label) {

                            label.addClass("success");

                        }

                });
              
             DTjQuery('#Field<?php echo $this->id ; ?>').rules('add',{remote: "<?php echo JRoute::_('index.php?option=com_dtregister&controller=validate&task=email&no_html=1&eventId='.$event->slabId.$dup_check ,$xhtml); ?>" }); 
      <?php if($this->emailConfirmation && $form !='adminForm') { ?>
              DTjQuery('#ConfirmField<?php echo $this->id ; ?>').rules('add',{equalTo: "#Field<?php echo $this->id ; ?>"
     
});

             <?php } ?>  

          })

            <?php

			$js = ob_get_clean();

			$document->addScriptDeclaration($js);

	      return $html;

	}

	 function viewHtml($obj=null,$event=null,$form='',$overlimitdisable=false){

	   require_once(JPATH_SITE."/components/com_dtregister/views/field/view.html.php");

	   $fieldView = new DtregisterViewField(array());

	   if($obj['fields'][$this->id] == "" ){

	      return false;

	   }

	   if (count($fieldView->_path['template']) > 0) {
	   foreach($fieldView->_path['template'] as $path){

	      if(file_exists($path)){

		     $basepath = $path;

			 break;

		  }

	   }
	   }

	   $file = $basepath."default.php";

	    $tpl = file_get_contents($file);

	   $constants = array('[label]','[value]','[description]');

	   $replace = array($this->label,$obj['fields'][$this->id],'');

	   $html = str_replace($constants,$replace,$tpl);

	   return $html;

   }

   function exportView($obj=null,$event=null,$form='',$overlimitdisable=false){
	       return $obj['fields'][$this->id];
   }

}

?>