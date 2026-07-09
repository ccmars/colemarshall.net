<?php

/**
 * Shared helpers: data loading, escaping, markdown, icons, and schema.
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Load and decode the resume data. Returns null when the file is missing
 * or malformed.
 */
function loadResume(): ?object
{
	static $resume = false;

	if ($resume === false) {
		$json = @file_get_contents(RESUME_JSON_PATH);
		$resume = ($json === false) ? null : json_decode($json);

		if ($resume === null) {
			error_log('Failed to load or parse ' . RESUME_JSON_PATH . ': ' . json_last_error_msg());
		}
	}

	return $resume;
}

/**
 * Escape a value for safe HTML output.
 */
function e(?string $value): string
{
	return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Render a single line of Markdown (no wrapping <p>).
 */
function markdownLine(string $text): string
{
	return markdownParser()->line($text);
}

/**
 * Render a block of Markdown (paragraphs, lists, etc.).
 */
function markdownBlock(string $text): string
{
	return markdownParser()->text($text);
}

function markdownParser(): Parsedown
{
	static $parsedown = null;

	if ($parsedown === null) {
		$parsedown = new Parsedown();

		// Safe mode arrived in Parsedown 1.7; enable it when available.
		if (method_exists($parsedown, 'setSafeMode')) {
			$parsedown->setSafeMode(true);
		}
	}

	return $parsedown;
}

/**
 * Inline a decorative SVG icon from ICON_DIRECTORY.
 */
function icon(string $name, string $class = ''): string
{
	static $cache = [];

	if (!isset($cache[$name])) {
		$path = ICON_DIRECTORY . "/{$name}.svg";
		$cache[$name] = is_file($path) ? file_get_contents($path) : '';

		if ($cache[$name] === '') {
			error_log("Icon not found: {$path}");
		}
	}

	if ($cache[$name] === '') {
		return '';
	}

	$classAttribute = 'icon' . ($class !== '' ? ' ' . e($class) : '');

	return str_replace('<svg ', "<svg class='{$classAttribute}' aria-hidden='true' focusable='false' ", $cache[$name]);
}

/**
 * Icon for a profile network.
 */
function profileIcon(string $network, string $class = 'icon-profile'): string
{
	return icon(PROFILE_ICONS[$network] ?? PROFILE_ICON_FALLBACK, $class);
}

/**
 * Inline a decorative SVG illustration (e.g. the CM monogram).
 */
function inlineSvg(string $path, string $class = ''): string
{
	if (!is_file($path)) {
		error_log("SVG not found: {$path}");
		return '';
	}

	$attributes = "aria-hidden='true' focusable='false'" . ($class !== '' ? " class='" . e($class) . "'" : '');

	// Drop the root id so the same file can be inlined more than once per page
	$svg = preg_replace('/(<svg\b[^>]*?)\s+id=(["\'])[^"\']*\2/', '$1', file_get_contents($path), 1);

	return str_replace('<svg ', "<svg {$attributes} ", $svg);
}

/**
 * schema.org Person structured data built from the resume.
 */
function personSchema(object $resume): array
{
	$basics = $resume->basics;

	$schema = [
		'@context' => 'https://schema.org',
		'@type' => 'Person',
		'name' => $basics->name,
		'jobTitle' => $basics->label,
		'email' => 'mailto:' . $basics->email,
		'url' => SITE_URL . '/',
		'image' => $basics->picture ?? META_IMAGE_URL,
		'sameAs' => array_map(fn($profile) => $profile->url, $basics->profiles ?? []),
	];

	if (!empty($basics->location)) {
		$schema['address'] = [
			'@type' => 'PostalAddress',
			'addressLocality' => $basics->location->city ?? '',
			'addressRegion' => $basics->location->region ?? '',
			'addressCountry' => $basics->location->countryCode ?? '',
		];
	}

	if (!empty($resume->work)) {
		$currentWork = array_filter($resume->work, fn($work) => empty($work->endDate));
		$schema['worksFor'] = array_values(array_map(fn($work) => [
			'@type' => 'Organization',
			'name' => $work->company,
			'url' => $work->website ?? null,
		], $currentWork));
	}

	if (!empty($resume->education)) {
		$schema['alumniOf'] = array_map(fn($education) => [
			'@type' => 'CollegeOrUniversity',
			'name' => $education->institution,
		], $resume->education);
	}

	return $schema;
}
