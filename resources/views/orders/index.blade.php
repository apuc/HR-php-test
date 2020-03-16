@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Название партнера</th>
                        <th scope="col">Стоимость</th>
                        <th scope="col">Cостав</th>
                        <th scope="col">Статус</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <th scope="row">
                                <a href="{{route('order.edit',$order)}}" target="_blank">{{$order->id}}</a>
                            </th>
                            <td>{{$order->partner->name}}</td>
                            <td>{{$order->getPrice()}}</td>
                            <td>{{$order->products->implode('name',',')}}</td>
                            <td>{{$order->getStatuses()[$order->status]}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
