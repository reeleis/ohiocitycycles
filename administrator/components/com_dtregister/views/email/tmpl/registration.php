<table>
  <tr><td><?php echo JText::_('DT_EVENT_NAME') ?>: </td><td>[EVENT_NAME]</td></tr>
  <tr><td><?php echo JText::_('DT_EVENT_NAME') ?>: </td><td>[EVENT_DATE]</td></tr>
  
 <?php
   if((int)$this->User->user_id >0){
?>
	       <tr><td><?php JText::_( 'DT_USERNAME' ) ?>:</td><td>[USERNAME]</td></tr>

<?php   
   }
 ?>
</table>
<?php
	$adminmsg.="<table>";

		$adminmsg.="<tr><td>".JText::_('DT_EVENT_NAME').": </td><td>".$eventName."</td></tr>";

		$adminmsg.="<tr><td>".JText::_('DT_EVENT_DATE').": </td><td>".$event_date."</td></tr>";

		$adminmsg.="<tr><td>".JText::_('DT_ADMIN_REGISTRANT_NAME').": </td><td>$title $fname $lname</td></tr>";
		
		if($org != NULL){$adminmsg.="<tr><td>".JText::_('DT_ORGANIZATION').": </td><td> $org</td></tr>";}

        $address2_display = "";
	   $comma = "";
	   if($address2!=""){
		  $address2_display = $address2."<br />";
		  $comma = ",";
		  
	   }
   
		if(($address) != NULL){$adminmsg.="<tr><td>".JText::_('DT_ADDRESS').": </td><td> $address </td></tr>";}
		
		if(($address2) != NULL){$adminmsg.="<tr><td>".JText::_('DT_ADDRESS2').": </td><td> $address2</td></tr>";}

		if($city != NULL){

			if($state != NULL){

				$adminmsg.="<tr><td>".JText::_('DT_CITY_STATE').": </td><td> $city ($state, $country)</td></tr>";

			} else {

				$adminmsg.="<tr><td>".JText::_('DT_CITY')." (".JText::_('DT_COUNTRY')."): </td><td> $city ( $country)</td></tr>";

			}

		}

		if($zip != NULL){$adminmsg.="<tr><td>".JText::_('DT_ZIPCODE').": </td><td> $zip</td></tr>";}

		if($phone != NULL){$adminmsg.="<tr><td>".JText::_('DT_PHONE').": </td><td> $phone</td></tr>";}

		$adminmsg.="<tr><td>".JText::_('DT_EMAIL').": </td><td> $email</td></tr>";
       if((int)$dt_user->user_id >0){
	       $adminmsg .= '<tr><td>'.JText::_( 'DT_USERNAME' ).':</td><td>'.stripslashes($dt_user->username).'</td></tr>';
	   
       }
		$contactCustomFields = '';

		if ($arrCustomFields){

			foreach ($arrCustomFields as $key => $value){

				if($rowUser->$key==""){

					continue;

				}
				
				if($cfields[$key]->type == 7){
				   
				   $rowUser->$key =  JFile::getName($rowUser->$key);
				}

				$adminmsg .= "<tr><td>".$value.':</td><td>'.$rowUser->$key.'</td></tr>';

				$contactCustomFields .= $value.': '.$rowUser->$key.'<br />';

			}

		}

		 $adminmsg.="<tr><td>".JText::_('DT_REGISTRATION_FEE').": </td><td>".numberFormat($amount,2)."</td></tr>";

         $adminmsg.="<tr><td>".JText::_('DT_AMOUNT_PAID').": </td><td>".numberFormat($rowUser->paid_amount,2)."</td></tr>";
         
		 $adminmsg.="<tr><td>".JText::_('DT_PAYMENT_TYPE').": </td><td>".$lang_var[$rowUser->payment_type]."</td></tr>";
		 
		 if($rowUser->transaction_id != ""){
		     
			 $adminmsg.="<tr><td>".JText::_('DT_TRANSACTION_ID').": </td><td>".$rowUser->transaction_id."</td></tr>";
			 
		 }

		 $adminmsg.="<tr><td>".JText::_('DT_CONFIRMATION_NUMBER').": </td><td>".$rowUser->confirmNum."</td></tr>";

        if($rowUser->discount_code_id != 0 && $rowUser->discount_code_id !=''){

			$dt_code = new DiscountCode($rowUser->discount_code_id);

			$adminmsg.="<tr><td>".JText::_('DT_DISCOUNT_CODE').": </td><td>".$dt_code->code."</td></tr>";

	    }

		if ($userType == 'G'){
             $fields=array() ;
	
	        $fld->getAllFields($eventId,'M',false,0,$fields) ;
			$arrCustomFields =  array();
			foreach($fields as $field){
			   $arrCustomFields[$field->name] = $field->label ;
			}
			$adminmsg.="<tr><td colspan=2>".JText::_('DT_ADMIN_GROUP_DETAILS').": </td></tr>";

			// get the details of the group users

			$sql2 = "SELECT m.* FROM #__dtregister_group_member m, #__dtregister_group g

					WHERE g.useid={$userId} AND g.groupId=m.groupUserId order by m.groupMemberId ";

			//$adminmsg.=$sql2;

			$database->setQuery($sql2);

			$rowUser2=$database->loadObjectList();

			//$memtot = count($rowUser);

			$adminmsg.="<tr><td>".JText::_('DT_NUMBER_MEMBERS').":</td><td>".count($rowUser2)."</td></tr>";

			$groupCustomFields = '';

			for ($i=0,$n=count($rowUser2);$i<$n;$i++){

				$row=$rowUser2[$i];

				$adminmsg.="<tr><td colspan=2><br><br>".JText::_('DT_MEMBER') .($i+1)."</td></tr>";

				if ($row->lastname){

                   if($row->title !=""){
				    $mtitle = $row->title." ";
				 }

				$adminmsg.="<tr><td>".JText::_('DT_NAME').": </td><td>".$mtitle.$row->firstname . ' ' .$row->lastname."</td></tr>";
                    
				$memberNames .= ' ' . stripslashes($mtitle.$row->firstname);

				$memberNames .= ' ' . stripslashes($row->lastname)."<br>";

				}

				if ($row->organization){$adminmsg.="<tr><td>".JText::_('DT_ORGANIZATION').": </td><td>". $row->organization."</td></tr>";}

					if (($row->address.$row->address2)!=""){$adminmsg.="<tr><td>".JText::_('DT_ADDRESS').": </td><td>".$row->address."  ".$row->address2."</td></tr>";}

				if ($row->city || $row->state || $row->country){

					$adminmsg.="<tr><td>";

						if ($row->city){$adminmsg.=JText::_('DT_CITY');}

						if ($row->state || $row->country){$adminmsg.=' ('.JText::_('DT_STATE');}

						if ($row->state && $row->country){$adminmsg.=', ';}

						if ($row->country){$adminmsg.=JText::_('DT_COUNTRY');}

						if ($row->state || $row->country){$adminmsg.=')';}

						$adminmsg.=": </td><td>";

						if ($row->city){$adminmsg.=$row->city;}

						if ($row->state || $row->country){$adminmsg.=' ('.$row->state;}

						if ($row->state && $row->country){$adminmsg.=', ';}

						if ($row->country){$adminmsg.=$row->country;}

						if ($row->state || $row->country){$adminmsg.=')';}

						$adminmsg.="</td></tr>";

				}

				if ($row->zip){$adminmsg.="<tr><td>".JText::_('DT_ZIPCODE').": </td><td>".$row->zip."</td></tr>";}

				if ($row->phone){$adminmsg.="<tr><td>".JText::_('DT_PHONE').": </td><td>".$row->phone."</td></tr>";}

				if ($row->email){$adminmsg.="<tr><td>".JText::_('DT_EMAIL').": </td><td>".$row->email."</td></tr>";}
                 $groupCustomFields .= JText::_('DT_MEMBER') .($i+1).': '.$mtitle.$row->firstname . ' ' .$row->lastname.'<br />';
				if ($arrCustomFields){

					foreach ($arrCustomFields as $key => $value){

						if($row->$key ==""){

							continue;

						}
                        if($cfields[$key]->type==7){
				   if($cfields[$key]->upload){
				      $admin_attachments[] =  addslashes(JPATH_SITE . DS . "images" . DS ."dtregister".DS."uploads".DS.$row->$key);

				   }
				}
				
						if ($row->$key){

                              if($cfields[$key]->type == 7){
				   
							   $rowUser->$key =  JFile::getName($rowUser->$key);
							}

							$adminmsg .= "<tr><td>".$value.':</td><td>'.$row->$key.'</td></tr>';

							 $groupCustomFields .= $value.': '.$row->$key.'<br />';

						}

					}
					
					$groupCustomFields .= "<br /><br />";

				}

			}

		}else{
		   
		   	

				$memberNames = "$title $fname $lname <br>";	
		}


        if(isset($rowUser->billing_name) && $rowUser->billing_name!=""){

			$adminmsg.="<tr><td>".JText::_('DT_BILLING_NAME').": </td><td>".$rowUser->billing_name."</td></tr>";

			$adminmsg.="<tr><td>".JText::_('DT_BILLING_ADDRESS').": </td><td>".$rowUser->billing_address."</td></tr>";

			$adminmsg.="<tr><td>".JText::_('DT_BILLING_CITY').": </td><td>".$rowUser->billing_city."</td></tr>";

			$adminmsg.="<tr><td>".JText::_('DT_BILLING_STATE').": </td><td>".$rowUser->billing_state."</td></tr>";

			$adminmsg.="<tr><td>".JText::_('DT_BILLING_ZIPCODE').": </td><td>".$rowUser->billing_zipcode."</td></tr>";

		}
global $barCodeImagetypeToExt , $barcode_image_type ;
  $barcodePath =JURI::root( false )."images/dtregister/barcode/".$rowUser->confirmNum.".".$barCodeImagetypeToExt[$barcode_image_type];
  $barcodeImg = '<img border="0" src="'.$barcodePath.'" />';
  if($barcode_enable){
     $adminmsg.="<tr><td>".JText::_('DT_BARCODE').": </td><td>".$barcodeImg."</td></tr>";
  }
		$adminmsg.="</table></pre>";

?>