<?php
if ( !defined('_JEXEC') && defined('_VALID_MOS') ) define( '_JEXEC', true ); defined('_JEXEC') or die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2007 Acajoom Services. All rights reserved.
### http://www.acajoom.com/license.php
define('UPLOAD_DEFAULT_CHMOD', 0644);

class upload
{
    var $files = array();

    var $_chmod = UPLOAD_DEFAULT_CHMOD;

    function upload()
    {

        $ini_size = preg_replace('/m/i', '000000', ini_get('upload_max_filesize'));

        if (function_exists('version_compare') &&
            version_compare(phpversion(), '4.1', 'ge'))
        {
            $this->post_files = $_FILES;
            $maxsize = (isset($_POST['MAX_FILE_SIZE'])) ?
                $_POST['MAX_FILE_SIZE'] : null;
            if (isset($_SERVER['CONTENT_TYPE'])) {
                $this->content_type = $_SERVER['CONTENT_TYPE'];
            }
        } else {
            global $POST_FILES, $SERVER_VARS;
            $this->post_files = $POST_FILES;
            $maxsize = (isset($POST_VARS['MAX_FILE_SIZE'])) ?
                $POST_VARS['MAX_FILE_SIZE'] : null;
            if (isset($SERVER_VARS['CONTENT_TYPE'])) {
                $this->content_type = $SERVER_VARS['CONTENT_TYPE'];
            }
        }

        if (empty($maxsize) || ($maxsize > $ini_size))  $maxsize = $ini_size;

    }

    function &getFiles($file = null)
    {
        static $is_built = false;
        if (!$is_built) {
            $files = &$this->_buildFiles();

            if (!$files) {
                $this->files['_error'] =  &new Upload_File(
                                                       '_error', null,
                                                       null, null,
                                                       null, 'error creating fake file',
                                                       $this->_chmod);
            } else {
                $this->files = $files;
            }
            $is_built = true;
        }
        if ($file !== null) {
            if (is_int($file)) {
                $pos = 0;
                foreach ($this->files as $obj) {
                    if ($pos == $file) {
                        return $obj;
                    }
                    $pos++;
                }
            } elseif (is_string($file) && isset($this->files[$file])) {
                return $this->files[$file];
            }
        }
        return $this->files;
    }

    function &_buildFiles() {

        if (function_exists('version_compare') &&
            version_compare(phpversion(), '4.2.0', 'ge')) {
            $uploadError = array(
                1 => _ACA_TOO_LARGE,
                2 => _ACA_TOO_LARGE,
                3 => _ACA_PARTIAL,
                4 => _ACA_NO_USER_FILE
                );
        }

        $files = array();
        foreach ($this->post_files as $userfile => $value) {
            if (is_array($value['name'])) {
                foreach ($value['name'] as $key => $val) {
                    $err = $value['error'][$key];
                    if (isset($err) && $err !== 0 && isset($uploadError[$err])) {
                        $error = $uploadError[$err];
                    } else {
                        $error = null;
                    }
                    $name = basename($value['name'][$key]);
                    $tmp_name = $value['tmp_name'][$key];
                    $size = $value['size'][$key];
                    $type = $value['type'][$key];
                    $formname = $userfile . "[$key]";
                    $files[$formname] = new Upload_File($name, $tmp_name,
                                                             $formname, $type, $size, $error, $this->_chmod);
                }
            } else {
                $err = $value['error'];
                if (isset($err) && $err !== 0 && isset($uploadError[$err])) {
                    $error = $uploadError[$err];
                } else {
                    $error = null;
                }
                $name = basename($value['name']);
                $tmp_name = $value['tmp_name'];
                $size = $value['size'];
                $type = $value['type'];
                $formname = $userfile;
                $files[$formname] = new Upload_File($name, $tmp_name,
                                                         $formname, $type, $size, $error, $this->_chmod);
            }
        }
        return $files;
    }

    function isMissing() {

        if (count($this->post_files) < 1) {
            return acajoom::printM('error' , _ACA_NO_USER_FILE);
        }
        $files = array();
        $size = 0;
        foreach ($this->post_files as $userfile => $value) {
            if (is_array($value['name'])) {
                foreach ($value['name'] as $key => $val) {
                    $size += $value['size'][$key];
                }
            } else {
                $size = $value['size'];
            }
        }
        if ($size == 0) {
            acajoom::printM('error' ,_ACA_NO_USER_FILE);
        }
        return false;
    }

    function setChmod($mode)
    {
        $this->_chmod = $mode;
    }
}

class Upload_File
{
    var $upload = array();

    var $mode_name_selected = false;

    var $_extensions_check = array('php', 'phtm', 'phtml', 'php3', 'inc', 'exe', 'dmg');

    var $_extensions_mode  = 'deny';

    var $_chmod = UPLOAD_DEFAULT_CHMOD;

