<!doctype html>

<html lang="en-US">
<head>
<meta charset="UTF-8" />
<meta http-equiv="content-type" content="text/html; charset=US-ASCII" />
<meta http-equiv="content-language" content="en-us" />
<meta name="author" content="Intersocial Project" />
<meta name="copyright" content="Copyright (c)2011-2013 Intersocial. All Rights Reserved." />
<meta name="description" content="Monitoring Tools" />
<meta name="keywords" content="intersocial, interreg, social media, monitoring tool" />

<title>INTERSOCIAL | Monitoring </title>

<link href="style.css" rel="stylesheet" type="text/css">
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if IE 6]>
<script src="js/belatedPNG.js"></script>
<script>
	DD_belatedPNG.fix('*');
</script>
<![endif]-->

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>

<script type="text/javascript" src="https://raw.github.com/jquery/jquery-tmpl/master/jquery.tmpl.min.js"></script>

</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="wrap">
<section id="left">
	<header id="mainheader">
	<img src="images/logo.jpg" width="250" height="120" alt="CleanRed | Free CSS Template"> 
    <h1 id="sitename">Inter-social.eu- Welcome to Intersocial's Monitoring Tools Page</h1>
    </header>
    <nav id="mainnav">
		<ul>
        	<li class="current"><a href="index.php">Home</a></li>
            <li><a href="about.html">Intersocial</a></li>
            <li><a href="monitoring.html">About Monitoring</a></li>
            
        </ul>
	</nav>

	
    
    <section id="sidebar">
    <div class="sb-block">
    <a href="http://www.inter-social.eu" target="_blank" onmouseover="this.style.opacity=0.8" onmouseout="this.style.opacity=1";><img src="images/final-logo.png" width="182" height="174" alt="Intersocial"></a> 
    </div>
    
    <div class="sb-block">
    <h2>Stay Social with INTERSOCIAL</h2>

</div>
    
    
    
   
    </section>
</section>

<section id="right">
	<header id="pageheader">
   		<div id="intro">
        	<div id="introwrap">
            <h2>Hello there,</h2>
            <p>INTERSOCIAL Monitoring is a Facebook and Twitter specific search engine, built upon Facebook's and Twitter's publicly available APIs, which are enabled to search for specific keywords/texts on the Timelines of Facebook and Twitter subscribers which they had denoted as being "Public".</p>
            </div>
                    <a class="resume">Download Resume</a>

        </div>
    </header>
	
	<?php
	//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	date_default_timezone_set('UTC');
	
      	$fbchecked = 'checked=yes';$twchecked = 'checked=yes';
	  if (isset($_GET['keyword'])) { 
	       $fbchecked = ''; $twchecked = '';
	       if (isset($_GET['Facebook'])) $fbchecked = 'checked=yes';
	       if (isset($_GET['Twitter']))  $twchecked = 'checked=yes';
	  } 
	?>
<form id="socialSearch" action="#" method="get">
<div id="SelectOptions">
Search in <input name="Facebook" id="Facebook" value="Facebook" type="checkbox" <?=$fbchecked;?>" /> <label for="Facebook">Facebook</label>
<input name="Twitter" id="Twitter" value="Twitter" type="checkbox" <?=$twchecked?>  /> <label for="Twitter">Twitter</label> <br><br>
Please type your keyword: 
</div>
  
    
	  <div id="bgTbxSearch">  <input id="tbxSearch" value="<?php if (isset($_GET['keyword'])) {echo $_GET['keyword']; }?>" type="text" name="keyword" style="width:580px; height:30px"> </div>
	    <input id="btnSearch" type="submit" value="" />
    </form>
<div class="clear"></div>
    <section id="contents">
    <section id="normalcontents">
   
<?php

if (isset($_GET['keyword']))
{
   include('search.php');
   
}
?>
    
      
    </section>
   
    
    <div class="clear"></div>
    </section>
</section>
<div class="clear"></div>
</div>
<footer id="pagefooter">

<div id="footerwrap">

<div id="about">

<h2>About</h2>
<div class="myphoto">


  <img src="images/logo2.jpg" width="80" height="130" alt="intersocial"></div>
<div class="about-text">
<p>

The Intersocial project aims at exploring social networking to enhance the competitiveness of SMEs 
in the region. Social networks offer new means and forums for world-wide product 
promotion as well as huge repositories of data for advanced market analysis and 
trend identification.&nbsp; <a href="about.html"> Read More </a></p>

</div>
</div>
<div id="services">
<img border="0" src="http://dmod.eu/intersocial/images/transparent-logo-1.gif" width="201" height="165">
<br><img border="0" src="http://dmod.eu/intersocial/images/transparent-logo-2.gif" width="201" height="165">
<p>&nbsp;</div>
<div id="tools">
<h2>Social Media &amp; SMEs</h2>
<ul>

	<li>Assess overall sentiment</li>
    <li>Target new stakeholders</li>
    <li>Identify SME's champions</li>
    <li>Identify SME's critics</li>
    <li>Audit SME's efforts</li>
    <li>Study the success stories</li>
	<li>Identify new product opportunities</li>
	<li>Identify donors or lower costs</li>
	<li>Keep tabs on competitors</li>
	<li>Improve SME's campaigns</li>
</ul>
</div>
<div class="clear"></div>
</div>
<div id="credits">
2011-2013 &copy; <a href="http://www.inter-social.eu/" target="_blank">Intersocial Project</a>  | Free CSS Template By CSSHeaven.org </div>
</footer>
</body>
</html>
