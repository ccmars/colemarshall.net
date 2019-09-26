<?php
$metaDescription = "{$resume->basics->name} is an interactive designer and developer that specializes in online media and can handle any variety of technical and design tasks.";
$metaImage = "http://colemarshall.net/images/ColeMarshall_landscape.jpg";
$metaImageSecure = "https://colemarshall.net/images/ColeMarshall_landscape.jpg";
?>
		<meta charset='utf-8'>
		<meta content='width=device-width, initial-scale=1' name='viewport'>
		<meta name='description' content='<?php echo $metaDescription; ?>'>
		<meta property='image' content='<?php echo $metaImage; ?>'>
		<meta property='og:url' content='https://colemarshall.net/'>
		<meta property='og:site_name' content='<?php echo $resume->basics->name; ?>'>
		<meta property='og:title' content='<?php echo $resume->basics->name . ' - ' . $resume->basics->label; ?>'>
		<meta property='og:image' content='<?php echo $metaImage; ?>'>
		<meta property='og:image:secure_url' content='<?php echo $metaImageSecure; ?>'>
		<meta property='og:type' content='website'>
		<meta name='twitter:site_name' content='<?php echo $resume->basics->name; ?>'>
		<meta name='twitter:title' content='<?php echo $resume->basics->name; ?>'>
		<meta name='twitter:card' content='summary'>
		<meta name='twitter:image' content='<?php echo $metaImageSecure; ?>'>
		<meta http-equiv='x-ua-compatible' content='ie=edge'>
		<meta name='theme-color' content='#506358'>
		<meta name='msapplication-navbutton-color' content='#506358'>
		<meta name='apple-mobile-web-app-status-bar-style' content='#506358'>
		<link href='/style/style.css' rel='stylesheet'>
		<script src="https://kit.fontawesome.com/39da7367fb.js"></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='/includes/svgInject/jquery.svgInject.js'></script>
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-148798504-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			
			gtag('config', 'UA-148798504-1');
		</script>