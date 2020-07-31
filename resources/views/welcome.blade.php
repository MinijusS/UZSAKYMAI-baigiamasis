@extends('layouts.home')

@section('content')
    <header>
        <div class="header-img">
            <div class="dark-overlay">
                <nav>
                    <img class="brand-logo" src="{{ asset('images/logo.png') }}">
                    <a href="tel: +37060560288" class="phone-number">+37060560288</a>
                </nav>
                <div class="header-text">
                    <h1 class="title">NiamNiam</h1>
                    <p class="slogan">Gaminame su meile!</p>
                </div>
            </div>
        </div>
    </header>
@endsection
