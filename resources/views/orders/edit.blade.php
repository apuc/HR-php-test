@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('order.update', $order) }}" method="post">
                {{method_field('PUT')}}
                {{ csrf_field() }}

                @if(session()->get( 'success' ))
                <div class="alert alert-success" role="alert">
                    {{session()->get( 'success' )}}
                </div>
                @endif

                <div class="form-group">
                    <label>Email клиента</label>
                    <input type="email" name="client_email" class="form-control" value="{{$order->client_email}}">

                    @if($errors->has('client_email'))
                        <div class="text-danger">
                            {{$errors->first('client_email')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Партнер</label>
                    <select class="form-control" name="partner_id">
                        @foreach($partners as $key=>$val)
                            <option {{$order->partner_id == $key ? 'selected' : ''}}  value="{{$key}}">{{$val}}</option>
                        @endforeach
                    </select>

                    @if($errors->has('partner_id'))
                        <div class="text-danger">
                            {{$errors->first('partner_id')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Продукты</label>

                    @foreach($order->products as $product)
                        <p>{{$product->name}} - {{$product->pivot->quantity}}</p>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>Статус</label>
                    <select class="form-control" name="status">
                        @foreach($order->getStatuses() as $key=>$val)
                            <option {{$order->status == $key ? 'selected' : ''}}  value="{{$key}}">{{$val}}</option>
                        @endforeach
                    </select>

                    @if($errors->has('status'))
                        <div class="text-danger">
                            {{$errors->first('status')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <p><b>Стоимость: </b> {{$order->getPrice()}}</p>
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
