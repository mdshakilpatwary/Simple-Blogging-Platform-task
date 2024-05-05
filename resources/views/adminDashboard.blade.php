@extends('master')
@section('mainBody')

{{-- main body  --}}
<div class="col-md-10 col-xl-10 col-lg-10 col-12">
    <h3 class="text-center">
        Welcome {{Auth::user()->name}} Dashboard
    </h3>
</div>
    
@endsection