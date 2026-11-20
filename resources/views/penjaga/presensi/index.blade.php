
@extends('penjaga.layouts.app')

@section('title', 'Presensi Penjaga')
@section('page-title', 'Presensi Penjaga')
@section('page-description', 'Catat kehadiran masuk penjaga hari ini.')

@section('content')

<div style="padding:10px 0 30px;">

    <div style="
        background:white;
        border-radius:16px;
        padding:45px 25px;
        text-align:center;
        box-shadow:0 4px 18px rgba(0,0,0,.06);
        border:1px solid #edf0ed;
        max-width:850px;
    ">

        <div style="
            width:85px;
            height:85px;
            border-radius:50%;
            background:#e7f5ee;
            color:#08764f;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:38px;
            margin:0 auto 20px;
        ">
            <i class="bi bi-clock-history"></i>
        </div>

        <h3 style="font-weight:700;color:#183b2e;">
            Presensi Masuk
        </h3>

        <p style="color:#75817a;margin-top:10px;">
            {{ now()->translatedFormat('l, d F Y') }}
        </p>

        @if(session('success'))
            <div style="
                background:#e7f5ee;
                color:#08764f;
                padding:15px;
                border-radius:9px;
                margin:20px auto;
            ">
                {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div style="
                background:#e7f5ee;
                color:#08764f;
                padding:15px;
                border-radius:9px;
                margin:20px auto;
            ">
                {{ session('info') }}
            </div>
        @endif

        @if($attendance)

            <div style="
                background:#f0f8f3;
                color:#08764f;
                padding:18px;
                border-radius:9px;
                margin:20px auto;
                max-width:500px;
            ">
                <i class="bi bi-check-circle-fill"></i>
                Kamu sudah melakukan presensi masuk hari ini.

                <br><br>

                <strong>
                    Jam masuk:
                    {{ \Carbon\Carbon::parse($attendance->check_in)->format('H:i') }}
                </strong>
            </div>

            <button disabled style="
                background:#8aa99b;
                color:white;
                border:none;
                padding:14px 30px;
                border-radius:9px;
                font-size:15px;
                font-weight:600;
            ">
                <i class="bi bi-check-circle"></i>
                Sudah Presensi Masuk
            </button>

        @else

            <p style="color:#75817a;margin:20px 0;">
                Kamu belum melakukan presensi masuk hari ini.
            </p>

            <form action="{{ route('penjaga.presensi.masuk') }}" method="POST">
                @csrf

                <button type="submit" style="
                    background:#08764f;
                    color:white;
                    border:none;
                    padding:14px 30px;
                    border-radius:9px;
                    font-size:15px;
                    font-weight:600;
                    cursor:pointer;
                ">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Presensi Masuk
                </button>
            </form>

        @endif

    </div>
</div>

@endsection
