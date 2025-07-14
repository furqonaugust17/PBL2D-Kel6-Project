@extends('errors.minimal')

@section('title', __('Forbidden'))
@section('sub-title')
    <i class="fas fa-ban text-danger"></i> Akses Diblokir!
@endsection
@section('code', '403')
@section('message', 'Anda tidak memiliki izin untuk mengakses halaman ini.')
