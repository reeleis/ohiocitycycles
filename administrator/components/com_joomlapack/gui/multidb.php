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
 * Multiple (extra) databases management page
 * 
 * Allows the user to define extra databases to be dumped, as part of the full site backup process.
 * This makes possible to backup a site consisting of a Joomla! installation along with other scripts
 * which might use their own databases.
 *
 */
class JoomlapackPageMultiDB
{
	var $_filterClass = 'multidb';

	/**
	 * Implements the Singleton pattern
	 *
	 * @return JoomlapackPageMultiDB
	 * @static
	 */
	function &getInstance()
	{
		static $instance;
		
		if( !is_object($instance) )
		{
			$instance = new JoomlapackPageMultiDB();
		}
		
		return $instance;
	}
	
	/**
	 * Displays the HTML for this page.
	 * 
	 * Depending on the task, it will call the appropriate private methods to handle and display
	 * the data
	 *
	 */
	function echoHTML()
	{
		$task = JoomlapackAbstraction::getParam('task', 'view');
		switch( $task )
		{
			case 'edit':
			case 'new':
				$this->_echoEditHTML();
				break;
			case 'save':
				$this->_saveFromPOST();
				$this->_echoViewHTML();
				break;
			case 'delete':
				$this->_deleteFromPOST();
				$this->_echoViewHTML();
				break;
			case 'view':
			default:
				$this->_echoViewHTML();
				break;
		}
	}
	
	/**
	 * Displays a list of all extra database definitions
	 *
	 */
	function _echoViewHTML()
	{
		$this->_echoJavaScript(); // Get JavaScript for AJAX calls
		echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_MULTIDB') );
		
		?>
		<form action="index2.php" method="post" name="adminForm">
			<input type="hidden" name="option" value="<?php echo JoomlapackAbstraction::getParam('option','com_joomlapack') ; ?>" />
			<input type="hidden" name="act" value="multidb" />
			<input type="hidden" name="task" id="task" value="" />
			<input type="hidden" name="id" id="id" value="" />
		</form>

		<div id="multidblist">
			&nbsp;
		</div>
		
		<script type="text/javascript">
			do_getMultiDBList();
		</script>
		<?php
	}
	
	/**
	 * Displays the edit form of an existing or newly created record 
	 *
	 */
	function _echoEditHTML()
	{
		// Get the task and find the item's id
		$task = JoomlapackAbstraction::getParam('task');
		$id = JoomlapackAbstraction::getParam('id', null);
		$id = ($task == 'new') ? null : (is_numeric($id) ? $id : null);
		
		// If it is not a new record, try to fetch it. If fetch is imposible, resort to new record
		if( !is_null($id) )
		{
			$row = JoomlapackHelperFiltertable::getInclusionEntry($this->_filterClass, $id);
			$id = $row['id'];
		} else {
			$row = array();
		}
		
		// Start outputting the page
		$this->_echoJavaScript(); // Get JavaScript for AJAX calls
		echo JoomlapackCommonHTML::getAdminHeadingHTML( JoomlapackLangManager::_('CPANEL_MULTIDB') );

		?>
		<form action="index2.php" method="post" name="adminForm">
			<input type="hidden" name="option" value="<?php echo JoomlapackAbstraction::getParam('option','com_joomlapack') ; ?>" />
			<input type="hidden" name="act" value="multidb" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="id" value="<?php echo is_null($id) ? '' : $id ?>" />
			<table cellpadding="4" cellspacing="0" border="0" width="95%" class="adminform">
				<tr>
					<td><?php echo JoomlapackLangManager::_('MULTIDB_HOST') ?></td>
					<td><input type="text" name="host" id="host" value="<?php echo $row['host']; ?>" /></td>					
				</tr>
				<tr>
					<td><?php echo JoomlapackLangManager::_('MULTIDB_PORT') ?></td>
					<td><input type="text" name="port" id="port" value="<?php echo $row['port']; ?>" /></td>					
				</tr>
				<tr>
					<td><?php echo JoomlapackLangManager::_('MULTIDB_USERNAME') ?></td>
					<td><input type="text" name="username" id="username" value="<?php echo $row['username']; ?>" /></td>					
				</tr>
				<tr>
					<td><?php echo JoomlapackLangManager::_('MULTIDB_PASSWORD') ?></td>
					<td><input type="text" name="password" id="password" value="<?php echo $row['password']; ?>" /></td>					
				</tr>
				<tr>
					<td><?php echo JoomlapackLangManager::_('MULTIDB_DATABASE') ?></td>
					<td><input type="text" name="database" id="database" value="<?php echo $row['database']; ?>" /></td>					
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					<input type="button" value="<?php echo JoomlapackLangManager::_('MULTIDB_TESTDB'); ?>" onclick="testdb();" />
					</td>
				</tr>
			</table>
		<?php
	}
	
