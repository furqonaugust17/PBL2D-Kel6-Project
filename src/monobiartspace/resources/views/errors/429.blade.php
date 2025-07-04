@extends('errors.minimal')

@section('title', __('Too Many Requests'))
@section('sub-title')
    <i class="fas fa-exclamation-triangle text-warning"></i> Terlalu Banyak Permintaan!
@endsection
@section('code', '429')
@section('message', 'Anda telah melakukan terlalu banyak permintaan dalam waktu singkat. Silakan coba lagi nanti.')
