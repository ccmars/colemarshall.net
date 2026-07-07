const THEME_STORAGE_KEY = 'theme';
const DARK_SCHEME_QUERY = window.matchMedia('(prefers-color-scheme: dark)');

function storedTheme() {
	try {
		const theme = localStorage.getItem(THEME_STORAGE_KEY);
		return (theme === 'light' || theme === 'dark') ? theme : null;
	} catch {
		return null;
	}
}

function resolvedTheme() {
	return storedTheme() ?? (DARK_SCHEME_QUERY.matches ? 'dark' : 'light');
}

function applyTheme(theme) {
	if (theme) {
		document.documentElement.dataset.theme = theme;
	} else {
		delete document.documentElement.dataset.theme;
	}

	refreshToggle();
	refreshMetaThemeColor();
}

function refreshToggle() {
	const toggle = document.querySelector('.theme-toggle');
	if (!toggle) {
		return;
	}

	const current = resolvedTheme();
	toggle.dataset.resolved = current;
	toggle.setAttribute('aria-label', current === 'dark' ? 'Switch to light theme' : 'Switch to dark theme');
}

/**
 * Keep the browser chrome tint in sync when the theme is toggled manually
 * (the meta media queries only follow the OS preference).
 */
function refreshMetaThemeColor() {
	const background = getComputedStyle(document.body).backgroundColor;
	document.querySelectorAll("meta[name='theme-color']").forEach((meta) => {
		meta.setAttribute('content', background);
	});
}

document.addEventListener('DOMContentLoaded', () => {
	const toggle = document.querySelector('.theme-toggle');
	if (!toggle) {
		return;
	}

	toggle.hidden = false;
	refreshToggle();

	toggle.addEventListener('click', () => {
		const next = resolvedTheme() === 'dark' ? 'light' : 'dark';

		try {
			localStorage.setItem(THEME_STORAGE_KEY, next);
		} catch {
			// Storage unavailable - the override still applies for this page view.
		}

		applyTheme(next);
	});

	// Follow OS changes while no manual override is set.
	DARK_SCHEME_QUERY.addEventListener('change', () => {
		if (!storedTheme()) {
			refreshToggle();
			refreshMetaThemeColor();
		}
	});
});
