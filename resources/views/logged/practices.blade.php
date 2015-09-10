@extends('app')

@section('content')

<div id="page-content-wrapper">
	<div ng-controller="Dashboard as dash" class="container-fluid">
		<div id="page-wrapper">

			<div class="row">
				<div class="col-lg-12">
					<h1>This should list practices</h1>
					<h2>Welcome back, [[Auth::user()->first_name]] [[Auth::user()->last_name]]!</h2>
				</div>
				<!-- /.col-lg-12 -->
			</div>

		</div><!-- #page-wrapper -->
	</div><!-- /ng-controller -->

</div>

@endsection
