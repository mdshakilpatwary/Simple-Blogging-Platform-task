<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
        <title>Blog site </title>
</head>
<body>
  <section style="border-bottom:1px solid #ddd;">
    <div class="container">
        <div class="pt-3 pb-3" style="text-align: right">
            @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                @if(Auth::user()->role == 'Admin')
                    <a href="{{ url('admin/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @elseif(Auth::user()->role == 'User') 
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @endif
                @else
                    <a href="{{ route('login') }}" class=" btn  btn-outline-info font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-success ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        </div>
    </div>
  </section>
  <section class="pt-4">
    <div class="container">
        <h2 class="text-center pb-1">Blog site</h2>
        <div class="row g-4">
            @foreach($blogPost as $blog)
            <div class="col-md-4 col-lg-4 col-xl-4 col-12 col-sm-12">
                <div class="blog-info">
                    <a href="{{route('single.blog',$blog->slug)}}"> <img src="{{asset($blog->image)}}" alt="" style="width: 100%; height: 300px;">
                    </a>
                    <div class="blog-footer text-center">
                        <h3><a href="{{route('single.blog',$blog->slug)}}">{{Str::words($blog->title, 5, ' ...')}}</a></h3>
                        <p>{{$blog->created_at->format('M d,y-  h:iA')}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <hr>
        <div class="blog-filter pt-4" style="display: flex; justify-content:space-around;">
            <span class="store-qty" style="padding:0 10px; font-size: 20px">Showing {{ $blogPost->firstItem() }} - {{ $blogPost->lastItem() }} Blog</span>
            
            <div class="">
                <div class="custom-pagination text-center">
                    <div class="pagination" >
                        {{-- Previous Page Link --}}
                        @if ($blogPost->onFirstPage())
                            <span class="disabled" style="padding:0 10px; font-size: 20px">Previous</span>
                        @else
                            <a href="{{ $blogPost->previousPageUrl() }}" style="padding:0 10px; font-size: 20px" rel="prev">Previous</a>
                        @endif
                
                        {{-- Pagination Elements --}}
                        @for ($i = 1; $i <= $blogPost->lastPage(); $i++)
                            @if ($i == $blogPost->currentPage())
                                <span class="current" style="padding:0 5px; font-size: 20px">{{ $i }}</span>
                            @else
                                <a href="{{ $blogPost->url($i) }}" style="padding:0 5px; font-size: 20px">{{ $i }}</a>
                            @endif
                        @endfor
                
                        {{-- Next Page Link --}}
                        @if ($blogPost->hasMorePages())
                            <a href="{{ $blogPost->nextPageUrl() }}" rel="next" style="padding:0 10px; font-size: 20px">Next</a>
                        @else
                            <span class="disabled" style="padding:0 10px; font-size: 20px">Next</span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
  </section>


            <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
</body>
</html>