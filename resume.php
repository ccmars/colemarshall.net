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
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=0.75" name="viewport">
		<link href='style.css' rel='stylesheet'>
		<script src='https://use.fontawesome.com/f151993474.js'></script>
	</head>
	<body>
		<nav class='resumeOptionsSpacer'></nav>
		<nav class='resumeOptions'>
			<ul>
				<!--<li><span class='fa fa-save'></span>Save</li>-->
				<li><span class='fa fa-print'></span>Print</li>
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
		<div id='resume'>
			<h1><?php echo $resume->basics->name; ?></h1>
			<h3><?php echo $resume->basics->label; ?></h3>
			<h4><?php echo $resume->basics->location->city . ', ' . $resume->basics->location->region; ?></h4>
			<h4><a href='mailto:<?php echo $resume->basics->email; ?>'><?php echo $resume->basics->email; ?></a></h4>
			<h4><a href='<?php echo $resume->basics->website; ?>'><?php echo $resume->basics->website; ?></a></h4>
			<div class='summary'>
				<h2>Summary</h2>
				<p><?php echo preg_replace('/\n/','<br>',$resume->basics->summary); ?></p>
			</div>
			<div class='experience'>
				<h2>Experience</h2>
				<?php
				foreach ($resume->work as $work) {
					echo "<h3>{$work->position}</h3>\n";
					// <h4>" . ($work->website?"<a href='{$work->website}' target='_new'>{$work->company}</a>":$work->company) . "</h4>
					echo "<h4>{$work->company}</h4>
					<date>" . date('Y',strtotime($work->startDate)) . " - " . ($work->endDate?date('Y',strtotime($work->endDate)):"Present") . "</date>
					<p class='summary'>
						" . $parsedown->line($summary) . "
					</p>
					<ul class='highlights'>";
						foreach ($work->highlights as $highlight) {
							echo "<li>" . $parsedown->line($highlight) . "</li>\n";
						}
					echo "</ul>";
				}
				?>
			</div>
			<div class='education'>
				<h2>Education</h2>
				<?php
				foreach ($resume->education as $education) { ?>
					<h3><?php echo $education->institution; ?></h3>
					<h4><?php echo $education->studyType; ?> of <?php echo $education->area; ?></h4>
					<date><?php echo date('Y',strtotime($education->endDate)); ?></date>
					<p class='summary'>
						<?php echo $education->summary; ?>
					</p>
					<ul class='courses'>
						<?php
						foreach ($education->courses as $course) {
							echo "<li>{$course}</li>";
						}
						?>
					</ul>
				<?php
				} ?>
			</div>
			<div class='skills'>
				<h2>Skills</h2>
				<?php
				foreach ($resume->skills as $skill) { ?>
					<h3><?php echo $skill->name; ?></h3>
					<ul class='specifics'>
						<?php
						foreach ($skill->keywords as $keyword) {
							echo "<li>{$keyword}</li>";
						}
						?>
					</ul>
				<?php
				} ?>
			</div>
			<div class='interests'>
				<h2>Interests</h2>
				<?php
				foreach ($resume->interests as $interest) { ?>
					<h3><?php echo $interest->name; ?></h3>
					<ul class='specifics'>
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
	</body>
</html>