	/**
	 * Handles data POSTed to the form and updates the database. If no error occured, it will
	 * reroute to list view of all records.
	 *
	 */
	function _saveFromPOST()
	{
		$id			= JoomlapackAbstraction::getParam('id', '');
		$host		= JoomlapackAbstraction::getParam('host','');
		$port		= JoomlapackAbstraction::getParam('port','');
		$user		= JoomlapackAbstraction::getParam('username','');
		$database	= JoomlapackAbstraction::getParam('database','');
		$pass		= JoomlapackAbstraction::getParam('password','');
		$active		= JoomlapackAbstraction::getParam('active', 'on');
		
		$active = ($active == 'on') || ($active === true) || ($active == 'checked');
		$new = is_null($id) || ($id == '');
		
		$value = array(
			'host' => $host,
			'port' => $port,
			'username' => $user,
			'password' => $pass,
			'database' => $database,
			'active'	=> $active
		);
		
		if( $new )
		{
			$value['active'] = true;
			JoomlapackHelperFiltertable::addInclusionFilter($this->_filterClass, $value);
		} else {
			JoomlapackHelperFiltertable::updateInclusionFilter($this->_filterClass, $id, $value);
		}
	}
	
	/**
	 * Deletes a selected row
	 *
	 */
	function _deleteFromPOST()
	{
		$id			= JoomlapackAbstraction::getParam('id', '');
		JoomlapackHelperFiltertable::deleteInclusionFilter($this->_filterClass, $id);
	}
	
	/**
	 * Toggles the active status of a record
	 *
	 * @param integer $id The row id (`id` column)
	 * @return boolean True on success
	 */
	function toggleActive( $id )
	{
		if( !is_numeric($id) ) return false;
		
		$value = JoomlapackHelperFiltertable::getInclusionEntry($this->_filterClass, $id);
		
		// Invert active status
		$value['active'] = !$value['active'];
		
		JoomlapackHelperFiltertable::updateInclusionFilter($this->_filterClass, $id, $value);
		
		return true;
	}
	
	/**
	 * Tests connection to a MySQL database using the provided settings
	 *
	 * @param string $host MySQL server's hostname
	 * @param string $port MySQL server's port
	 * @param string $user MySQL server's username
	 * @param string $pass MySQL server's password
	 * @param string $database MySQL database
	 * @return boolean|string True on success, error description on failure
	 */
	function testConnection($host, $port, $user, $pass, $database)
	{
		$host = $host . ($port != '' ? ":$port" : '');
		
		if( !defined('_JEXEC') )
		{
			$database = new database($host, $user, $pass, $database, '', false);
			// A dummy SQL statement which shouldn't fail
			$sql = 'SHOW TABLES';
			$database->setQuery($sql);
			$database->query();
			// If the query failed, I guess we're not connected to the database
			if( $database->getErrorNum() != 0) return false;
		} else {
			jimport('joomla.database.database');
			jimport( 'joomla.database.table' );
			$conf =& JFactory::getConfig();
			$driver 	= $conf->getValue('config.dbtype');
			$options	= array ( 'driver' => $driver, 'host' => $host, 'user' => $user, 'password' => $pass, 'database' => $database, 'prefix' => '' );
			
			$database =& JDatabase::getInstance( $options );
			
			if ( JError::isError($database) ) return false;
			if ($database->getErrorNum() > 0) return false;
		}
		
		return true;
	}
	
	/**
	 * Returns a list of associative arrays representing the database records
	 *
	 * @return array
	 */
	function _getRowList()
	{
		return JoomlapackHelperFiltertable::getInclusionList($this->_filterClass);
	}
	
	/**
	 * Loads a record into an associative array
	 *
	 * @param integer $id The ID of the requested row
	 * @return array
	 */
	function _getRow($id)
	{
		return JoomlapackHelperFiltertable::getInclusionEntry($this->_filterClass, $id);
	}
	
	/**
	 * Outputs the JavaScript required for (S)AJAX to work
	 *
	 */
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


