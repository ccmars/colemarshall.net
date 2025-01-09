document.addEventListener('DOMContentLoaded', function() {
	// Expand and collapse code snippets
  document.querySelectorAll('code').forEach(function(codeElement) {
    codeElement.addEventListener('click', function() {
      this.classList.toggle('expanded');
    });
  });

  console.log(
    "%cLook at you! You seem to know where the really good stuff is. I like that.",
    "color:#C0D3B1; background-color:#3B3C36; font-size:180%; padding:8px; font-weight:bold; border-radius:12px;"
  );
});