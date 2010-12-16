<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.database.table' );
JTable::getInstance( 'user', 'JTable');
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.DTR_COM_COMPONENT.DS.'models');
global $tableInstances ;
global $queryResults ;
global $memcache;
//$memcache = new Memcache;
//$memcache->connect('localhost', '11211');
class DtrTable extends JTable{
    
	
	
    function __construct($table,$id,&$db){
       parent::__construct($table,$id,$db);
	}
	 
	function getObjData(){
	   
	   $temp = clone $this ;
	   
	   unset($temp->db);
	   unset($temp->_db);
	   
	   return (object)(array)$temp ;
	   
	} 
	 
	function load($id){
	   global $tableInstances , $memcache ;
	   $signature =  get_class($this).$id ;
	   
	   
	  if(0){
	 //if(isset($tableInstances[$signature])){
	  // $data = $memcache->get($signature) ;
	//   if($data !== false){ die ; var_dump($data);
		    $vars  = get_object_vars($tableInstances[$signature]);
		//	 $vars  = get_object_vars($data);
			 foreach($vars as $key=>$value){
			    	 $this->$key = $value ;
			 }
	     
	   }else{
	      parent::load($id);
		  
		 // $memcache->set(md5($signature),$this,true,600);

		  $tableInstances[$signature] = $this ;
	   }
	   	
	}
	function &getInstance( $type, $prefix = 'JTable', $config = array() ){
	   	
		return parent::getInstance($type,$prefix,$config );
		
	}
	
	function rawquery($query){
	   	 $this->_db->setQuery($query);
		 return $this->_db->query();
	}
	function query($query ,$limitstart=0,$limit=20){
	 
	   $this->_db->setQuery($query,$limitstart,$limit);
	    //pr($this->_db->getQuery());
	   
	   $data = $this->_db->loadObjectList();
	  
	   return $data;
	   
	   	
	}
	function getLastCount(){
       
	   $this->_db->setQuery('SELECT FOUND_ROWS();');
	   return    $this->_db->loadResult() ;
	   
     }
     function find($condition = " 1=1 ",$ordering="",$limitstart=0,$limit=0){
		     global $queryResults ;
			     $where  = "";
				  if($condition != "1=1" && $condition != ""){

							 $where = " where ".$condition ;
				
				   }
			  $ordering =    ($ordering !=="")?' order by '.$ordering:'';
			  $sql_count = "";
            if($limit != 0 && $limit != ""){
			    $sql_count = " SQL_CALC_FOUND_ROWS "; 
			}
			  $sql = "select ".$sql_count." * from ".$this->getTableName()." ".$where ." ".$ordering ;
			 
               if($limit != 0 && $limit != ""){
			      $this->_db->setQuery($sql,$limitstart,$limit);
			   }else{
			      $this->_db->setQuery($sql,$limitstart,$limit);
			   }
			   
		  // pr($this->_db->getQuery());
			 //  $this->_db->query();
			
			if(isset($queryResults[str_replace(" ","",$this->_db->getQuery())])){
				$data = $queryResults[str_replace(" ","",$this->_db->getQuery())] ;
		    }else{
               $data = $this->_db->loadObjectList(); 
			   $queryResults[str_replace(" ","",$this->_db->getQuery())] = $data ;
			}
				
			
	  //  pr($this->_db->getErrorMsg());
				
			   return  $data ;

	  }
	  
	 function save_field($field,$value){
	  
	  $query = "update ". $this->getTableName()." set ".$field." = ".$value." where ".$this->_tbl_key." = ".$this->{$this->_tbl_key} ;
	  
	   $this->_db->setQuery($query);
	   $this->_db->query();
    }
	  
	  function optionslist($condition = " 1=1 ",$ordering=""){
	     $data = $this->find($condition,$ordering);
		 
		 $list =  array();
		 if(isset($this->displayField)){
		    $name = $this->displayField ;
		 }else{
		    $name = 'name';
		 }
		 if($data)
		 foreach($data as $value){ 
		    
			$list[$value->{$this->_tbl_key}] = stripslashes($value->$name );
			
		 }
		 //pr($list);
		 return $list ;
	  }
	
	 function saveAll($data){
         if(is_array($data))
		 foreach($data as $row){
		     
			 $this->save($row);
			 $this->{$this->_tbl_key} = "";
		 }
		 
     }
	 
	function renamefield($oldname="",$newname=""){
	   	
		$query = "SHOW COLUMNS FROM ". $this->getTableName()." WHERE field = '$oldname' ";
		$this->_db->setQuery($query);
		$fieldDesc = $this->_db->loadObject(); 
	
         $null = array('NO'=>'NOT NULL','YES'=>'NULL',''=>'');
		
		if($fieldDesc){
		$query = "alter table ". $this->getTableName()." change $oldname $newname ". $fieldDesc->Type." ".$null[$fieldDesc->Null]." DEFAULT  '".$fieldDesc->Default."'" ;
		$this->_db->setQuery($query);
		//echo $this->_db->getQuery();
		$this->_db->query();
		}
		
	}
	 
	 function save($data){
	   unset($this->displayField);
	   parent::save($data);
	 }
	 function store(){
	    unset($this->displayField);
	    parent::store();
	 }
	 function getNumRows(){
	    
	 }
	 function truncate(){
	    
		$sql="TRUNCATE TABLE `".$this->getTableName()."`  ";
	
		$this->_db->setQuery($sql);
	
		$this->_db->query();
		
	 }
	
}
?>