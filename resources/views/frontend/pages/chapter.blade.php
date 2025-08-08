@extends('frontend.layout')
@section('body-class-name','chapter-detail')
@section('content')
<!-- Breadcrumb -->
<nav class="breadcrumb">
  <a href="{{route('home')}}">Trang chủ</a>
  <span>></span>
  @foreach ($book->book_in_multiple_cate as $item)
  <a href="{{ route('danh-muc', ['slug' => $item->slug]) }}"">{{$item->name}}</a> 
              <span>></span>
            @endforeach 
             <a href=" {{ route('detail', ['slug' => $book->slug]) }}">{{$book->name}}</a>
  <span>></span>
  <span class="current">{{$chapter->name}}</span>
</nav>

<!-- Chapter Header -->
<div class="chapter-header">
  <div class="book-title">{{$chapter->book->name}}</div>
  <h1 class="chapter-title">{{$chapter->name}}</h1>
</div>

<!-- Sticky Navigation -->
<div class="sticky-nav" id="stickyNav">
  <div class="nav-controls">
    <a class="nav-button <?= $chapter->previousChapter() ? '' : 'opacityhide' ?> " href="<?= $chapter->previousChapter() ? route('chapter', ['bookslug' => $book->slug, 'slug' => $chapter->previousChapter()->slug]) : 'javascript:void(0)'; ?>" id="prevBtn">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
        <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
      </svg>
      Chương trước
    </a>

    <div class="chapter-selector">
      <div class="chapter-dropdown" onclick="toggleChapterList()">
        <span id="currentChapterText"><?= $chapter->name ?></span>
        <svg class="dropdown-arrow" id="dropdownArrow" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
          <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" />
        </svg>
      </div>

      <div class="chapter-list-dropdown" id="chapterListDropdown">
        <div class="search-box">
          <input type="text" class="search-input" placeholder="Search chapters..."
            oninput="searchChapters(this.value)" id="searchInput">
        </div>
        <div class="chapter-list" id="chapterList">
          <!-- Chapter list will be populated by JavaScript -->
        </div>
      </div>
    </div>

    <a class="nav-button <?= $chapter->nextChapter() ? '' : 'opacityhide' ?>" href="<?= $chapter->nextChapter() ? route('chapter', ['bookslug' => $book->slug, 'slug' => $chapter->nextChapter()->slug]) : 'javascript:void(0)'; ?>" id="prevBtn">
      Chương sau
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
        <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" />
      </svg>
    </a>
  </div>
</div>

<!-- Chapter Content -->
<div class="chapter-content">
  {!! $chapter->content !!}
</div>

<!-- Bottom Navigation -->
<div class="bottom-nav">
  <a class="bottom-nav-button <?= $chapter->previousChapter() ? '' : 'opacityhide' ?>" href="<?= $chapter->previousChapter() ? route('chapter', ['bookslug' => $book->slug, 'slug' => $chapter->previousChapter()->slug]) : 'javascript:void(0)'; ?>" id="prevBtn">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
      <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
    </svg>
    Chương trước
  </a>

  <div class="chapter-info-bottom">
  
  </div>

  <a class="bottom-nav-button <?= $chapter->nextChapter() ? '' : 'opacityhide' ?>" href="<?= $chapter->nextChapter() ? route('chapter', ['bookslug' => $book->slug, 'slug' => $chapter->nextChapter()->slug]) : 'javascript:void(0)'; ?>" id="prevBtn">
    Chương sau
    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
      <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" />
    </svg>
  </a>
</div>
<script>
  <?php
     $chapters = array_map(function ($chapter) use ($book) {
                $chapter['url'] = route('chapter', ['bookslug' => $book->slug, 'slug' => $chapter['slug']]);
                return $chapter;
            }, $book->chapters->toArray());
            ?>
  
  window.dataChapter = <?= json_encode($chapters) ?>;
  
  window.currentChapter = <?= $chapter->id ?>
</script>
<script src="{{ asset('js/chapter.js') }}"></script>
@endsection