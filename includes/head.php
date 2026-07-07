<?php

/**
 * Shared <head> contents. Expects:
 *   $resume - decoded resume data (see loadResume())
 *   $page   - [
 *     'title'         => document/social title,
 *     'description'   => meta description,
 *     'canonicalPath' => path beginning with '/',
 *     'ogType'        => OpenGraph type, defaults to 'website',
 *   ]
 */

$pageTitle = $page['title'];
$pageDescription = $page['description'];
$canonicalUrl = SITE_URL . $page['canonicalPath'];
$ogType = $page['ogType'] ?? 'website';
?>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<title><?php echo e($pageTitle); ?></title>
		<meta name='description' content='<?php echo e($pageDescription); ?>'>
		<meta name='author' content='<?php echo e($resume->basics->name); ?>'>
		<meta name='color-scheme' content='light dark'>
		<meta name='theme-color' media='(prefers-color-scheme: light)' content='<?php echo THEME_COLOR_LIGHT; ?>'>
		<meta name='theme-color' media='(prefers-color-scheme: dark)' content='<?php echo THEME_COLOR_DARK; ?>'>
		<meta name='format-detection' content='telephone=no,date=no,address=no'>
		<link rel='canonical' href='<?php echo e($canonicalUrl); ?>'>
		<link rel='icon' href='/favicon.ico' sizes='32x32'>
		<link rel='icon' type='image/svg+xml' href='/images/favicon.svg'>
		<meta property='og:url' content='<?php echo e($canonicalUrl); ?>'>
		<meta property='og:site_name' content='<?php echo e($resume->basics->name); ?>'>
		<meta property='og:title' content='<?php echo e($pageTitle); ?>'>
		<meta property='og:description' content='<?php echo e($pageDescription); ?>'>
		<meta property='og:image' content='<?php echo e(META_IMAGE_URL); ?>'>
		<meta property='og:type' content='<?php echo e($ogType); ?>'>
		<meta name='twitter:card' content='summary_large_image'>
		<meta name='twitter:title' content='<?php echo e($pageTitle); ?>'>
		<meta name='twitter:description' content='<?php echo e($pageDescription); ?>'>
		<meta name='twitter:image' content='<?php echo e(META_IMAGE_URL); ?>'>
		<link rel='preload' href='/style/fonts/oswald-variable.woff2' as='font' type='font/woff2' crossorigin>
		<link rel='preload' href='/style/fonts/catamaran-variable.woff2' as='font' type='font/woff2' crossorigin>
		<script>
			/* Apply any saved theme override before first paint */
			try {
				const savedTheme = localStorage.getItem('theme');
				if (savedTheme === 'light' || savedTheme === 'dark') {
					document.documentElement.dataset.theme = savedTheme;
				}
			} catch (storageError) {}
		</script>
		<link rel='stylesheet' href='/style/main.css?v=<?php echo ASSET_VERSION; ?>'>
		<script defer src='/scripts/theme.js?v=<?php echo ASSET_VERSION; ?>'></script>
		<script type='application/ld+json'><?php echo json_encode(personSchema($resume), JSON_UNESCAPED_SLASHES); ?></script>
		<script async src='https://www.googletagmanager.com/gtag/js?id=<?php echo GA_MEASUREMENT_ID; ?>'></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', '<?php echo GA_MEASUREMENT_ID; ?>');
		</script>
