@if(!is_null($representative))
    <label class="f-w-500 header">Representative Contacts</label>

    <button class="btn btn-xs btn-success m-btn m-btn--icon m-btn--pill m-l-5"
        data-modal-callback='reloadProviderDetail'
        data-modal-route="/client/edit/{{ $representative->id }}?for=representative"
        data-param="{{$organization->id}}">
        <span>
            <i class="fa fa-edit"></i>
            <span>
                Edit
            </span>
        </span>
    </button>

    <ul class="no-list-style no-m">
        <li>Name: &nbsp;
            <strong>{{$representative->fname}} {{$representative->mname}} {{$representative->lname}}</strong>
        </li>
        <li>Designation: &nbsp;<strong>Member</strong></li>
    </ul>
@endif

<script type="text/javascript">
    function reloadProviderDetail() {
        console.log(document.param);
    }
</script>