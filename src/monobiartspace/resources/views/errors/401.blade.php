@extends('errors.minimal')

@section('title', __('Unauthorized'))
@section('sub-title')
    <i class="fas fa-user-lock text-danger"></i> Akses Ditolak!
@endsection
@section('code', '401')
@section('message', 'Anda tidak memiliki izin untuk mengakses halaman ini tanpa autentikasi.')
