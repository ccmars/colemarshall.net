<?php

/**
 * Site-wide configuration. Every tunable value lives here.
 */

// Canonical origin (no trailing slash)
const SITE_URL = 'https://colemarshall.net';

// Bump when deploying changed CSS/JS to bust browser caches
const ASSET_VERSION = '3.2.0';

// Data sources, relative to the site root
const RESUME_JSON_PATH = 'data/resume.json';
const CODE_SAMPLE_DIRECTORY = 'data/code';
const ICON_DIRECTORY = 'style/icons';

// Social/OpenGraph preview image
const META_IMAGE_URL = SITE_URL . '/images/ColeMarshall_landscape.jpg';

// Browser chrome tint per color scheme
const THEME_COLOR_LIGHT = '#eef0e4';
const THEME_COLOR_DARK = '#2d2d27';

// Google Analytics
const GA_MEASUREMENT_ID = 'G-CS0EQ8NM2D';

// Profile network -> icon name (files in ICON_DIRECTORY)
const PROFILE_ICONS = [
	'LinkedIn' => 'brand-linkedin',
	'GitHub' => 'brand-github',
	'Stack Overflow' => 'brand-stackoverflow',
	'Behance' => 'brand-behance',
	'Dribbble' => 'brand-dribbble',
	'ArtStation' => 'brand-artstation',
	'500px' => 'brand-500px',
	'Linktree' => 'brand-linktree',
	'MyFonts' => 'typography',
];
const PROFILE_ICON_FALLBACK = 'circle-plus';
