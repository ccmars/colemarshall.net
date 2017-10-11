<?php
	require('includes/vendor/autoload.php');
	$parsedown = new Parsedown();
?><!DOCTYPE html>
<html>
	<head>
		<title><?php 
			$resume = json_decode(file_get_contents('data/resume.json'));
			echo $resume->basics->name . ' - ' . $resume->basics->label . ' - Resume'; 
		?></title>
		<meta charset='utf-8'>
		<meta content='width=device-width, initial-scale=0.75' name='viewport'>
		<link href='style.css' rel='stylesheet'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src="https://use.fontawesome.com/3356175cee.js"></script>
		<script type='text/javascript' src='resume.js'></script>
	</head>
	<body>
		<main id='resume'>
			<nav class='resumeOptions'>
				<ul>
					<!--<li><a><span class='fa fa-save'></span>Save</a></li>-->
					<li><a class='print'><span class='fa fa-print'></span>Print</a></li>
				</ul>
				<ul>
					<li>
						<label><input type='checkbox' data-section='summary' checked>Summary</label>
						<ul>
							<li><label><label><input type='checkbox' id='summary-extended' data-section='summary-extended'>Extended</label></li>
						</ul>
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
						<label><input type='checkbox' data-section='interests'>Interests</label>
						<ul>
							<li><label><input type='checkbox' data-section='interests-specifics'>Specifics</label></li>
						</ul>
					</li>
				</ul>
			</nav>
			<div>
				<div data-section='header'>
					<div></div>
					<h1><?php echo $resume->basics->name; ?></h1>
					<h3><?php echo $resume->basics->label; ?></h3>
					<h4><span class='fa fa-envelope fa-fw'></span><a href='mailto:<?php echo $resume->basics->email; ?>'><?php echo $resume->basics->email; ?></a></h4>
					<h4><span class='fa fa-home fa-fw'></span><a href='<?php echo $resume->basics->website; ?>'><?php echo $resume->basics->website; ?></a></h4>
				</div>
				<div data-section='summary'>
					<div></div>
					<h2><span class='fa fa-check-circle-o fa-fw'></span>Summary</h2>
					<?php echo $parsedown->text($resume->basics->summary); ?>
				</div>
				<div data-section='experience'>
					<div></div>
					<h2><span class='fa fa-briefcase fa-fw'></span>Experience</h2>
					<?php
					foreach ($resume->work as $work) {
						echo "<h3><span class='fa fa-user-circle fa-fw'></span>{$work->position}</h3>\n";
						echo "<h4>{$work->company}</h4>
						<date>" . date('Y',strtotime($work->startDate)) . " - " . ($work->endDate?date('Y',strtotime($work->endDate)):"Present") . "</date>
						<p data-section='experience-summary'>
							" . $parsedown->line($work->summary) . "
						</p>
						<ul data-section='experience-highlights'>";
							foreach ($work->highlights as $highlight) {
								echo "<li>" . $parsedown->line($highlight) . "</li>\n";
							}
						echo "</ul>";
					}
					?>
				</div>
				<div data-section='education'>
					<div></div>
					<h2><span class='fa fa-graduation-cap fa-fw'></span>Education</h2>
					<?php
					foreach ($resume->education as $education) { ?>
						<h3><span class='fa fa-pencil fa-fw'></span><?php echo $education->institution; ?></h3>
						<h4><?php echo $education->studyType; ?> of <?php echo $education->area; ?></h4>
						<date><?php echo date('Y',strtotime($education->endDate)); ?></date>
						<p data-section='education-summary'>
							<?php echo $education->summary; ?>
						</p>
						<ul data-section='education-courses'>
							<?php
							foreach ($education->courses as $course) {
								echo "<li>{$course}</li>";
							}
							?>
						</ul>
					<?php
					} ?>
				</div>
				<div data-section='skills'>
					<div></div>
					<h2><span class='fa fa-tasks fa-fw'></span>Skills</h2>
					<?php
					foreach ($resume->skills as $skill) { ?>
						<h3><span class='fa fa-keyboard-o fa-fw'></span><?php echo $skill->name; ?></h3>
						<ul data-section='skills-specifics'>
							<?php
							foreach ($skill->keywords as $keyword) {
								echo "<li>{$keyword}</li>";
							}
							?>
						</ul>
					<?php
					} ?>
				</div>
				<div data-section='interests'>
					<div></div>
					<h2><span class='fa fa-smile-o fa-fw'></span>Interests</h2>
					<?php
					foreach ($resume->interests as $interest) { ?>
						<h3><span class='fa fa-thumbs-up fa-fw'></span><?php echo $interest->name; ?></h3>
						<ul data-section='interests-specifics'>
							<?php
							foreach ($interest->keywords as $keyword) {
								echo "<li>{$keyword}</li>";
							}
							?>
						</ul>
					<?php
					} ?>
				</div>
			</div>
		</main>
	</body>
</html>