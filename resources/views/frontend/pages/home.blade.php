@extends('frontend.layouts.app')
@section('title','Beranda')
@section('content')
    @include('frontend.sections.home.banner')
    @include('frontend.sections.home.about')
    @include('frontend.sections.home.package_tour')
   {{-- @include('frontend.sections.home.fasilitas')

    @include('frontend.sections.home.layanan')
    @include('frontend.sections.home.benefits')
    @include('frontend.sections.home.form-testimoni')--}}
@endsection
