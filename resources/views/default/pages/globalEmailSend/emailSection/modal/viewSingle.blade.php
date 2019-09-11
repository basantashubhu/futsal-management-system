<div class="m-section__content">
	<div class="m-portlet">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						{{ucfirst($email->sub)}}
						<small>Date: {{date('m/d/Y', strtotime($email->sent_date))}}</small>
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<p class="t-u w-15"><i class="fa fa-user"></i> <strong>From: {{$email->from}}</strong></p>
			<p class="t-u w-15"><i class="fa fa-user"></i> <strong>To: {{$email->to}}</strong></p>
			<br>
			{!! $email->msg !!}
		</div>
		<!-- <div class="m-portlet__foot">
			<div class="row align-items-center">
				<div class="col-lg-12">
					<form class="replayMail m-form m-form--fit m-form--label-align-right">
						<textarea name="" class="form-control m-input"></textarea>
					</form>
				</div>
			</div>
		</div> -->
	</div>
</div>