@extends('errors.minimal')

@section('title', __('Service Unavailable'))
@section('sub-title')
    <i class="fas fa-tools text-muted"></i> Layanan Sedang Dalam Perawatan!
@endsection
@section('code', '503')
@section('message', 'Layanan saat ini tidak tersedia. Kami sedang melakukan pemeliharaan. Silakan kembali nanti.')
