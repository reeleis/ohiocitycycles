<?php

/**
* @version 2.7.7
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

class cryptastic {

	/** Encryption Procedure
	 *
	 *	@param   mixed    msg      message/data
	 *	@param   string   k        encryption key
	 *	@param   boolean  base64   base64 encode result
	 *
	 *	@return  string   iv+ciphertext+mac or
	 *           boolean  false on error
	*/
	public function encrypt( $msg, $k, $base64 = true ) {

		# open cipher module (do not change cipher/mode)
		if ( ! $td = mcrypt_module_open('rijndael-256', '', 'ctr', '') )
			return false;

		$msg = serialize($msg);							# serialize
		$iv  = mcrypt_create_iv(32, MCRYPT_RAND);		# create iv

		if ( mcrypt_generic_init($td, $k, $iv) !== 0 )	# initialize buffers
			return false;

		$msg  = mcrypt_generic($td, $msg);				# encrypt
		$msg  = $iv . $msg;								# prepend iv
		$mac  = $this->pbkdf2($msg, $k, 1000, 32);		# create mac
		$msg .= $mac;									# append mac

		mcrypt_generic_deinit($td);						# clear buffers
		mcrypt_module_close($td);						# close cipher module

		if ( $base64 ) $msg = base64_encode($msg);		# base64 encode?

		return $msg;									# return iv+ciphertext+mac
	}

	/** Decryption Procedure
	 *
	 *	@param   string   msg      output from encrypt()
	 *	@param   string   k        encryption key
	 *	@param   boolean  base64   base64 decode msg
	 *
	 *	@return  string   original message/data or
	 *           boolean  false on error
	*/
	public function decrypt( $msg, $k, $base64 = true ) {

		if ( $base64 ) $msg = base64_decode($msg);			# base64 decode?

		# open cipher module (do not change cipher/mode)
		if ( ! $td = mcrypt_module_open('rijndael-256', '', 'ctr', '') )
			return false;

		$iv  = substr($msg, 0, 32);							# extract iv
		$mo  = strlen($msg) - 32;							# mac offset
		$em  = substr($msg, $mo);							# extract mac
		$msg = substr($msg, 32, strlen($msg)-64);			# extract ciphertext
		$mac = $this->pbkdf2($iv . $msg, $k, 1000, 32);		# create mac

		if ( $em !== $mac )									# authenticate mac
			return false;

		if ( mcrypt_generic_init($td, $k, $iv) !== 0 )		# initialize buffers
			return false;

		$msg = mdecrypt_generic($td, $msg);					# decrypt
		$msg = unserialize($msg);							# unserialize

		mcrypt_generic_deinit($td);							# clear buffers
		mcrypt_module_close($td);							# close cipher module

		return $msg;										# return original msg
	}

	/** PBKDF2 Implementation (as described in RFC 2898);
	 *
	 *	@param   string  p   password
	 *	@param   string  s   salt
	 *	@param   int     c   iteration count (use 1000 or higher)
	 *	@param   int     kl  derived key length
	 *	@param   string  a   hash algorithm
	 *
	 *	@return  string  derived key
	*/
	public function pbkdf2( $p, $s, $c, $kl, $a = 'sha256' ) {

		$hl = strlen(hash($a, null, true));	# Hash length
		$kb = ceil($kl / $hl);				# Key blocks to compute
		$dk = '';							# Derived key

		# Create key
		for ( $block = 1; $block <= $kb; $block ++ ) {

			# Initial hash for this block
			$ib = $b = hash_hmac($a, $s . pack('N', $block), $p, true);

			# Perform block iterations
			for ( $i = 1; $i < $c; $i ++ ) 

				# XOR each iterate
				$ib ^= ($b = hash_hmac($a, $b, $p, true));

			$dk .= $ib; # Append iterated block
		}

		# Return derived key of correct length
		return substr($dk, 0, $kl);
	}
}
class DtregisterModelCard extends DtrModel { 

	function __construct($config = array()){

       parent::__construct($config);
 
	   $this->table = new TableCard($this->getDBO());
	
	 }
	
}

class TableCard extends DtrTable{
	
	var $id=null;

    var $status=null;

    var $x_card_num=null;

    var $firstname=null;

    var $lastname=null;

    var $address;

    var $city;

    var $state;

    var $country;
	var $phone;
	
	var $cardtype;
	
	var $x_exp_date;
	var $userId;
	
	var $zipcode;
	
	function __construct( &$db = null ) {

		$db = &JFactory::getDBO();

		$this->db =&$db;
		
		parent::__construct( '#__dtregister_cards', 'id', $db );
	  }
     function removeByuser($id){

	   $query = "delete from ".$this->getTableName()." where userId = ".$this->_db->Quote($id)." ";

	   $this->_db->setQuery($query);

	   $this->_db->query();
      
    }
    function removeByUserId($id){
	  
	  $this->removeByuser($id);  
    }
	   function findByUserId($user_id=0,$decrypt = true){
    
		 $data = $this->find(' userId ='.$user_id);
		 
		 if(!isset($data[0])){
			return false;   
		 }
		 $data = $data[0];
  
		 $fee = new stdClass;
		
		
		 if($data) {
  
		 	foreach($data as $key => $field){
  
			 $this->$key = $field;
  
			 $fee->$key = $field;
  
		 	}
			$cryptastic = new cryptastic;
		  
		   if(isset($this->x_card_num) && $this->x_card_num != "" && strlen($this->x_card_num) !="16" && $decrypt ) {
			  $this->x_card_num = $cryptastic->decrypt($this->x_card_num , $this->firstname );//or   die("Failed to complete decryption");
			  $fee->x_card_num = $this->x_card_num;
		   }
		   
		 }
		 
		 return $fee;

   }
	  
	  function save($data){
  		
		if(isset($data['userId'])){
		  $row = $this->findByUserId($data['userId'],false);
		  if($row){
			$data['id'] = $row->id;
		  }
		}
		$cryptastic = new cryptastic;
	   
	   $data['x_card_num'] = $cryptastic->encrypt($data['x_card_num'], $data['firstname']);// or   die("Failed to complete encryption.");
       
		parent::save($data);
		
  }
	
}
?>