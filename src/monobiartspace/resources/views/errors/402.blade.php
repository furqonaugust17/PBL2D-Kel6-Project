@extends('errors.minimal')

@section('title', __('Payment Required'))
@section('sub-title')
    <i class="fas fa-credit-card text-warning"></i> Pembayaran Diperlukan!
@endsection
@section('code', '402')
@section('message', 'Layanan ini memerlukan pembayaran sebelum dapat digunakan.')
