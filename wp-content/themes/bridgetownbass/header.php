<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]--> 
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]--> 
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]--> 
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]--> 
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->
	<head>
		<title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"><!--TODO Come back to this for Responsive-->
		<meta name="google" value="notranslate" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico"/>
		<link href='http://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"  ></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/js.js"  ></script>
		<link rel="shortcut icon" href="favicon.ico"> <link rel="shortcut icon" href="favicon.gif">
		
		<?php wp_head(); ?>
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-28531109-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
	</head>
	<body <?php body_class(); ?>>
		<div id="cover"></div>
		<div class="fixed"></div>
		<header>
			<img src="<?php echo get_template_directory_uri(); ?>/images/btbheaderlogo2_11.gif" width="498" height="447" alt="Btbheaderlogo2" class="logo">
			<h1>
				<!--<a href="<?php// echo home_url(); ?>"><span id="bridge">BRIDGE</span></br><span id="town">TOWN</span></br><span id="bass">BASS</span></a>-->
				<a href="<?php // echo home_url(); ?>">BRIDGETOWNBASS</a>
			</h1>
			<?php wp_nav_menu('primary'); ?>
		</header>
		<section>