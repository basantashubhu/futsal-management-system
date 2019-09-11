<style type="text/css">
	.app-col-header{
		display: table;
		width: 100%;
	}
	.app-col-header-caption{
		display: table-cell;
		text-align: left;
		vertical-align: middle;
	}
	.app-col-header-tool{
		display: table-cell;
		text-align: right;
		vertical-align: middle;
	}
	.app-col-header-tool button{
		margin-right: 5px;
	}
</style>
<div class="m-content">
	<div class="row" id="organizationViewBoard" data-org-id="{{$organization->id}}">

		@include('default.pages.organization.single.section.left_section')

		<!-- Right Section -->
		@include('default.pages.organization.single.section.right_section')

	</div>
</div>