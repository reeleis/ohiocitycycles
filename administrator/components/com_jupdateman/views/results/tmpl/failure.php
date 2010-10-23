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
<p>Installation failed!</p>
<p><?php echo $this->message; ?></p>
<p>You may wish to install the extension manually. <a href="<?php echo $this->updatepackage ?>">Download the package.</a></p>
<p><a href="<?php echo 'index.php?option=com_jupdateman'; ?>">Home &gt;&gt;&gt;</a></p>