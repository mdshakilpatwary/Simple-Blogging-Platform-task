@extends('master')
@section('mainBody')

{{-- main body  --}}
<div class="col-md-10 col-xl-10 col-lg-10 col-12">
    <h3 class="mt-3">
        Add blog 
    </h3>
<div class="row pt-5">
    <div class="offset-md-2 offset-lg-2 offset-xl-2 col-md-8 col-xl-8 col-lg-8 col-12">
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

    <table class="table">
        <thead>
            <tr>
                <th>#Id</th>
                <th>Blog title</th>
                <th>Image</th>
                <th>Date</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $sl =1 ;
            @endphp
            @if(Auth::user()->role == 'Admin')
            @foreach ($blogs as $blog)
            <tr>
                <td>{{$sl++}}</td>
                <td>{{$blog->title}}</td>
                <td><img src="{{asset($blog->image)}}" alt="" width="30"></td>
                <td>{{$blog->created_at->format('M d,y-  h:iA')}}</td>
                <td>
                    @if(Auth::user()->id == $blog->user_id)
                    <a class="btn btn-sm btn-info" href="{{route('edit.blog',$blog->slug)}}">Edit</a>
                    @else
                    <span>noEdit</span>
                    @endif
                    <a href="{{route('delete.blog',$blog->id)}}" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
                
            @endforeach
            {{-- user blog --}}
            @elseif(Auth::user()->role == 'User')
            @foreach ($userBlogs as $blog)
            <tr>
                <td>{{$sl++}}</td>
                <td>{{$blog->title}}</td>
                <td><img src="{{asset($blog->image)}}" alt="" width="30"></td>
                <td>{{$blog->created_at->format('M d,y-  h:iA')}}</td>
                <td>
                    
                    <a class="btn btn-sm btn-info" href="{{route('edit.blog',$blog->slug)}}">Edit</a>
                    <a href="{{route('delete.blog',$blog->id)}}" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
                
            @endforeach
            @endif

        </tbody>
    </table>
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