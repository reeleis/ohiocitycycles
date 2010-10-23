<?php 
/**
 * @copyright	Copyright (C) 2005 - 2007 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
	<jdoc:include type="head" />	
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/common.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template_css.css" type="text/css" />
		<style type="text/css" media="all">
			<?php if ($this->params->get('authorName')=='no') { ?>		.author {display:none}				<?php } ?>
			<?php if ($this->params->get('dateCreated')=='no') { ?>		.createdate {display:none}		<?php } ?>
			<?php if ($this->params->get('dateModified')=='no') { ?>	.modifydate {display:none}		<?php } ?>
			<?php if ($this->params->get('Buttons')=='no') { ?>	.buttons {display:none}		<?php } ?>
		</style>
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/overIE.js"></script>
<?php JHTML::_('behavior.mootools'); ?>
</head>

<body>
<!-- wrap starts here -->
<div id="wrap">

	<div id="top-bg"></div>
				
	<!--header -->
	<div id="header">			
				
		<h1 id="logo-text"><a href="index.php" title="">Ohio City <span> Bicycle Co-op</span></a></h1>		
		<h2 id="slogan">Helping people use bicycles as much as they can</h2>		
		<div id="header-links"><jdoc:include type="modules" name="header" /></div>		
	<!--header ends-->					
	</div>
		
	<div id="header-photo"></div>		
		
	<div  id="menu"><jdoc:include type="modules" name="user1" /></div>					
	<!-- content-wrap starts -->
	<div id="content-wrap">
		<jdoc:include type="modules" name="top" />
		<a name="top"></a>
		<jdoc:include type="message" />
		<div id="sidebar">
			<jdoc:include type="modules" name="right" style="xhtml" />	
		</div>
				
		<div id="main">
		<jdoc:include type="modules" name="abovemain" style="xhtml" />
		<jdoc:include type="component" style="xhtml" />						
		<jdoc:include type="modules" name="belowmain" style="xhtml" />
		</div>
		
	<!-- content-wrap ends-->	
	</div>
		
	<!-- footer starts -->		
	<div id="footer-wrap">
		<div id="footer-bottom">		
			<jdoc:include type="modules" name="user4" style="xhtml" />
			<jdoc:include type="modules" name="footer" style="xhtml" />
		</div>	
	<!-- footer ends-->
	</div>
<!-- wrap ends here -->

</div>
</body>
</html>
