<?php
  use App\Supplier;
?>


<h1>Dodavatelé v databázi:</h1>
<ul>
	@foreach(Supplier::all() as $supplier)
		<li>
			{!! $supplier->nameLink() !!}
		</li>
	@endforeach
</ul>