		function testdb()
		{
			var host = document.getElementById("host").value;
			var port = document.getElementById("port").value;
			var username = document.getElementById("username").value;
			var password = document.getElementById("password").value;
			var database = document.getElementById("database").value;

			x_testdatabase( host, port, username, password, database, testdb_cb ); 
		}
		
		function testdb_cb( myRet )
		{
			if( myRet == true )
			{
				alert('<?php echo JoomlapackLangManager::_('MULTIDB_TESTOK'); ?>');
			} else {
				alert('<?php echo JoomlapackLangManager::_('MULTIDB_TESTNOTOK'); ?>');
			}
		}
		
		function do_getMultiDBList()
		{
			x_getMultiDBList( do_getMultiDBList_cb );
		}
		
		function do_getMultiDBList_cb( myRet )
		{
			document.getElementById("multidblist").innerHTML = myRet;
		}
		
		function ToggleActive( id )
		{
			x_toggleMultiDBActive( id, ToggleActive_cb );
		}
		
		function ToggleActive_cb( myRet )
		{
			do_getMultiDBList();
		}
		
		function editRow( id )
		{
			document.getElementById("id").value = id;
			submitbutton('edit');
		}
		
		function deleteRow( id )
		{
			document.getElementById("id").value = id;
			submitbutton('delete');
		}
		 
		</script>
<?php
	}

	/**
	 * Returns the admin list of multidb definitions
	 *
	 * @return string The HTML of the table
	 */
	function getMultiDBList()
	{
		jpimport('helpers.lang');
		
		$lang_active = JoomlapackLangManager::_('MULTIDB_ACTIVE');
		$lang_host = JoomlapackLangManager::_('MULTIDB_HOST');
		$lang_database = JoomlapackLangManager::_('MULTIDB_DATABASE');
		
		$out = '';
		$out .= <<<END
			<table class="adminlist">
			<thead>
			<tr>
				<th width="5">#</th>
				<th class="title" width="100px">$lang_active</th>
				<th class="title">$lang_host</th>
				<th class="title">$lang_database</th>
				<th width="80" align="right"></th>
				<th width="80" align="right"></th>
			</tr>
			</thead>
			<tbody>
END;
		$allRows = $this->_getRowList();
		if( count($allRows) > 0 )
		{
			foreach( $allRows as $row )
			{
				$checked = $row['active'] ? " checked = \"true\" " : "";
				
				$row_id = $row['id'];
				$row_host = $row['host'];
				$row_database = $row['database'];
				$lang_edit = JoomlapackLangManager::_('MULTIDB_EDIT');
				$lang_delete = JoomlapackLangManager::_('MULTIDB_DELETE');
				
				$out .= <<<ENDTHISROW
			<tr>
				<td>$row_id</td>
				<td><input type="checkbox" $checked onclick="ToggleActive($row_id);" /></td>
				<td>$row_host</td>
				<td>$row_database</td>
				<td><a href="javascript:editRow($row_id);">$lang_edit</a></td>
				<td><a href="javascript:deleteRow($row_id);">$lang_delete</a></td>
			</tr>
ENDTHISROW;
			}
		} else {
			$out .= '<tr><td colspan="6">' . JoomlapackLangManager::_('MULTIDB_NORECORDS') . '</td></tr>';
		}
		
		$out .= <<<END
			</tbody>
		</table>
END;
		
		return $out;
	}

// ======================================== AJAX Part ========================================
	function commonSAJAX()
	{
		jpimport('helpers.sajax');
		sajax_init();
		sajax_force_page_ajax();
		sajax_export('testdatabase', 'getMultiDBList', 'toggleMultiDBActive');
	}
	
	function processAJAX()
	{
		$this->commonSAJAX();
		
		sajax_handle_client_request($this);
	}

	function testdatabase($host, $port, $user, $pass, $database)
	{
		$JP_Error_Reporting = @error_reporting(E_ERROR | E_PARSE);
		
		$result = $this->testConnection($host, $port, $user, $pass, $database);
		
		@error_reporting($JP_Error_Reporting);
		
		return $result;
	}

	
	function toggleMultiDBActive($id)
	{
		$JP_Error_Reporting = @error_reporting(E_ERROR | E_PARSE);
		
		$result = $this->toggleActive($id);
		
		@error_reporting($JP_Error_Reporting);
		
		return $result;
	}
		
}