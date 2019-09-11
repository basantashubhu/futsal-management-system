@php $partialLocation='default.pages.roleManagement.permission.include' @endphp

<div class="m-content no-pd-top no-pd-bottom m--padding-right-15">
    <div class="m-portlet m-portlet--mobile no-m-bottom std-divider">
        @include($partialLocation.'.permissionhead')
        @include($partialLocation.'.permissionbody')
    </div>
</div>
@include($partialLocation.'.permissionjs');