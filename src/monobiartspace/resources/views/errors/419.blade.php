@extends('errors.minimal')

@section('title', __('Page Expired'))
@section('sub-title')
    <i class="fas fa-hourglass-end text-muted"></i> Sesi Telah Berakhir!
@endsection
@section('code', '419')
@section('message', 'Sesi Anda telah kadaluarsa. Silakan muat ulang halaman atau login kembali.')
