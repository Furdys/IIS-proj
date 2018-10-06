<?php
	use App\Medicine;
?>

@extends('layouts.app')

@section('content')
	<h1>Léky v databázi:</h1>

	@if(auth()->user()->isAuthorised('superior'))
		<a href="{{ route('medicines.create') }}">Přidat nový</a>
	@endif

	<ul>
		@foreach(Medicine::all() as $medicine)
			<li>
				{!! $medicine->nameLink() !!}
			</li>
		@endforeach
	</ul>
@endsection
