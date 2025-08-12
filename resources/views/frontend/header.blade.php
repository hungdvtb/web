  <header class="main-header">
      <div class="header-container">
          <div class="logo-section">
              <a href="{{ route('home')}}" class="logo">
                  <div class="logo">
                      <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g transform="translate(20, 20)">
                              <path d="M-8 -4 Q-12 -12 -6 -12 Q0 -15 6 -12 Q12 -12 8 -4 Q6 4 0 10 Q-6 4 -8 -4Z"
                                  fill="rgba(255, 160, 122, 0.8)" stroke="rgba(205, 133, 133, 0.9)" stroke-width="1.5" />
                              <circle cx="0" cy="-2" r="3" fill="rgba(255, 182, 193, 0.6)" />
                          </g>
                      </svg>
                      <span class="logo-text">TruyệnDV</span>
                  </div>
              </a>
              <p class="tagline">Đọc truyện online mới nhất</p>
          </div>

          <!-- Desktop Navigation -->
          <nav class="main-nav">
              <ul class="nav-links">

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          Thể loại
                          <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                              <path d="M7 10l5 5 5-5z" />
                          </svg>
                      </a>
                      <div class="dropdown-menu grid4">
                          @foreach($categories as $category)

                          <a href="{{ route('danh-muc', ['slug'=> $category->slug]) }}" class="dropdown-item">
                              {{ $category->name }}
                          </a>

                          @endforeach
                      </div>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          Danh sách
                          <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                              <path d="M7 10l5 5 5-5z" />
                          </svg>
                      </a>
                      <div class="dropdown-menu">
                          @foreach($categories as $category) 
                          <a href="{{ route('danh-muc', ['slug'=> $category->slug]) }}" class="dropdown-item">
                              {{ $category->name }}
                          </a> 
                          @endforeach
                      </div>
                  </li>
              </ul>

              <!-- Search Container -->
              <div class="search-container">
                  <input type="text" class="search-input" placeholder="Tìm kiếm truyện,tác giả..."
                      oninput="searchStories(this.value)"
                      onfocus="showSearchSuggestions()"
                      onblur="hideSearchSuggestions()">
                  <div class="search-dropdown" id="searchDropdown">
                      <div class="search-suggestion" onclick="selectSuggestion('Whispers of the Heart', 'story')">
                          <svg class="suggestion-icon" viewBox="0 0 24 24" fill="currentColor">
                              <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                          </svg>
                          <span class="suggestion-text">Whispers of the Heart</span>
                          <span class="suggestion-type">Story</span>
                      </div>
                      <div class="search-suggestion" onclick="selectSuggestion('Emma Rose', 'author')">
                          <svg class="suggestion-icon" viewBox="0 0 24 24" fill="currentColor">
                              <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                          </svg>
                          <span class="suggestion-text">Emma Rose</span>
                          <span class="suggestion-type">Author</span>
                      </div>
                      <div class="search-suggestion" onclick="selectSuggestion('Contemporary Romance', 'genre')">
                          <svg class="suggestion-icon" viewBox="0 0 24 24" fill="currentColor">
                              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                          </svg>
                          <span class="suggestion-text">Contemporary Romance</span>
                          <span class="suggestion-type">Genre</span>
                      </div>
                      <div class="search-suggestion" onclick="selectSuggestion('Moonlit Promises', 'story')">
                          <svg class="suggestion-icon" viewBox="0 0 24 24" fill="currentColor">
                              <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                          </svg>
                          <span class="suggestion-text">Moonlit Promises</span>
                          <span class="suggestion-type">Story</span>
                      </div>
                      <div class="search-suggestion" onclick="selectSuggestion('Dancing in the Rain', 'story')">
                          <svg class="suggestion-icon" viewBox="0 0 24 24" fill="currentColor">
                              <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                          </svg>
                          <span class="suggestion-text">Dancing in the Rain</span>
                          <span class="suggestion-type">Story</span>
                      </div>
                  </div>
              </div>
          </nav>

          <!-- Header Actions -->
          <div class="header-actions">
              <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
                  </svg>
              </button>
          </div>

          <!-- Mobile Navigation -->
          <nav class="mobile-nav" id="mobileNav">
              <div class="mobile-nav-content">
                  <!-- Mobile Search -->
                  <div class="mobile-search">
                      <input type="text" class="mobile-search-input" placeholder="Search stories, authors..." oninput="searchStories(this.value)">
                  </div>

                  <ul class="mobile-nav-links"> 
                      <li class="mobile-nav-item">
                          <a href="#" class="mobile-nav-link" onclick="toggleMobileDropdown(event, 'browse')">
                              Thể loại
                              <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                  <path d="M7 10l5 5 5-5z" />
                              </svg>
                          </a>
                          <div class="mobile-dropdown" id="browse-dropdown">
                                  @foreach($categories   as $category)
                            
                                <a href="{{ route('danh-muc', ['slug'=> $category->slug]) }}" class="dropdown-item">
                                    {{ $category->name }}
                                </a>
                            
                        @endforeach 
                          </div>
                      </li>
                      <li class="mobile-nav-item">
                          <a href="#" class="mobile-nav-link" onclick="toggleMobileDropdown(event, 'genres')">
                              Danh sách
                              <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                  <path d="M7 10l5 5 5-5z" />
                              </svg>
                          </a>
                          <div class="mobile-dropdown" id="genres-dropdown">
                                @foreach($categories   as $category)
                            
                                <a href="{{ route('danh-muc', ['slug'=> $category->slug]) }}" class="dropdown-item">
                                    {{ $category->name }}
                                </a>
                            
                        @endforeach 
                          </div>
                      </li>
                  </ul>
              </div>
          </nav>
      </div>
  </header>