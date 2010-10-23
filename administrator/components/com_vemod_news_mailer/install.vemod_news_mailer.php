<?php
function com_install() {
    $database = &JFactory::getDBO();
  echo "<center><img src='components/com_vemod_news_mailer/vemod.jpg' /></center><br><h2 align='center'>Thank you for using Vemod News Mailer.</h2>
<p align='center'>Mailings are scheduled using the index.php of your template 
  and executed on a given interval but you can also choose to trigger mailings 
  manually.</p>
<p align='center'>Selected users can trigger mailings from the frontend.</p>
<p align='center'>Please contact me at vemod@musiker.nu with any questions.</p>
";

        $now = gmdate( 'Y-m-d H:i:s' );
		$database->setQuery("TRUNCATE TABLE #__vemod_news_mailer_scantime");
		$database->query();	    	        
		$database->setQuery("INSERT INTO #__vemod_news_mailer_scantime (scantime,throttletime) VALUES (" . $database->Quote($now).",". $database->Quote($now). ")");
		$database->query();

# Set up new icons for admin menu
$database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/config.png' WHERE admin_menu_link='option=com_vemod_news_mailer&task=configuration'");
$iconresult[0] = $database->query();
$database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/users.png' WHERE admin_menu_link='option=com_vemod_news_mailer&task=showsubscribers'");
$iconresult[1] = $database->query();
$database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/controlpanel.png' WHERE admin_menu_link='option=com_vemod_news_mailer&task=showmaintenance'");
$iconresult[2] = $database->query();
$database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/backup.png' WHERE admin_menu_link='option=com_vemod_news_mailer&task=showbackup'");
$iconresult[3] = $database->query();		
		
}
?> 

