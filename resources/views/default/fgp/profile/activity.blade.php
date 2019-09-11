<div class="tab-pane" id="user_activity">
	<div class="m-portlet__body">
		<!--begin:Timeline 1-->
		<div class="m-timeline-1 m-timeline-1--fixed">
			<div class="m-timeline-1__items">
				<div class="m-timeline-1__marker"></div>
				<?php $i = 2; ?>
				@foreach($notes as $note)
				<div class="m-timeline-1__item @if($note->line%$i == 0) m-timeline-1__item--right @else m-timeline-1__item--left @endif @if($note->line == 1) m-timeline-1__item--first @endif">
					<div class="m-timeline-1__item-circle">
						<div class="m--bg-danger"></div>
					</div>
					<div class="m-timeline-1__item-arrow"></div>
					<span class="m-timeline-1__item-time m--font-brand">
						{{date('F j, Y, g:i a', strtotime($note->created_at))}}
					</span>
					<div class="m-timeline-1__item-content c-p" style="background-color: #e7e9ef;">
						<div class="m-timeline-1__item-title">
							Section: {{ucfirst($note->table_name)}}
						</div>
						<div class="m-timeline-1__item-body">
							<div class="m-timeline-1__item-body m--margin-top-15">
								{{$note->title}}
							</div>
						</div>
					</div>
				</div>
				@endforeach
				<div id="loadedData"></div>
			</div>
		</div>
		<div class="row">
			<div class="col m--align-center">
				<button type="button" class="btn btn-sm m-btn--custom m-btn--pill  btn-danger" id="loadMore">
					Load More
				</button>
			</div>
		</div>
		<!--End:Timeline 1-->
	</div>
</div>
<script>
var	const_i = 1;
$(document).off('click', '#loadMore').on('click', '#loadMore', function(e){
	var self = $(this);
	e.preventDefault();
	var request = {
		url: 'loadMoreNote/'+const_i*8,
		method: 'get'
	}
	addFormLoader();
	ajaxRequest(request, function(response){
		removeFormLoader();
		if(response && response.data && response.data != null && response.data != ''){
			$('#loadedData').html(response.data);
			const_i++;
		}else{
			self.attr('disabled', true);
			self.text('No More Data');
		}
	});
});
</script>