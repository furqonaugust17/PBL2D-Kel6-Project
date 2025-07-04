@extends('errors.minimal')

@section('title', __('Server Error'))
@section('sub-title')
    <i class="fas fa-server text-danger"></i> Kesalahan Internal Server!
@endsection
@section('code', '500')
@section('message', 'Terjadi kesalahan tak terduga di server kami. Silakan coba beberapa saat lagi.')
