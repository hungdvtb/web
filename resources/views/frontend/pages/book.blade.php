@extends('frontend.layout')
@section('layout-column','two-columns')

@section('content')


<div class="main-container">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{route('home')}}">Trang chủ</a>
        <span>></span>
         @foreach ($book->book_in_multiple_cate as $item)
          <a href="{{ route('danh-muc', ['slug' => $item->slug]) }}"">{{$item->name}}</a> 
        @endforeach
       
        <span>></span>
        <span class="current">{{$book->name}}</span>
    </nav>

    <!-- Book Detail -->
    <div class="book-detail">
        <div class="book-header">
            <div class="books">
                <div class="book">
                    <div class="book-image-container">
                        <img src="<?= $book->thumb ?>" alt="Whispers of the Heart" itemprop="image">
                        <div class="book-title-overlay">
                            <?= $book->name ?>
                        </div>
                        <div class="book-author-overlay">
                            <?= $book->author ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-info">
                <div>
                    <h1 class="book-title-large">{{$book->name}}</h1>
                    <p class="book-subtitle-large">{{$book->author}}</p>

                    <div class="book-meta">
                        <div class="meta-item">
                            <span class="meta-label">Trang thái</span>
                            <span class="meta-value">{{ $book->book_status}}</span>
                        </div>
                           <div class="meta-item">
                            <span class="meta-label">Số chương</span>
                            <span class="meta-value">{{ $book->chapters->count()}}</span>
                        </div> 
                    </div>

                    <div class="rating-section" id="ratingSection">
                        <div class="stars-display" <?php if(!$reviewed):?> onclick="rateBook(event)" <?php endif;?>>
                           @for ($i = 1; $i <= 5; $i++)
                            <svg class="star <?= $i > round($book->average_rating) ? 'empty': '' ?>" data-rating="{{$i}}" data-id="{{$book->id}}" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                         @endfor
                        </div>
                        <span class="rating-text">{{$book->average_rating}}</span>
                        <span class="rating-count">( {{$book->rating_count}} reviews)</span>
                        <script> 
                            
                            const  container = document.getElementById('ratingSection');
                                container.addEventListener('mouseleave', () => { 
                                    hoverDisplay(<?= $book->average_rating ?>)
                                }); 
                         
                        </script>
                    </div>
                </div>

                <div class="book-description">
                                {!! $book->description !!}
                </div>
            </div>
        </div>
    </div>


    <div class="chapters-section" id="chaptersSection">

    
        <h2 class="section-title">Chapters</h2> 
        <div class="chapters-list" id="chaptersGrid">
            <div class="chapter-item" >
                <div class="chapter-info">
                    <div class="chapter-number">Chapter 45</div>
                    <div class="chapter-title">The Wedding Vows</div>
                    <div class="chapter-date">Published 2 days ago</div>
                </div>
                <div class="chapter-status status-new">NEW</div>
            </div>
        </div>
     
        <div class="pagination-container" id="paginationContainer"> 
            <div class="pagination" id="pagination"></div>
            <div class="jump-to-page">
                <label for="jumpToPageInput">Chuyển đến trang:</label>
                <input type="number" id="jumpToPageInput" min="1" >
                <button onclick="jumpToPage()">Đi</button>
            </div>
        </div>
        <script>
            <?php
            $chapters = array_map(function ($chapter) use ($book) {
                $chapter['url'] = route('chapter', ['bookslug' => $book->slug, 'slug' => $chapter['slug']]);
                return $chapter;
            }, $book->chapters->toArray());
            ?>
            window.chapters = <?= json_encode($chapters) ?>
        </script>
    </div>
