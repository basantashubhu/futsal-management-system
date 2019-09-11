@extends('default.emails.master')

@section('title', $subject)

@section('content')
    {{ $subject }} <br><br>
    
    {{ $stipends->pluck('period_id')->unique()->count() }} Periods <br>
    {{ $stipends->pluck('site_id')->unique()->count() }} Sites <br>
    {{ $stipends->pluck('vol_id')->unique()->count() }} Volunteers 

    @if($link)
    <br><br>
    Please check the attached file or click the download to download the file. <br>
    <a href="{{ $link }}">Download</a>
    @endif
@endsection