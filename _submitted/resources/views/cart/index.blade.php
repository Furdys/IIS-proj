<?php
	use App\Classes\Cart;
	use App\Branch;
?>

@extends('layouts.app')

@section('content')


    <div class="container">
        <h1>Léky v košíku:</h1>
        @if(Cart::isEmpty())
            Váš košík je prázdný.
        @else
            <form method="POST" action="{{ route('cart.update') }}">
                @csrf

                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th>Název léku</th>
                            <th>Počet kusů</th>
                            <th>Počet kusů skladem</th>
                            <th>Cena za kus</th>
                            <th>Součet</th>
                            <th>Odebrat</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Cart::items() as $cartItem)
                            <tr>
                                <td>
                                    {!! $cartItem->medicine->nameLink() !!}
                                </td>
                                <td>
                                    {{-- @todo error class when $cartItem->verifyStock() == false --}}
                                    <input type="number" name="medicines[{{ $loop->index }}][quantity]" value="{{ $cartItem->quantity }}"> ks
                                    @if ($errors->has("medicines.0.quantity"))
                                        @foreach ($errors->get("medicines.0.quantity") as $error)
                                            <div class="errorMessage">
                                                <strong>{{$error}}</strong>
                                            </div>
                                        @endforeach
                                    @endif
                                    <input type="hidden" name="medicines[{{ $loop->index }}][id]" value="{{ $cartItem->medicine->id }}">
                                </td>
                                <td>
                                    {{ Branch::current()->getQuantityInStock( $cartItem->medicine) }} ks
                                </td>
                                <td>
                                    {{ $cartItem->medicine->price }} Kč / ks
                                </td>
                                <td>
                                    <b>{{ $cartItem->getPrice() }} Kč</b>
                                </td>
                                <td>
                                    <a href="{{ route('cart.delete', $cartItem->medicine) }}" title="Odebrat položku">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                    <div class="row">
                        <div class="col-10">
                            <a href="{{ route('cart.erase') }}" class="btn btn-sm btn-danger">Vyprázdnit košík</a>
                            <button type="submit" class="btn btn-sm btn-warning">Upravit množství</button>
                        </div>
                        <div class="col-2"> Celkem: {{ Cart::sum() }} Kč </div>
                    </div>
                <br>
                <a href="{{ route('sales.store') }}"><button type="button" class="btn btn-block btn-success">Dokončit nákup</button></a>
                {{-- @todo if medicine out of stock <a href="route('reservations.index')">Vytvorit rezervaci</a>--}}
            </form>

        @endif
    </div>
@endsection
