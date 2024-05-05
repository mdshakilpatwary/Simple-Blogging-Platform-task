<div class="col-md-2 col-xl-2 col-lg-2 col-12 text-center" style="border: 1px solid #787575; height: 100vh;">
    <h3>
        @if(Auth::user()->role =='Admin')
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
        @else
        <a href="{{route('dashboard')}}">dashboard</a>
        @endif
    </h3>
    <h4>
        <a href="{{url('/')}}">Frontend site</a>
    </h4>
    <ul class="pt-4" style="list-style: none">
        <li><a href="{{route('create.blog')}}">Add Blog</a></li>
        <li><a href="{{route('manage.blog')}}">Manage Blog</a></li>
    </ul>
</div>