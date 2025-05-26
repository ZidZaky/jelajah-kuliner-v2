@extends('layouts.layout2')

@section('title')
ABOUT US?
@endsection

@section('css')
<link rel="stylesheet" href="/css/aboutus.css">
@endsection

@section('main')
<div class="content" style="margin: 1.5%;">
    <div style="display: flex; justify-content: space-between;">
        {{-- admin --}}
        <div style="width: 48%; display: flex; flex-direction: column; align-items: center;">
            <h1>User Guide Admin</h1>
            <iframe allowfullscreen="allowfullscreen" scrolling="no" class="fp-iframe"
                src="https://heyzine.com/flip-book/d2f8e85f02.html"
                style="border: 1px solid lightgray; width: 100%; height: 550px;"></iframe>
        </div>

        <div style="width: 48%; display: flex; flex-direction: column; align-items: center;">
            <h1>User Guide Visitor</h1>
            <iframe allowfullscreen="allowfullscreen" scrolling="no" class="fp-iframe"
                src="https://heyzine.com/flip-book/00bf2a3947.html"
                style="border: 1px solid lightgray; width: 100%; height: 550px;"></iframe>
        </div>
    </div>

    <div style="display: flex; justify-content: space-between; margin-top: 3%; margin-bottom: 3%">
        {{-- PKL --}}
        <div style="width: 48%; display: flex; flex-direction: column; align-items: center;">
            <h1>User Guide PKL</h1>
            <iframe allowfullscreen="allowfullscreen" scrolling="no" class="fp-iframe" src="https://heyzine.com/flip-book/71c9ca6e8a.html" style="border: 1px solid lightgray; width: 100%; height: 400px;"></iframe>
        </div>
    </div>
</div>

@endsection