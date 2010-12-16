<?php

$document	=& JFactory::getDocument();

$document->addStyleSheet(JURI::root(true).'/components/com_dtregister/assets/css/south-street/jquery-ui.css');

$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery.js');

$document->addScript( JURI::root(true).'/components/com_dtregister/assets/js/jquery-ui.js');

?>

<head>

<link href="<?php echo JURI::root(true).'/components/com_dtregister/assets/css/south-street/jquery-ui.css'; ?>" rel="stylesheet"  />

<script type="text/javascript" src="<?php echo JURI::root(true).'/components/com_dtregister/assets/js/jquery.js'; ?>"></script>

<script type="text/javascript" src="<?php echo JURI::root(true).'/components/com_dtregister/assets/js/jquery-ui.js'; ?>"></script>



<style type="text/css">

	#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }

	#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }

	#sortable li span { position: absolute; margin-left: -1.3em; }

	</style>

	<script type="text/javascript">

	DTjQuery(function() {

		DTjQuery("#sortable").sortable({

		  update : function(e,ui){

			  

				  var order = DTjQuery(this).sortable("serialize") ;

				  DTjQuery.post("index.php?option=com_dtregister&controller=feeorder&task=order", order, function(theResponse){

                     DTjQuery("#contentRight").html(theResponse);

                  });

			  }	

	    });

		DTjQuery("#sortable").disableSelection();

	});

	</script>

</head>

<body>

<ul id="sortable">

    <?php

      foreach($this->feeorders as $feeorder){

		  ?>

          <li class="ui-state-default" id="ordering_<?php echo $feeorder->id; ?>"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo JText::_($feeorder->title); ?></li>

          <?php

	  }

	?>

	

	

</ul>

<div id="contentRight">



</div>

</body>

