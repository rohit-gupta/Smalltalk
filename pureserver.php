<?php

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
    $user_friends = $facebook->api('/me/friends');
  } catch (FacebookApiException $e) {
    echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
    $user = null;
  }
}

?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<title>SmallTalk</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="javascript/jquery-1.7.1.min.js"></script>
		<style type="text/css">
		</style>
	</head>
  <body style="margin:0;">
	    <div class="container-fluid">
			<div class="row-fluid">
				<div class="span2" style="overflow:auto; height:650px; position:relative;">
				<!--Sidebar content-->
					<div style="position:relative;">
						<?php 
						if ($user_friends) { 
							//$count=0; 
							foreach($user_friends['data'] as $friend) {
								//if($count>15)
								//break;
						?>
							<div style=" cursor:pointer; background-image:url('https://graph.facebook.com/<?php echo $friend['id'];?>/picture'); width:50px; height:50px; float:left; padding:0;" class="btn" onClick="getFriends('<?php echo $friend['id'];?>')"></div>
							<div style="width:100px; height:50px; padding:0; float:left;" onClick="getFriends('<?php echo $friend['id'];?>')" class="btn" ><?php echo $friend['name'];?></div>
							<div style="position:absolute; left:150px; right:0; top:<?php echo $count*52?>px; height:52px;"><i style="font-size:20px;margin-top:15px; margin-left:5px; cursor:pointer;" onClick="getFriends('<?php echo $friend['id'];?>')" class="icon-chevron-right"></i></div>
						<?php $count++;}?>
					</div>
				</div>
			
				<div class="span10">
				<!--Body content-->
				<div id="friend-photo"></div>
				<div id="friend-news"></div>
				<span id="friend-likes"></span>
				</div>
			</div>
		</div>
	 <?php } else { ?>
      <fb:login-button scope="user_likes,friends_likes,user_online_presence,friends_online_presence,friends_work_history"></fb:login-button>
    <?php } ?>

	
    <div id="fb-root"></div>
    <script>               
      window.fbAsyncInit = function() {
        FB.init({
          appId: '<?php echo $facebook->getAppID() ?>', 
          cookie: true, 
          xfbml: true,
          oauth: true
        });
        FB.Event.subscribe('auth.login', function(response) {
          window.location.reload();
        });
        FB.Event.subscribe('auth.logout', function(response) {
          window.location.reload();
        });
      };
      (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
	<script>
		function getFriends(friend_id){
			FB.api('/'+friend_id+'/likes', function(likes_response) { 
				var i=0;
				console.log(likes_response);
				if(likes_response.data[i])
				/*while(likes_response.data[i])
				{
					document.getElementById('friend-likes').innerHTML+=','+likes_response.data[i].name;
					i++;
			    }*/
				$.get("uid_likes.php", { uid: friend_id},function(resp) {
					document.getElementById('friend-photo').innerHTML=" "; document.getElementById('friend-photo').innerHTML+=resp;
				
					$.get("getnews.php", { q: $("#sport-text").html() },function(data) {
						var retObj=JSON.parse(data);
						var resultArr=retObj.query.results.bossresponse.news.results.result;
						//var dispTxt='<a target="_blank" href="'+resultArr[0].url+'>'+resultArr[0].title+'</a><p>resultArr[0].abstract</p>"';
						//$("#sport-text").append('<a target="_blank" href="'+resultArr[0].url+'>'+resultArr[0].title+'</a><p>resultArr[0].abstract</p>"');
						document.getElementById('friend-news').innerHTML='<a target="_blank" href="'+resultArr[0].url+'">'+resultArr[0].title+'</a><p>'+resultArr[0].abstract+'</p>';
						//document.getElementById('friend-news').innerHTML=dispTxt;
					});
				});
			});
		}
	</script>
	</body>
</html>
