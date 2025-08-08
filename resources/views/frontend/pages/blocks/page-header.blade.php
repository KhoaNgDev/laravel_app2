 <div class="page-header parallaxie">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="page-header-box">
                     <h1 class="text-anime-style-3" data-cursor="-opaque">@yield('module')</h1>
                     <nav class="wow fadeInUp">
                         <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="{{ route('homepage') }}">@yield('title')</a></li>
                             <li class="breadcrumb-item active" aria-current="page">@yield('module')</li>
                         </ol>
                     </nav>
                 </div>
             </div>
         </div>
     </div>
 </div>
