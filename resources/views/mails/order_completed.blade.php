@extends('layouts.mail')

@section('content')
    <div class="container">
        <h3>заказ №({{$order->id}}) завершен</h3>
        <ul>
            @foreach($order->products as $product)
            <li>{{$product->name}}</li>
            @endforeach
        </ul>

        <p><b>Стоимость: </b>{{$order->getPrice()}}</p>
    </div>
@endsection
