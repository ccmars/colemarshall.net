const HIGHLIGHTS_DEFAULT = 5;

function resumeOptions(hide = false) {
  document.querySelectorAll('.resumeOptions input[type="checkbox"]').forEach(checkbox => {
    const section = checkbox.dataset.section;

    if (section.includes('-extended')) {
      if (section.includes('summary')) {
        const summaryElements = document.querySelectorAll('#resume > div [data-section="summary"] p:nth-of-type(n+2)');
        toggleElements(summaryElements, checkbox.checked, hide);
      } else if (section.includes('highlights')) {
        const highlightsElements = document.querySelectorAll(`#resume > div [data-section$="highlights"] li:nth-child(n+${HIGHLIGHTS_DEFAULT + 1})`);
        toggleElements(highlightsElements, checkbox.checked, hide);
      }
    } else {
      const sectionElements = document.querySelectorAll(`#resume > div [data-section="${section}"]`);
      toggleElements(sectionElements, checkbox.checked, hide);
    }
  });
}

function toggleElements(elements, isVisible, immediate = false) {
  elements.forEach(element => {
    if (isVisible) {
      element.style.display = element.dataset.originalDisplay || '';
    } else {
      if (!element.dataset.originalDisplay && element.style.display !== 'none') {
        element.dataset.originalDisplay = getComputedStyle(element).display;
      }
      element.style.display = 'none';
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  resumeOptions(true);

  document.querySelectorAll('.resumeOptions input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', () => resumeOptions());
  });

  document.querySelector('.resumeOptions .print')?.addEventListener('click', () => {
    window.print();
  });
});