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
			Section: {{$note->table_name}}
		</div>
		<div class="m-timeline-1__item-body">
			<div class="m-timeline-1__item-body m--margin-top-15">
				{{$note->title}}
			</div>
		</div>
	</div>
</div>
@endforeach