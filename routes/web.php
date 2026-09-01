<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return '
        <h1>Profil Toko PosKita</h1>
        <p>Selamat datang di Toko PosKita! Kami menyediakan berbagai kebutuhan harian dengan harga terjangkau dan pelayanan terbaik.</p>
        <p>Alamat: Jl. Demang No. 45, Karawang</p>
        <p>Kontak: 0856-8723-621</p>
    ';
});