<?php

require_once("fb/facebook.php");

date_default_timezone_set('Europe/Oslo');

$config = array();
$config['appId'] = '220940381386560';
$config['secret'] = '5934b5ba7b1cde2f095807528d258efa';

$facebook = new Facebook($config);
$user_id = $facebook->getUser();

    if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {
      	$ret_obj = $facebook->api('/search?q='.$keyword2.'&type=post');
      		//echo '<pre>Name: ' . $ret_obj['data'][0]['from']['name'] . $ret_obj['data'][0]['message'] . '</pre><br />'; //this was converted to foreach
        foreach ($ret_obj['data'] as $i => $data){
       		//echo '<pre>' . $data['from']['name'] . $data['from']['id'] . $data['message'] . date("d F Y H:i:s", strtotime($data['created_time'])) . '</pre><br />'; //template echo
       		if(!empty($data['message'])){
	       		$myresult['date'] =  "Posted on " . date("d F Y H:i:s", strtotime($data['created_time'])) . " under Facebook" ;
	       		$myresult['timestamp'] = strtotime($data['created_time']);
	       		$myresult['username'] =$data['from']['name'] ;
	       		$myresult['message'] = substr_with_ellipsis($data['message']) ;
	       		$myresult['profileImage'] = 'https://graph.facebook.com/'.$data['from']['id'].'/picture' ;
	       		$myresult['from'] = 'images/fb.png';
	       		$myresult['profileLink'] = 'https://www.facebook.com/' .$data['from']['id'];
       		}
       		
       		@$allresults[]=$myresult;
        }
        
      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl(); 
        echo 'In order to use the Facebook search fetaure you need to <a href="' . $login_url . '">login</a> to your account first.';
        error_log($e->getType());
        error_log($e->getMessage());
        echo $e->getType();
        echo $e->getMessage();
      }   
    } else {

      // No user, so print a link for the user to login
      $login_url = $facebook->getLoginUrl();
      echo 'In order to use the Facebook search fetaure you need to <a href="' . $login_url . '">login</a> to your account first.';

    }

    
    function substr_with_ellipsis($string, $chars = 500)
    {
    	if(strlen($string) <= $chars) return $string; else return substr($string, 0, $chars) . "...";
    }
  ?>
