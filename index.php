<!DOCTYPE html>
<html lang='en'>
	<head>
		<title><?php 
			$resume = json_decode(file_get_contents('data/resume.json'));
			echo $resume->basics->name . ' - ' . $resume->basics->label; 
		?></title>
		<!--

		Looking under the hood, I see. Nice!
		These code samples are presented with highlight.js and some logos from Font Awesome.
		The content may be a joke, but all the code actually runs.
		Give it a try.

		-->
		<meta charset='utf-8'>
		<meta content='width=device-width, initial-scale=0.75' name='viewport'>
		<meta property='og:image' content='http://www.ColeMarshall.net/images/ColeMarshall_landscape.jpg'>
		<meta name='description' content='Cole Marshall is an interactive designer and developer that specializes in online media and can handle any variety of technical and design tasks.'>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<link href='/style/style.css' rel='stylesheet'>
		<script defer src="/includes/fontawesome/fa-light.min.js"></script>
		<script defer src="/includes/fontawesome/fa-brands.min.js"></script>
		<script src="/includes/fontawesome/fontawesome.min.js"></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<link rel='stylesheet' href='/includes/highlight/styles/cole-neon.css'>
		<script src='/includes/highlight/highlight.pack.js'></script>
		<script src='/includes/svgInject/jquery.svgInject.js'></script>
		<script src='/scripts/home.js'></script>
		<script>
			hljs.initHighlightingOnLoad();
		</script>
	</head>
	<body>
		<main id='home'>
		<?php
		if (is_null($resume)) {
			echo "Site malfunction!";
		} else { ?>
			<header>
				<div>
					<div>
						<h1><?php echo $resume->basics->name; ?></h1>
						<h3><?php echo $resume->basics->label; ?></h3>
						<h4><span class='fal fa-envelope fa-fw'></span><a href='mailto:<?php echo $resume->basics->email; ?>'><?php echo $resume->basics->email; ?></a></h4>
					</div>
					<img src='/images/cm_wireframe.svg' width='200'>
				</div>
			</header>
			<?php
			// Profiles
			if ($resume->basics->profiles) {
				echo "<div class='profiles'>
					<h2>
						<div>
							Profiles
						</div>
					</h2>
					<div>
					<a href='resume.php'><span class='fal fa-file-alt'></span><b>Resume</b></a>";
					foreach ($resume->basics->profiles as $profile) {
						echo "<a href='{$profile->url}' target='_new'><span class='";
						if ($profile->network == 'LinkedIn') {
							echo "fab fa-linkedin";
						} else if ($profile->network == 'Stack Overflow') {
							echo "fab fa-stack-overflow";
						} else if ($profile->network == 'GitHub') {
							echo "fab fa-github";
						} else if ($profile->network == 'Behance') {
							echo "fab fa-behance";
						} else if ($profile->network == 'MyFonts') {
							echo "fal fa-font";
						} else if ($profile->network == '500px') {
							echo "fab fa-500px";
						} else {
							echo "fal fa-plus-circle ";
						}
						echo " fa-fw'></span><b>{$profile->network}</b></a>";
					}
				echo "</div>
				</div>";
			} ?>
			<div class='knowledge'>
				<h2>
					<div>
						Knowledge
					</div>
				</h2>
				<?php
				// Code Samples
				require('includes/codeSampleItems.php');
				foreach ($codeSampleItems as $codeKey => $codeDetails) {
					if (file_exists("data/code/{$codeDetails['file']}")) {
						echo "<fieldset>
							<legend>" . ($codeDetails['icon']?"<span class='{$codeDetails['icon']}'></span>":'') . "{$codeDetails['name']}</legend>
							<h4>{$codeDetails['description']}</h4>
							<pre><code" . ($codeDetails['interpret']?" class='" . $codeDetails['interpret'] . "'":" class='hljs {$codeKey}'") . ">";
							$sampleCode = file_get_contents("data/code/{$codeDetails['file']}");
							echo htmlspecialchars($sampleCode);
						echo "</code></pre>
						" . ($codeDetails['fiddle']?"<p>
								<a href='{$codeDetails['fiddle']}' target='_new'>Run it <span class='fas fa-play'></span></a>
							</p>":'') . "
						</fieldset>";
					}
				}
				?>
			</div>
			<footer>
				<a href="/legacy/">Legacy Site (Flash Required)</a>
			</footer>
		<?php
		} ?>
		</main>
	</body>
</html>