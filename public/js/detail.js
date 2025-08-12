

// Related book viewing function
function viewBook(bookId) {
    alert(`Navigating to book: ${bookId}`);
}

// Star Rating functionality
let userRating = 0;
let currentBookRating = 4.5;

async function  rateBook(event) {
    const clickedStar = event.target.closest('.star');
    if (!clickedStar) return;

    const rating = parseInt(clickedStar.getAttribute('data-rating'));
    const book_id = parseInt(clickedStar.getAttribute('data-id'));
    userRating = rating;

    // Update star display

    const data = {
        book_id,
        rating
    }
  
    try {
        const response = await fetch('/review', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                 'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            const errorText = await response.text();
            throw new Error(errorText);
        }
        
        const result = await response.json();
        updateStarDisplay(result.average_rating)
        alert(result.message); 
    } catch (error) {
         alert(error.message); 
    } 
}


function hoverDisplay(rating){
    const stars = document.querySelectorAll('.star');
    stars.forEach((star, index) => {
        const starRating = index + 1;
        star.classList.remove('empty', 'half-filled');

        if (starRating <= rating) {
            star.style.color = '#ffd700';
        } else if (index === Math.floor(rating) && rating % 1 !== 0) {  // Half star
            star.classList.add('half-filled');
        } else {
            star.style.color = 'rgba(205, 133, 133, 0.3)';
            star.classList.add('empty');
        }
    });
}
function updateStarDisplay(rating) {
    const stars = document.querySelectorAll('.star');
    stars.forEach((star, index) => {
        const starRating = index + 1;
        star.classList.remove('empty', 'half-filled');

        if (starRating <= rating) {
            star.style.color = '#ffd700';
        } else if (index === Math.floor(rating) && rating % 1 !== 0) {  // Half star
            star.classList.add('half-filled');
        } else {
            star.style.color = 'rgba(205, 133, 133, 0.3)';
            star.classList.add('empty');
        }
    });

    // Update rating text
    document.querySelector('.rating-text').textContent = rating;
}
document.addEventListener('DOMContentLoaded', initializeRating);
function initializeRating() {
    const stars = document.querySelectorAll('.star');
        
    stars.forEach((star, index) => {
        // Hover effect
        star.addEventListener('mouseenter', () => {
            hoverDisplay(index+1)
        }); 
    }); 
   
}

// Pagination functionality
let currentPage = 5;
const totalPages = 5;

function goToPage(page) {
    if (page < 1 || page > totalPages) return;

    currentPage = page;
    updatePagination();
    updateChapterDisplay(page);
    alert(`Loading page ${page} of chapters...`);
}

function nextPage() {
    if (currentPage < totalPages) {
        goToPage(currentPage + 1);
    }
}

function previousPage() {
    if (currentPage > 1) {
        goToPage(currentPage - 1);
    }
}

function updatePagination() {
    // Update page number buttons
    const pageNumbers = document.querySelectorAll('.page-number');
    pageNumbers.forEach((btn, index) => {
        btn.classList.toggle('active', index + 1 === currentPage);
    });

    // Update navigation buttons
    const firstBtn = document.querySelector('.page-btn[onclick="goToPage(1)"]');
    const prevBtn = document.querySelector('.page-btn[onclick="previousPage()"]');
    const nextBtn = document.querySelector('.page-btn[onclick="nextPage()"]');
    const lastBtn = document.querySelector('.page-btn[onclick="goToPage(5)"]');

    if (firstBtn) firstBtn.disabled = currentPage === 1;
    if (prevBtn) prevBtn.disabled = currentPage === 1;
    if (nextBtn) nextBtn.disabled = currentPage === totalPages;
    if (lastBtn) lastBtn.disabled = currentPage === totalPages;

    // Update pagination info
    const startChapter = (currentPage - 1) * 10 + 1;
    const endChapter = Math.min(currentPage * 10, 45);
    const paginationInfo = document.querySelector('.pagination-info');
    if (paginationInfo) {
        paginationInfo.textContent =
            `Showing chapters ${startChapter}-${endChapter} of 45 total chapters`;
    }
}

function updateChapterDisplay(page) {
    // This would normally update the chapter list based on the page
    // For demo purposes, we'll just show the current page's chapters
    console.log(`Displaying chapters for page ${page}`);
}

