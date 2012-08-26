<?php
require('genrefrommovie.php');
require('getsports.php');
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
	$user_name = $facebook->api('/'.$uid);
	$user_atheletes = $user_name['favorite_athletes'];
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
	$movie_recommendations=genres($user_movies['data']);
	if($movie_recommendations!=-1)
	{
		$k=0;
		echo '<div class="well clearfix">';
		echo '<div>';
		echo $user_name['name'].'\'s most watched genre is:'.end($movie_recommendations);
		echo '<br/> Some movies you have seen that '.$user_name['first_name'].' might find interesting are:';
		echo '</div>';
		foreach($movie_recommendations as $movie)
		{
			if($movie == end($movie_recommendations)||$k>8)
			break;
			$movie_page=$facebook->api('/search?q='.urlencode($movie).'&type=page');
			echo '<div class="img-polaroid pull-left">';
			echo '<img class="img-polaroid pull-left" src="https://graph.facebook.com/'.$movie_page['data'][0]['id'].'/picture?type=square"/>';
			echo $movie;
			echo '</div>';
			$k++;
		}
		echo '</div>';
	}
}
	echo $user_name['name']."'s favourite sport: <span id='sport-text'><b>".get_sport($user_atheletes)."</b></span>";
?>