    function Upload_File($name = null, $tmp = null,  $formname = null,
                              $type = null, $size = null, $error = null,
                              $chmod = UPLOAD_DEFAULT_CHMOD)
    {
        $ext = null;

        if (empty($name) || $size == 0) {
            $error = _ACA_NO_USER_FILE;
        } elseif ($tmp == 'none') {
            $error = _ACA_TOO_LARGE;
        } else {
            if (($pos = strrpos($name, '.')) !== false) {
                $ext = substr($name, $pos + 1);
            }
        }

        if (function_exists('version_compare') &&
            version_compare(phpversion(), '4.1', 'ge')) {
            if (isset($_POST['MAX_FILE_SIZE']) &&
                $size > $_POST['MAX_FILE_SIZE']) {
                $error = _ACA_TOO_LARGE;
            }
        } else {
            global $POST_VARS;
            if (isset($POST_VARS['MAX_FILE_SIZE']) &&
                $size > $POST_VARS['MAX_FILE_SIZE']) {
                $error = _ACA_TOO_LARGE;
            }
        }

        $this->upload = array(
            'real'      => $name,
            'name'      => $name,
            'form_name' => $formname,
            'ext'       => $ext,
            'tmp_name'  => $tmp,
            'size'      => $size,
            'type'      => $type,
            'error'     => $error
        );

        $this->_chmod = $chmod;
    }

    function setName($mode, $prepend = null, $append = null)
    {
        switch ($mode) {
            case 'uniq':
                $name = $this->nameToUniq($this->upload['real']);
                $this->upload['ext'] = $this->nameToSafe($this->upload['ext'], 40);
                $name .= '.' . $this->upload['ext'];
                break;
            case 'safe':
                $name = $this->nameToSafe($this->upload['real']);
                if (($pos = strrpos($name, '.')) !== false) {
                    $this->upload['ext'] = substr($name, $pos + 1);
                } else {
                    $this->upload['ext'] = '';
                }
                break;
            case 'real':
                $name = $this->upload['real'];
                break;
            default:
                $name = $mode;
        }
        $this->upload['name'] = $prepend . $name . $append;
        $this->mode_name_selected = true;
        return $this->upload['name'];
    }

    function nameToUniq($name)
    {
        return md5(uniqid( substr(trim('com_acajoom'.$name)),0,80 ,time()));
    }

    function nameToSafe($name, $maxlen=250)
    {
        $noalpha = 'ÁÉÍÓÚÝáéíóúýÂÊÎÔÛâêîôûÀÈÌÒÙàèìòùÄËÏÖÜäëïöüÿÃãÕõÅåÑñÇç@°ºª';
        $alpha   = 'AEIOUYaeiouyAEIOUaeiouAEIOUaeiouAEIOUaeiouyAaOoAaNnCcaooa';

        $name = substr($name, 0, $maxlen);
        $name = strtr($name, $noalpha, $alpha);
        return preg_replace('/[^a-zA-Z0-9,._\+\()\-]/', '_', $name);
    }

    function isValid()
    {
        if ($this->upload['error'] === null) {
            return true;
        }
        return false;
    }

    function isMissing()
    {
        if ($this->upload['error'] == _ACA_NO_USER_FILE) {
            return true;
        }
        return false;
    }

    function isError()
    {
        if (in_array($this->upload['error'], array(_ACA_TOO_LARGE))) {
            return true;
        }
        return false;
    }

    function moveTo($dir_dest, $overwrite = true)
    {
        if (!$this->isValid()) {
            return acajoom::printM('error' ,$this->upload['error']);
        }

        if (!$this->_evalValidExtensions()) {
            return acajoom::printM('error' ,_ACA_NOT_ALLOWED_EXTENSION);
        }

        $err_code = $this->_chk_dir_dest($dir_dest);
        if ($err_code !== false) {
            return acajoom::printM('error' ,$err_code);
        }
        if (!$this->mode_name_selected) {
            $this->setName('safe');
        }

        $name_dest = $dir_dest . DIRECTORY_SEPARATOR . $this->upload['name'];

        if (@is_file($name_dest)) {
            if ($overwrite !== true) {
                return acajoom::printM('error' ,_ACA_FILE_EXISTS);
            } elseif (!is_writable($name_dest)) {
                return acajoom::printM('error' ,_ACA_CANNOT_OVERWRITE);
            }
        }

        if (!@move_uploaded_file($this->upload['tmp_name'], $name_dest)) {
            return acajoom::printM('error' ,_ACA_E_FAIL_MOVE);
        }
        @chmod($name_dest, $this->_chmod);
        return $this->getProp('name');
    }

    function _chk_dir_dest($dir_dest)
    {
        if (!$dir_dest) {
            return _ACA_MISSING_DIR;
        }
        if (!@is_dir($dir_dest)) {
            return _ACA_IS_NOT_DIR;
        }
        if (!is_writeable($dir_dest)) {
            return _ACA_NO_WRITE_PERMS;
        }
        return false;
    }
    function getProp($name = null)
    {
        if ($name === null) {
            return $this->upload;
        }
        return $this->upload[$name];
    }

    function errorMsg()
    {
        return $this->errorCode($this->upload['error']);
    }

    function getMessage()
    {
        return $this->errorCode($this->upload['error']);
    }

    function setValidExtensions($exts, $mode = 'deny')
    {
        $this->_extensions_check = $exts;
        $this->_extensions_mode  = $mode;
    }

    function _evalValidExtensions()
    {
        $exts = $this->_extensions_check;
        settype($exts, 'array');
        if ($this->_extensions_mode == 'deny') {
            if (in_array($this->getProp('ext'), $exts)) {
                return false;
            }
        } else {
            if (!in_array($this->getProp('ext'), $exts)) {
                return false;
            }
        }
        return true;
    }
}
