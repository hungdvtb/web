let currentSlide = 0;
const booksPerView = 4;
const totalBooks = 6;
let tooltipTimeout;

// Drag functionality variables
let isDragging = false;
let startX = 0;
let currentX = 0;
let initialTranslate = 0;
let animationId = 0;
let autoSlideInterval;

// Book data for tooltips
const bookData = {
  'whispers-heart': {
    title: 'Whispers of the Heart',
    author: 'Emma Rose',
    rating: 4.5,
    description: 'A heartwarming tale of love found in unexpected places. When Sarah moves to a small coastal town, she never expected to find her soulmate in the local bookshop owner. Their story unfolds through whispered conversations and stolen glances.',
    chapters: ['Chapter 45: The Confession', 'Chapter 44: Moonlit Walk', 'Chapter 43: Hidden Letters', 'Chapter 42: First Kiss', 'Chapter 41: The Storm', 'Chapter 40: Revelations'],
    cover: `<svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 45px; height: 67px;">
                    <g transform="translate(30, 45)">
                        <path d="M-12 -5 Q-18 -15 -9 -15 Q0 -18 9 -15 Q18 -15 12 -5 Q9 6 0 15 Q-9 6 -12 -5Z" 
                              fill="rgba(255, 160, 122, 0.6)" stroke="rgba(205, 133, 133, 0.8)" stroke-width="1.5"/>
                    </g>
                </svg>`
  },
  'moonlit-promises': {
    title: 'Moonlit Promises',
    author: 'Luna Silver',
    rating: 4.8,
    description: 'Under the silver moonlight, two souls make promises that will change their lives forever. A story of second chances and the magic that happens when you believe in love again.',
    chapters: ['Chapter 32: Forever Yours', 'Chapter 31: The Promise', 'Chapter 30: Midnight Dance', 'Chapter 29: Starlit Vows', 'Chapter 28: Silver Dreams', 'Chapter 27: Moonbeams'],
    cover: `<svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 45px; height: 67px;">
                    <g transform="translate(30, 45)">
                        <circle cx="0" cy="-8" r="20" fill="rgba(255, 218, 185, 0.6)" stroke="rgba(205, 133, 133, 0.5)" stroke-width="1"/>
                        <g transform="translate(-20, -18)">
                            <path d="M0 -4 L1 -1 L4 -1 L1.5 1 L2.5 4 L0 2 L-2.5 4 L-1.5 1 L-4 -1 L-1 -1 Z" fill="rgba(255, 182, 193, 0.7)"/>
                        </g>
                    </g>
                </svg>`
  },
  'dancing-rain': {
    title: 'Dancing in the Rain',
    author: 'Maya Storm',
    rating: 4.9,
    description: 'Sometimes the most beautiful moments happen in the storm. Follow Emma and Jake as they discover that love isn\'t about waiting for the storm to pass, but learning to dance in the rain together.',
    chapters: ['Chapter 28: Rainbow After', 'Chapter 27: Thunder Hearts', 'Chapter 26: Rain Dance', 'Chapter 25: Storm\'s Eye', 'Chapter 24: Lightning Strike', 'Chapter 23: First Drop'],
    cover: `<svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 45px; height: 67px;">
                    <g transform="translate(30, 45)">
                        <g opacity="0.6">
                            <line x1="-18" y1="-20" x2="-15" y2="-12" stroke="rgba(135, 206, 235, 0.6)" stroke-width="2"/>
                            <line x1="-6" y1="-18" x2="-3" y2="-10" stroke="rgba(135, 206, 235, 0.6)" stroke-width="2"/>
                            <line x1="6" y1="-20" x2="9" y2="-12" stroke="rgba(135, 206, 235, 0.6)" stroke-width="2"/>
                        </g>
                        <path d="M-3 -3 Q-6 -7 -1.5 -7 Q1.5 -9 4.5 -7 Q9 -7 6 -3 Q4.5 2 1.5 6 Q-1.5 2 -3 -3Z" 
                              fill="rgba(255, 182, 193, 0.7)"/>
                    </g>
                </svg>`
  },
  'starlight-serenade': {
    title: 'Starlight Serenade',
    author: 'Isabella Grace',
    rating: 4.7,
    description: 'A musician and an astronomer find love written in the stars. Their romance blooms under starlit skies as they discover that some melodies are meant to be played together.',
    chapters: ['Chapter 24: Cosmic Symphony', 'Chapter 23: Stellar Harmony', 'Chapter 22: Night Music', 'Chapter 21: Star Crossed', 'Chapter 20: Celestial Dance', 'Chapter 19: Moonlight Sonata'],
    cover: `<svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 45px; height: 67px;">
                    <g transform="translate(30, 45)">
                        <circle cx="0" cy="-8" r="15" fill="rgba(255, 218, 185, 0.6)"/>
                        <g transform="translate(-20, -15)">
                            <path d="M0 -4 L1 -1 L4 -1 L1.5 1 L2.5 4 L0 2 L-2.5 4 L-1.5 1 L-4 -1 L-1 -1 Z" fill="rgba(255, 182, 193, 0.7)"/>
                        </g>
                        <g transform="translate(15, -12)">
                            <path d="M0 -3 L0.75 -0.75 L3 -0.75 L1.2 0.75 L1.95 3 L0 1.5 L-1.95 3 L-1.2 0.75 L-3 -0.75 L-0.75 -0.75 Z" fill="rgba(255, 182, 193, 0.7)"/>
                        </g>
                    </g>
                </svg>`
  },
  'ocean-dreams': {
    title: 'Ocean Dreams',
    author: 'Marina Blue',
    rating: 4.6,
    description: 'Where the ocean meets the shore, two hearts find their rhythm. A marine biologist and a lighthouse keeper discover that some dreams are worth diving deep for.',
    chapters: ['Chapter 18: Tidal Hearts', 'Chapter 17: Deep Blue', 'Chapter 16: Lighthouse Keeper', 'Chapter 15: Ocean Whispers', 'Chapter 14: Coral Dreams', 'Chapter 13: Seaside Serenade'],
    cover: `<svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 45px; height: 67px;">
                    <g transform="translate(30, 45)">
                        <path d="M-20 5 Q-15 -2 -10 5 Q-5 -1 0 5 Q5 -1 10 5 Q15 -2 20 5" 
                              fill="none" stroke="rgba(135, 206, 235, 0.6)" stroke-width="2"/>
                        <path d="M-20 10 Q-15 3 -10 10 Q-5 4 0 10 Q5 4 10 10 Q15 3 20 10" 
                              fill="none" stroke="rgba(135, 206, 235, 0.6)" stroke-width="2"/>
                        <circle cx="0" cy="-8" r="8" fill="rgba(255, 218, 185, 0.6)"/>
                    </g>
                </svg>`
  },
  'winter-hearts': {
    title: 'Winter Hearts',
    author: 'Crystal Snow',
    rating: 4.4,
    description: 'In the heart of winter, two souls find warmth in each other. A cozy romance that proves love can bloom even in the coldest seasons.',
    chapters: ['Chapter 22: Spring Thaw', 'Chapter 21: Frozen Moments', 'Chapter 20: Snowflake Kiss', 'Chapter 19: Winter Solstice', 'Chapter 18: Icy Hearts', 'Chapter 17: First Snow'],
    cover: `<svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 45px; height: 67px;">
                    <g transform="translate(30, 45)">
                        <g opacity="0.7">
                            <path d="M-15 -15 L-10 -20 L-5 -15 L-10 -10 Z" fill="rgba(173, 216, 230, 0.6)"/>
                            <path d="M5 -18 L10 -23 L15 -18 L10 -13 Z" fill="rgba(173, 216, 230, 0.6)"/>
                            <path d="M-5 -5 L0 -10 L5 -5 L0 0 Z" fill="rgba(173, 216, 230, 0.6)"/>
                        </g>
                        <path d="M-3 5 Q-6 0 -1 0 Q1.5 -2 4.5 0 Q9 0 6 5 Q4.5 10 1.5 15 Q-1.5 10 -3 5Z" 
                              fill="rgba(255, 182, 193, 0.7)"/>
                    </g>
                </svg>`
  }
};

