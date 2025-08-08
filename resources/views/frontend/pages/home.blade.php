 @extends('frontend.layout')
 @section('content')
 <section class="recommended-section">
     <h2 class="section-title">Truyện được đề xuất</h2>
     <div class="book-slider" onmouseenter="clearInterval(autoSlideInterval)" onmouseleave="startAutoSlide()">
         <div class="slider-container" id="sliderContainer"
             onmousedown="dragStart(event)"
             ontouchstart="dragStart(event)"
             ontouchmove="dragMove(event)"
             ontouchend="dragEnd(event)"
             style="cursor: grab;"
             onmousedown="this.style.cursor='grabbing'"
             onmouseup="this.style.cursor='grab'"
             onmouseleave="this.style.cursor='grab'">

             @foreach($books as $book)
             <div class="book-item" onmouseenter="showTooltip(event, <?= $book->id ?>)" onmouseleave="hideTooltip()">
                 <a href="  {{ route('detail', ['slug' => $book->slug]) }}">
                     <div class="book-cover">
                         <img src="{{$book->thumb}}" />
                     </div>
                     <div class="book-title">{{ $book->name}}</div>
                     <div class="book-author">{{$book->author}}</div>
                 </a>
             </div>
             @endforeach
         </div>

         <button class="slider-nav slider-prev" onclick="slideBooks(-1)">
             <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                 <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
             </svg>
         </button>
         <button class="slider-nav slider-next" onclick="slideBooks(1)">
             <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                 <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
             </svg>
         </button>
     </div>
 </section>
 <!-- Section 2: Two Column Layout -->
 <section class="content-section">
     <!-- Left Column: Stories (2/3 width) -->
     <div class="stories-column">
         <h3 class="column-title">
             <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                 <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
             </svg>
             Truyện mới cập nhật
         </h3>
         @foreach($books as $book)
         <div class="story-list">
             <div class="story-item" onmouseenter="showTooltip(event, <?= $book->id ?>)" onmouseleave="hideTooltip()"> 
                     <div class="story-cover">
                        <a href="  {{ route('detail', ['slug' => $book->slug]) }}">
                         <img src="{{$book->thumb}}" />
                        </a>
                     </div>
                     <div class="story-info">
                         <div>
                             <div class="story-title"><a href="  {{ route('detail', ['slug' => $book->slug]) }}">{{ $book->name}}</a></div>
                             <div class="story-author">{{$book->author}}</div>
                             <div class="story-rating">
                                 <div class="stars">
                                     <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                         <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                     </svg>
                                     <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                         <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                     </svg>
                                     <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                         <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                     </svg>
                                     <svg class="star" viewBox="0 0 24 24" fill="currentColor">
                                         <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                     </svg>
                                     <svg class="star empty" viewBox="0 0 24 24" fill="currentColor">
                                         <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                     </svg>
                                 </div>
                                 <span class="rating-text">4.5</span>
                             </div>
                         </div>
                         <div class="latest-chapter">Chapter 45</div>
                     </div>
                 </a>
             </div>
         </div>

         @endforeach

         <button class="show-more-btn" onclick="showMoreStories()">Xem tất cả</button>
     </div>

     <!-- Right Column: Sidebar (1/3 width) -->
     <div class="sidebar-column">
         <!-- Recent Reading Box -->
         <div class="sidebar-box">
             <h3 class="column-title">
                 <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                     <path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z" />
                 </svg>
                 Truyện đang đọc
             </h3>

             <div class="recent-item">
                 <div class="recent-info">
                     <div class="recent-title">Whispers of the Heart</div>
                     <div class="recent-chapter">Chapter 42</div>
                 </div>
             </div>

             <div class="recent-item">
                 <div class="recent-info">
                     <div class="recent-title">Moonlit Promises</div>
                     <div class="recent-chapter">Chapter 28</div>
                 </div>
             </div>

             <div class="recent-item">
                 <div class="recent-info">
                     <div class="recent-title">Dancing in the Rain</div>
                     <div class="recent-chapter">Chapter 15</div>
                 </div>
             </div>

             <div class="recent-item">
                 <div class="recent-info">
                     <div class="recent-title">Starlight Serenade</div>
                     <div class="recent-chapter">Chapter 8</div>
                 </div>
             </div>

             <div class="recent-item">
                 <div class="recent-info">
                     <div class="recent-title">Ocean Dreams</div>
                     <div class="recent-chapter">Chapter 3</div>
                 </div>
             </div>
         </div>

         <!-- Top Reads Box -->
         <div class="sidebar-box">
             <h3 class="column-title">
                 <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                     <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z" />
                 </svg>
                 Đọc nhiều
             </h3>

             <div class="tab-nav">
                 <button class="tab-btn active" onclick="switchTab('day')">Ngày</button>
                 <button class="tab-btn" onclick="switchTab('week')">Tuần</button>
                 <button class="tab-btn" onclick="switchTab('month')">Tháng</button>
             </div>

             <div class="tab-content active" id="day-content">
                 <div class="top-item">
                     <div class="top-rank">1</div>
                     <div class="top-info">
                         <div class="top-title">Whispers of the Heart</div>
                         <div class="top-reads">2.8K reads</div>
                     </div>
                 </div>
                 <div class="top-item">
                     <div class="top-rank">2</div>
                     <div class="top-info">
                         <div class="top-title">Moonlit Promises</div>
                         <div class="top-reads">2.1K reads</div>
                     </div>
                 </div>
                 <div class="top-item">
                     <div class="top-rank">3</div>
                     <div class="top-info">
                         <div class="top-title">Dancing in the Rain</div>
                         <div class="top-reads">1.9K reads</div>
                     </div>
                 </div>
                 <div class="top-item">
                     <div class="top-rank">4</div>
                     <div class="top-info">
                         <div class="top-title">Starlight Serenade</div>
                         <div class="top-reads">1.5K reads</div>
                     </div>
                 </div>
                 <div class="top-item">
                     <div class="top-rank">5</div>
                     <div class="top-info">
                         <div class="top-title">Ocean Dreams</div>
                         <div class="top-reads">1.2K reads</div>
                     </div>
                 </div>
             </div>

             <div class="tab-content" id="week-content">
                 <div class="top-item">
                     <div class="top-rank">1</div>
                     <div class="top-info">
                         <div class="top-title">Dancing in the Rain</div>
                         <div class="top-reads">15.2K reads</div>
                     </div>
                 </div>
                 <div class="top-item">
                     <div class="top-rank">2</div>
                     <div class="top-info">
                         <div class="top-title">Whispers of the Heart</div>
                         <div class="top-reads">14.8K reads</div>
                     </div>
                 </div>
                 <div class="top-item">
                     <div class="top-rank">3</div>
                     <div class="top-info">
                         <div class="top-title">Moonlit Promises</div>
                         <div class="top-reads">12.5K reads</div>
                     </div>
                 </div>
                 <div class="top-item">
                     <div class="top-rank">4</div>
                     <div class="top-info">
                         <div class="top-title">Winter Hearts</div>
                         <div class="top-reads">9.8K reads</div>
                     </div>
                 </div>
                 <div class="top-item">
                     <div class="top-rank">5</div>
                     <div class="top-info">
                         <div class="top-title">Ocean Dreams</div>
                         <div class="top-reads">8.9K reads</div>
                     </div>
                 </div>
             </div>

             <div class="tab-content" id="month-content">
                 <div class="top-item">
                     <div class="top-rank">1</div>
                     <div class="top-info">
                         <div class="top-title">Whispers of the Heart</div>
                         <div class="top-reads">89.5K reads</div>
                     </div>
                 </div>
                 <div class="top-item">
                     <div class="top-rank">2</div>
                     <div class="top-info">
                         <div class="top-title">Dancing in the Rain</div>
                         <div class="top-reads">76.2K reads</div>
                     </div>
                 </div>
                 <div class="top-item">
                     <div class="top-rank">3</div>
                     <div class="top-info">
                         <div class="top-title">Moonlit Promises</div>
                         <div class="top-reads">65.8K reads</div>
                     </div>
                 </div>
                 <div class="top-item">
                     <div class="top-rank">4</div>
                     <div class="top-info">
                         <div class="top-title">Starlight Serenade</div>
                         <div class="top-reads">52.1K reads</div>
                     </div>
                 </div>
                 <div class="top-item">
                     <div class="top-rank">5</div>
                     <div class="top-info">
                         <div class="top-title">Winter Hearts</div>
                         <div class="top-reads">48.7K reads</div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 @endsection