 @extends('frontend.layout')
@section('layout-column','one-columns')
@section('content')
            <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Romance Novels</h1>
            <p class="page-subtitle">Discover Your Next Favorite Love Story</p>
        </div>

        <!-- Search and Filter Bar -->
        <div class="filter-bar">
            <div class="search-box">
                <input type="text" class="search-input" placeholder="Search stories by title, author, or keywords..." oninput="searchStories(this.value)">
            </div>
            <select class="filter-select" onchange="filterByGenre(this.value)">
                <option value="">All Genres</option>
                <option value="contemporary">Contemporary Romance</option>
                <option value="historical">Historical Romance</option>
                <option value="fantasy">Fantasy Romance</option>
                <option value="paranormal">Paranormal Romance</option>
                <option value="young-adult">Young Adult Romance</option>
            </select>
            <select class="filter-select" onchange="filterByStatus(this.value)">
                <option value="">All Status</option>
                <option value="completed">Completed</option>
                <option value="ongoing">Ongoing</option>
            </select>
            <select class="filter-select" onchange="sortStories(this.value)">
                <option value="latest">Latest Updated</option>
                <option value="popular">Most Popular</option>
                <option value="rating">Highest Rated</option>
                <option value="title">Title A-Z</option>
            </select>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Left Column - Stories List -->
            <div class="stories-section">
                <h2 class="section-title">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                    </svg>
                    Featured Stories
                </h2>
                
                <div class="stories-grid" id="storiesGrid">
                    <!-- Story Card 1 -->
                    <div class="story-card" onclick="viewStory('whispers-heart')">
                        <div class="story-image">
                            <svg viewBox="0 0 120 180" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 80px; height: 120px;">
                                <g transform="translate(60, 90)">
                                    <!-- Wings -->
                                    <path d="M-30 -8 Q-45 -22 -52 -11 Q-48 0 -30 4" fill="rgba(255, 182, 193, 0.4)" stroke="rgba(205, 133, 133, 0.6)" stroke-width="1"/>
                                    <path d="M30 -8 Q45 -22 52 -11 Q48 0 30 4" fill="rgba(255, 182, 193, 0.4)" stroke="rgba(205, 133, 133, 0.6)" stroke-width="1"/>
                                    <!-- Heart -->
                                    <path d="M-15 -4 Q-22 -15 -11 -15 Q0 -18 11 -15 Q22 -15 15 -4 Q11 8 0 18 Q-11 8 -15 -4Z" 
                                          fill="rgba(255, 160, 122, 0.5)" stroke="rgba(205, 133, 133, 0.7)" stroke-width="2"/>
                                </g>
                            </svg>
                        </div>
                        <div class="story-info">
                            <div>
                                <h3 class="story-title">Whispers of the Heart</h3>
                                <p class="story-author">by Emma Rose</p>
                                <div class="story-meta">
                                    <span class="story-genre">Contemporary Romance</span>
                                    <span class="story-status status-completed">Completed</span>
                                </div>
                                <p class="story-description">In the enchanting world of "Whispers of the Heart," follow the journey of Isabella, a talented artist who discovers love in the most unexpected places. When she meets Alexander, a mysterious writer with secrets of his own, their worlds collide in a symphony of passion and dreams.</p>
                            </div>
                            <div>
                                <div class="story-stats">
                                    <div class="story-rating">
                                        <div class="stars">
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star empty" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        </div>
                                        <span>4.5</span>
                                    </div>
                                    <div class="stat-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                        45 Chapters
                                    </div>
                                    <div class="stat-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                                        </svg>
                                        2.8K reads
                                    </div>
                                </div>
                                <div class="latest-chapter">
                                    <div class="chapter-title">Chapter 45: The Wedding Vows</div>
                                    <div class="chapter-date">Updated 2 days ago</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Story Card 2 -->
                    <div class="story-card" onclick="viewStory('moonlit-promises')">
                        <div class="story-image">
                            <svg viewBox="0 0 120 180" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 80px; height: 120px;">
                                <g transform="translate(60, 90)">
                                    <circle cx="0" cy="-10" r="25" fill="rgba(255, 218, 185, 0.6)" stroke="rgba(205, 133, 133, 0.5)" stroke-width="1"/>
                                    <g transform="translate(-30, -25)">
                                        <path d="M0 -6 L1.5 -1.5 L6 -1.5 L2.25 1.5 L3.75 6 L0 3 L-3.75 6 L-2.25 1.5 L-6 -1.5 L-1.5 -1.5 Z" 
                                              fill="rgba(255, 182, 193, 0.7)"/>
                                    </g>
                                    <g transform="translate(25, -20)">
                                        <path d="M0 -4 L1 -1 L4 -1 L1.5 1 L2.5 4 L0 2 L-2.5 4 L-1.5 1 L-4 -1 L-1 -1 Z" 
                                              fill="rgba(255, 182, 193, 0.7)"/>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="story-info">
                            <div>
                                <h3 class="story-title">Moonlit Promises</h3>
                                <p class="story-author">by Emma Rose</p>
                                <div class="story-meta">
                                    <span class="story-genre">Contemporary Romance</span>
                                    <span class="story-status status-ongoing">Ongoing</span>
                                </div>
                                <p class="story-description">Under the silver glow of the moon, Sarah makes a promise that will change her life forever. A story of second chances, healing hearts, and the magic that happens when two souls find each other in the darkness.</p>
                            </div>
                            <div>
                                <div class="story-stats">
                                    <div class="story-rating">
                                        <div class="stars">
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        </div>
                                        <span>4.8</span>
                                    </div>
                                    <div class="stat-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                        32 Chapters
                                    </div>
                                    <div class="stat-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                                        </svg>
                                        1.9K reads
                                    </div>
                                </div>
                                <div class="latest-chapter">
                                    <div class="chapter-title">Chapter 32: Under the Stars</div>
                                    <div class="chapter-date">Updated 1 day ago</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Story Card 3 -->
                    <div class="story-card" onclick="viewStory('dancing-rain')">
                        <div class="story-image">
                            <svg viewBox="0 0 120 180" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 80px; height: 120px;">
                                <g transform="translate(60, 90)">
                                    <g opacity="0.6">
                                        <line x1="-25" y1="-30" x2="-22" y2="-18" stroke="rgba(135, 206, 235, 0.6)" stroke-width="2"/>
                                        <line x1="-10" y1="-28" x2="-7" y2="-16" stroke="rgba(135, 206, 235, 0.6)" stroke-width="2"/>
                                        <line x1="5" y1="-30" x2="8" y2="-18" stroke="rgba(135, 206, 235, 0.6)" stroke-width="2"/>
                                        <line x1="20" y1="-28" x2="23" y2="-16" stroke="rgba(135, 206, 235, 0.6)" stroke-width="2"/>
                                    </g>
                                    <path d="M-3 -5 Q-6 -9 -1.5 -9 Q1.5 -12 4.5 -9 Q9 -9 6 -5 Q4.5 0 1.5 4.5 Q-1.5 0 -3 -5Z" 
                                          fill="rgba(255, 182, 193, 0.7)"/>
                                </g>
                            </svg>
                        </div>
                        <div class="story-info">
                            <div>
                                <h3 class="story-title">Dancing in the Rain</h3>
                                <p class="story-author">by Emma Rose</p>
                                <div class="story-meta">
                                    <span class="story-genre">Contemporary Romance</span>
                                    <span class="story-status status-completed">Completed</span>
                                </div>
                                <p class="story-description">Sometimes the most beautiful moments happen in the storm. Maya learns to dance again, not just with her feet, but with her heart, when she meets David on a rainy Tuesday that changes everything.</p>
                            </div>
                            <div>
                                <div class="story-stats">
                                    <div class="story-rating">
                                        <div class="stars">
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        </div>
                                        <span>4.9</span>
                                    </div>
                                    <div class="stat-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                        28 Chapters
                                    </div>
                                    <div class="stat-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                                        </svg>
                                        3.2K reads
                                    </div>
                                </div>
                                <div class="latest-chapter">
                                    <div class="chapter-title">Chapter 28: Forever Dance</div>
                                    <div class="chapter-date">Completed 1 week ago</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Story Card 4 -->
                    <div class="story-card" onclick="viewStory('starlight-serenade')">
                        <div class="story-image">
                            <svg viewBox="0 0 120 180" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 80px; height: 120px;">
                                <g transform="translate(60, 90)">
                                    <circle cx="0" cy="-5" r="20" fill="rgba(255, 218, 185, 0.6)"/>
                                    <g transform="translate(-25, -20)">
                                        <path d="M0 -5 L1.2 -1.2 L5 -1.2 L2 1.2 L3.2 5 L0 2.5 L-3.2 5 L-2 1.2 L-5 -1.2 L-1.2 -1.2 Z" 
                                              fill="rgba(255, 182, 193, 0.7)"/>
                                    </g>
                                    <g transform="translate(20, -15)">
                                        <path d="M0 -3 L0.8 -0.8 L3 -0.8 L1.2 0.8 L2 3 L0 1.5 L-2 3 L-1.2 0.8 L-3 -0.8 L-0.8 -0.8 Z" 
                                              fill="rgba(255, 182, 193, 0.7)"/>
                                    </g>
                                    <g transform="translate(0, -25)">
                                        <path d="M0 -2 L0.5 -0.5 L2 -0.5 L0.8 0.5 L1.3 2 L0 1 L-1.3 2 L-0.8 0.5 L-2 -0.5 L-0.5 -0.5 Z" 
                                              fill="rgba(255, 182, 193, 0.7)"/>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="story-info">
                            <div>
                                <h3 class="story-title">Starlight Serenade</h3>
                                <p class="story-author">by Isabella Grace</p>
                                <div class="story-meta">
                                    <span class="story-genre">Fantasy Romance</span>
                                    <span class="story-status status-ongoing">Ongoing</span>
                                </div>
                                <p class="story-description">In a world where music has magic, Lyra discovers her voice can heal hearts and mend souls. But when she meets Orion, a mysterious bard with secrets written in the stars, she learns that some melodies are worth risking everything for.</p>
                            </div>
                            <div>
                                <div class="story-stats">
                                    <div class="story-rating">
                                        <div class="stars">
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <svg class="star empty" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        </div>
                                        <span>4.3</span>
                                    </div>
                                    <div class="stat-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                        18 Chapters
                                    </div>
                                    <div class="stat-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                                        </svg>
                                        1.5K reads
                                    </div>
                                </div>
                                <div class="latest-chapter">
                                    <div class="chapter-title">Chapter 18: The Celestial Symphony</div>
                                    <div class="chapter-date">Updated 3 days ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <button class="page-btn" onclick="goToPage(1)">First</button>
                    <button class="page-btn" onclick="previousPage()">Previous</button>
                    <button class="page-btn active" onclick="goToPage(1)">1</button>
                    <button class="page-btn" onclick="goToPage(2)">2</button>
                    <button class="page-btn" onclick="goToPage(3)">3</button>
                    <button class="page-btn" onclick="goToPage(4)">4</button>
                    <button class="page-btn" onclick="goToPage(5)">5</button>
                    <button class="page-btn" onclick="nextPage()">Next</button>
                    <button class="page-btn" onclick="goToPage(5)">Last</button>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="sidebar">
                <!-- Hot Books Section -->
                <div class="sidebar-section">
                    <h3 class="sidebar-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.5.67s.74 2.65.74 4.8c0 2.06-1.35 3.73-3.41 3.73-2.07 0-3.63-1.67-3.63-3.73l.03-.36C5.21 7.51 4 10.62 4 14c0 4.42 3.58 8 8 8s8-3.58 8-8C20 8.61 17.41 3.8 13.5.67zM11.71 19c-1.78 0-3.22-1.4-3.22-3.14 0-1.62 1.05-2.76 2.81-3.12 1.77-.36 3.6-1.21 4.62-2.58.39 1.29.59 2.65.59 4.04 0 2.65-2.15 4.8-4.8 4.8z"/>
                        </svg>
                        Hot Books
                    </h3>
                    <div class="hot-books">
                        <div class="hot-book" onclick="viewStory('letters-love')">
                            <div class="hot-book-image">
                                <svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 40px; height: 60px;">
                                    <g transform="translate(30, 45)">
                                        <rect x="-25" y="-12" width="50" height="28" fill="rgba(255, 245, 240, 0.8)" stroke="rgba(205, 133, 133, 0.6)" rx="2"/>
                                        <path d="M-25 -12 L0 4 L25 -12" fill="none" stroke="rgba(205, 133, 133, 0.6)" stroke-width="1"/>
                                        <path d="M-3 -3 Q-5 -7 -1.5 -7 Q1.5 -8 4.5 -7 Q8 -7 6 -3 Q4.5 2 1.5 6 Q-1.5 2 -3 -3Z" 
                                              fill="rgba(255, 160, 122, 0.7)"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="hot-book-info">
                                <div class="hot-book-title">Letters to My Love</div>
                                <div class="hot-book-author">Sophia Lane</div>
                                <div class="hot-book-rating">
                                    <div class="stars">
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </div>
                                    <span style="font-size: 12px; color: rgba(139, 69, 19, 0.6);">4.9</span>
                                </div>
                            </div>
                        </div>

                        <div class="hot-book" onclick="viewStory('midnight-garden')">
                            <div class="hot-book-image">
                                <svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 40px; height: 60px;">
                                    <g transform="translate(30, 45)">
                                        <circle cx="0" cy="-2" r="18" fill="rgba(144, 238, 144, 0.4)" stroke="rgba(34, 139, 34, 0.5)"/>
                                        <path d="M-8 2 Q-12 -2 -8 -6 Q-4 -8 0 -6 Q4 -8 8 -6 Q12 -2 8 2 Q4 6 0 8 Q-4 6 -8 2Z" 
                                              fill="rgba(255, 182, 193, 0.6)"/>
                                        <circle cx="-10" cy="-8" r="2" fill="rgba(255, 218, 185, 0.8)"/>
                                        <circle cx="8" cy="-6" r="1.5" fill="rgba(255, 218, 185, 0.8)"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="hot-book-info">
                                <div class="hot-book-title">The Midnight Garden</div>
                                <div class="hot-book-author">Rose Mitchell</div>
                                <div class="hot-book-rating">
                                    <div class="stars">
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="rgba(205, 133, 133, 0.3)">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </div>
                                    <span style="font-size: 12px; color: rgba(139, 69, 19, 0.6);">4.7</span>
                                </div>
                            </div>
                        </div>

                        <div class="hot-book" onclick="viewStory('ocean-dreams')">
                            <div class="hot-book-image">
                                <svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 40px; height: 60px;">
                                    <g transform="translate(30, 45)">
                                        <path d="M-20 5 Q-15 -5 -10 5 Q-5 -3 0 5 Q5 -3 10 5 Q15 -5 20 5" 
                                              fill="none" stroke="rgba(135, 206, 235, 0.6)" stroke-width="2"/>
                                        <path d="M-20 10 Q-15 0 -10 10 Q-5 2 0 10 Q5 2 10 10 Q15 0 20 10" 
                                              fill="none" stroke="rgba(135, 206, 235, 0.6)" stroke-width="2"/>
                                        <circle cx="0" cy="-8" r="8" fill="rgba(255, 218, 185, 0.6)"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="hot-book-info">
                                <div class="hot-book-title">Ocean Dreams</div>
                                <div class="hot-book-author">Marina Blue</div>
                                <div class="hot-book-rating">
                                    <div class="stars">
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </div>
                                    <span style="font-size: 12px; color: rgba(139, 69, 19, 0.6);">4.8</span>
                                </div>
                            </div>
                        </div>

                        <div class="hot-book" onclick="viewStory('winter-hearts')">
                            <div class="hot-book-image">
                                <svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 40px; height: 60px;">
                                    <g transform="translate(30, 45)">
                                        <g opacity="0.7">
                                            <path d="M-15 -15 L-10 -20 L-5 -15 L-10 -10 Z" fill="rgba(173, 216, 230, 0.6)"/>
                                            <path d="M5 -18 L10 -23 L15 -18 L10 -13 Z" fill="rgba(173, 216, 230, 0.6)"/>
                                            <path d="M-5 -5 L0 -10 L5 -5 L0 0 Z" fill="rgba(173, 216, 230, 0.6)"/>
                                        </g>
                                        <path d="M-3 5 Q-6 1 -1.5 1 Q1.5 -1 4.5 1 Q9 1 6 5 Q4.5 10 1.5 14 Q-1.5 10 -3 5Z" 
                                              fill="rgba(255, 182, 193, 0.7)"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="hot-book-info">
                                <div class="hot-book-title">Winter Hearts</div>
                                <div class="hot-book-author">Crystal Snow</div>
                                <div class="hot-book-rating">
                                    <div class="stars">
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="#ffd700">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <svg class="hot-star" viewBox="0 0 24 24" fill="rgba(205, 133, 133, 0.3)">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </div>
                                    <span style="font-size: 12px; color: rgba(139, 69, 19, 0.6);">4.6</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Genres Section -->
                <div class="sidebar-section">
                    <h3 class="sidebar-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        Browse by Genre
                    </h3>
                    <div class="genre-list">
                        <div class="genre-item" onclick="filterByGenre('contemporary')">
                            <span class="genre-name">Contemporary Romance</span>
                            <span class="genre-count">156</span>
                        </div>
                        <div class="genre-item" onclick="filterByGenre('historical')">
                            <span class="genre-name">Historical Romance</span>
                            <span class="genre-count">89</span>
                        </div>
                        <div class="genre-item" onclick="filterByGenre('fantasy')">
                            <span class="genre-name">Fantasy Romance</span>
                            <span class="genre-count">124</span>
                        </div>
                        <div class="genre-item" onclick="filterByGenre('paranormal')">
                            <span class="genre-name">Paranormal Romance</span>
                            <span class="genre-count">67</span>
                        </div>
                        <div class="genre-item" onclick="filterByGenre('young-adult')">
                            <span class="genre-name">Young Adult Romance</span>
                            <span class="genre-count">203</span>
                        </div>
                        <div class="genre-item" onclick="filterByGenre('romantic-suspense')">
                            <span class="genre-name">Romantic Suspense</span>
                            <span class="genre-count">45</span>
                        </div>
                        <div class="genre-item" onclick="filterByGenre('western')">
                            <span class="genre-name">Western Romance</span>
                            <span class="genre-count">32</span>
                        </div>
                        <div class="genre-item" onclick="filterByGenre('sci-fi')">
                            <span class="genre-name">Sci-Fi Romance</span>
                            <span class="genre-count">78</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

 


