	<!-- begin::Quick Nav -->
	<!--begin::Base Scripts -->
	<!-- <script src="assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
	<script src="assets/demo/demo3/base/scripts.bundle.js" type="text/javascript"></script> -->
	<!--end::Base Scripts -->
    <!--begin::Page Snippets -->
	<!-- <script src="assets/app/js/dashboard.js" type="text/javascript"></script> -->
	<!--end::Page Snippets -->

	<!-- Developer Note -->
	@include('default.pages.developerNote.create')
	<!-- Developer Note: END -->

	@section('scripts')
		<script src="{{ asset('js/theme.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('js/app.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('js/custom.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('js/temp/route.js') }}" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
		    initResizer();
		</script>
		<script type="text/javascript">
			$(document).off('click', '#lookup-popover').on('click', '#lookup-popover', function(e){
				e.preventDefault();
				$(this).remove();
			});
		    $(document).ready(function() {
		        // $('#todo').summernote(std.config.minEditorConfig);
				initIE_ServiceProviderDate("date");
		    });
			$('body').on('click', function(e){
				let target = e.target || e.srcElement;
				if(!target.classList.contains('lookup-popover')){
					$('#lookup-popover').remove();
				}
			});

		    $(document).off('click', '#submitTodo').on('click', '#submitTodo', function(e){
		        e.preventDefault();
		        const form = $(`#${ $(this).attr('data-target') }`);
		        sendAjax({
					url: '/note/noteStore',
					method: 'post',
					data: form.serializeArray(),
					loader: true,
				}, function (response) {
		        	form.resetForm();
					processAjaxForm(response, loadTodoList);
					// refresh pages
					reloadDatatable('.note_datatable');
					reloadDatatable('.note_datatable_done');
					reloadDatatable('#todo_table')
				}, processAjaxForm)
		    });

			$(document).off('click', '.clearBtn').on('click', '.clearBtn', function(e){
	            var form = $(this).attr('data-target');
	            $('#'+form).find(':input').val('');
	        });
			$.fn.dataTable.ext.errMode = 'throw';
			setInterval(function() {
				$('#navDateTime').html(moment().format(std.config.date_format+' H:mm'));
			}, 1000);


			/**
			 * Responsive JS
			 */
			$(function() {
				$(window).trigger('resize');
			})

			$(window).on('resize', function(e) {
				if(window.innerWidth) {
					if(window.innerWidth <= 1600 && window.innerWidth > 1015) {
						if(!($('#m_header_nav .m-menu__submenu--right').length))
							$('#m_header_nav ul > li:not(.header_logo):not(:nth-of-type(2)):not(:nth-of-type(3)) .m-menu__submenu')
								.removeClass('m-menu__submenu--left').addClass('m-menu__submenu--right');
					}
				}
			});



		</script>
		<!-- <script src="{{ asset('js/temp/ajaxsubmit.js') }}" type="text/javascript" charset="utf-8"></script> -->

	@show



</body>
<!-- end::Body -->
</html>