@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Denver Roller Derby: Waiver</div>
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

					<form class="form-horizontal" role="form" method="POST" action="/auth/login">
						<input type="hidden" name="_token" value="[[ csrf_token() ]]">

						<h3>Colorado Women’s Roller Derby, Inc.</h3>
						<h4><em>DBA Denver Roller Derby</em></h4>
						<h4>DERBY WAIVER AND ACKNOWLEDGEMENT</h4>

						<div class="form-group">
							<label class="col-md-4 control-label">Full Legal Name</label>
							<div class="col-md-6">
								<input type="full_name" class="form-control" name="full_name" value="[[ old('full_name') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Date of Birth</label>
							<div class="col-md-6">
								<input type="dob" class="form-control" name="dob" value="[[ old('dob') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Address</label>
							<div class="col-md-6">
								<input type="address" class="form-control" name="address" value="[[ old('address') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone</label>
							<div class="col-md-6">
								<input type="phone" class="form-control" name="phone" value="[[ old('phone') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Email</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="[[ old('email') ]]">
							</div>
						</div>

						<br />

						<strong>Emergency Contact</strong>
						<div class="form-group">
							<label class="col-md-4 control-label">Full Name</label>
							<div class="col-md-6">
								<input type="emergency_contact" class="form-control" name="emergency_contact" value="[[ old('emergency_contact') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Relationship</label>
							<div class="col-md-6">
								<input type="emergency_relationship" class="form-control" name="emergency_relationship" value="[[ old('emergency_relationship') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone</label>
							<div class="col-md-6">
								<input type="emergency_phone" class="form-control" name="emergency_phone" value="[[ old('emergency_phone') ]]">
							</div>
						</div>

						<p><strong>MEDICAL:</strong> It is the responsibility of the undersigned to insure that the above named person is medically fit to participate 
						in strenuous on­rink or off­rink activities. As stated below, participation in roller derby activities presents an inherent risk 
						of injury to person or property. The undersigned certifies that the above named participant has no known conditions that prohibit 
						or limit participation in any derby / skating activities held by or in association with Colorado Women’s Roller Derby, Inc. (CWRD), 
						the warehouse at 3600 Wynkoop St, Denver, CO, or any venue skated with the CWRD. Additionally, the undersigned understands and agrees 
						to have medical insurance in place for the participant to cover any expenses related to any potential injury that may arise from their 
						participation in the sport.</p>

						<p>Any and all of my known illnesses, allergies, and medications are as follows:</p>
						<div class="form-group">
							<div class="col-md-12">
								<textarea class="form-control" name="allergies">[[ old('allergied') ]]</textarea>
							</div>
						</div>

						<p><strong>EQUIPMENT:</strong> Participants must wear the following mandatory safety equipment during all Colorado Women’s Roller Derby, Inc. 
						on­rink activities and practices: Helmet, mouth guard, knee pads, elbow pads, and wrist pads. Eyeglasses must have plastic shatterproof lenses. 
						The undersigned must take full responsibility that the above named participant (including self) is wearing the aforementioned safety equipment 
						at all times and that it is properly worn. Only quad roller skates are permitted. All skates must be rink­safe; their use must not gash, indent 
						or blemish the skating surface or any other surface and that the skates will not cause injury to persons or property. All liabilities thereof 
						are undertaken by the undersigned. Participates should use the softest wheel composition available to achieve the best possible grip on the </p>

						<p><strong>CONDUCT:</strong> Participants must behave in a respectful manner to both persons and property. Behavior, which could potentially 
						lead to intentional or unintentional bodily injury or property injury, will not be tolerated.</p>

						<p><strong>INDEMNIFICATION AND RISK ACKNOWLEDGEMENT:</strong> In consideration of being allowed to participate in the Colorado Women’s Roller 
						Derby, Inc. athletic sports programs, related events and activities, the undersigned acknowledges, appreciates and agrees that:</p>

						<ol>
							<li>1. The risk of injuries from the activities involved in this program is significant, including the potential for permanent paralysis and 
							death, and while particular rules, equipment and personal discipline may reduce this risk, the risk of serious injury remains, and,</li>
							<li>2. I KNOWINGLY AND FREELY ASSUME ALL SUCH RISKS, both known and unknown, EVEN IF ARISING FROM THE NEGLIGENCE OF OTHERS, and I assume 
							full responsibility for my participation; and I willingly agree to comply with the stated and customary terms and conditions for participation. 
							If, however, I observe any unusual significant hazard during my presence or participation, I will remove myself from participation and bring 
							such to the attention of the nearest official immediately; and,</li>
							<li>3. I, for myself and on behalf of my heirs, assigns, personal representatives and next of kin, HEREBY RELEASE AND HOLD HARMLESS the Colorado 
							Women’s Roller Derby, Inc., the rinks, coaches, officers, officials, agents, employees, other participates, sponsoring agencies, sponsors and 
							advertisers (“RELEASEES”) WITH RESPECT TO ANY AND ALL INJURY, DISABILITY, DEATH, or loss, or damage to person or property, WHETHER ARISING FROM 
							THE NEGLIGENCE OF THE RELEASEES OR OTHERWISE.</li>
						</ol>
						<p><strong>I HAVE READ THIS ASSUMPTION OF RISK AGREEMENT AND ACKNOWLEDGEMENT AND I HAVE ACCEPTED RESPONSIBILITY; I FULLY UNDERSTAND ITS TERMS AND I 
						UNDERSTAND THAT I HAVE GIVEN UP SUBSTANTIAL RIGHTS BY SIGNING IT, AND I SIGN IT FREELY AND VOLUNTARILY WITHOUT ANY INDUCEMENT.</strong></p>

						<div class="form-group">
							<label class="col-md-4 control-label">Participant’s Signature:</label>
							<div class="col-md-6">
								<input type="signature" class="form-control" name="signature" value="[[ old('signature') ]]">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Participant’s Initials:</label>
							<div class="col-md-6">
								<input type="initials" class="form-control" name="initials" value="[[ old('initials') ]]">
							</div>
						</div>

						[[ date('l, F j, Y', strtotime('now')) ]]

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
									Submit Waiver
								</button>
							</div>
						</div>
					</form>

				</div><!-- /.panel-body -->
			</div><!-- /.panel -->
		</div>
	</div>
</div>
@endsection
