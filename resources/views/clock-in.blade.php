@extends('app')

@section('content')
<div 
	class="container-fluid"
	ng-controller="ClockIn as clock"
	ng-init="clock.setData()">

	<form class="clock-in" role="form" method="POST" action="/clock-in">
		<input type="hidden" name="_token" value="[[ csrf_token() ]]">
		<input type="hidden" name="clock_time" value="{{ clock.currentTime | date: 'EEEE, MMM. d hh:mm:ssa'}}" />
		<h1>Practice &amp; Activity Clock-in</h1>

		<p><strong>Late</strong>: 5+ min after practice start</p>
		<p><strong>No Credit</strong>: 15+ min after practice start</p>
		<p><strong>Current Time</strong>: {{ clock.currentTime | date: 'EEEE, MMM. d hh:mm:ssa'}}</p>
		<br />
		<div class="form-group">
			<label for="member_clock_number">4-digit Member Clock-in Number</label><br />
			<input type="text" class="clock-number form-control sm"
				ng-class="{'invalid': !clock.numberIsValid}"
				name="clock_number"
				placeholder="Clock-in Number"
				maxlength="4"
				ng-model="clock.number"
				ng-required="required"
				ng-blur="clock.verifyNumber()" />
		</div>

		<div class="form-group">
			<label for="event_type">Please select the practice you are clocking in for:</label>
			<p>Note: Only practices within 2 weeks of today are shown. If this is outside that time frame, you're too late.</p>

			<p class="center" ng-hide="clock.eventList.length > 0"><strong>loading events...</strong></p>
			<select class="form-control" name="event_type" 
				ng-show="clock.eventList.length > 0"
				ng-disabled="!clock.numberIsValid" 
				ng-model="clock.event_type">
				<optgroup ng-repeat="eventsList in clock.eventList track by $index" label="{{eventsList.date}}">
					<option ng-repeat="event in eventsList.events" value="{{eventsList.date}} :: {{event.details}}">
						{{event.details}}
					</option>
				</optgroup>
			</select>
		</div>

		<!-- if past due date -->
		<div ng-if="clock.numberIsValid" class="form-group">
			<label for="event_type">Why are you clocking in late?</label>
			<p>Date-Time-Practice-Location Only practices within 2 weeks of today are shown. If this is outside that time frame, you're too late.</p>
			<input type="radio" name="late_reason" value="Forgot" ng-click="clock.setLateOption(false)" /> I forgot...but I was here on time!<br />
			<input type="radio" name="late_reason" value="Late" ng-click="clock.setLateOption(false)" /> I was actually late, sorry.<br />
			<input type="radio" name="late_reason" value="Redo" ng-click="clock.setLateOption(false)" /> I clocked in for the wrong practice before. Redo!<br />
			<input type="radio" name="late_reason" value="Other" ng-click="clock.setLateOption(true)" /> Other<br />
			<input type="text" class="form-control half" name="late_other_reason" placeholder="Other Reason" ng-if="clock.isOther" />
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-lg" ng-disabled="!clock.numberIsValid">Clock-in</button>
		</div>

	</form>

</div>
@endsection
