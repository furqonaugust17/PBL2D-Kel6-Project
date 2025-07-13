@extends('errors.minimal')

@section('title', __('Not Found'))
@section('sub-title')
    <i class="fas fa-search-minus text-warning"></i> Halaman Tidak Ditemukan!
@endsection
@section('code', '404')
@section('message', 'Halaman yang Anda cari tidak tersedia atau telah dipindahkan.')