// Tooltip functions
let currentTooltipElement = null;

function showTooltip(event, bookId) {
  clearTimeout(tooltipTimeout);

  const tooltip = document.getElementById('bookTooltip');
  const book = bookData[bookId];

  if (!book) return;

  currentTooltipElement = event.currentTarget;

  // Update tooltip content
  document.getElementById('tooltipTitle').textContent = book.title;
  document.getElementById('tooltipAuthor').textContent = `by ${book.author}`;
  document.getElementById('tooltipRating').textContent = book.rating;
  document.getElementById('tooltipDescription').textContent = book.description;
  document.getElementById('tooltipCover').innerHTML = book.cover;

  // Update stars
  const starsContainer = document.getElementById('tooltipStars');
  starsContainer.innerHTML = '';
  const fullStars = Math.floor(book.rating);
  const hasHalfStar = book.rating % 1 !== 0;

  for (let i = 0; i < 5; i++) {
    const star = document.createElement('svg');
    star.className = i < fullStars ? 'tooltip-star' : 'tooltip-star empty';
    star.setAttribute('viewBox', '0 0 24 24');
    star.setAttribute('fill', 'currentColor');
    star.innerHTML = '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>';
    starsContainer.appendChild(star);
  }

  // Update chapters
  const chaptersContainer = document.getElementById('tooltipChapters');
  chaptersContainer.innerHTML = '';
  book.chapters.forEach((chapter, index) => {
    const chapterDiv = document.createElement('div');
    chapterDiv.className = 'chapter-item';
    chapterDiv.textContent = chapter;
    chapterDiv.onclick = () => openChapter(bookId, index + 1);
    chaptersContainer.appendChild(chapterDiv);
  });

  // Position tooltip at cursor
  positionTooltipAtCursor(event);

  // Show tooltip with delay
  tooltipTimeout = setTimeout(() => {
    tooltip.classList.add('show');
  }, 300);
}

