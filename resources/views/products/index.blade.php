@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Поставщик</th>
                    <th scope="col">Цена</th>
                </tr>
                </thead>

                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{$product->vendor->name}}</td>
                        <td>
                            <form class="form-inline">
                                <input type="text" value="{{$product->price}}" class="form-control mb-2 mr-sm-2">

                                <button type="button" data-product="{{$product->id}}" class="btn btn-price btn-primary mb-2">Изменить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{$products->links()}}
        </div>
    </div>
@endsection
