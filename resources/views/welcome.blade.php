@extends('layouts.home')

@section('content')
    <header>
        <nav>
            {{--            <span>Vaizganto 6, Radviliskis</span>--}}
            <img class="homepage-logo" src="{{ asset('images/logo.png') }}">
            {{--            <a href="tel: +37060560288" class="phone-number">+37060560288</a>--}}
            {{--            <span>+37060560288</span>--}}
        </nav>
    </header>
    <main class="content wrapper-home">
        <product-list></product-list>
    </main>
    <footer class="main-footer bg-dark align-bottom">
        <div class="wrapper-home">
            <div class="left-column">
                <h5>Rekvizitai</h5>
                <span>UAB "Melendė"</span>
                <span>Adresas: Vaizganto g. 6, Radviliskis</span>
                <span>Tel. Nr: +37060560288</span>
            </div>
            <div class="right">
                <h5>Prisijungimas</h5>
                <a href="/login">Prisijungti prie sistemos</a>
            </div>
        </div>
    </footer>
@endsection
