<?php 

defined( '_JEXEC' ) or die( 'Restricted Access.' );

//include once guarantee
if (!defined('_vmn_javascriptdefined'))
{

define( '_vmn_javascriptdefined',true);

if (!isset($popupstyle))
{
    $popupstyle=0;
}

?>

<SCRIPT LANGUAGE="JavaScript">
<!--

var win;
var LoremIpsum;
var LoremIpsumShort;
var olderBrowser;

    <?php
    if ($popupstyle==0)
    {
        ?>
function closeFrame()
{
    document.getElementById('borderdiv').style.visibility="hidden";
    document.getElementById('framediv').style.visibility="hidden";    
}
        <?php
    }
?>

function setLoremIpsum()
{
LoremIpsum="Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas fermentum ullamcorper magna. In hac habitasse platea dictumst. Proin euismod adipiscing quam." + 
" Curabitur sit amet diam. Aenean nec justo. In faucibus diam eget libero. Sed tortor velit, luctus vel, dapibus vel, cursus ut, enim. Morbi quis dui. Suspendisse consequat aliquam ligula." +
" Nulla ac odio ut felis sagittis dictum.<br> <br>Pellentesque quis turpis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos." +
" Curabitur pulvinar, nibh sit amet tincidunt porta, sem magna eleifend mauris, vitae condimentum quam ante eu sapien. Praesent suscipit elit nec felis laoreet pellentesque." +
" Aliquam erat volutpat. Vestibulum egestas sapien eget ante. Sed quis lacus eu velit nonummy tempus. Maecenas mollis velit id nisi. Sed sit amet velit a lorem dictum volutpat." +
" Pellentesque lorem nisl, sollicitudin in, ornare nec, volutpat non, enim. Sed eros sem, cursus quis, facilisis eu, feugiat vitae, metus. Vestibulum vulputate est sed pede." +
" Praesent malesuada, dui vel vestibulum faucibus, leo tortor vehicula enim, vestibulum volutpat mi enim non ligula. Donec id ipsum. Aliquam erat volutpat. Maecenas feugiat vehicula sapien.";
LoremIpsumShort="Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<br>Maecenas fermentum ullamcorper magna.";
}

//CHECK ALL FOR TABS WITH TOGGLE NAME PARAM
function vmn_checkAll( n, fldName, toggleName, frm ) 
{	if (!fldName) {
		fldName = 'cb';
	}
	if (!toggleName) {
		toggleName = 'toggle';
	}	
	var f;
	if (!frm)
	{
		f = document.userForm;
	}
	else
	{
		f = document.adminForm;		
	}
	var c = eval( 'f.' + toggleName + '.checked' );
	var n2 = 0;
	for ( i=0; i < n; i++ ) {
		cb = eval( 'f.' + fldName + '' + i );
		if ( cb ) {
			cb.checked = c;
			n2++;
		}
	}	
}


function showwindow(inf,title)
{
    inf="<html><head><title>"+title+"</title></head><body>" + inf + "</BODY></HTML>";
	if (win)
	{
		if (!win.closed)
		{
    		win.document.close();
			win.document.write("" + inf + "");
		}
		else
		{
			win = window.open("", 'popup', 'width = 800, height = 600, resizable=1,scrollbars=1,location=0,status=0,menubar=0,directories=0,toolbar=0,titlebar=0');
			win.document.write("" + inf + "");
		}
	}
	else
	{
		win = window.open("", 'popup', 'width = 800, height = 600, resizable=1,scrollbars=1,location=0,status=0,menubar=0,directories=0,toolbar=0,titlebar=0');
		win.document.write("" + inf + "");
	}
	win.document.close();
	if((navigator.userAgent.toLowerCase().indexOf("opera")==-1)&&(navigator.userAgent.toLowerCase().indexOf("safari")==-1))
	{
	   win.document.location.reload();
	}
	win.focus();
}   

function displayHTML(inf,livesite,subject,subscribeto,linktext,sitename,readmoretext,usereadmore,readmoretruncate,moduletitle1,moduletitle2,moduletitle3,moduletitle4,moduletitle5,moduletitle6,closewindow,username,unsubscribealltext,compiledHTML,compiled)
{
	setLoremIpsum();
	
	if (subject=="")
	{
        subject=sitename + " / Lorem Ipsum";
    }
    else
    {
		subject = subject.replace(/\[title]/g, "Lorem Ipsum");
		subject = subject.replace(/\[sitename]/g, sitename);
		subject = subject.replace(/\[livesite]/g, livesite);		
		subject = subject.replace(/\[categoryname]/g, "Sample Category");
		subject = subject.replace(/\[senddate]/g, "1970-01-01");
		subject = subject.replace(/\[sendtime]/g, "12:00:00");                        		
    }
    
	if (compiled==1)
	{
		if (compiledHTML == "")
		{
			compiledHTML="<table bgcolor='#EEEEEE' width='100%'><tr><td><font size='-1'><strong>[title]</strong><font color='#555555'> (by [author], published [publishdatetime])</font><br><em>[introtext]</em><br>[bodytext]</font></td></tr></table><br>";
		}
		compiledHTML = compiledHTML.replace(/\[title]/g, "Lorem Ipsum [count]");	
		compiledHTML = compiledHTML.replace(/\[publishdatetime]/g, "1970-01-01 12:00:00");	
		compiledHTML = compiledHTML.replace(/\[author]/g, "Author");
		
        compiledHTML=truncateText(readmoretruncate,usereadmore,readmoretext,livesite,compiledHTML,false);		
        	
		var allcompiled = compiledHTML.replace(/\[count]/g, "1");
		allcompiled = allcompiled + compiledHTML.replace(/\[count]/g, "2");
		allcompiled = allcompiled + compiledHTML.replace(/\[count]/g, "3");
		allcompiled = allcompiled + compiledHTML.replace(/\[count]/g, "4");				
		inf = inf.replace(/\[bodytext]/g, allcompiled);	
        inf = inf.replace(/\[introtext]/g, "Lorem ipsum dolor sit amet");	
	}
	
	inf = inf.replace(/\[livesite]/g, livesite);
	inf = inf.replace(/\[sitename]/g, sitename);
	inf = inf.replace(/\[title]/g, "Lorem Ipsum");
	if (compiled==1)
	{
		inf = inf.replace(/\[publishdatetime]/g, "");
		inf = inf.replace(/\[author]/g, "");
	}
	else
	{
		inf = inf.replace(/\[publishdatetime]/g, "1970-01-01 12:00:00");
		inf = inf.replace(/\[author]/g, "Author");
	}

	inf=truncateText(readmoretruncate,usereadmore,readmoretext,livesite,inf,false);

	//inf = inf.replace(/\[bodytext]/g, LoremIpsum);
	//inf = inf.replace(/\[introtext]/g, "Lorem ipsum dolor sit amet");	
	inf = inf.replace(/\[moduletitle1]/g, moduletitle1);
	inf = inf.replace(/\[moduletitle2]/g, moduletitle2);
	inf = inf.replace(/\[moduletitle3]/g, moduletitle3);
	inf = inf.replace(/\[moduletitle4]/g, moduletitle4);
	inf = inf.replace(/\[moduletitle5]/g, moduletitle5);
	inf = inf.replace(/\[moduletitle6]/g, moduletitle6);

	inf = inf.replace(/\[modulecontent1]/g, LoremIpsumShort);
	inf = inf.replace(/\[modulecontent2]/g, LoremIpsumShort);
	inf = inf.replace(/\[modulecontent3]/g, LoremIpsumShort);
	inf = inf.replace(/\[modulecontent4]/g, LoremIpsumShort);
	inf = inf.replace(/\[modulecontent5]/g, LoremIpsumShort);
	inf = inf.replace(/\[modulecontent6]/g, LoremIpsumShort);    	
	inf = inf.replace(/\[subject]/g, subject);
	inf = inf.replace(/\[senddate]/g, "1970-01-01");
	inf = inf.replace(/\[sendtime]/g, "12:00:00");
	inf = inf.replace(/\[categoryname]/g, "Sample Category");
	inf = inf.replace(/\[username]/g, username);
	inf = inf.replace(/\[subscribeto]/g, subscribeto + "<br> <br>Sample Category 1<br>Sample Category 2<br>Sample Category 3<br>Sample Category 4");
	inf = inf.replace(/\[verifylink]/g, "<a target='_blank' href='" + livesite + "/index.php?option=com_vemod_news_mailer'>" + linktext + "</a>");
	inf = inf.replace(/\[unsubscribeall]/g, "<a target='_blank' href='" + livesite + "/index.php?option=com_vemod_news_mailer'>" + unsubscribealltext + "</a>");

	showFrame(inf,subject,closewindow);	
}

function truncateText(readmoretruncate,usereadmore,readmoretext,livesite,inf,text)
{
    setLoremIpsum();
	var LoremIpsumTrunc = LoremIpsum;
	if (readmoretruncate != "")
	{
		if (LoremIpsum.length > readmoretruncate)
		{
		    if (text)
		    {
                LoremIpsumTrunc = LoremIpsum.substring(0, readmoretruncate) + "...<br> <br>" + readmoretext + "<br>" + livesite + "/index.php?option=com_vemod_news_mailer";
            }
            else
            {
                LoremIpsumTrunc = LoremIpsum.substring(0, readmoretruncate) + "...<br> <br>" + '<a href="'+livesite + '/index.php?option=com_vemod_news_mailer" >' + readmoretext + '</a>';
            }
        }
    }
    if (usereadmore==0)
	{
	    inf = inf.replace(/\[introtext]/g, "Lorem ipsum dolor sit amet");
        inf = inf.replace(/\[bodytext]/g, LoremIpsum);    		
	}
	if (usereadmore==1)
	{
	    inf = inf.replace(/\[introtext]/g, "Lorem ipsum dolor sit amet");
	    inf = inf.replace(/\[bodytext]/g, LoremIpsumTrunc);
	}
	if (usereadmore==2)
	{
	    inf = inf.replace(/\[introtext]/g, LoremIpsumTrunc);
	    inf = inf.replace(/\[bodytext]/g, '');
	}
    return inf;    
}

function autolink(s) 
{  
      var urlRegex = /\b(((https?|ftp|irc|telnet|nntp|gopher|file):\/\/|(mailto|news|data):)[^\s\"<>\{\}\'\(\)]*)/g;
      return s.replace(urlRegex,function($1)
      {
        var link = arguments[0];
        return "<a href=\""+link+"\">"+link+"</a>";
      }
      );
}

function displayText(inf,livesite,subject,subscribeto,linktext,sitename,readmoretext,usereadmore,readmoretruncate,moduletitle1,moduletitle2,moduletitle3,moduletitle4,moduletitle5,moduletitle6,closewindow,username,unsubscribealltext,compiledtext,compiled)
{
	setLoremIpsum();       
	
	if (subject=="")
	{
        subject=sitename + " / Lorem Ipsum";
    }
    else
    {
		subject = subject.replace(/\[title]/g, "Lorem Ipsum");
		subject = subject.replace(/\[sitename]/g, sitename);
		subject = subject.replace(/\[livesite]/g, livesite);		
		subject = subject.replace(/\[categoryname]/g, "Sample Category");
		subject = subject.replace(/\[senddate]/g, "1970-01-01");
		subject = subject.replace(/\[sendtime]/g, "12:00:00");                        		
    }

	inf="<pre style='white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;white-space: pre-wrap;word-wrap: break-word;'>" + inf +
	"</pre>";

	if (compiled == 1)
	{
		if (compiledtext == "")
		{
			compiledtext = "[title] (by [author], published [publishdatetime])<br>[introtext]<br>[bodytext]<br>_______________________________________________________________<br> <br>";
		}
		compiledtext = compiledtext.replace(/\[title]/g, "Lorem Ipsum [count]");
		compiledtext = compiledtext.replace(/\[publishdatetime]/g, "1970-01-01 12:00:00");
		compiledtext = compiledtext.replace(/\[author]/g, "Author");
		compiledtext=truncateText(readmoretruncate,usereadmore,readmoretext,livesite,compiledtext,true);
		var allcompiled = compiledtext.replace(/\[count]/g, "1");
		allcompiled = allcompiled + compiledtext.replace(/\[count]/g, "2");
		allcompiled = allcompiled + compiledtext.replace(/\[count]/g, "3");
		allcompiled = allcompiled + compiledtext.replace(/\[count]/g, "4");
		inf = inf.replace(/\[bodytext]/g, allcompiled);
        inf = inf.replace(/\[introtext]/g, "Lorem ipsum dolor sit amet");		
	}

	inf = inf.replace(/\[livesite]/g, livesite);
	inf = inf.replace(/\[sitename]/g, sitename);
	inf = inf.replace(/\[title]/g, "Lorem Ipsum");
	if (compiled==1)
	{
		inf = inf.replace(/\[publishdatetime]/g, "");
		inf = inf.replace(/\[author]/g, "");
	}
	else
	{
		inf = inf.replace(/\[publishdatetime]/g, "1970-01-01 12:00:00");
		inf = inf.replace(/\[author]/g, "Author");
	}

    inf=truncateText(readmoretruncate,usereadmore,readmoretext,livesite,inf,true);

	//var nomodules="(no modules in plain text)";

	inf = inf.replace(/\[moduletitle1]/g, moduletitle1);
	inf = inf.replace(/\[moduletitle2]/g, moduletitle2);
	inf = inf.replace(/\[moduletitle3]/g, moduletitle3);
	inf = inf.replace(/\[moduletitle4]/g, moduletitle4);
	inf = inf.replace(/\[moduletitle5]/g, moduletitle5);
	inf = inf.replace(/\[moduletitle6]/g, moduletitle6);

	inf = inf.replace(/\[modulecontent1]/g, LoremIpsumShort);
	inf = inf.replace(/\[modulecontent2]/g, LoremIpsumShort);
	inf = inf.replace(/\[modulecontent3]/g, LoremIpsumShort);
	inf = inf.replace(/\[modulecontent4]/g, LoremIpsumShort);
	inf = inf.replace(/\[modulecontent5]/g, LoremIpsumShort);
	inf = inf.replace(/\[modulecontent6]/g, LoremIpsumShort);   

	inf = inf.replace(/\[subject]/g, subject);
	inf = inf.replace(/\[senddate]/g, "1970-01-01");
	inf = inf.replace(/\[sendtime]/g, "12:00:00");
	inf = inf.replace(/\[categoryname]/g, "Sample Category");
	inf = inf.replace(/\[username]/g, username);
	inf = inf.replace(/\[subscribeto]/g, subscribeto + "<br> <br>Sample Category 1<br>Sample Category 2<br>Sample Category 3<br>Sample Category 4");
	inf = inf.replace(/\[verifylink]/g, linktext + "<br>" + livesite + "/index.php?option=com_vemod_news_mailer");
	inf = inf.replace(/\[unsubscribeall]/g, unsubscribealltext  + "<br>" + livesite + "/index.php?option=com_vemod_news_mailer");
	
	inf=autolink(inf);

	showFrame(inf,subject,closewindow);	
}

function displayResult(inf)
{
	inf="<span style='font-family: Verdana;'>" + inf + "</span>";
	
	showFrame(inf,'Results','Close');	
}

function displayNewsletter(inf,title,close)
{
    if (inf.substr(0,5).toLowerCase()=='<pre>')
    {
        inf=autolink(inf);
    }
	showFrame(inf,title,close);
}

    
<?php
if ($popupstyle==1)
{
    ?>   
    function showFrame(inf,title,close)
    {
        showwindow(inf,title);

    }
    <?php
}
else
{
    ?>

    function showFrame(inf,title,close)
    {
        if (olderBrowser)
        {
            showwindow(inf,title);
            return;
        }
        
        var body1=document.body.firstChild; 
        if (body1)
        {    
            //alert(body1.id);
            var body1id=body1.id;
            if (body1id!='borderdiv')
            {
                //alert('moving');
                document.body.insertBefore(document.getElementById('borderdiv'),body1);
                document.body.insertBefore(document.getElementById('framediv'),body1);
            }
        }
        
        var previewframe=window.frames['previewframe'];
        if (previewframe)
        {
            previewframe.document.open();
            previewframe.document.write(""+inf+"");
            previewframe.document.close();
        }
        var alternativediv=document.getElementById('alternativediv');
        if (alternativediv)
        {
            alternativediv.innerHTML=inf;
        }
        document.getElementById('closediv').innerHTML='<table width="100%" height="14" cellpadding="0" cellspacing="0"><tr><td align="left"><div style="float:left;font: bold 13px arial;"> '+title+'</div></td><td align="right"><div style="float:right;font: bold 13px arial;" align="right"><a style="font: bold 13px arial;" href="javascript:closeFrame();">'+close+' <img src="<?php echo JURI::root(); ?>/components/com_vemod_news_mailer/publish_x.png" border="0"/></a><div></td></tr></table>';           
        document.getElementById('borderdiv').style.visibility="visible";
        document.getElementById('framediv').style.visibility="visible";
        document.getElementById('borderdiv').style.position="absolute";
        document.getElementById('borderdiv').style.position="fixed";               
        
        if (previewframe)
        {
            if((navigator.userAgent.toLowerCase().indexOf("opera")==-1)&&(navigator.userAgent.toLowerCase().indexOf("safari")==-1))
            {
                previewframe.document.location.reload();
            }
        }
    }
    <?php
}
?>
    olderBrowser=true;
    -->
    </script>

    <?php
    if ($popupstyle==0)
    {
        ?>
        
        <!--[if gt IE 6]><!-->  
        <SCRIPT LANGUAGE="JavaScript">
<!--
        olderBrowser=false;
    -->
    </script>
                    
            <div id="framediv" name="framediv" STYLE="position: fixed; top: 50%;left: 50%;width: 800px;height: 624px;margin-top: -324px;margin-left: -400px;background: #ffffff;z-index: 19002;color: #336699;border: 4px solid #336699;text-align: left;visibility: hidden;">        
                    <div name="closediv" id="closediv" STYLE="position: relative; top: 0;left: 0;width: 790px;height: 14px;background-color: #EEEEEE;layer-background-color: #EEEEEE;border: 5px solid #EEEEEE;"></div>
                    <IFRAME NAME="previewframe" ID="previewframe" frameborder="0" STYLE="position: relative; top: 24;left: 0;width: 800px;height: 600px;clear: both;border: none;margin-bottom: -1px;margin-top: 1px;_margin-bottom: 1px;" SRC="components/com_vemod_news_mailer/index.html"><div id="alternativediv" STYLE="position: relative; top: 24;left: 0;width: 800px;height: 600px;clear: both;border: none;margin-bottom: -1px;margin-top: 1px;_margin-bottom: 1px;"></div></IFRAME>
            </div>		
                    
            <div id="borderdiv" name="borderdiv" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;visibility: hidden;z-index: 19000;top: 0px;left: 0px;background-color: #000;filter:alpha(opacity=60);-moz-opacity: 0.6;opacity: 0.6;" onclick="closeFrame();"></div>
        <![endif]-->      
<?php
    }

}

?>          	