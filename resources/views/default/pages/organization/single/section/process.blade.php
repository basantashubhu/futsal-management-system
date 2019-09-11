<div class="tab-pane active" id="applicationProcess" role="tabpanel">
	<div class="m-scrollable mCustomScrollbar _mCS_5 mCS-autoHide" data-scrollbar-shown="true" data-scrollable="true"
		 data-max-height="680"
		 style="overflow: visible; position: relative;">
		<!--Begin::Timeline 2 -->
		<div class="m-timeline-2">
			<div class="m-timeline-2__items  m--padding-top-25 m--padding-bottom-30">
				<?php $prevstep = 0?>
				@foreach($process as $processName=>$step)
					<div class="m-timeline-2__item m--padding-top-25 m--padding-bottom-30">

											<span class="m-timeline-2__item-time"
												  style="font-size: 1rem; padding-top: 0.29rem;">
												Step {{$step->step}}
											</span>
						<div class="m-timeline-2__item-cricle">
							<i class="fa fa-genderless m--font-info"></i>
						</div>
						<div class="m-timeline-2__item-text  m--padding-top-5">
							{{$step->step_name}}
							<ul class="processDetail">
								<?php
								$items = explode(',', $step->item);
								$status = explode(',', $step->status);
								$type = is_null($step->type) ?: explode(',', $step->type);
								$c = 0;
								?>
								@foreach($items as $item)
									@if($type[$c]=='Null' || $type[$c]=='web'
									|| ($type[$c]=='Approval' && $organization->is_approved==1)
									|| ($type[$c]=='Denial' && $organization->is_approved==3))
											<li class="{{$status[$c]?'m--font-success m--font-boldest process-complete':''}}">{{$item}}</li>
									@endif
									<?php $c++?>
								@endforeach
							</ul>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<!--End::Timeline 2 -->
	</div>
</div>