// Add smooth scrolling for better UX
document.addEventListener('DOMContentLoaded', function () {
    // Add click animations to interactive elements
    const clickableElements = document.querySelectorAll('.chapter-item, .related-book');

    clickableElements.forEach(element => {
        element.addEventListener('click', function () {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
}); 


class ChapterPagination {
    constructor(chapters) {
        this.allChapters = chapters;
        this.filteredChapters = [...chapters];
        this.currentPage = 1;
        this.chaptersPerPage = 20;
        this.searchQuery = '';
        this.firstInit = true;
        this.init();
    }
    
    init() {
        this.updateDisplay(); 
    }
    
    // Update chapters per page
    setChaptersPerPage(count) {
        this.chaptersPerPage = parseInt(count);
        this.currentPage = 1; // Reset to first page
        this.updateDisplay();
    }
    
    // Search functionality
    search(query) {
        this.searchQuery = query.toLowerCase().trim();
        
        if (this.searchQuery === '') {
            this.filteredChapters = [...this.allChapters];
        } else {
            this.filteredChapters = this.allChapters.filter(chapter => 
                chapter.title.toLowerCase().includes(this.searchQuery) ||
                chapter.preview.toLowerCase().includes(this.searchQuery) ||
                chapter.number.toString().includes(this.searchQuery)
            );
        }
        
        this.currentPage = 1; // Reset to first page
        this.updateDisplay(); 
    }
    
    // Navigate to specific page
    goToPage(page) {
        const totalPages = this.getTotalPages();
        if (page >= 1 && page <= totalPages) {
            this.currentPage = page;
            this.updateDisplay();
        }
    }
    
    // Get total pages
    getTotalPages() {
        return Math.ceil(this.filteredChapters.length / this.chaptersPerPage);
    }
    
    // Get current page chapters
    getCurrentPageChapters() {
        const startIndex = (this.currentPage - 1) * this.chaptersPerPage;
        const endIndex = startIndex + this.chaptersPerPage;
        return this.filteredChapters.slice(startIndex, endIndex);
    }
    
    // Update the display
    updateDisplay() {
        this.renderChapters();
        this.renderPagination(); 
    }
    
    // Render chapters
    renderChapters() {
        const chaptersGrid = document.getElementById('chaptersGrid'); 
        const currentChapters = this.getCurrentPageChapters();
        
        if (currentChapters.length === 0) {
            chaptersGrid.style.display = 'none';
            noResults.style.display = 'block';
            document.getElementById('paginationContainer').style.display = 'none';
            return;
        }
        
        chaptersGrid.style.display = 'grid';
        document.getElementById('paginationContainer').style.display = 'flex';
        
        chaptersGrid.innerHTML = '';
        
        currentChapters.forEach(chapter => {
            const chapterCard = this.createChapterCard(chapter);
            chaptersGrid.appendChild(chapterCard);
        });
        if(!this.firstInit){
              // Scroll to top of chapters section
            document.getElementById('chaptersSection').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        }
        this.firstInit = false;
      
    }
    
    // Create chapter card element
    createChapterCard(chapter) {
        const card = document.createElement('div');
        card.className = 'chapter-item'; 
         
        
        card.innerHTML = `
            <div class="chapter-info">
                <div class="chapter-number">Chương ${chapter.number}</div>  
                <div class="chapter-date">${chapter.publishDate}</div>
            </div> 
        `;
        console.log(chapter)
        card.onclick = ()=> { window.location.href = chapter.url}
        
        return card;
    }
    
    // Render pagination
    renderPagination() {
        const pagination = document.getElementById('pagination');
        const totalPages = this.getTotalPages();
        const jumptopage =   document.getElementsByClassName('jump-to-page');
        if (totalPages <= 1) {
            pagination.innerHTML = '';
            jumptopage[0].style.display = 'none';
            return;
        }
        
        pagination.innerHTML = '';
        
        // Previous button
        const prevBtn = this.createPaginationButton('‹', this.currentPage - 1, this.currentPage === 1);
        prevBtn.title = 'Previous page';
        pagination.appendChild(prevBtn);
        
        // Page numbers
        this.renderPageNumbers(pagination, totalPages);
        
        // Next button
        const nextBtn = this.createPaginationButton('›', this.currentPage + 1, this.currentPage === totalPages);
        nextBtn.title = 'Next page';
        pagination.appendChild(nextBtn);
    }
    
    // Render page numbers with smart ellipsis
    renderPageNumbers(pagination, totalPages) {
        const current = this.currentPage;
        const delta = 2; // Number of pages to show around current page
        
        // Always show first page
        if (current > delta + 2) {
            pagination.appendChild(this.createPaginationButton('1', 1));
            if (current > delta + 3) {
                pagination.appendChild(this.createEllipsis());
            }
        }
        
        // Show pages around current page
        const start = Math.max(1, current - delta);
        const end = Math.min(totalPages, current + delta);
        
        for (let i = start; i <= end; i++) {
            const btn = this.createPaginationButton(i.toString(), i, false, i === current);
            pagination.appendChild(btn);
        }
        
        // Always show last page
        if (current < totalPages - delta - 1) {
            if (current < totalPages - delta - 2) {
                pagination.appendChild(this.createEllipsis());
            }
            pagination.appendChild(this.createPaginationButton(totalPages.toString(), totalPages));
        }
    }
    
    // Create pagination button
    createPaginationButton(text, page, disabled = false, active = false) {
        const btn = document.createElement('button');
        btn.className = 'pagination-btn';
        btn.textContent = text;
        btn.disabled = disabled;
        
        if (active) {
            btn.classList.add('active');
        }
        
        if (!disabled) {
            btn.onclick = () => this.goToPage(page);
        }
        
        return btn;
    }
    
    // Create ellipsis
    createEllipsis() {
        const ellipsis = document.createElement('span');
        ellipsis.className = 'pagination-ellipsis';
        ellipsis.textContent = '...';
        return ellipsis;
    }
    
    // Update pagination info
    updatePaginationInfo() {
        const paginationInfo = document.getElementById('paginationInfo');
        const totalChapters = this.filteredChapters.length;
        const totalPages = this.getTotalPages();
        
        if (totalChapters === 0) {
            paginationInfo.textContent = '';
            return;
        }
        
        const startIndex = (this.currentPage - 1) * this.chaptersPerPage + 1;
        const endIndex = Math.min(this.currentPage * this.chaptersPerPage, totalChapters);
        
        paginationInfo.textContent = `Showing ${startIndex}-${endIndex} of ${totalChapters} chapters (Page ${this.currentPage} of ${totalPages})`;
        
        // Update jump to page input max value
        const jumpInput = document.getElementById('jumpToPageInput');
        jumpInput.max = totalPages;
        jumpInput.placeholder = `1-${totalPages}`;
    }
  
}

// Sample chapter data (100 chapters)
function generateChapterData() {
    var result = [];
    const chaptersData =  window.chapters;
    chaptersData.forEach(function(ch,index){
        var publishDate = new Date(ch.created_at);
         result.push({
            number: index + 1, 
            url: ch.url,
            publishDate: publishDate.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'numeric', 
                day: 'numeric' 
            }), 
        });
    });

    return result;
   
}

// Initialize pagination system
let chapterPagination;

// Event handlers
function changeChaptersPerPage() {
    const select = document.getElementById('chaptersPerPage');
    chapterPagination.setChaptersPerPage(select.value);
}

 

function jumpToPage() {
    const jumpInput = document.getElementById('jumpToPageInput');
    const page = parseInt(jumpInput.value);
    
    if (page && page > 0) {
        chapterPagination.goToPage(page);
        jumpInput.value = '';
    }
}

// Book actions 
// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Generate sample chapter data
    const chapters = generateChapterData(); 
    
    // Initialize pagination system
    chapterPagination = new ChapterPagination(chapters);
    
    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Arrow keys for navigation
        if (e.key === 'ArrowLeft' && e.ctrlKey) {
            e.preventDefault();
            chapterPagination.goToPage(chapterPagination.currentPage - 1);
        } else if (e.key === 'ArrowRight' && e.ctrlKey) {
            e.preventDefault();
            chapterPagination.goToPage(chapterPagination.currentPage + 1);
        }
        
        // Enter key in jump to page input
        if (e.key === 'Enter' && e.target.id === 'jumpToPageInput') {
            jumpToPage();
        }
    }); 
    
});

function toggleDescription() {
    const description = document.getElementById('bookDescription');
    const viewMoreBtn = document.getElementById('viewMoreBtn');
  
    description.classList.remove('collapsed');
    viewMoreBtn.style.display = 'none';
    
}