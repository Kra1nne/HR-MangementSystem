@extends('layouts/commonMaster')

@section('layoutContent')
    @include('layouts/sections/navbar/homenavbar')
    @yield('content')
    @include('layouts/sections/footer/homefooter')
@endsection
