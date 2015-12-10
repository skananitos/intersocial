<link rel="stylesheet" href="style.css" type="text/css">
<?php


/* n RESULTS PER PAGE (FOR PAGINATION) */
$max_results_per_page = 10;

//The number of tweets to return per page, up to a max of 100
$max_twitter_results = 50;

//The number of facebook posts to return per page, up to a max of 100
$max_facebook_results = 50;

session_start();


if(!isset($_GET["page"])) $_GET["page"] = 1;


$accessToken = file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=220940381386560&client_secret=5934b5ba7b1cde2f095807528d258efa&grant_type=client_credentials");

/* FACEBOOK */
$keyword = $_GET['keyword'];
$keyword2 = str_replace(" ", "+", $keyword);
$graph_url = "https://graph.facebook.com/search?";
$graph_url .= "&type=post";
$graph_url .= "&q=$keyword2";
$graph_url .= "&access_token=$accessToken";
$graph_url .= "&limit=$max_facebook_results";


$allresults = array();


$count = 0 ; 

 if (isset($_GET['Facebook']))
{

	require('fb.php');
	

}



/* TWITTER */
$srchterm = $_GET['keyword'];
$srchterm2 = str_replace(" ", "+", $keyword);
$twit_url = "https://api.twitter.com/1.1/search/tweets.json?";
$twit_url .= "q=$srchterm2";
$twit_url .= "&count=$max_twitter_results";

if (isset($_GET['Twitter']))
{
	require_once("twitteroauth/twitteroauth.php"); //Path to twitteroauth library
	
	$search = "@$srchterm2 OR $srchterm2";
	$notweets = 50;
	$consumerkey = "OWR61p7EGPtqIil6eRvw";
	$consumersecret = "teL1FdIiymeXGzeGjYPrfJdbk5iBIpjWVoaVaXGzk8";
	$accesstoken = "306643553-tpXtmooEJSdsQyF7Plw3obK8elnSomJ9n0Iy03GU";
	$accesstokensecret = "nHJavsgpqoTIqZdd10hO618xsYK1CXnepsLwImsnU";
	
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
		$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
		return $connection;
	}
	 
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
	
	$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=".$search."&count=".$notweets);
	
	$tmp = json_encode($tweets);
	//print_r(json_encode($tweets)); die();
	
	$res= json_decode($tmp, true);


foreach ($res['statuses'] as $results2) {
     
	$myresult['date'] =  "Posted on " .  date("d F Y H:i:s", strtotime($results2['created_at'])) . " under Twitter" ;
	$myresult['timestamp'] = strtotime($results2['created_at']);
	$myresult['username'] = $results2['user']['name'] ;
	$myresult['message'] = $results2['text'] ;
	$myresult['profileImage'] = $results2['user']['profile_image_url'];
	$myresult['from'] = 'images/twitter.png';
	$myresult['profileLink'] = 'http://www.twitter.com/' .$results2['user']['name'] ;
	$allresults[]=$myresult;
	
}

}


function cmp($a, $b)
{
    if ($a['timestamp'] == $b['timestamp']) {
        return 0;
    }
    return ($a['timestamp'] < $b['timestamp']) ? 1 : -1;
}
usort($allresults, 'cmp');


/* PAGINATION */
$pages_num = ceil(count($allresults) / $max_results_per_page); 
if($pages_num > 0) echo "<br /><center>Page | ";

for($j=1; $j<=$pages_num; $j++)
{
	echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?";
	if (isset($_GET['Facebook'])) echo "&Facebook=" . $_GET['Facebook'];
	if (isset($_GET['Twitter'])) echo "&Twitter=" . $_GET['Twitter'];
	if (isset($_GET['keyword'])) echo "&keyword=" . $_GET['keyword'];
	echo "&page=$j\">". $j . "</a> | ";
}

echo "</center>";

$last_result = $_GET["page"] * $max_results_per_page;
$first_result = $last_result - $max_results_per_page + 1;
if ($first_result < 1) $first_result = 1;
if ($last_result > count($allresults)) $last_result = count($allresults);


/* PRINT RESULTS */

$i = 0;
foreach ($allresults as $smallarray )  { 
$i++;

	if ($i >= $first_result && $i <= $last_result) {
		
		?> 
	
	   <article class='post'>
	    <header>
	     <h2>
	<? if (isset ($smallarray['profileImage']) ) {?>
	   <img class='profileImg' width='50'  border='0' align='left' src='<?=$smallarray['profileImage']?>' />
	<? } else{ ?>
	   <img class='profileImg' width='50'  border='0' align='left' src='images/userphoto.jpg' />
	<? } ?>
	   <a href="<?=$smallarray['profileLink']?>"> <?=$smallarray['username']?></a>
	   </h2>
	   <span class='articlemeta'><?= $smallarray['date']?></span>
	
	<img width='30' height='28' border='0' align='right' src='<?= $smallarray['from'] ?>'/>
	
	</header>
	<div class='entry'><p><?= $smallarray['message'] ?></p></div>
	</article>
	<?php
	} 
}

?>
