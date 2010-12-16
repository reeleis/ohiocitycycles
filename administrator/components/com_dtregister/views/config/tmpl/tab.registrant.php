<?php

/**
* @version 2.7.0
* @package Joomla 1.5
* @subpackage DT Register
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
 
 $config = $this->getModel('config');

?>
            <table border="0" class="adminlist">

                                 <tr>

                                    <td align="left" valign="top"><?php echo JText::_( 'DT_REGISTRANT_MESSAGE' ); ?>:</td>

                                    <td>

                                        <?php

                            				$registrant_message = isset($registrant_message)?$registrant_message:'';

                                        ?>
                                         <?php echo $editor->display("config[registrant_message]",stripslashes($config->getGlobal('registrant_message','')),'','','20','20','0'); ?>

                                    </td>

                                    <td valign="top" align="center"><?php echo JHTML::tooltip((JText::_( 'DT_REGISTRANT_MESSAGE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

                                  </tr>

                            	 <tr>

                                    <td align="left"><?php echo JText::_( 'DT_REGISTRANT_USERNAME' ); ?>:</td>

                                    <td>

                                        <?php

                                           $options=array();

                                           $options[]=JHTML::_('select.option',"0",JText::_( 'NO' ));

                                           $options[]=JHTML::_('select.option',"1",JText::_( 'YES' ));

                                           echo JHTML::_('select.radiolist', $options, 'config[registrant_username]','','value','text',$config->getGlobal('registrant_username',''));

                                        ?>

                                    </td>

                                    <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_REGISTRANT_USERNAME_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

                               </tr>

                            	 <tr>

                                    <td align="left"><?php echo JText::_( 'DT_REGISTRANT_REGISTER_DATE' ); ?>:</td>

                                    <td>

                                        <?php

                                             $options=array();

                                             $options[]=JHTML::_('select.option',"0",JText::_( 'NO' ));

                                             $options[]=JHTML::_('select.option',"1",JText::_( 'YES' ));	   

                                              echo JHTML::_('select.radiolist', $options, 'config[registrant_registered_date]','','value','text',$config->getGlobal('registrant_registered_date',''));

                                        ?>

                                    </td>

                                    <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_REGISTRANT_REGISTER_DATE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

                               </tr>

                               <tr>

                                    <td align="left"><?php echo JText::_( 'DT_REGISTRANT_LIST_ACCESS' ); ?>:</td>

                                    <td>

                                        <?php

                                                $options=array();

                                                $options[]=JHTML::_('select.option',"0",JText::_( 'DT_PRIVATE' ));

                                                $options[]=JHTML::_('select.option',"1",JText::_( 'DT_PUBLIC' ));

                                              echo JHTML::_('select.radiolist', $options, 'config[registrant_list]','','value','text',$config->getGlobal('registrant_list',''));

                                        ?>

                                    </td>

                                    <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_REGISTRANT_LIST_ACCESS_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

                                  </tr>

                                  <tr>

                                    <td align="left"><?php echo JText::_( 'DT_REGISTRANT_SHOW_AVATAR' ); ?>:</td>

                                    <td>

                                        <?php

                                             $options=array();

                                             $options[]=JHTML::_('select.option',"0",JText::_( 'NO' ));

                                             $options[]=JHTML::_('select.option',"1",JText::_( 'YES' ));

                                              echo JHTML::_('select.radiolist', $options, 'config[registrant_show_avatar]','','value','text',$config->getGlobal('registrant_show_avatar',0));

                                        ?>

                                    </td>

                                        <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_REGISTRANT_SHOW_AVATAR_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

                                  </tr>

                                  <tr>

                                    <td align="left"><?php echo JText::_( 'DT_REGISTRANT_AVATAR_SIZE' ); ?>:</td>

                                    <td>


                                 <input type="text" size="3" name="config[registrant_avatar_height]" value="<?php echo $config->getGlobal('registrant_avatar_height',86) ?>"> &nbsp;h &nbsp;&nbsp;

                            		 <input type="text" size="3" name="config[registrant_avatar_width]" value="<?php echo $config->getGlobal('registrant_avatar_width',60) ; ?>"> &nbsp;w

                                    </td>

                                    <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_REGISTRANT_AVATAR_SIZE_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

                                  </tr>

                                  <tr>

                                    <td align="left"><?php echo JText::_( 'DT_REGISTRANT_PROFILE_LINK' ); ?>:</td>

                                    <td>

                                    <?php

                            			  $options=array();

                                           $options[]=JHTML::_('select.option',"0",JText::_( 'NO' ));

                                           $options[]=JHTML::_('select.option',"1",JText::_( 'YES' ));
                                          
                                           echo JHTML::_('select.radiolist', $options, 'config[registrant_cb_linked]','','value','text',$config->getGlobal('registrant_cb_linked',0));

									?>

                                    </td>

                                    <td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_REGISTRANT_PROFILE_LINK_HELP' )), '', 'tooltip.png', '', ''); ?> </td>

                                  </tr>

                                   <tr align="center" valign="middle">  <td align="left" valign="top"><?php echo JText::_( 'DT_REGISTRANTS_SHOW_GROUP_MEMBERS' );?>:</td>

							    <td align="left" valign="top">

								   <?php

								   $options=array();

								   $options[]=JHTML::_('select.option', '0', JText::_( 'NO' ));

								   $options[]=JHTML::_('select.option', '1', JText::_( 'YES' ));

								   echo JHTML::_('select.radiolist', $options,'config[show_group_members]','','value','text',$config->getGlobal('show_group_members',0));

								   ?>

							   </td>

								<td align="center"><?php echo JHTML::tooltip((JText::_( 'DT_REGISTRANTS_SHOW_GROUP_MEMBERS_HELP' )), '', 'tooltip.png', '', '');?> </td>

							   </tr>

                            </table>