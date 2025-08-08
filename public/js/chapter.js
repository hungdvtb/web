const chapters = window.dataChapter
let currentChapter = window.currentChapter;
let isDropdownOpen = false;
let allChapters = window.dataChapter
 
populateChapterList()
 

function loadChapter(selectChapter) {
    let chapter = chapters.find(ch => ch.id === selectChapter.id);
    if (chapter) {
        // Update page title and header 
        document.querySelector('.chapter-title').textContent = chapter.name
        document.querySelector('#currentChapterText').textContent = chapter.name
        document.querySelector('.chapter-title-bottom').textContent = chapter.name;  
        // Update chapter list highlighting
        populateChapterList();

        // Close dropdown if open
        if (isDropdownOpen) {
            toggleChapterList();
        }

        window.location.href = chapter.url

       
    }
}
 

function toggleChapterList() {
    const dropdown = document.getElementById('chapterListDropdown');
    const arrow = document.getElementById('dropdownArrow');

    isDropdownOpen = !isDropdownOpen;

    if (isDropdownOpen) {
        dropdown.classList.add('show');
        arrow.classList.add('open');
        document.getElementById('searchInput').focus();
    } else {
        dropdown.classList.remove('show');
        arrow.classList.remove('open');
        document.getElementById('searchInput').value = '';
        allChapters = [...chapters];
        populateChapterList();
    }
}

function populateChapterList() {
    const chapterList = document.getElementById('chapterList');
    chapterList.innerHTML = '';

    allChapters.forEach(chapter => {
        const item = document.createElement('div');
        item.className = `chapter-list-item ${chapter.id === currentChapter ? 'current' : ''}`;
        item.onclick = () => {
            loadChapter(chapter);
        }; 
        item.innerHTML = `
                    <div class="chapter-item-info">
                        <div class="chapter-item-number">  ${chapter.name}</div> 
                    </div> 
                `;

        chapterList.appendChild(item);
    });
}

function searchChapters(query) {
    if (!query.trim()) {
        allChapters = [...chapters];
    } else {
        const searchTerm = query.toLowerCase();
        allChapters = chapters.filter(chapter =>
            chapter.name.toLowerCase().includes(searchTerm)
        );
    }
    populateChapterList();
}

// Close dropdown when clicking outside
document.addEventListener('click', function (event) {
    const chapterSelector = document.querySelector('.chapter-selector');
    if (isDropdownOpen && !chapterSelector.contains(event.target)) {
        toggleChapterList();
    }
});

// Keyboard navigation
document.addEventListener('keydown', function (event) {
    if (event.key === 'ArrowLeft' && currentChapter > 1) {
        previousChapter();
    } else if (event.key === 'ArrowRight' && currentChapter < chapters.length) {
        nextChapter();
    } else if (event.key === 'Escape' && isDropdownOpen) {
        toggleChapterList();
    }
});

 