<div class="tab-pane" id="detailNote" role="tabpanel">
	<form class="m-form">
		<div class="m-form__group form-group row">
			<label class="col-4 col-form-label" id="statusChange">
				Done Status Only
			</label>
			<div class="col-3">
				<span class="m-switch m-switch--success m-switch--sm">
					<label>
						<input type="checkbox" checked="checked" name="" id="changeTable" checked>
						<span></span>
					</label>
				</span>
			</div>
		</div>
	</form>
    <div class="note_datatable_done"></div>
    <div class="note_datatable_notDone" id="notDone_status" style="display: none;"></div>
</div>
@include('default.pages.organization.single.section.note_js')