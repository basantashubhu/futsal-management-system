<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-body" style="background: #fff;">
			<h3 class="text-center">{{ucwords($holiday->name)}}</h3>
			<p class="text-center">
				{{$holiday->description}}
			</p>
		</div>
		<div class="modal-footer" style="border: none; padding-top: 0;">
			<button type="button" class="btn btn-success m-btn m-btn--custom" data-dismiss="modal" style="margin: auto;">Close</button>
		</div>
	</div>
</div>