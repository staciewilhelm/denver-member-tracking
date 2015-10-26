@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>[[ $error ]]</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="/auth/register">
						<input type="hidden" name="_token" value="[[ csrf_token() ]]">

						<div class="form-group">
							<label class="col-md-4 control-label">First Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="first_name" value="[[ old('first_name') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Last Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="last_name" value="[[ old('last_name') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="[[ old('email') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<input type="hidden" name="role_id" value="3">

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Clock Number</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="clock_number" value="[[ old('clock_number') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone #</label>
							<div class="col-md-6">
								<input type="phone" class="form-control" name="phone" value="[[ old('phone') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">DOB</label>
							<div class="col-md-6">
								<input type="date" class="form-control" name="dob" value="[[ old('dob') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Alt Email</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="alt_email" value="[[ old('alt_email') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Identify As:</label>
							<div class="col-md-6">
								<label class="checkbox-inline">
									<input type="radio" name="identifies_as" id="Female" value="Female">&nbsp;&nbsp;Female
								</label>
								<label class="checkbox-inline">
									<input type="radio" name="identifies_as" id="Male" value="Male">&nbsp;&nbsp;Male
								</label>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
