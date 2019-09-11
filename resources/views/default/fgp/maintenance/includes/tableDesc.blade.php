<style>
.equalHeight {
  display: flex; /* equal height of the children */
  min-height: 300px;
}
.dyanamicHeight {
  flex: 1; /* additionally, equal width */
  position:relative;
}
.tableDesc{
    max-height: 300px;
    overflow: auto;
}
.tableDesc::-webkit-scrollbar{
    width: 2px;
}
.tableDesc::-webkit-scrollbar-track{
    width: 2px;
}
/* Handle */
.tableDesc::-webkit-scrollbar-thumb {
    background: #888;
}

/* Handle on hover */
.tableDesc::-webkit-scrollbar-thumb:hover {
    background: #555;
}
.m-list-search__results .getDescription:not(:last-child){
    border-bottom: 1px dotted grey;
}

</style>
<div class="row">
    <div class="col-sm-4 equalHeight">
        <div class="m-portlet dyanamicHeight">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Name of Tables
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body" style="padding:1.2rem 2.2rem !important;">
                <div class="m-form m-form--label-align-right m--margin-top-bottom">
                    <div class="global-filter row no-gutters">
                        <div class="col-lg-12">
                            <div class="m-portlet no-m-i m-portlet--bordered-semi">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                                        <form class="form-inline">
                                        <div class="col-auto">
                                            <div class="input-group m-input-group"
                                                style="border-radius: 20px !important;">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                                    Label
                                                </span>
                                                </div>
                                                <input type="text"
                                                    name="label"
                                                    class="form-control m-input width-160" id="generalSearch"
                                                    aria-describedby="basic-addon1"
                                                    style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;"
                                                        autocomplete="off">
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <button type="button" class="hidden" id="appQuickButton" data-target="TableMainSearch">test</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m_datatable m-t-10" id="table_name"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 equalHeight">
        <div class="m-portlet dyanamicHeight">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Description
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <!-- <button type="button" data-modal-route="addTable" class="btn m-btn--pill btn-outline-info btn-sm m-btn m-btn--custom no-m-i" title="Add Table">
                        <i class="la la-plus"></i> Add Table
                    </button> -->
                    <a href="#" class="btn btn-outline-brand m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill" id="viewTable" data-modal-route="viewTable/@if($firstItem){{$firstItem->id}}@endif">
                        <i class="la la-eye"></i>
                    </a>
                    <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill" id="editTable" data-modal-route="editTable/@if($firstItem){{$firstItem->id}}@endif">
                        <i class="la la-edit"></i>
                    </a>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-sm-12" id="tableDescription">
                        <span>
                        @if($firstItem){{$firstItem->description}}@endif
                        </span>
                    </div>
                    <div class="col-sm-12">
                    <br>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>