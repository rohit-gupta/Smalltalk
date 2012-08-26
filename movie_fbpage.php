<?php
$movie_name=urlencode($_REQUEST['movie_name']);
require 'sdk/src/facebook.php';
$facebook = new Facebook(array(
  'appId'  => '274212992687423',
  'secret' => 'dd0d7a1f4d7060f3792d97e343989af5',
));
// See if there is a user from a cookie
$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_movies = $facebook->api('/search?q='.$movie_name.'&type=page');  
  } catch (FacebookApiException $e) {
    $user = null;
  }
}
if($user_movies)
{
		echo '<img src="https://graph.facebook.com/'.$user_movies['data'][0]['id'].'/picture?type=normal"/>'.'<br/>';
		echo $_REQUEST['movie_name'].'<br />';
}
