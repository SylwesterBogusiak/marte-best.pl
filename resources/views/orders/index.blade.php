@extends('layouts.app')

@section('content')
<div class="container">

@include('helpers.flash-messages')
  

    <div class="row">
    <div class="w-100"></div>
        <div class="col">
            <h1><i class="fas fa-list"></i> Zamówienia</h1>
        </div> 

        
       
    
    </div>
<div class="row">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ilość</th>
      <th scope="col">Cena [PLN]</th>
      <th scope="col">Produkty</th>
    </tr>
  </thead>
  <tbody>

  @foreach($orders as $order)
    <tr>
      <th scope="row">{{ $order->id }}</th>
      <td scope="row">{{ $order->quantity }}</td>
      <td scope="row">{{ $order->price }} </td>
      <td scope="row">
      @foreach($order->products as $product)
      
        <ul>
            <li>  
      {{ $product->name }} - {{ $product->description }}
            </li>
        </ul>
      @endforeach
        </td>
      </tr>
  @endforeach
  </tbody>
</table>

{{ $orders->links() }}
</div>
</div>
@endsection

