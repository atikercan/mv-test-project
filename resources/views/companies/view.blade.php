@extends('app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h3>View Company: {{ $company->name }}</h3>
			<hr>
		</div>
	</div>


	<div class="row">
		<div class="col">
			<img width="100" src="{{ $company->logo }}">
		</div>
		<div class="col">
			@php
			$investments = $company->investments()->sum("amount");
			$fees = $company->investments()->sum("fees");
			@endphp
			<p><a href="/companies/{{ $company->id }}">{{ $company->name }}</a> ({{ number_format($investments,2,".",",")}} USD) (Fees: {{ number_format($fees,2,".",",")}} USD) (Total: {{ number_format($investments-$fees,2,".",",")}} USD)</p>
		</div>
	</div>

</div>

@endsection
