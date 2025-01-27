<?php
$metaDescription = "{$resume->basics->name} is an web designer and developer that specializes in online media and can handle any variety of technical and design tasks.";
$metaImage = 'https://colemarshall.net/images/ColeMarshall_landscape.jpg';
$metaThemeColor = '#506358';
?>
		<meta charset='utf-8'>
		<meta content='width=device-width, initial-scale=1' name='viewport'>
		<meta name='description' content='<?php echo $metaDescription; ?>'>
		<meta name='color-scheme' content='light dark'>
		<meta name='theme-color' content='<?php echo $metaThemeColor; ?>'>
		<meta name='theme-color' media='(prefers-color-scheme: light)' content='<?php echo $metaThemeColor; ?>'>
		<meta name='theme-color' media='(prefers-color-scheme: dark)' content='<?php echo $metaThemeColor; ?>'>
		<meta name='format-detection' content='telephone=no,date=no,address=no'>
		<meta property='image' content='<?php echo $metaImage; ?>'>
		<meta property='og:url' content='https://colemarshall.net/'>
		<meta property='og:site_name' content='<?php echo $resume->basics->name; ?>'>
		<meta property='og:title' content='<?php echo $resume->basics->name . ' - ' . $resume->basics->label; ?>'>
		<meta property='og:image' content='<?php echo $metaImage; ?>'>
		<meta property='og:image:secure_url' content='<?php echo $metaImage; ?>'>
		<meta property='og:type' content='website'>
		<meta name='twitter:site_name' content='<?php echo $resume->basics->name; ?>'>
		<meta name='twitter:title' content='<?php echo $resume->basics->name; ?>'>
		<meta name='twitter:card' content='summary'>
		<meta name='twitter:image' content='<?php echo $metaImage; ?>'>
		<link rel='icon' type='image/svg+xml' href='/images/favicon.svg'>
		<link rel='alternate icon' href='/images/favicon.ico'>
		<link rel='canonical' href='https://colemarshall.net/'>
		<link href='/style/style.css' rel='stylesheet'>
		<link href='/style/fa/css/all.min.css' rel='stylesheet'>
		<link rel='preconnect' href='https://unpkg.com'>
		<link rel='dns-prefetch' href='https://unpkg.com'>
		<script async src='https://www.googletagmanager.com/gtag/js?id=G-CS0EQ8NM2D'></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			
			gtag('config', 'G-CS0EQ8NM2D');
		</script>