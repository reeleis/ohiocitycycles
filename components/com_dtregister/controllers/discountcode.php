<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
class DtregisterControllerDiscountcode extends DtrController {
   
   var $name ='discountcode';
	
	function __construct($config = array()){
		$config = array('default_task'=>'discountcode','task_map'=>array('new'=>'add'));
		 parent::__construct($config);
		 $this->view = & $this->getView( 'discountcode', 'html' );
		 $this->view->setModel($this->getModel('discountcode'),true);
		 //$this->registerTask( 'new',  'add' );
		 //$this->registerDefaultTask("discountcode");
		 JToolBarHelper::title(  JText::_( 'DT_DISCOUNT_CODE_MANAGEMENT'), 'dtregister' );

	}
	
	function publish(){
	   $this->status(1);
	}
	
	function unpublish(){
	  $this->status(0);
	}
	
	function status($publish){
	   global $mainframe ,$Itemid;

	$dt_code =   $this->getModel('discountcode')->table; 
	$dt_code->load($_REQUEST['cid'][0]);
	
	$dt_code->publish = $publish;

	$dt_code->store();

	$url = "index.php?option=com_dtregister&controller=discountcode&Itemid=$Itemid";

	$mainframe->redirect($url,JText::_( 'DT_DISCOUNT_CODE_UPDATED'));
	   
	}
	
	function cancel(){
	   global $mainframe ,$Itemid;	
	   
	   $mainframe->redirect("index.php?option=com_dtregister&controller=discountcode&Itemid=$Itemid");
	}
	
	function discountcode(){
	    
		JToolBarHelper::divider();
        JToolBarHelper::deleteList('Delete disount code','delete');
        JToolBarHelper::addNew('new',JText::_( 'DT_NEW_DISCOUNT_CODE'));
		$this->view->setLayout('list');
	    $this->view->display();
		
	}
	
	function add(){
	    JToolBarHelper::cancel('cancel');
        JToolBarHelper::save('save');
		$this->view->setLayout('add');
	   $this->view->display();
	  
	}
	
	function delete(){
	     $dt_code = $this->getModel('discountcode')->table;
		 global $mainframe ,$Itemid;

		if (is_array($_REQUEST['cid'])) 
		foreach($_REQUEST['cid'] as $value){
	
			$dt_code->delete($value);
	
		}
	
		$url = "index.php?option=com_dtregister&task=discountcode&controller=discountcode&Itemid=$Itemid";

		$mainframe->redirect($url,JText::_( 'DT_DISCOUNT_CODE_DELETED'));
		}
	
	function edit(){
	   
	   JToolBarHelper::cancel('cancel');
       JToolBarHelper::save('save');
	   $this->view->setLayout('edit');
	   $this->view->display();
	}
	
	function save(){
	   ob_clean();
	   global $mainframe , $Itemid; 
	   $discount_code = $this->getModel('discountcode')->table;
       if($_REQUEST['name']!=''){

		if(!$discount_code->check_space($_REQUEST['name'])){

			?>

            var form=document.adminForm;

			var fieldName=form.name;

            var re = new RegExp("[ ]", "g");

			fieldName.value= fieldName.value.replace(re,"_");

		  alert("<?php echo $discount_code->error ;?>");

			<?php

			exit;

		}

	}
	if(!$discount_code->validate_name($_REQUEST['name'])){

		?>

		  alert("<?php echo $discount_code->error ;?>");

		<?php

		exit;

	}
	if(isset($_REQUEST['id'])){

		$discount_code->id = $_REQUEST['id'];

		if(!$discount_code->validate_code($_REQUEST['code'])){

			$url = "index.php?option=com_dtregister&task=new_discount_code&Itemid=$Itemid";

			?>

			 alert('<?php echo JText::_('DT_ALERT_CODE_EXISTS') ?>');

            <?php

			exit;

		}

	}else{

		if(!$discount_code->validate_code($_REQUEST['code'])){

			$url = "index.php?option=com_dtregister&task=new_discount_code&Itemid=$Itemid";

			?>

			 alert('<?php echo JText::_('DT_ALERT_CODE_EXISTS') ?>');

            <?php

			exit;

		}

	}
	
	if(strtotime($_REQUEST['start']) > strtotime($_REQUEST['end'])){

		$url = "index.php?option=com_dtregister&controller=discountcode&Itemid=$Itemid";

		if(isset($_REQUEST['id'])){

			$discount_code->id = $_REQUEST['id'];

			$url .= "&task=edit&id=".$_REQUEST['id'];

		}else{

			$url .="&task=new";

		}

		?>

               alert('<?php echo JText::_('DT_ALERT_CODE_DATE_INVALID') ?>');

            <?php

			exit;

	}else{

		if(isset($_REQUEST['no_html'])){

			if(isset($_REQUEST['id'])){

				$form_id = "updateDiscountCode";

			}else{

				$form_id = "newDiscountCode";

			}

		 ?>

       		document.adminForm.task.value = '<?php echo $_REQUEST['task'];?>';

       		DTjQuery('#<?php echo $form_id;?>').submit();

    	<?php

			exit ;

		}

		$discount_code->bind($_REQUEST);

		$discount_code->store();
       if($discount_code->events_enable == 1){
		   
		   $discount_code->enableAllEvents();
		   
		}
		$url = "index.php?option=com_dtregister&controller=discountcode&Itemid=$Itemid";

		 $mainframe->redirect($url, JText::_('DT_ALERT_DISCOUNT_CREATED'));

	}

       $row =  $discount_code;

	   $id=JRequest::getInt('id',0);
	   
	}
   
}