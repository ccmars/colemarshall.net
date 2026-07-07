const CONSOLE_GREETING = 'Look at you! You seem to know where the really good stuff is.';
const CONSOLE_GREETING_STYLE = 'color:#C0D3B1; background-color:#3B3C36; font-size:180%; padding:8px; font-weight:bold; border-radius:12px;';

const STATIC_CARD_CLASS = 'code-card-static';
// Cards overflowing by less than ~2 code lines just show in full instead
// of offering a pointless expand (CSS lifts max-height on static cards).
const CODE_OVERFLOW_TOLERANCE_PX = 48;
const RESIZE_DEBOUNCE_MS = 150;

function debounce(callback, delayMs) {
	let timer;
	return () => {
		clearTimeout(timer);
		timer = setTimeout(callback, delayMs);
	};
}

function collapsedCodeHeight() {
	const height = getComputedStyle(document.documentElement).getPropertyValue('--code-collapsed-height');
	return parseFloat(height) || 300;
}

function isCodeTruncated(code) {
	return code.scrollHeight > collapsedCodeHeight() + CODE_OVERFLOW_TOLERANCE_PX;
}

function setCardExpanded(card, isExpanded) {
	const toggleButton = card.querySelector('.code-toggle');

	card.classList.toggle('expanded', isExpanded);

	if (toggleButton) {
		toggleButton.setAttribute('aria-expanded', String(isExpanded));

		const label = toggleButton.querySelector('.code-toggle-label');
		if (label) {
			label.textContent = isExpanded ? 'Collapse' : 'Expand';
		}
	}
}

/**
 * Expansion only makes sense when the collapsed view actually truncates the
 * code; short samples become static (no button, no click affordance).
 */
function refreshCardExpandability() {
	document.querySelectorAll('.code-card').forEach((card) => {
		const code = card.querySelector('code');
		if (!code) {
			return;
		}

		const isExpandable = isCodeTruncated(code);
		card.classList.toggle(STATIC_CARD_CLASS, !isExpandable);

		if (!isExpandable) {
			setCardExpanded(card, false);
		}
	});
}

function initializeCodeCards() {
	document.querySelectorAll('.code-card').forEach((card) => {
		const toggle = () => {
			if (!card.classList.contains(STATIC_CARD_CLASS)) {
				setCardExpanded(card, !card.classList.contains('expanded'));
			}
		};

		card.querySelector('.code-toggle')?.addEventListener('click', toggle);
		card.querySelector('code')?.addEventListener('click', toggle);
	});
}

document.addEventListener('DOMContentLoaded', () => {
	if (typeof hljs !== 'undefined') {
		hljs.highlightAll();
	}

	initializeCodeCards();
	refreshCardExpandability();

	// Re-measure once the web fonts land and whenever rewrapping could change heights.
	document.fonts?.ready.then(refreshCardExpandability);
	window.addEventListener('resize', debounce(refreshCardExpandability, RESIZE_DEBOUNCE_MS));

	console.log(`%c${CONSOLE_GREETING}`, CONSOLE_GREETING_STYLE);
});
