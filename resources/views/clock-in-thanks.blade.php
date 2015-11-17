@extends('app')

@section('content')
<div ng-controller="ClockIn as clock" class="container-fluid">
	<div class="clock-in">
		<h1>Thanks!</h1>
		<p>You have successfully clocked in.</p>
		<p><a href="/clock-in">Click here</a>  to clock-in again</p>
	</div>
</div>
@endsection