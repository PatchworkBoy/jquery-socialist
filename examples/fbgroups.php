<?php
	// Facebook Groups and Twitter Hashtags... 
	// Get the Group ID for the Facebook group whose
	// wall feed you want to integrate from http://wallflux.com/facebook_id/
	
	
	// You'll need the Facebook PHP SDK...
	// Clone it from https://github.com/facebook/facebook-php-sdk
	require_once('../facebook-php-sdk/src/facebook.php');
	
	// Register a Facebook Web App at https://developers.facebook.com/apps
	// and replace YOUR_FB_APP_ID and YOUR_FB_SECRET
	$config = array();
	$config['appId'] = 'YOUR_FB_APP_ID';
	$config['secret'] = 'YOUR_FB_SECRET';
	$config['fileUpload'] = false; // optional
    $app_token_url = "https://graph.facebook.com/oauth/access_token?"
        . "client_id=" . $config['appId']
        . "&client_secret=" . $config['secret'] 
        . "&grant_type=client_credentials";

    $response = file_get_contents($app_token_url);
    $params = null;
    parse_str($response, $params);
	// AppToken now stored in $params['access_token']
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link href="js/socialist/jquery.socialist.css" rel="stylesheet" />
	</head>
	<body>
		<div>
			<h1>FB Group & Twitter Hashtag Support</h1>
			<p>Get the Group ID for the Facebook group whose wall feed you want to integrate from <a href="http://wallflux.com/facebook_id/">WallFlux</a> and provide this for the network id within Socialist's call in $(document).ready()</p>
			<p>Clone the Facebook PHP-SDK from <a href="https://github.com/facebook/facebook-php-sdk">GitHub</a></p>
			<p>Register a Facebook WebApp at <a href="https://developers.facebook.com/apps">developers.facebook.com</a> and replace YOUR_FB_APP_ID and YOUR_FB_SECRET</p>
			<p>Upload n' go!</p>
		</div>
	    <div id="content"></div>
	    <script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.1.1.min.js"></script>
		<script src="../jquery.socialist.js"></script>
		<script>
		;(function($, window, undefined) {
			$(document).ready(function() {
				$('#content').socialist({
				        networks: [
				            {name:'fbgroup',id:'294816410624169',authtoken:'<?=$params['access_token'];?>'},
				            {name:'hashtag',id:'madeinwakefield'}
				           ],
				        isotope:true,
				        maxResults:30,
				        textLength:800,
				        random:true,
				        fields:['source','heading','text','date','image','followers','likes']
			    });
			});
		})(jQuery, this);
			
		</script>
	</body>
</html>