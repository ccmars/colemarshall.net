const HIGHLIGHTS_SHOWN_BY_DEFAULT = 5;
const REFERENCES_SHOWN_BY_DEFAULT = 2;
const OPTIONS_STORAGE_KEY = 'resumeOptions';
const MOBILE_MEDIA_QUERY = '(max-width: 760px)';
const HIDDEN_CLASS = 'is-hidden';

/**
 * Elements controlled by an "extended" checkbox: the tail of a list that is
 * truncated by default.
 */
const EXTENDED_SECTION_SELECTORS = {
	'experience-highlights-extended':
		`.resume-sheet [data-section='experience-highlights'] li:nth-child(n+${HIGHLIGHTS_SHOWN_BY_DEFAULT + 1})`,
	'references-extended':
		`.resume-sheet [data-section='references'] .resume-entry:nth-of-type(n+${REFERENCES_SHOWN_BY_DEFAULT + 1})`,
};

function optionCheckboxes() {
	return document.querySelectorAll(".resume-options input[type='checkbox']");
}

function applyOption(checkbox) {
	const section = checkbox.dataset.section;
	const selector = EXTENDED_SECTION_SELECTORS[section] ?? `.resume-sheet [data-section='${section}']`;

	document.querySelectorAll(selector).forEach((element) => {
		element.classList.toggle(HIDDEN_CLASS, !checkbox.checked);
	});
}

function saveOptions() {
	const state = {};
	optionCheckboxes().forEach((checkbox) => {
		state[checkbox.dataset.section] = checkbox.checked;
	});

	try {
		localStorage.setItem(OPTIONS_STORAGE_KEY, JSON.stringify(state));
	} catch {
		// Storage unavailable (private mode, quota) - options simply won't persist.
	}
}

function restoreOptions() {
	let state = null;

	try {
		state = JSON.parse(localStorage.getItem(OPTIONS_STORAGE_KEY));
	} catch {
		return;
	}

	if (!state) {
		return;
	}

	optionCheckboxes().forEach((checkbox) => {
		const saved = state[checkbox.dataset.section];
		if (typeof saved === 'boolean') {
			checkbox.checked = saved;
		}
	});
}

/**
 * The options panel is a permanent sidebar on desktop and a collapsed
 * disclosure on mobile. Sync on load and whenever the breakpoint changes.
 */
function initializeOptionsPanel() {
	const panel = document.querySelector('.resume-options-panel');
	if (!panel) {
		return;
	}

	const mobileQuery = window.matchMedia(MOBILE_MEDIA_QUERY);
	const summary = panel.querySelector('summary');
	const syncPanel = () => {
		panel.open = !mobileQuery.matches;

		// Desktop: the panel is permanent, so the summary is a plain heading -
		// keep it out of the tab order rather than focusable but inert.
		if (summary) {
			summary.tabIndex = mobileQuery.matches ? 0 : -1;
		}
	};

	syncPanel();
	mobileQuery.addEventListener('change', syncPanel);

	// On desktop the panel must stay open; block summary toggling there.
	summary?.addEventListener('click', (event) => {
		if (!mobileQuery.matches) {
			event.preventDefault();
		}
	});
}

document.addEventListener('DOMContentLoaded', () => {
	restoreOptions();
	optionCheckboxes().forEach((checkbox) => {
		applyOption(checkbox);
		checkbox.addEventListener('change', () => {
			applyOption(checkbox);
			saveOptions();
		});
	});

	document.querySelector('.resume-options .print')?.addEventListener('click', () => {
		window.print();
	});

	initializeOptionsPanel();
});
