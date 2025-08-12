function toggleMobileMenu() {
  const mobileNav = document.getElementById('mobileNav');
  mobileNav.classList.toggle('active');
}
function toggleMobileDropdown(event, dropdownId) {
  event.preventDefault();
  const dropdown = document.getElementById(dropdownId + '-dropdown');
  const arrow = event.target.querySelector('svg');

  // Close other dropdowns
  document.querySelectorAll('.mobile-dropdown').forEach(dd => {
    if (dd.id !== dropdownId + '-dropdown') {
      dd.classList.remove('active');
    }
  });

  dropdown.classList.toggle('active');

  if (arrow) {
    arrow.style.transform = dropdown.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
  }
}

let searchTimeout;

function searchStories(query) {
  clearTimeout(searchTimeout);

  if (query.length > 0) {
    // Show suggestions after a short delay
    searchTimeout = setTimeout(() => {
      showSearchSuggestions();
      filterSuggestions(query);
    }, 200);
  } else {
    hideSearchSuggestions();
    hideMobileSearchSuggestions();
  }
}

function showSearchSuggestions() {
  const dropdown = document.getElementById('searchDropdown');
  if (dropdown) {
    dropdown.classList.add('show');
  }
}

function hideSearchSuggestions() {
  setTimeout(() => {
    const dropdown = document.getElementById('searchDropdown');
    if (dropdown) {
      dropdown.classList.remove('show');
    }
  }, 150);
}

function showMobileSearchSuggestions() {
  const dropdown = document.getElementById('mobileSearchDropdown');
  if (dropdown) {
    dropdown.classList.add('show');
  }
}

function hideMobileSearchSuggestions() {
  setTimeout(() => {
    const dropdown = document.getElementById('mobileSearchDropdown');
    if (dropdown) {
      dropdown.classList.remove('show');
    }
  }, 150);
}

function filterSuggestions(query) {
  const suggestions = document.querySelectorAll('.search-suggestion');
  const lowerQuery = query.toLowerCase();

  suggestions.forEach(suggestion => {
    const text = suggestion.querySelector('.suggestion-text').textContent.toLowerCase();
    if (text.includes(lowerQuery)) {
      suggestion.style.display = 'flex';
    } else {
      suggestion.style.display = 'none';
    }
  });
}

function selectSuggestion(text, type) {
  // Fill the search input
  const searchInputs = document.querySelectorAll('.search-input, .mobile-search-input');
  searchInputs.forEach(input => {
    input.value = text;
  });

  // Hide dropdowns
  hideSearchSuggestions();
  hideMobileSearchSuggestions();

  // Perform search
  alert(`Searching for ${type}: "${text}"`);
}