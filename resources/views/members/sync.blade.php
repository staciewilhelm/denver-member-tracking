@extends('app')

@section('content')
<div class="container-fluid">
	<h1>Sync Denver Tracking with Google Directory</h1>

	<p>The Denver Tracking system was last sycned on [insert last synced date]</p>

	<p>Clicking the "Sync Members" button will <strong>ONLY</strong> add newly created Google Directory members to the Denver Tracking system.</p>

	<form class="form-horizontal" role="form" method="POST" action="/members/sync">
		<input type="hidden" name="_token" value="[[ csrf_token() ]]">

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
					Sync Now
				</button>
			</div>
		</div>
	</form>

</div>
@endsection
