<?php
/**
 * Document Description
 * 
 * Document Long Description 
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
 * @see JoomlaCode Project: http://joomlacode.org/gf/project/
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Update Manager Component
 *
 * @package    JUpdateMan
 */

class JUpdateManViewResults extends JView
{	
    function display($tpl = null)
    {
    	JToolBarHelper::title( JText::_( 'Joomla! Update Manager' ), 'install.png' );
        $model =& $this->getModel();
        $this->assign('message', $model->getState('message'));
        $this->assign('extension_message', $model->getState('extension.message'));
        $this->assign('updatepackage', $model->getUpdatePackage());
        parent::display($tpl);
        
    }
}
