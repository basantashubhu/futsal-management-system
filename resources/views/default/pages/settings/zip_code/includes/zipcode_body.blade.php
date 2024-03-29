<div class="m-content">
    <div class="m-portlet m-portlet--mobile with-border">
        <!-- Zip code Body part -->
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-bottom">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-4">
                                <div class="m-input-icon m-input-icon--left">
                                    <input type="text" class="form-control m-input" placeholder="Search..."
                                           id="generalSearch">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
        								<span>
        									<i class="la la-search"></i>
        								</span>
        							</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                        <a href="#" data-modal-route="addZipCode" class="btn btn-info btn-sm m-btn m-btn--custom m-btn--icon m-btn--pill">
        					<span>
        						<i class="la la-plus"></i>
        						<span>
        							Add Zip Code
        						</span>
        					</span>
                        </a>
                        <a href="#" data-modal-route="massDeleteZip" data-target="massDelete" id="massDeleteZip" class="btn btn-danger btn-sm m-btn m-btn--custom m-btn--icon m-btn--pill" style="display: none;">
                            <span>
                                <i class="la la-trash"></i>
                                <span>
                                    Delete
                                </span>
                            </span>
                        </a>

                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <form id="massDelete">
                <div class="zipcode_datatable" id="auto_column_hide"></div>
            </form>
            <!--end: Datatable -->
        </div>
    </div>
</div>