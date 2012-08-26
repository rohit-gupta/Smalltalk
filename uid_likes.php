<?php
$uid=$_REQUEST['uid'];
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
    $user_movies = $facebook->api('/'.$uid.'/movies');
  } catch (FacebookApiException $e) {
    $user = null;
  }
}
?>
    <div class="well clearfix">
	<img src="https://graph.facebook.com/<?php echo $uid;?>/picture?type=large" class="img-polaroid pull-left"/>
    </div>
<?php
if($user_movies)
{
	/*
	foreach( $user_movies['data'] as $movie)
	{
		$genres_list=genres($movie['name']);
		foreach($genres_list as $genre)
		{
			if(!isset($pref[$genre]))
				$pref[$genre]=1;
			else
				$pref[$genre]+=1;
		}	
	}*/
}
