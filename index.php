<!DOCTYPE html>
<html>
	<head>
		<title>Cole Marshall - Web Developer &amp; Designer</title>
		<link href='style.css' rel='stylesheet'>
		<script src="https://use.fontawesome.com/f151993474.js"></script>
		<link rel="stylesheet" href="/includes/highlight/styles/cole-neon.css">
		<script src="/includes/highlight/highlight.pack.js"></script>
		<script>hljs.initHighlightingOnLoad();</script>
	</head>
	<body>
	<?php
	// Cole Resume
	$resume = json_decode(file_get_contents('data/resume.json'));
	if (is_null($resume)) {
		echo "Site malfunction!";
	} else { ?>
		 <h1><?php echo $resume->basics->name; ?></h1>
		<h2><?php echo $resume->basics->label; ?></h2>
		<h3><a href='mailto:<?php echo $resume->basics->email; ?>'><?php echo $resume->basics->email; ?></a></h3> 
		<?php
		require('/includes/codeSampleItems.php');
		foreach ($codeSampleItems as $codeKey => $codeDetails) {
			if (file_exists("data/code/{$codeDetails['file']}")) {
				echo "<fieldset>
					<legend>" . $codeDetails['name'] . "</legend>
					<pre><code" . ($codeDetails['interpret']?" class='" . $codeDetails['interpret'] . "'":" class='hljs {$codeKey}'") . ">";
					$sampleCode = file_get_contents("data/code/{$codeDetails['file']}");
					echo htmlspecialchars($sampleCode);
				echo "</code></pre>
				</fieldset>";
			}
		}
		?>
	<?php
	} ?>
	</body>
</html>