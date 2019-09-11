<?php

?>

@forelse($notes as $reminder)
    <div class="d-flex mb-1" style="border-bottom: 1px dotted lightgray;">
        <div style="flex-basis: 120px">
            <span style="line-height: 2;">{{ date('m/d/Y', strtotime( $reminder->created_at)) }}</span>
        </div>
        <div class="d-flex justify-content-between" style="flex: 1;">
            <div >
                <span style="line-height: 2;">{{ $reminder->title }}</span>
            </div>
            <div>
                <div class="mb-1">
                    <span class="m-portlet__nav-link btn btn-sm m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" style="height:25px;width:25px;"
                     data-modal-route="/note/edit/{{ $reminder->id }}"><i
                           class="la la-edit"></i></span>
                    <span class="m-portlet__nav-link btn btn-sm m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" style="height:25px;width:25px;"
                          data-modal-route="/note/delete/{{ $reminder->id }}"><i class="la la-trash-o"></i></span>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="row justify-content-between px-15">
        <div><i class="la la-bell"></i> No reminders for today.</div>
    </div>
@endforelse