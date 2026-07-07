<?php

/**
 * Code samples shown in the Knowledge section of the home page.
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
	'javascript' => [
		'name' => 'JavaScript',
		'description' => 'Makes the web page interactive in the foreground',
		'file' => 'javascript.js',
		'fiddle' => 'https://jsfiddle.net/5vmtrcwg/',
		'icon' => 'brand-javascript',
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
];
