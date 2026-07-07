<?php
require_once 'includes/functions.php';

$resume = loadResume();
if ($resume === null) {
	http_response_code(500);
	exit('<!DOCTYPE html><title>Site malfunction!</title><h1>Site malfunction!</h1><p>The resume data could not be loaded. Please try again later.</p>');
}

$page = [
	'title' => "{$resume->basics->name} – {$resume->basics->label} – Resume",
	'description' => "Interactive resume of {$resume->basics->name}, {$resume->basics->label} in {$resume->basics->location->city}, {$resume->basics->location->region}. Tailor the sections you want to see, then print or download the JSON.",
	'canonicalPath' => '/resume.php',
	'ogType' => 'profile',
];
?>
<!DOCTYPE html>
<html lang='en-US'>
	<head>
<?php include 'includes/head.php'; ?>
		<script defer src='/scripts/resume.js?v=<?php echo ASSET_VERSION; ?>'></script>
	</head>
	<body>
		<a class='skip-link' href='#resume-sheet'>Skip to resume</a>
		<button type='button' class='theme-toggle' hidden aria-label='Switch theme'>
			<span class='theme-toggle-orb' aria-hidden='true'></span>
		</button>
		<div class='resume-layout'>
			<aside class='resume-options' aria-label='Resume options'>
				<details class='resume-options-panel' open>
					<summary>Resume options</summary>
					<ul class='resume-actions'>
						<li><button type='button' class='action-button print'><?php echo icon('printer'); ?>Print</button></li>
						<li><a class='action-button' href='data/resume.json'><?php echo icon('braces'); ?>resume.json</a></li>
					</ul>
					<ul class='resume-toggles'>
						<li>
							<label><input type='checkbox' data-section='summary' checked>Summary</label>
						</li>
						<li>
							<label><input type='checkbox' data-section='experience' checked>Experience</label>
							<ul>
								<li><label><input type='checkbox' data-section='experience-summary' checked>Summary</label></li>
								<li>
									<label><input type='checkbox' data-section='experience-highlights' checked>Highlights</label>
									<ul>
										<li><label><input type='checkbox' data-section='experience-highlights-extended'>Extended</label></li>
									</ul>
								</li>
							</ul>
						</li>
						<li>
							<label><input type='checkbox' data-section='education' checked>Education</label>
							<ul>
								<li><label><input type='checkbox' data-section='education-summary'>Summary</label></li>
								<li><label><input type='checkbox' data-section='education-courses'>Courses</label></li>
							</ul>
						</li>
						<li>
							<label><input type='checkbox' data-section='skills' checked>Skills</label>
							<ul>
								<li><label><input type='checkbox' data-section='skills-specifics' checked>Specifics</label></li>
							</ul>
						</li>
						<li>
							<label><input type='checkbox' data-section='references'>References</label>
							<ul>
								<li><label><input type='checkbox' data-section='references-extended'>Extended</label></li>
							</ul>
						</li>
						<li>
							<label><input type='checkbox' data-section='interests'>Interests</label>
							<ul>
								<li><label><input type='checkbox' data-section='interests-specifics'>Specifics</label></li>
							</ul>
						</li>
					</ul>
				</details>
			</aside>
			<main class='resume-sheet' id='resume-sheet'>
				<?php echo inlineSvg('images/cm_wireframe.svg', 'resume-monogram'); ?>
				<header data-section='header'>
					<h1><?php echo e($resume->basics->name); ?></h1>
					<p class='resume-role'><?php echo e($resume->basics->label); ?></p>
					<ul class='resume-contact'>
						<li><?php echo icon('mail'); ?><a href='mailto:<?php echo e($resume->basics->email); ?>'><?php echo e($resume->basics->email); ?></a></li>
						<li><?php echo icon('home'); ?><a href='<?php echo e($resume->basics->website); ?>'><?php echo e($resume->basics->website); ?></a></li>
						<li><?php echo icon('map-pin'); ?><?php echo e($resume->basics->location->city); ?>, <?php echo e($resume->basics->location->region); ?></li>
					</ul>
				</header>
				<section data-section='summary'>
					<h2><?php echo icon('circle-check'); ?>Summary</h2>
					<?php echo markdownBlock($resume->basics->summary); ?>
				</section>
				<section data-section='experience'>
					<h2><?php echo icon('briefcase'); ?>Experience</h2>
					<?php foreach ($resume->work ?? [] as $work) { ?>
					<article class='resume-entry'>
						<h3><?php echo icon('user-circle'); ?><?php echo e($work->position); ?></h3>
						<p class='resume-organization'>
							<?php if (!empty($work->website)) { ?>
							<a href='<?php echo e($work->website); ?>' target='_blank' rel='noopener'><?php echo e($work->company); ?></a>
							<?php } else {
								echo e($work->company);
							} ?>
						</p>
						<p class='resume-period'>
							<time datetime='<?php echo e(date('Y-m', strtotime($work->startDate))); ?>'><?php echo e(date('Y', strtotime($work->startDate))); ?></time>
							–
							<?php if (!empty($work->endDate)) { ?>
							<time datetime='<?php echo e(date('Y-m', strtotime($work->endDate))); ?>'><?php echo e(date('Y', strtotime($work->endDate))); ?></time>
							<?php } else { ?>
							Present
							<?php } ?>
						</p>
						<?php if (!empty($work->summary)) { ?>
						<p data-section='experience-summary'><?php echo markdownLine($work->summary); ?></p>
						<?php } ?>
						<?php if (!empty($work->highlights)) { ?>
						<ul data-section='experience-highlights'>
							<?php foreach ($work->highlights as $highlight) { ?>
							<li><?php echo markdownLine($highlight); ?></li>
							<?php } ?>
						</ul>
						<?php } ?>
					</article>
					<?php } ?>
				</section>
				<section data-section='education'>
					<h2><?php echo icon('school'); ?>Education</h2>
					<?php foreach ($resume->education ?? [] as $education) { ?>
					<article class='resume-entry'>
						<h3><?php echo icon('pencil'); ?><?php echo e($education->institution); ?></h3>
						<p class='resume-organization'><?php echo e($education->studyType); ?> in <?php echo e($education->area); ?></p>
						<p class='resume-period'>
							<time datetime='<?php echo e(date('Y-m', strtotime($education->endDate))); ?>'><?php echo e(date('Y', strtotime($education->endDate))); ?></time>
						</p>
						<?php if (!empty($education->summary)) { ?>
						<p data-section='education-summary'><?php echo e($education->summary); ?></p>
						<?php } ?>
						<?php if (!empty($education->courses)) { ?>
						<ul class='tag-list' data-section='education-courses'>
							<?php foreach ($education->courses as $course) { ?>
							<li><?php echo e($course); ?></li>
							<?php } ?>
						</ul>
						<?php } ?>
					</article>
					<?php } ?>
				</section>
				<section data-section='skills'>
					<h2><?php echo icon('list-check'); ?>Skills</h2>
					<?php foreach ($resume->skills ?? [] as $skill) { ?>
					<article class='resume-entry'>
						<h3><?php echo icon('keyboard'); ?><?php echo e($skill->name); ?></h3>
						<ul class='tag-list' data-section='skills-specifics'>
							<?php foreach ($skill->keywords as $keyword) { ?>
							<li><?php echo e($keyword); ?></li>
							<?php } ?>
						</ul>
					</article>
					<?php } ?>
				</section>
				<section data-section='references'>
					<h2><?php echo icon('messages'); ?>References</h2>
					<?php foreach ($resume->references ?? [] as $reference) {
						$referenceName = trim($reference->name);
						$referencePosition = null;
						if (str_contains($referenceName, ',')) {
							[$referenceName, $referencePosition] = array_map('trim', explode(',', $referenceName, 2));
						}
					?>
					<article class='resume-entry'>
						<h3><?php echo icon('user'); ?><?php echo e($referenceName); ?></h3>
						<?php if ($referencePosition !== null) { ?>
						<p class='resume-organization'><?php echo e($referencePosition); ?></p>
						<?php } ?>
						<blockquote><p><?php echo nl2br(e($reference->reference)); ?></p></blockquote>
					</article>
					<?php } ?>
				</section>
				<section data-section='interests'>
					<h2><?php echo icon('mood-smile'); ?>Interests</h2>
					<?php foreach ($resume->interests ?? [] as $interest) { ?>
					<article class='resume-entry'>
						<h3><?php echo icon('thumb-up'); ?><?php echo e($interest->name); ?></h3>
						<ul class='tag-list' data-section='interests-specifics'>
							<?php foreach ($interest->keywords as $keyword) { ?>
							<li><?php echo e($keyword); ?></li>
							<?php } ?>
						</ul>
					</article>
					<?php } ?>
				</section>
			</main>
		</div>
	</body>
</html>
