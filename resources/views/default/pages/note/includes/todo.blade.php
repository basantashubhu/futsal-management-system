<?php

?>

@forelse($notes as $todo)
    <div class="row justify-content-between px-15 mb-1" style="border-bottom: 1px dotted lightgray;">
        <div>
            <span style="line-height: 2;">{{ $todo->title }}</span>
        </div>
        <div>
            <div class="mb-1">
               <span class="m-portlet__nav-link btn btn-sm m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill doneTodo" style="height:25px;width:25px;" title="Mark done" data-tooltip=""
                    data-id="{{ $todo->id }}"><i class="la la-check"></i></span>
               <span class="m-portlet__nav-link btn btn-sm m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" style="height:25px;width:25px;" 
                    data-modal-route="/note/edit/{{ $todo->id }}"><i class="la la-edit"></i></span>
                <span class="m-portlet__nav-link btn btn-sm m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" style="height:25px;width:25px;" 
                    data-modal-route="/note/delete/{{ $todo->id }}"><i class="la la-trash-o"></i></span>
            </div>
        </div>
    </div>
@empty
    <div class="row justify-content-between px-15">
        <div>No todo.</div>
    </div>
@endforelse

<script>
    $(tooltip);
</script>