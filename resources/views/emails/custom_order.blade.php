@extends('emails.notification')

@section('content')
    <h2>Здравствуйте!</h2>
    <p>
        Поступил пошив на заказ от клиента по имени <strong>{{$order->name}}</strong>, номер для связи <strong>{{$order->phone}}</strong>.
    </p>
    <p style="padding: 10px 0px; border-top: 1px solid black; color: #808080;">
        {{$order->description}}
    </p>
@endsection
