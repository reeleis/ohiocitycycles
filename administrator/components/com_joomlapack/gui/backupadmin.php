<?php
/**
* @package		JoomlaPack
* @copyright	Copyright (C) 2006-2008 JoomlaPack Developers. All rights reserved.
* @version		$Id$
* @license 	http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @since		1.2.1
*
* JoomlaPack is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
**/

// ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

/**
 * Backup files administration page
 *
 */
class JoomlapackPageBackupAdmin
{
	/**
	 * The file patterns for the filetypes that could be backup files
	 *
	 * @var array
	 * @access private
	 */
	var $filePatterns = array(
							'.zip', '.jpa', '.sql'
						);
	
	/**
	 * An array holding all backup files
	 *
	 * @var array
	 * @access private
	 */
	var $backupFiles;
	
	/**
	 * Implements the Singleton pattern
	 *
	 * @return JoomlapackPageBackupAdmin
	 * @static
	 */
	function &getInstance()
	{
		static $instance;
		
		if( !is_object($instance) )
		{
			$instance = new JoomlapackPageBackupAdmin();
		}
		
		return $instance;
	}
	
	/**
	 * Sends the page's HTML to the standard output
	 *
	 */
	function echoHTML()
	{
		$act = JoomlapackAbstraction::getParam('act');
		$task = JoomlapackAbstraction::getParam('task','default');
		
		// Handle downloads
		if( $task == 'downloadfile' )
		{
			$this->downloadFile();
			return;
		}

		$this->_getBackupFileList(); // Populate backup file list
		
		$this->_echoJavaScript(); // Get JavaScript for AJAX calls
		// Show top header
		echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_BUADMIN') );
		echo JoomlapackLangManager::_('BUADMIN_FILECOUNT').': ' . count( $this->backupFiles );				
		?>
		<table class="adminlist">
			<tr>
				<th width="5">
					#
				</th>
				<th class="title">
					<?php echo JoomlapackLangManager::_('BUADMIN_FILENAME'); ?>
				</th>
				<th align="left" width="100">
					<?php echo JoomlapackLangManager::_('BUADMIN_SIZE'); ?>
				</th>
				<th width="80" align="right">
				</th>
				<th width="80" align="right">
				</th>
				<th align="center" width="120">
					<?php echo JoomlapackLangManager::_('BUADMIN_DATE'); ?>
				</th>
			</tr>
		<?php
		$count = 0;
		foreach($this->backupFiles as $fileName) {
			$fileName = realpath($fileName);
			$count++;
			$createdTime	= date( "Y-m-d H:i:s", filemtime( $fileName ) );
			$fileSizeKb		= round( filesize($fileName) / 1024, 2 );
			$onlyName		= basename($fileName);
			$linkDownload	= JoomlapackAbstraction::JPLink( $act, 'downloadfile', true, 'filename=' . addslashes($onlyName) );
			$linkDelete		= "javascript:if (confirm('". JoomlapackLangManager::_('BUADMIN_CONFIRMTITLE') ."')){ do_deletebackup('". addslashes($onlyName) ."'); }";
			?>
			<tr class="<?php echo "row$count"; ?>">
				<td><?php echo $count; ?></td>
				<td align="left"><?php echo $onlyName; ?></td>
				<td align="left"><?php echo $fileSizeKb; ?> Kb</td>
				<td align="center">
					<a href="<?php echo $linkDownload; ?>">
					<img src="images/downarrow.png" border=0>
					<?php echo JoomlapackLangManager::_('BUADMIN_DOWNLOAD'); ?>
					</a>
				</td>
				<td align="center">
					<a href="<?php echo $linkDelete; ?>">
					<img src="images/publish_x.png" border=0>
					<?php echo JoomlapackLangManager::_('BUADMIN_DELETE'); ?>
					</a>
				</td>
				<td><?php echo $createdTime; ?></td>
			</tr>
			<?php
		}
		?>
		</table>
<?php
	}
	
	/**
	 * Populates a list of all backup files
	 */
	function _getBackupFileList()
	{
		jpimport('classes.engine.lister.default');

		$configuration =& JoomlapackConfiguration::getInstance();
		$FS = new JoomlapackListerAbstraction();
		
		$allFilesAndFolders = array();
		
		foreach( $this->filePatterns as $pattern )
		{
			$moreFiles = $FS->getDirContents($configuration->OutputDirectory, '*' . $pattern);
			$allFilesAndFolders = $this->_selectiveMergeArrays( $allFilesAndFolders, $moreFiles );
		}

		if ($allFilesAndFolders === false)
		{
			$this->backupFiles = array();
		} else {
			$this->backupFiles = array();
			foreach($allFilesAndFolders as $fileName)
			{
				if( is_file($fileName) ) $this->backupFiles[] = $fileName;
			}
		}
	}
	
