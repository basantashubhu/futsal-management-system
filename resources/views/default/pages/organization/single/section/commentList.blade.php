<div class="m-portlet">
    @if(count($comments)>0)
        <div class="m-portlet__body">
            <div class="m-widget3">
                @foreach($comments as $comment)
                    <div class="m-widget3__item">
                        <div class="m-widget3__header">
                            <div class="m-widget3__info no-pd-left">
                            <span class="m-widget3__username m-r-10">
                                <strong>{{$comment->comment_by_name}}</strong>
                            </span>
                                <span class="m-widget3__time">
                                        {{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}
                            </span>
                            </div>
                        </div>
                        <div class="m-widget3__body">
                            <p class="m-widget3__text">
                                {!! $comment->comment !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>