 <nav class="navbar navbar-expand-lg">
   <div class="container">
     <a class="logo" href="{{ route('home') }}">
       <img src="{{ asset('theme/images/logo.png') }}" />
     </a> 
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>

     <div class="collapse navbar-collapse" id="navbarNav">
       <ul class="navbar-nav ms-lg-5 me-lg-auto">
         <li class="nav-item">
           <a class="nav-link click-scroll" href="#section_1">Truyện mới</a>
         </li>
         <li class="nav-item">
           <a class="nav-link click-scroll" href="#section_2">Lịch sử</a>
         </li>
       </ul>

       <div class=" d-lg-block search-block">

         <form method="get" role="search">
           <div class="input-group  ">

             <input name="keyword" type="search" class="form-control" id="keyword" placeholder="Tìm kiếm truyện,tác giả" aria-label="Tìm kiếm">

             <button type="submit" class="form-control"><i class="bi bi-search"></i></button>
           </div>
         </form>

       </div>
     </div>
   </div>
 </nav>