<?php

/**
 * Code samples shown in the Self-Portraits section of the home page.
 *   name        - display name
 *   description - one-line summary shown under the heading
 *   file        - source file inside CODE_SAMPLE_DIRECTORY
 *   language    - highlight.js language class (defaults to the array key)
 *   fiddle      - optional "run it" URL
 *   icon        - icon name (see ICON_DIRECTORY)
 */
$codeSampleItems = [
	'html' => [
		'name' => 'HTML',
		'description' => 'Hypertext Markup Language, defines the structure of the web page',
		'file' => 'html.html',
		'fiddle' => 'https://jsfiddle.net/wjqb5e70/',
		'icon' => 'brand-html5',
	],
	'css' => [
		'name' => 'CSS',
		'description' => 'Cascading Style Sheet, defines the style of the web page',
		'file' => 'css.css',
		'fiddle' => 'https://jsfiddle.net/eLpkfvbs/',
		'icon' => 'brand-css3',
	],
	'typescript' => [
		'name' => 'TypeScript',
		'description' => 'JavaScript with static types, makes the web page interactive in the foreground',
		'file' => 'typescript.ts',
		'fiddle' => 'https://www.typescriptlang.org/play/?target=99#code/JYOwLgpgTgZghgYwgAgBIFcC2cTIN4BQAkFBHACYD2IANgJ7IhyYQBiwUAzmAFzLdRQAcwDcxUhWr1GzCABk43PgOFiAvgQJg6ABxQBRAB57BEEEjkQAbhBrIAvMQA+yAOQBJcNBCvnbgFLoIMCUUL5ELq4AssDkALSWNjThkQDKZiFhfq6pYHAwMCluAAqC5sA6cMnZAMLUYFCIYK5iBKCQsIgGIEKgENDIEIaQIOScaFg4+OJkVLQMOlCUMBCcnCEgfAAGACR4RibAZhbWtmrIeyo9altiJLNSDJx6CMBVYEecfBJz0gDaVyEABpkAA6cGAv4AXSh6k0AHp4cg6jQIK5xs8IK93p8CAhqNx+C83jQPqsHMg-sRXAB1CAAI2QABFVsAhD4gdTWEsvKNkHTGSykpQdCxwK5OURXAAhRAAazM5H5DOZpxoIrFzUlrgAgugwJRsJAlQAVVYfHoS6k1dXoJVCgDyOk4VqhyEUyHxIG4rURyE83BwHzgkGRlFReIJYE94ZQ9mmRCYLHYXF4bhRaMlSfkijT0TgXAAFlVkpLFstVutqHwchlQshWOgaDQ4rl5ch9D0+gMAGSq9bs6BWoiY7Gkz6c86cEPATgwT4drsgfpQX1IzwNSjkdBId24Tu9ZfQAgwIIID7UZDtJbbpAACjwMmTHG4IOzClfyHLKzWGxBo5JMlxjUPgD27KAAEplAaYQEy9QkCw+BBUQpeEAD0-jgCAQnQKF4WAUFIG4O9v0rDYIOQAB+NwcFcZAazgFpiHg6MAPeOg5FnaN42XAB3f1wBoUFOO4VhQiNO9XDMCV8GQbQ9BrL0ACszwvHxkDUCDQRgcSQzvNjx1WCDWnuMB0CgXBdjwbMU24c49nfXNzlnC48EQ4BkIgey8FI39qHOXjC0oIksRJYAAC9yVAVyDO0ESwDUUFbgIDQCD9fQECCsNUXRL8lh-KtcBwJVYtxeDY1BdUhDva8tx3CA73xVEIOMgggA',
		'icon' => 'brand-typescript',
	],
	'php' => [
		'name' => 'PHP',
		'description' => 'PHP: Hypertext Preprocessor, makes the web page interactive in the background',
		'file' => 'php.php',
		'fiddle' => 'https://www.mycompiler.io/view/84blnPph371',
		'icon' => 'brand-php',
	],
	'mysql' => [
		'name' => 'MySQL',
		'description' => 'Stores data for the web page',
		'file' => 'sql.sql',
		'language' => 'sql',
		'fiddle' => 'https://www.mycompiler.io/view/20ivYADjlWH',
		'icon' => 'brand-mysql',
	],
	'http' => [
		'name' => 'REST',
		'description' => 'Representational state transfer, makes transferring data between applications easier',
		'file' => 'rest.txt',
		'icon' => 'server',
	],
	'xml' => [
		'name' => 'XML',
		'description' => 'Extensible Markup Language, a format for storing data for the web page or application',
		'file' => 'xml.xml',
		'icon' => 'code',
	],
	'json' => [
		'name' => 'JSON',
		'description' => 'JavaScript Object Notation, a format for storing data for the web page or application',
		'file' => 'json.json',
		'icon' => 'braces',
	],
	'git' => [
		'name' => 'Git',
		'description' => 'Allows the tracking of source changes to the web page or application',
		'file' => 'git.txt',
		'language' => 'nohighlight',
		'icon' => 'brand-git',
	],
	'cdk' => [
		'name' => 'AWS CDK',
		'description' => 'Cloud Development Kit, defines the cloud infrastructure beneath the web page as code (IaC)',
		'file' => 'cdk.ts',
		'language' => 'typescript',
		'icon' => 'brand-aws',
	],
];
