@extends('layouts.app')

@section('content')
        <div class="product-list">
            @table($table)
            <a href="{{route('categories.create')}}" class="btn btn-primary"><i class="material-icons">add</i> Pridėti kategoriją</a>
        </div>
@endsection