function positionTooltipAtCursor(event) {
  const tooltip = document.getElementById('bookTooltip');

  // Get cursor position
  let left = event.clientX + 15; // 15px offset from cursor
  let top = event.clientY - 10; // 10px offset from cursor

  // Adjust if tooltip goes off screen
  const tooltipWidth = 320;
  const tooltipHeight = 400; // Approximate height

  if (left + tooltipWidth > window.innerWidth - 10) {
    left = event.clientX - tooltipWidth - 15; // Show on left side of cursor
  }
  if (top + tooltipHeight > window.innerHeight - 10) {
    top = event.clientY - tooltipHeight + 10; // Show above cursor
  }
  if (left < 10) left = 10;
  if (top < 10) top = 10;

  tooltip.style.left = left + 'px';
  tooltip.style.top = top + 'px';
}

function hideTooltip() {
  clearTimeout(tooltipTimeout);
  tooltipTimeout = setTimeout(() => {
    const tooltip = document.getElementById('bookTooltip');
    tooltip.classList.remove('show');
    currentTooltipElement = null;
  }, 100);
}

function keepTooltipVisible() {
  clearTimeout(tooltipTimeout);
}

function scheduleTooltipHide() {
  tooltipTimeout = setTimeout(() => {
    const tooltip = document.getElementById('bookTooltip');
    tooltip.classList.remove('show');
    currentTooltipElement = null;
  }, 100);
}

function openChapter(bookId, chapterNum) {
  const book = bookData[bookId];
  alert(`Opening ${book.title} - Chapter ${chapterNum}. You'll be taken to the reading page.`);
}

// Mobile menu functionality
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

// Search functionality
 
