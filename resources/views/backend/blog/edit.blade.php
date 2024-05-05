@extends('master')
@section('mainBody')

{{-- main body  --}}
<div class="col-md-10 col-xl-10 col-lg-10 col-12">
    <h3 class="mt-3">
        Add blog 
    </h3>
<div class="row pt-5">
    <div class="offset-md-3 offset-lg-3 offset-xl-3 col-md-6 col-xl-6 col-lg-6 col-12">
 @if(session('success'))

<div class="container alertsuccess">
<div class="alert alert-success alert-dismissible show fade">
    <div class="alert-body">
    <button class="close" data-dismiss="alert">
        <span>×</span>
    </button>
    {{ session('success')}}
    </div>
 </div>
</div>
@elseif(session('error'))
<div class="container alerterror">
<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('error')}}
                      </div>
 </div>
</div>

@endif
        <form action="{{route('update.blog',8)}}" method="POST" enctype="multipart/form-data">
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
</div>
</div>
    
<script>
	$(document).ready(function(){
    ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
  console.error(error);
});
});
</script>
@endsection