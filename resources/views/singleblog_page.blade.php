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
        <h2 class="text-center pb-1">{{$blog->title}}</h2>
        <div class="py-4">
            <img src="{{asset($blog->image)}}" alt="" width="100%">
        </div>
        <p>{!!$blog->text_content!!}</p>
      
    </div>
  </section>
  <section class="py-2" style="border-top:1px solid #ddd ">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-xl-5 col-lg-5 col-12">
                <form action="{{route('store.comment')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group pb-1">
                        <label for="title">Blog Title</label>
                        <input type="text" name="title" value="{{$blog->title}}" class="form-control">
                        @error('title')
                            <p class="text-danger ">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group pb-3">
                        <label for="image">Blog Image</label>
                        <input type="file" name="image" class="form-control" id="">
                        @error('image')
                        <p class="text-danger ">{{$message}}</p>
                        @enderror
                        <img src="{{asset($blog->image)}}" alt="" style="width: 200px; margin: 5px 0;">
                    </div>
                    <div class="form-group">
                        <label for="image">Blog content</label>
                        <textarea name="content" class="form-control" id="editor" cols="30" rows="10" style="height: 300px">
                            {{$blog->text_content}}
                        </textarea>
                        @error('content')
                        <p class="text-danger ">{{$message}}</p>
                    @enderror
                    </div>
                    <button class="btn btn-lg btn-success mt-3">Submit</button>
                </form>
            </div>
            <div class="col-md-7 col-xl-7 col-lg-7 col-12"></div>
        </div>
    </div>
  </section>


            <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
</body>
</html>