	function _echoJavaScript()
	{
		$this->commonSAJAX();
?>
		<script type="text/javascript">
		<?php sajax_show_javascript(); ?>
		
	 		
 		sajax_fail_handle = SAJAXTrap;

		function SAJAXTrap( myData ) {
			alert('Invalid AJAX reponse: ' + myData);
		}

		function do_deletebackup( filename )
		{
			x_deleteBackup( filename, do_deletebackup_cb ); 
		}
		
		function do_deletebackup_cb( myRet )
		{
			if( myRet ) {
				alert('<?php echo JoomlapackLangManager::_('BUADMIN_DELETESUCCESS'); ?>');
			} else {
				alert('<?php echo JoomlapackLangManager::_('BUADMIN_DELETEFAILED'); ?>');
			}
			
			history.go(0);
		}
		 
		</script>
<?php
	}
		
	/**
	 * Returns the contents of the files in the 'filename' parameter of
	 * the request. It returns a 404 if the file is not found.
	 */
	function downloadFile()
	{
		$configuration =& JoomlapackConfiguration::getInstance();
		$filename = JoomlapackAbstraction::getParam('filename', null);
		
		// Check for blank filename
		if( is_null($filename) )
		{
			header("HTTP/1.0 404 Not Found");
			return;
		}
		
		// Make sure the filename is OK and get absolute path to file
		$filename = stripslashes( $filename );
		$filename = realpath($configuration->OutputDirectory . DIRECTORY_SEPARATOR . $filename);
		
		// Test for nonexistent file
		if( $filename === FALSE )
		{
			header("HTTP/1.0 404 Not Found");
			return;
		}
		
		// OK, all check pass. Now, get me the file!
		ob_end_clean(); // In case some braindead mambot spits its own HTML despite no_html=1
		// Since we're not outputting text/html, we need to send the correct headers!
		// Tell the browser we'll be outputting a gzip file
		header('Content-type: application/zip'); // TODO Find the correct MIME type for binary archives!
		// It will be called... whatever the filename is
		header('Content-Disposition: attachment; filename="'. basename($filename) .'"');

		readfile( $filename );
	}
	
	/**
	 * Deletes the file specified in $filename. Meant to be used in AJAX calls.
	 *
	 * @param string $filename Relative filename to delete
	 * @return boolean True if delete was succesfull, false otherwise
	 */
	function deleteBackup( $filename )
	{
		$configuration =& JoomlapackConfiguration::getInstance();
		
		// Check for blank filename
		if( is_null($filename) )
		{
			return false; 
		}

		// Make sure the filename is OK and get absolute path to file
		$filename = stripslashes( $filename );
		$filename = realpath($configuration->get('OutputDirectory').DS.$filename);
		
		// Test for nonexistent file
		if( $filename === FALSE )
		{
			return false;
		}
		
		// Test the suffix of the file (the last four letters) to make sure this
		// function is not being exploited by Mallory, Oscar and their gang :)
		$suffix = strtolower(substr( $filename, -4 ));
		if( in_array($suffix, $this->filePatterns) )
		{
			if( file_exists($filename) ) @unlink( $filename );
			return true;
		} else {
			return false;
		}
	}

	/**
	 * A variation of array_merge which treats boolean false as an empty array
	 *
	 * @param array|boolean $files1 The first array, or boolean false (treated as empty array)
	 * @param array|boolean $files2 The second array, or boolean false (treated as empty array)
	 * @return array The combination of the two arrays
	 */
	function _selectiveMergeArrays($files1, $files2)
	{
		if( is_array($files1) ) {
			if( is_array($files2) ) {
				return array_merge($files1, $files2);
			} else {
				return $files1;
			}
		} else {
			if( is_array($files2) ) {
				return $files2;
			} else {
				return false;
			}
		}
	}

// ======================================== AJAX Part ========================================
	function commonSAJAX()
	{
		jpimport('helpers.sajax');
		sajax_init();
		sajax_force_page_ajax();
		sajax_export('deleteBackup');
	}
	
	function processAJAX()
	{
		$this->commonSAJAX();
		
		sajax_handle_client_request($this);
	}	
}