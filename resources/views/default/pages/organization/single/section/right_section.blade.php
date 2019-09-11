<div class="col col-sm-12 col-md-12 col-lg-4 col-xl-4">
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Work Flow
					</h3>
				</div>
			</div>
			<div class="m-portlet__head-tools">
                <button class="btn btn-sm btn-info m-btn m-btn--icon m-btn--pill" id="addApplicationNote" data-modal-route="addNote?table=organization&table_id={{$organization->id}}">
					<span>
						<i class="fa fa-plus"></i>
						<span>
							Add Note
						</span>
					</span>
                </button>
            </div>
		</div>
		<div class="m-portlet__body">
			<ul class="nav nav-tabs nav-fill" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#m_tabs_2_1">
						Process
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#organizationComment">
						Comment
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#detailNote">
						Notes
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#npEmailLog">
						Emails
					</a>
				</li>
				<li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#auditDetail">
                        Audit
                    </a>
                </li>
			</ul>
			<div class="tab-content">
				@include('default.pages.organization.single.section.process')
				@include('default.pages.organization.single.section.comment')
				@include('default.pages.organization.single.section.note')
				@include('default.pages.organization.single.section.audit')
				@include('default.pages.organization.single.section.email_log')
			</div>
		</div>
	</div>
</div>