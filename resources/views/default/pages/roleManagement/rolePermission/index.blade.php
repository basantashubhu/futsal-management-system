@php $partialLocation='default.pages.roleManagement.rolePermission.include' @endphp

<div class="m-content no-pd-top no-pd-bottom m--padding-right-15">
    <div class="m-portlet m-portlet--mobile no-m-bottom std-divider">
        @include($partialLocation.'.rolePermissionhead')
        @include($partialLocation.'.rolePermissionbody')
    </div>
</div>
@include($partialLocation.'.rolePermissionjs');