<?php
	use App\Branch;
?>

@extends('layouts.app')

@section('content')
	<h1>Pobočky v databázi:</h1>

	@if(empty($branches))
		<p>V databázi nejsou žádné pobočky.</p>
	@else
		<ul>
			@foreach($branches as $branch)
				<li>
					{!! $branch->nameLink() !!}
				</li>
			@endforeach
		</ul>
	@endif
@endsection