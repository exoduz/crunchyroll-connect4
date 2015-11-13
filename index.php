<?
	require_once('classes/ConnectFour.php');
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>CrunchyRoll Connect 4</title>
	
	<meta name="description" content="CrunchyRoll Connect 4" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<link rel="shortcut icon" href="/img/logo/favicon.ico" type="image/png" />	
	<link rel="apple-touch-icon" href="crunchyroll-ios.png" />
	
	<link rel="stylesheet" href="/css/normalize.css" />
	<link rel="stylesheet" href="/css/bootstrap.css" />
	<link rel="stylesheet" href="/css/style.css" />
	<script src="/js/modernizr-2.6.2.min.js"></script>
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="/js/html5shiv/html5shiv.js"></script>
		<script src="/js/respond/respond.min.js"></script>
	<![endif]-->
</head>
<body>
    <!--[if lt IE 10]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Static navbar -->
	<header>
		<div class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="/"><img src="/img/logo/crunchyroll-logo.png" alt="CrunchyRoll Logo" class="logo"></a>
				</div>
			</div>
		</div>
	</header>

	<section class="container">
		<h1 class="text-center">Connect 4</h1>
		<p class="text-center">
			Player 1 = <strong>x</strong><br />
			Player 2 = <strong>o</strong>
		</p>

		<div class="text-center">
			<? $game_start = new ConnectFour(); ?>
		</div><!-- .text-center -->

	</section> <!-- /container -->

	<footer class="footer">
		<div class="container">
			<p>Made for <a href="http://crunchyroll.com" target="_blank">CrunchyRoll</a></p>
		</div><!-- .container -->
	</footer><!-- .footer -->
	
    <script src="/js/init.js"></script>
</script>
</body>
</html>