function renderReadingHistory() {
    let history = JSON.parse(localStorage.getItem('reading_history') || '[]');
    let container = document.getElementById('reading-history');

    if (!history.length) { 
        return;
    }

    let html = "";
    history = history.slice(0,5); // Limit to last 5 items
    history.forEach(item => {
        html +=`
          <div class="recent-item">
                  <div class="recent-info">
                      <div class="recent-title"><a href="${item.book_url}">${item.book_name}</a></div>
                      <div class="recent-chapter"><a href="${item.chapter_url}">${item.name}</a></div>
                  </div>
              </div>
        ` 
    }); 

    container.innerHTML = html;
}

// Gọi hàm khi load trang
document.addEventListener('DOMContentLoaded', renderReadingHistory);
 

// Book slider functionality
function slideBooks(direction) {
  const slider = document.getElementById('sliderContainer');

  currentSlide += direction;

  // Loop functionality
  if (currentSlide < 0) {
    currentSlide = totalBooks - 1;
  } else if (currentSlide >= totalBooks) {
    currentSlide = 0;
  }

  updateSliderPosition();
}

function updateSliderPosition() {
  const slider = document.getElementById('sliderContainer');
  const translateX = -(currentSlide * (220)); // 200px width + 20px gap
  slider.style.transform = `translateX(${translateX}px)`;
  slider.style.transition = 'transform 0.5s ease';
}

// Drag functionality
function dragStart(e) {
  const slider = document.getElementById('sliderContainer');
  isDragging = true;
  startX = getPositionX(e);
  initialTranslate = getCurrentTranslate();

  slider.style.transition = 'none';
  clearInterval(autoSlideInterval);

  if (e.type === 'mousedown') {
    document.addEventListener('mousemove', dragMove);
    document.addEventListener('mouseup', dragEnd);
  }
}

function dragMove(e) {
  if (!isDragging) return;

  e.preventDefault();
  currentX = getPositionX(e);
  const deltaX = currentX - startX;
  const newTranslate = initialTranslate + deltaX;

  setSliderTransform(newTranslate);
}

function dragEnd(e) {
  if (!isDragging) return;

  isDragging = false;
  const deltaX = currentX - startX;
  const threshold = 50; // Minimum drag distance to trigger slide

  if (Math.abs(deltaX) > threshold) {
    if (deltaX > 0) {
      slideBooks(-1); // Drag right = previous slide
    } else {
      slideBooks(1); // Drag left = next slide
    }
  } else {
    // Snap back to current position
    updateSliderPosition();
  }

  // Remove event listeners
  document.removeEventListener('mousemove', dragMove);
  document.removeEventListener('mouseup', dragEnd);

  // Restart auto-slide
  startAutoSlide();
}

function getPositionX(e) {
  return e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
}

function getCurrentTranslate() {
  const slider = document.getElementById('sliderContainer');
  const style = window.getComputedStyle(slider);
  const transform = style.transform;

  if (transform === 'none') return 0;

  // Parse matrix values
  const matrix = transform.match(/matrix.*\((.+)\)/);
  if (matrix) {
    const values = matrix[1].split(', ');
    return parseFloat(values[4]) || 0;
  }

  return 0;
}

function setSliderTransform(translateX) {
  const slider = document.getElementById('sliderContainer');
  slider.style.transform = `translateX(${translateX}px)`;
}

function startAutoSlide() {
  clearInterval(autoSlideInterval);
  autoSlideInterval = setInterval(() => {
    slideBooks(1);
  }, 4000);
}
 

// Tab functionality
function switchTab(tabName) {
  // Remove active class from all tabs and content
  document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
  document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

  // Add active class to clicked tab and corresponding content
  event.target.classList.add('active');
  document.getElementById(tabName + '-content').classList.add('active');
}

 

// Initialize page
document.addEventListener('DOMContentLoaded', function () {
  // Navigation interactions
 

  // Start auto-slide
  startAutoSlide();
});