<?php
/**
 * View: JUpdateMan Default Template 
 * 
 * PHP4/5
 *  
 * Created on Sep 28, 2007
 * 
 * @package JUpdateMan
 * @author Sam Moffatt <pasamio@gmail.com>
 * @license GNU/GPL http://www.gnu.org/licenses/gpl.html
 * @copyright 2009 Sam Moffatt 
 * @version SVN: $Id:$
 * @see JoomlaCode Project: http://joomlacode.org/gf/project/pasamioprojects
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access'); ?>
	<div align="left">
		<p>Welcome to the Joomla! Update Manager component. My job is to guide you through upgrading your Joomla! installation.</p>
		<p>If you have a proxy server you will need to enter your details in the preference screen.</p>
		<p>This is a simple step by step process, which will hopefully be as simple as possible. This is:</p>
		<ol>
			<li>Download the Update XML File and select your package file.</li>
			<li>Download the package file and display customary 'Are you sure?' message</li>			
			<li>Completed message</li>
		</ol>
		<?php if($this->calculated_tmp_path != $this->config_tmp_path) : ?>
			<p style="font-weight:bold; color: orange;">Warning: Potentially invalid temporary path.<br /> 
				Configured path: <span style="font-weight: bold; color: black"><?php echo $this->config_tmp_path ?></span><br />
				Suggested path: <span style="font-weight: bold; color: black"><?php echo $this->calculated_tmp_path ?></span>
			</p>
		<?php endif; ?>
		<?php if($this->http_support || $this->curl_support) : ?>	
			<?php if(!$this->http_support && $this->current_method == JUPDATEMAN_DLMETHOD_FOPEN) : ?>
				<p style="font-weight:bold; color: red;">Note: You have fopen selected but your server doesn't appear to support this method. Try selecting cURL instead.</p>
			<?php endif; ?>
			<?php if(!$this->curl_support && $this->current_method == JUPDATEMAN_DLMETHOD_CURL): ?>
				<p style="font-weight:bold; color: red;">Note: You have selected curl but your server doesn't appear to support this method. Try selecting fopen instead.</p>
			<?php endif; ?>
			<p>So lets continue our travels and <a href="index.php?option=com_jupdateman&task=step1">download the update file &gt;&gt;&gt;</a></p>
		<?php else: ?>
			<p>Your Joomla! instance doesn't support cURL or fopen HTTP wrappers. This tool cannot be used unless you have either of these features.</p>
		<?php endif; ?>
	</div>