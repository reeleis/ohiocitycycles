<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class DtregisterModelConfig extends DtrModel {

	var $table;

	var $config_array_type =  array(

	                             'paymentmethod',

								 'cardtype',

								 'pay_later_options',

								 'cardtype' ,
								 'eventModifyNotification'

	                           );

	var $config_array_map = array('map_cb_fields','map_jomsocial_fields');

    function __construct($config = array()){

	   $config['name'] = 'config';

       parent::__construct($config);

	   $this->table =  new DtrTable('#__dtregister_config','id',$this->getDBO());
	   
	   $this->TablePayoption  =& DtrTable::getInstance('payoption','Table');

	  $this->db = $this->getDBO();

	 }

     function getGlobal($key,$default=""){

		 $str = " global \$".$key.";";

		 eval($str);

		 if(!isset($$key) || $$key==""){

		    return $default;

		 }

		 return $$key;

	}

	function joomfish_fix(){
	      $query = " SELECT * 
		 	FROM `#__dtregister_config`
		 	WHERE config_key
		 	IN (
			'DT_fromname',
		 	'thanksmsg',
		'pay_later_thk_msg',
		'thanksemail',
		'full_message',
		'cut_off_date_message',
		'waiting_msg',
		'terms_conditions_msg',
		'private_event_msg',
		'prerequisite_event_msg',
		'overlap_event_msg',
		'subthanksemail',
		'admin_registrationemail',
		'subject_admin_registrationemail',
		'registrant_message',
		'userpanelmessage',
		'subthanksemail',
		'email_cancel_confirm' ,
		'email_change_confirm',
		'payment_confirm',
		'status_change_msg',
		'subchangestatusemail',
		'paid_status_change_msg',
		'subpaidstatusemail',
		'registrant_message',
		'upsubpaymentemail',
		'upsubcancelemail',
		'upsubchangeemail'
		 	)";
		 	
		 $this->db->setQuery($query);
		 
		 $configs = $this->db->loadObjectList();
		 $keys = array();
		
		 if (count($configs) > 0) {
			 foreach($configs as $config){
				$query = "select jf1.* from `#__jf_content` jf1 inner join `#__jf_content` jf2 on jf1.reference_id = jf2.reference_id and jf2.value='".$config->config_key."'   where jf1.reference_table='dtregister_config' and  jf2.reference_table='dtregister_config' ";
				$keys[$config->config_key] = $config->id;
				$this->db->setQuery($query);
				$this->db->getQuery($query);
				$jfrows = $this->db->loadObjectList();
				if($jfrows){
					foreach($jfrows as $jfrow){
						 $query = "Update #__jf_content set reference_id=".$config->id." where id =  ".$jfrow->id;
						 $this->db->setQuery($query);
						 $this->db->getQuery($query);
						 if($config->id != $jfrow->reference_id)
						 if(!$this->db->query()){
							echo $this->db->getErrorMsg();
						}
					}
				}
			 }
		 }
	  }

	 function updateEventorder($order=0){

		 if($order==1){

		   $ordering = " a.dtstart desc , a.dtstarttime desc ";

		}else if($order==2){

		   $ordering = " a.dtstart asc  , a.dtstarttime asc  ";

		}elseif($order==3){

			 $ordering = " a.title asc  ";

		}else{

		   return;

		   $ordering = " a.ordering ASC ";

		}

		$sql ="SELECT a. *

		FROM #__dtregister_group_event as  a

        LEFT JOIN #__dtregister_categories as c ON a.category = c.categoryId 
	
        where a.parent_id = 0

		";

        $sql .= " order by c.ordering ,$ordering ";

		$this->db->setQuery($sql);

		$events = $this->db->loadObjectList();

		pr($events);

		$category = 0;

		$ordering = 1;

		$evt =& JTable::getInstance('event', 'Table');

		if(is_array($events))

		foreach($events as $event){

		   if($event->category != $category){

		      $ordering = 1;

			  $category = $event->category;

		   }
           
           $evt->slabId = $event->slabId;
		   $evt->save_field('ordering',$ordering);

           $ordering ++ ;

		}

	  }

	function setConfig($key,$value){
	     
		 $sql = "Update #__dtregister_config set config_value=$value  where config_key='$key'";
	  
	     $this->db->setQuery($sql);
		
		 return $this->db->query();
	  }

    function setGlobal(){

	  global $DT_config;

	  $rowConfigs=$this->table->find();

      $payment = $this->TablePayoption->find('`default` = "1"');
	  
	  if($payment){
		  $payment = $payment[0];
		  $this->TablePayoption->load($payment->id);
		  $paymentconfigs = $this->TablePayoption->getConfig();
		  
		  if (count($paymentconfigs) > 0) {
			  foreach($paymentconfigs as $key => $value){
				 $obj = new stdClass();
				 $obj->config_key = $key;
				 $obj->config_value = $value;
				 $rowConfigs[] = $obj;
					  
			  }
	  	  }
	  }
	  
	  for($i=0,$n=count($rowConfigs);$i<$n;$i++){

		$rowConfig=$rowConfigs[$i];

		$name=$rowConfig->config_key;

		$value=$rowConfig->config_value;

        $str = " global \$".$name.";";

		 eval($str);

        if(in_array($name,$this->config_array_type)){

		   $temp =  array();
            if(!is_array($value)){
			  $value = explode(",",$value);   
			}else{
				
		    }
		    if (count($value) > 0) {
				foreach($value as $val){
	
					$temp[$val] = $val;
	
				}
			}

		    $value = $temp;

		}

		if(in_array($name,$this->config_array_map)){
            
		   	$value = json_decode($value,true);
			if(is_array($value)){
              $value = array_flip($value);
			}else{
			   $value =  array();;	
			}  			
 
		}

        if(!isset($$name) && $$name==""){

		  $$name=$value;

		  // if($name=="map_cb_fields") 

		    // prd($value);

		}

		$DT_config['global'][$name] = $value;

	}

  }

}

?>