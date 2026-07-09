<?php
require_once 'includes/functions.php';

$resume = loadResume();
if ($resume === null) {
	http_response_code(500);
	exit('<!DOCTYPE html><title>Site malfunction!</title><h1>Site malfunction!</h1><p>The resume data could not be loaded. Please try again later.</p>');
}

$page = [
	'title' => "{$resume->basics->name} – {$resume->basics->label}",
	'description' => "{$resume->basics->name} is a senior full-stack engineer and designer in {$resume->basics->location->city}, {$resume->basics->location->region}, blending design, frontend and backend development, testing, and cloud DevOps.",
	'canonicalPath' => '/',
	'ogType' => 'website',
];

require 'includes/codeSampleItems.php';
?>
<!DOCTYPE html>
<html lang='en-US'>
	<head>
		<!--

		Looking under the hood, I see. Nice!
		These code samples are presented with highlight.js and icons from Tabler.
		The content may be a joke, but all the code actually runs.
		Give it a try.

		-->
<?php include 'includes/head.php'; ?>
		<link rel='stylesheet' href='/style/cole-neon.css?v=<?php echo ASSET_VERSION; ?>'>
		<script defer src='/scripts/vendor/highlight.min.js'></script>
		<script defer src='/scripts/vendor/http.min.js'></script>
		<script defer src='/scripts/home.js?v=<?php echo ASSET_VERSION; ?>'></script>
	</head>
	<body>
		<a class='skip-link' href='#main'>Skip to content</a>
		<button type='button' class='theme-toggle' hidden aria-label='Switch theme'>
			<span class='theme-toggle-orb' aria-hidden='true'></span>
		</button>
		<header class='hero'>
			<div class='hero-inner'>
				<div class='hero-text'>
					<h1><?php echo e($resume->basics->name); ?></h1>
					<p class='hero-role'><?php echo e($resume->basics->label); ?></p>
					<p class='hero-pitch'>Blending design, frontend and backend development, testing, and cloud DevOps from <?php echo e($resume->basics->location->city); ?>, <?php echo e($resume->basics->location->region); ?>.</p>
					<p class='hero-contact'>
						<?php echo icon('mail'); ?><a href='mailto:<?php echo e($resume->basics->email); ?>'><?php echo e($resume->basics->email); ?></a>
					</p>
				</div>
				<?php echo inlineSvg('images/cm_wireframe.svg', 'hero-monogram'); ?>
			</div>
		</header>
		<main id='main'>
			<?php if (!empty($resume->basics->profiles)) {
				// resume.json orders profiles by hiring funnel; the first three headline beside the resume tile
				$headlineProfiles = array_slice($resume->basics->profiles, 0, 3);
				$supportingProfiles = array_slice($resume->basics->profiles, 3);
			?>
			<section class='profiles' aria-labelledby='profiles-heading'>
				<h2 class='section-heading' id='profiles-heading'><span>Profiles</span></h2>
				<ul class='profile-grid'>
					<li>
						<a class='profile-tile profile-tile-featured' href='resume.php'>
							<?php echo icon('file-text', 'icon-profile'); ?>
							<b>Resume</b>
						</a>
					</li>
					<?php foreach ($headlineProfiles as $profile) { ?>
					<li>
						<a class='profile-tile' href='<?php echo e($profile->url); ?>' target='_blank' rel='noopener'>
							<?php echo profileIcon($profile->network); ?>
							<b><?php echo e($profile->network); ?></b>
						</a>
					</li>
					<?php } ?>
				</ul>
				<?php if (!empty($supportingProfiles)) { ?>
				<ul class='profile-strip'>
					<?php foreach ($supportingProfiles as $profile) { ?>
					<li>
						<a class='profile-pill' href='<?php echo e($profile->url); ?>' target='_blank' rel='noopener'>
							<?php echo profileIcon($profile->network, ''); ?><?php echo e($profile->network); ?>
						</a>
					</li>
					<?php } ?>
				</ul>
				<?php } ?>
			</section>
			<?php } ?>
			<section class='self-portraits' aria-labelledby='self-portraits-heading'>
				<h2 class='section-heading' id='self-portraits-heading'><span>Self-Portraits</span></h2>
				<?php foreach ($codeSampleItems as $sampleKey => $sample) {
					$samplePath = CODE_SAMPLE_DIRECTORY . "/{$sample['file']}";
					if (!is_file($samplePath)) {
						continue;
					}

					$language = $sample['language'] ?? $sampleKey;
					$codeClass = ($language === 'nohighlight') ? 'hljs nohighlight' : "hljs language-{$language}";
					$codeId = "code-{$sampleKey}";
				?>
				<article class='code-card'>
					<h3 class='code-card-title'><?php echo icon($sample['icon']); ?><?php echo e($sample['name']); ?></h3>
					<p class='code-card-description'><?php echo e($sample['description']); ?></p>
					<pre><code id='<?php echo $codeId; ?>' class='<?php echo $codeClass; ?>'><?php echo e(file_get_contents($samplePath)); ?></code></pre>
					<p class='code-card-actions'>
						<button type='button' class='action-button code-toggle' aria-expanded='false' aria-controls='<?php echo $codeId; ?>'><?php echo icon('chevron-down'); ?><span class='code-toggle-label'>Expand</span></button>
						<?php if (!empty($sample['fiddle'])) { ?>
						<a class='action-button code-run' href='<?php echo e($sample['fiddle']); ?>' target='_blank' rel='noopener'><?php echo icon('rocket'); ?>Run it</a>
						<?php } ?>
					</p>
				</article>
				<?php } ?>
			</section>
		</main>
		<footer class='site-footer'>
			<?php echo inlineSvg('images/favicon.svg', 'footer-monogram'); ?>
			<p><a class='action-button' href='<?php echo GITHUB_REPO_URL; ?>' target='_blank' rel='noopener'><?php echo icon('brand-github'); ?>Read the source</a></p>
			<p>© <?php echo date('Y'); ?> Cole Marshall</p>
		</footer>
	</body>
</html>
