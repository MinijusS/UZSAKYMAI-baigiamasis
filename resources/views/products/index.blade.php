@extends('layouts.app')

@section('content')
    <div class="tables">
        <div class="left">
            <h3>Produktų sarašas</h3>
            <product-table></product-table>
        </div>
        <div class="right">
            <h3>Kategorijų sarašas</h3>
            <div class="table-action">
                <a href="{{route('categories.create')}}" class="btn btn-primary"><i class="material-icons">add</i>
                    Pridėti
                    kategoriją</a>
            </div>
            @table($category_table)
        </div>
    </div>
@endsection