</div>
<div class="right-container">
    <div class="right-column">
        <div class="related-section">
            <h2 class="section-title">Related Books</h2>

            <h3>More by Emma Rose</h3>
            <div class="related-books">
                <div class="related-book" onclick="viewBook('moonlit-promises')">
                    <div class="related-book-image">
                        <svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
                            <g transform="translate(30, 45)">
                                <circle cx="0" cy="-5" r="15" fill="rgba(255, 218, 185, 0.6)" stroke="rgba(205, 133, 133, 0.5)" stroke-width="1" />
                                <g transform="translate(-18, -15)">
                                    <path d="M0 -4 L1 -1 L4 -1 L1.5 1 L2.5 4 L0 2 L-2.5 4 L-1.5 1 L-4 -1 L-1 -1 Z"
                                        fill="rgba(255, 182, 193, 0.7)" />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="related-book-info">
                        <div class="related-book-title">Moonlit Promises</div>
                        <div class="related-book-author">Emma Rose</div>
                        <div class="related-book-rating">
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="rgba(205, 133, 133, 0.3)">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="related-book" onclick="viewBook('dancing-rain')">
                    <div class="related-book-image">
                        <svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
                            <g transform="translate(30, 45)">
                                <g opacity="0.6">
                                    <line x1="-15" y1="-20" x2="-13" y2="-12" stroke="rgba(135, 206, 235, 0.6)" stroke-width="1" />
                                    <line x1="0" y1="-18" x2="2" y2="-10" stroke="rgba(135, 206, 235, 0.6)" stroke-width="1" />
                                    <line x1="15" y1="-20" x2="17" y2="-12" stroke="rgba(135, 206, 235, 0.6)" stroke-width="1" />
                                </g>
                                <path d="M-2 -3 Q-4 -6 -1 -6 Q1 -8 3 -6 Q6 -6 4 -3 Q3 0 1 3 Q-1 0 -2 -3Z"
                                    fill="rgba(255, 182, 193, 0.7)" />
                            </g>
                        </svg>
                    </div>
                    <div class="related-book-info">
                        <div class="related-book-title">Dancing in the Rain</div>
                        <div class="related-book-author">Emma Rose</div>
                        <div class="related-book-rating">
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <h3>More Contemporary Romance</h3>
            <div class="related-books">
                <div class="related-book" onclick="viewBook('starlight-serenade')">
                    <div class="related-book-image">
                        <svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
                            <g transform="translate(30, 45)">
                                <circle cx="0" cy="-3" r="12" fill="rgba(255, 218, 185, 0.6)" />
                                <g transform="translate(-15, -12)">
                                    <path d="M0 -3 L0.8 -0.8 L3 -0.8 L1.2 0.8 L2 3 L0 1.5 L-2 3 L-1.2 0.8 L-3 -0.8 L-0.8 -0.8 Z"
                                        fill="rgba(255, 182, 193, 0.7)" />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="related-book-info">
                        <div class="related-book-title">Starlight Serenade</div>
                        <div class="related-book-author">Isabella Grace</div>
                        <div class="related-book-rating">
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="rgba(205, 133, 133, 0.3)">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="related-book" onclick="viewBook('letters-love')">
                    <div class="related-book-image">
                        <svg viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
                            <g transform="translate(30, 45)">
                                <rect x="-18" y="-8" width="36" height="20" fill="rgba(255, 245, 240, 0.8)" stroke="rgba(205, 133, 133, 0.6)" rx="1" />
                                <path d="M-18 -8 L0 3 L18 -8" fill="none" stroke="rgba(205, 133, 133, 0.6)" stroke-width="1" />
                                <path d="M-2 -2 Q-4 -5 -1 -5 Q1 -6 3 -5 Q6 -5 4 -2 Q3 1 1 4 Q-1 1 -2 -2Z"
                                    fill="rgba(255, 160, 122, 0.7)" />
                            </g>
                        </svg>
                    </div>
                    <div class="related-book-info">
                        <div class="related-book-title">Letters to My Love</div>
                        <div class="related-book-author">Sophia Lane</div>
                        <div class="related-book-rating">
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="#ffd700">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="related-star" viewBox="0 0 24 24" fill="rgba(205, 133, 133, 0.3)">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/detail.js') }}"></script>
@endsection