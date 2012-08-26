<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SmallTalk</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script>
		  window.fbAsyncInit = function() {
			FB.init({
			  appId      : '274212992687423', // App ID
			  channelUrl : '//dry-brushlands-2494.herokuapp.com/channel.html', // Channel File
			  status     : true, // check login status
			  cookie     : true, // enable cookies to allow the server to access the session
			  xfbml      : true  // parse XFBML
			});

			// Additional initialization code here
		  };

		  // Load the SDK Asynchronously
		  (function(d){
			 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			 if (d.getElementById(id)) {return;}
			 js = d.createElement('script'); js.id = id; js.async = true;
			 js.src = "//connect.facebook.net/en_US/all.js";
			 ref.parentNode.insertBefore(js, ref);
		   }(document));
		</script>
		
	</head>
	<body>
		<div class="hero-unit">
			<h1>SmallTalk</h1>
			<p>SmallTalk lets you to chat more meaningfully with your Facebook Friends by informing you of the latest news on their favourite topics.</p>
			<p>
				<a class="btn btn-primary btn-large" href="pureserver.php">
				Try Small Talk
				</a>
				<div id="fb-root"></div>
				<fb:login-button show-faces="true" width="200" max-rows="1" perms="user_likes, friends_likes"></fb:login-button>
			</p>
		</div>
	</body>
</html>
