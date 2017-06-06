<!DOCTYPE html>
<html>
	<head>
		<title><?php 
			$resume = json_decode(file_get_contents('data/resume.json'));
			echo $resume->basics->name . ' - ' . $resume->basics->label; 
		?></title>
		<link href='style.css' rel='stylesheet'>
		<script src='https://use.fontawesome.com/f151993474.js'></script>
		<link rel='stylesheet' href='https://cdn.rawgit.com/konpa/devicon/4f6a4b08efdad6bb29f9cc801f5c07e263b39907/devicon.min.css'>
		<link rel='stylesheet' href='/includes/highlight/styles/cole-neon.css'>
		<script src='/includes/highlight/highlight.pack.js'></script>
		<script>
			hljs.initHighlightingOnLoad();
		</script>
	</head>
	<body>
	<?php
	if (is_null($resume)) {
		echo "Site malfunction!";
	} else { ?>
		<h1><?php echo $resume->basics->name; ?></h1>
		<h3><?php echo $resume->basics->label; ?></h3>
		<h4><a href='mailto:<?php echo $resume->basics->email; ?>'><?php echo $resume->basics->email; ?></a></h4>
		<?php
		// Profiles
		if ($resume->basics->profiles) {
			echo "<div>
				<h2>Profiles</h2>";
				echo "<a href='resume.php'><span class='fa fa-file-text-o'></span><b>Resume</b></a>";
				foreach ($resume->basics->profiles as $profile) {
					echo "<a href='{$profile->url}' target='_new'><span class='fa ";
					if ($profile->network == 'LinkedIn') {
						echo "fa-linkedin";
					} else if ($profile->network == 'Stack Overflow') {
						echo "fa-stack-overflow";
					} else if ($profile->network == 'GitHub') {
						echo "fa-github";
					} else if ($profile->network == 'Behance') {
						echo "fa-behance";
					} else if ($profile->network == 'MyFonts') {
						echo "fa-font";
					} else if ($profile->network == '500px') {
						echo "fa-500px";
					} else {
						echo "fa-plus-circle ";
					}
					echo " fa-fw' title='{$profile->network}'></span><b>{$profile->network}</b></a>";
				}
			echo "</div>";
		}

		echo "<h2>Knowledge</h2>";
		// Code Samples
		require('/includes/codeSampleItems.php');
		foreach ($codeSampleItems as $codeKey => $codeDetails) {
			if (file_exists("data/code/{$codeDetails['file']}")) {
				echo "<fieldset>
					<legend>" . ($codeDetails['icon']?"<span class='{$codeDetails['icon']}'></span>":'') . "{$codeDetails['name']}</legend>
					<h3>{$codeDetails['description']}</h3>
					<pre><code" . ($codeDetails['interpret']?" class='" . $codeDetails['interpret'] . "'":" class='hljs {$codeKey}'") . ">";
					$sampleCode = file_get_contents("data/code/{$codeDetails['file']}");
					echo htmlspecialchars($sampleCode);
				echo "</code></pre>
				" . ($codeDetails['fiddle']?"<p>
						<a href='{$codeDetails['fiddle']}' target='_new'>Run it <span class='fa fa-play'></span></a>
					</p>":'') . "
				</fieldset>";
			}
		}
		?>
	<?php
	} ?>
	</body>
</html>