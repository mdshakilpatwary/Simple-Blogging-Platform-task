@include('backend.includes.head')
  <body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 pb-4" style="border-bottom: 1px solid #ddd">
                    <div class="pt-5" style="text-align: right;">
                        <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button>Logout</button></form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        @include('backend.includes.sidebar')
        @yield('mainBody')
    </div>


@include('backend.includes.script')
