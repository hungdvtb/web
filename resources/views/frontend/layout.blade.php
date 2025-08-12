<!DOCTYPE html>
<html lang="en">
@include('frontend.head')
<body class="@yield('body-class-name')">

    <?php if(env('GOOGLE_TAG_ID')): ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= env('GOOGLE_TAG_ID') ?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    <?php endif; ?>
    <!-- Header --> 
    @include('frontend.header')
    <!---- content -->
    
    <!-- Main Content -->
    <div class="main-content @yield('layout-column')">
         @yield('content')  
    </div>

    <!-- Footer -->
   

    <!-- Tooltip Element -->
    <div class="book-tooltip" id="bookTooltip">
        <div class="tooltip-arrow"></div>
        <div class="tooltip-header">
            <div class="tooltip-cover" id="tooltipCover"></div>
            <div class="tooltip-info">
                <div class="tooltip-title" id="tooltipTitle"></div>
                <div class="tooltip-author" id="tooltipAuthor"></div>
                <div class="tooltip-rating">
                    <div class="tooltip-stars" id="tooltipStars"></div>
                    <span class="tooltip-rating-text" id="tooltipRating"></span>
                </div>
            </div>
        </div>
        <div class="tooltip-description" id="tooltipDescription"></div>
        <div class="tooltip-chapters">
            <div class="tooltip-chapters-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                </svg>
                Latest Chapters
            </div>
            <div class="chapters-list" id="tooltipChapters"></div>
        </div>
    </div>
   <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
