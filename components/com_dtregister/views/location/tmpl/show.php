<?php

/**
* @version 2.7.5
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

global $googlekey,$amp,$location_img_w,$location_img_h,$linktogoogle;
$document =& JFactory::getDocument();
if($googlekey!==""){

   $document->addScript( "http://maps.google.com/maps?file=api".$amp."v=2.x".$amp."key=".$googlekey);
}
$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/dt_jquery.js');
$mlocation = $this->getModel('location');
$location = $mlocation->table;
$location->load(JRequest::getVar('id',0));

?>
<script type="text/javascript">
   var map = null;

    var geocoder = null;

	var address = null;

	var display_address = null;

    function initialize() {

      if (GBrowserIsCompatible()) {

        map = new GMap2(document.getElementById("map_canvas"));

        map.setCenter(new GLatLng(37.4419, -122.1419), 13);

        geocoder = new GClientGeocoder();

		showAddress(address);

      }

    }

    function showAddress(address) {

      if (geocoder) {

        geocoder.getLatLng(

          address,

          function(point) {

            if (!point) {

              alert(address + " not found");

            } else {

              map.setCenter(point, 13);

              var marker = new GMarker(point);

              map.addOverlay(marker);

              marker.openInfoWindowHtml(display_address);

            }

          }

        );

      }

    }
  
</script>

 <table class="location_box">

    <tr>

      <td colspan="2" align="left" class="location_name"><?php echo stripslashes($location->name) ?></td>

    </tr>

    <tr>

    <?php if(file_exists($location->image) && $location->showimage==1  ){?>

      <td align="left" valign="top" class="location_image">

        <img src="index.php?option=com_dtregister&controller=file&task=thumb&w=<?php echo $location_img_w; ?>&h=<?php echo $location_img_h; ?>&filename=images/dtregister/locations/<?php echo basename($location->image) ?>" border="0" /></td>

         <?php } ?>

      <td valign="top" align="left" class="location_details">

       <?php if($location->address !=""){?>

	      <?php echo stripslashes($location->address); ?>

       <?php }?>

       <?php if($location->address2 !=""){?>

              <br /><?php echo stripslashes($location->address2); ?>

       <?php }?>

       <?php if($location->city !=""){?>

         <br /><?php echo stripslashes($location->city); ?>,&nbsp;<?php echo stripslashes($location->state); ?>&nbsp;&nbsp;<?php echo stripslashes($location->zip); ?>

        <?php }?>

        <?php if($location->country !=""){?>

         <br /><?php echo stripslashes($location->country); ?>

        <?php }?>

        <?php if($location->phone !=""){?>

          <br /><b><?php echo JText::_( 'DT_PHONE' ); ?></b>: <?php echo $location->phone ?>

        <?php }?>

        <?php if($location->email !=""){?>

          <br /><b><?php echo JText::_( 'DT_EMAIL' ); ?></b>: <a href="mailto:<?php echo $location->email ?>">[<?php echo JText::_( 'DT_CLICK_TO_EMAIL' ); ?>]</a>

        <?php }?>

        <?php if($location->website !=""){?>

          <br /><b><?php echo JText::_( 'DT_WEBSITE' ); ?></b>: <a href="<?php echo $location->website ?>" target="_blank"><?php echo $location->website ?></a>

        <?php }?>

      </td>

    </tr>

   </table>

   <div style="margin-left:6px">

   <?php

   if(isset($googlekey) && $googlekey !=""){

   ?>

   <div id="map_canvas" style="width: 500px; height: 300px">

   </div>

   <?php 

   }

   ?>

  <?php

		 if($linktogoogle==1){

	?>

     [<a target="_blank" href="http://maps.google.com/maps?f=d&hl=en&z=11&om=0&layer=t&utm_campaign=en&utm_source=en-ha-na-us-google-dd&utm_medium=ha&saddr=<?php echo $location->address.', '.$location->city.', '.$location->state.' '.$location->zip; ?>"><?php echo JText::_( 'DT_GOOGLE_LINK' ); ?></a>]

       <?php } ?>

   </div>
  <script>
    address = '<?php echo $location->address.$location->address2.', '.$location->city.', '.$location->state.' '.$location->zip; ?>';
  </script>
   <?php

    if($location->address2 !=""){

	   $location->address2 = "<br />".$location->address2;

	}

   ?>

   <script>
	 
	 display_address  = '<?php echo $location->address.$location->address2.'<br /> '.$location->city.', '.$location->state.' '.$location->zip; ?>';
	 
	 DTjQuery(function(){
		 
		 initialize();
	});

   </script>