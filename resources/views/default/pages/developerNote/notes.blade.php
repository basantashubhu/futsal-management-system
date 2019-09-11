@if(count($notes)>0)
@foreach($notes as $note)
    <div class="m-widget3__item">
        <div class="m-widget3__header">
            <div class="m-widget3__user-img">
                <img class="m-widget3__img" src="{{ asset('images/no-user.svg') }}" alt="">
            </div>
            <div class="m-widget3__info">
                                        <span class="m-widget3__username">
                                            @if($note->creator)
                                           {{ucfirst($note->creator->name)}} &nbsp;
                                            @else
                                                Datatrax
                                            @endif
                                            <button class="btn m-btn--pill btn-xs btn-outline-warning">
                                            {{ucfirst($note->page)}}
                                        </button>
                                        </span>

                <br>
                <span class="m-widget3__time">
                                           {{$note->created_at->diffForHumans()}}
                                        </span>
            </div>
            <span class="m-widget3__status m--font-info">

                @if(! $note->user)
                    <button class="btn m-btn--pill btn-xs btn-outline-info dNotePickUp" data-id="{{$note->id}}">
                                            Pick Up
                                        </button>
                @endif
                @if($note->user)
                    <button class="btn m-btn--pill btn-xs btn-outline-info">
                                            Picked By : {{ucfirst($note->user->name)}}
                                        </button>
                @endif
                @if($note->user && ! $note->is_done &&$note->user->id == auth()->id())
                    <button class="btn m-btn--pill btn-xs btn-sm btn-outline-success m-l-5 d_is_done"
                            data-id="{{$note->id}}">
                                            Done
                                        </button>
                @endif
                                    </span>
        </div>
        <div class="m-widget3__body">
            <p class="m-widget3__text">
                {!! $note->text !!}
            </p>
        </div>
    </div>
@endforeach
    @else
    No Developer Note Found
    @endif