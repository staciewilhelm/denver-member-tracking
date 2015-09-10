@extends('app')

@section('content')
<div ng-controller="ClockIn as clock" class="container-fluid">

	<form class="clock-in">
		<h1>Practice &amp; Activity Clock-in</h1>

		<p><strong>Late</strong>: 5+ min after practice start<br />
			<strong>No Credit</strong>: 15+ min after practice start<br />
			The time is visible at the top of the ipad.</p>

		<div class="form-group">
			<label for="member_clock_number">4-digit Member Clock-in Number</label>
			<input type="text" class="form-control xsm" placeholder="Clock-in Number" ng-required="required" ng-blur="clock.whateverThings()" />
		</div>

		<div class="form-group">
			<label for="event_type">Please select the practice you are clocking in for:</label>
			<p>Note: Only practices within 2 weeks of today are shown. If this is outside that time frame, you're too late.</p>

			<select class="form-control" name="event_type" ng-model="clockin.event_type" ng-change="clock.showLateOptions()">
			@foreach ($eventList as $group => $events)
				<optgroup label="[[ $group ]]">
				@foreach ($events as $e)
					<option value="[[ $e ]]">[[ $e ]]</option>
				@endforeach
				</optgroup>
			@endforeach
			</select>
		</div>

		<!-- if past due date -->
		<div ng-show="clock.late" class="form-group">
			<label for="event_type">Why are you clocking in late?</label>
			<p>Date-Time-Practice-Location Only practices within 2 weeks of today are shown. If this is outside that time frame, you're too late.</p>

			<input type="radio" name="late_reason" value="Forgot" ng-click="clock.setLateOption(false)" /> I forgot; but, I was here on entry.<br />
			<input type="radio" name="late_reason" value="Late" ng-click="clock.setLateOption(false)" /> I was actually late, sorry.<br />
			<input type="radio" name="late_reason" value="Redo" ng-click="clock.setLateOption(false)" /> I clocked in for the wrong practice before. Redo!<br />
			<input type="radio" name="late_reason" value="Other" ng-click="clock.setLateOption(true)" /> Other<br />

			<input type="text" name="late_other_reason" placeholder="Other Reason" ng-if="clock.isOther" />

		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-lg">
				Clock-in
			</button>
		</div>

	</form>

</div>
@endsection
