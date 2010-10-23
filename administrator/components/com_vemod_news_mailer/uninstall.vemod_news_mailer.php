<?php
function com_uninstall() {
 echo "<center><img src='components/com_vemod_news_mailer/vemod.jpg' /><br>Thank you for using Vemod News Mailer. Please contact me at vemod@musiker.nu with any questions</center>";
 $database = &JFactory::getDBO();

    $incl_code = "<" . "?php " . "$" . "fromtemplate = 1;@include('components/com_vemod_news_mailer/vemod_news_mailer.php'); ?" . ">";
    
    $query = "SELECT template"
		   . "\n FROM #__templates_menu"
		   . "\n WHERE client_id = 0"
		   . "\n AND menuid = 0"
		   ;
    $database->setQuery( $query );

    $current_template = $database->loadResult();

    $tfile = JPATH_SITE . "/templates/" . $current_template . "/index.php";
	         
    $file = file_get_contents($tfile);

	$codeincluded=substr_count($file, $incl_code);
    if ($codeincluded != FALSE) 
	{
	        if($fp = fopen($tfile, 'w'))
			{
        		$file = str_replace($incl_code, "", $file);
          		fwrite($fp, $file);
          		fclose($fp);
			}		
    }	
}
?>
