<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class DtregisterViewCpanel	 extends DtrView {
   
   	function display($tpl = null){
	      			
			
			parent::display($tpl);
				
	}
	function cpanelbutton( $link, $image, $text, $path='/administrator/images/', $target='', $onclick='' ) {
		global $Itemid;
	 	if( $target != '' ) {
	 		$target = 'target="' .$target. '"';
	 	}
	 	if( $onclick != '' ) {
	 		$onclick = 'onclick="' .$onclick. '"';
	 	}
	 	if( $path === null || $path === '' ) {
	 		$path = '/administrator/images/';
	 	}
		$link .= "&Itemid=".$Itemid ;
		
		?>
		<div style="float:left;">
			<div class="icon">
				<a href="<?php echo $link; ?>" <?php echo $target;?>  <?php echo $onclick;?>>
					<?php echo JHTML::_('image.administrator', $image, $path, NULL, NULL, $text ); ?>
					<span><?php echo $text; ?></span>
				</a>
			</div>
		</div>
		<?php
	}
   
}
?>