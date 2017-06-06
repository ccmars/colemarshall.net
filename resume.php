<!DOCTYPE html>
<html>
	<head>
		<title><?php 
			$resume = json_decode(file_get_contents('data/resume.json'));
			echo $resume->basics->name . ' - ' . $resume->basics->label . ' - Resume'; 
		?></title>
		<link href='style.css' rel='stylesheet'>
		<script src='https://use.fontawesome.com/f151993474.js'></script>
		<link rel='stylesheet' href='https://cdn.rawgit.com/konpa/devicon/4f6a4b08efdad6bb29f9cc801f5c07e263b39907/devicon.min.css'>
	</head>
	<body>
		<nav>
			<ul>
				<li><span class='fa fa-save'></span>Save</li>
				<li><span class='fa fa-print'></span>Print</li>
			</ul>
			<ul>
				<li>
					<input type='checkbox' data-section='summary' checked>Summary
					<ul>
						<li><input type='checkbox' data-section='summary-extended'>Extended</li>
					</ul>
				</li>
				<li>
					<input type='checkbox' data-section='experience' checked>Experience
					<ul>
						<li><input type='checkbox' data-section='experience-summary' checked>Summary</li>
						<li>
							<input type='checkbox' data-section='experience-highlights' checked>Highlights
							<ul>
								<li><input type='checkbox' data-section='experience-highlights-extended'>Extended</li>
							</ul>
						</li>
					</ul>
				</li>
				<li>
					<input type='checkbox' data-section='education' checked>Education
					<ul>
						<li><input type='checkbox' data-section='education-summary'>Summary</li>
						<li><input type='checkbox' data-section='education-courses'>Courses</li>
					</ul>
				</li>
				<li>
					<input type='checkbox' data-section='skills' checked>Skills
					<ul>
						<li><input type='checkbox' data-section='skills-specifics' checked>Specifics</li>
					</ul>
				</li>
				<li>
					<input type='checkbox' data-section='interests'>Interests
					<ul>
						<li><input type='checkbox' data-section='interests-specifics'>Specifics</li>
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
						{$work->summary}
					</p>
					<ul class='highlights'>";
						foreach ($work->highlights as $highlight) {
							echo "<li>{$highlight}</li>\n";
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