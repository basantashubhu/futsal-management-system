<div class="m-content">
    <div class="m-portlet m-portlet--mobile with-border">
        <!-- Zip code Body part -->
        <div class="m-portlet__body">
            <!--begin: Datatable -->

            <div id="fileImportTable">
                <div class="col-md-4">

                    <div class="m-widget4">
                          <!-- Volunteer-->
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--icon">
                                <img class="icon-img m-r-10" src="assets/images/file-icon/csv.svg" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Volunteers
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <div class="btn-group m-btn-group m-btn-group--pill" role="group" aria-label="...">
                                    <button type="button"
                                            class="m-btn btn btn-secondary btn-sm downloadCSV" data-sort-field="first_name" data-sort-value="desc"
                                            data-file="volunteer"
                                            target="_blank"
                                            download>
                                        <i class="la la-download"></i> <span>Sample Download</span>
                                    </button>
                                    <button type="button"
                                            data-modal-route="importer/uploadcsv?table=volunteer"
                                            class="m-btn btn btn-secondary btn-sm ">
                                        <i class="la la-upload"></i> <span>Upload</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Volunteer-->
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--icon">
                                <img class="icon-img m-r-10" src="assets/images/file-icon/csv.svg" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Sites
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <div class="btn-group m-btn-group m-btn-group--pill" role="group" aria-label="...">
                                    <button type="button" data-file-extension="false"
                                            data-file="sites"
                                            class="m-btn btn btn-secondary btn-sm downloadCSV">
                                        <i class="la la-download"></i> <span>Sample Download</span>
                                    </button>
                                    <button type="button"
                                            data-modal-route="importer/uploadcsv?table=sites"
                                            class="m-btn btn btn-secondary btn-sm ">
                                        <i class="la la-upload"></i> <span>Upload</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--icon">
                                <img class="icon-img m-r-10" src="assets/images/file-icon/csv.svg" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Address
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <div class="btn-group m-btn-group m-btn-group--pill" role="group" aria-label="...">
                                    <button type="button" data-file-extension="false"
                                            data-file="address"
                                            class="m-btn btn btn-secondary btn-sm downloadCSV">
                                        <i class="la la-download"></i> <span>Sample Download</span>
                                    </button>
                                    <button type="button"
                                            data-modal-route="importer/uploadcsv?table=address"
                                            class="m-btn btn btn-secondary btn-sm ">
                                        <i class="la la-upload"></i> <span>Upload</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Holiday -->
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--icon">
                                <img class="icon-img m-r-10" src="assets/images/file-icon/csv.svg" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Holidays
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <div class="btn-group m-btn-group m-btn-group--pill" role="group" aria-label="...">
                                    <button type="button" data-file-extension="false"
                                            data-file="holiday"
                                            class="m-btn btn btn-secondary btn-sm downloadCSV">
                                        <i class="la la-download"></i> <span>Sample Download</span>
                                    </button>
                                    <button type="button"
                                            data-modal-route="importer/uploadcsv?table=holiday"
                                            class="m-btn btn btn-secondary btn-sm ">
                                        <i class="la la-upload"></i> <span>Upload</span>
                                    </button>
                                </div>
                            </div>
                        </div> 

                        <!-- Stipend Period -->
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--icon">
                                <img class="icon-img m-r-10" src="assets/images/file-icon/csv.svg" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    Stipend Periods
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <div class="btn-group m-btn-group m-btn-group--pill" role="group" aria-label="...">
                                    <button type="button" data-file="stipend_period"
                                            class="m-btn btn btn-secondary btn-sm downloadCSV">
                                        <i class="la la-download"></i> <span>Sample Download</span>
                                    </button>
                                    <button type="button"
                                            data-modal-route="importer/uploadcsv?table=pay_periods"
                                            class="m-btn btn btn-secondary btn-sm ">
                                        <i class="la la-upload"></i> <span>Upload</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--end: Datatable -->
        </div>
    </div>
</div>
<script>
    $(document).off('click', '.volReportExport').on('click', '.volReportExport', function (e) {

        addFormLoader();
        ajaxRequest({
            url:'export/volunteer',
            method:'get',
            success:function(response){
                removeFormLoader();
                console.log(response);

            }
        },function (resp) {
            console.log(resp)
        });
    });

    $(document).off('click','.downloadCSV').on('click','.downloadCSV',function(e) {
        let dataFile = $(this).attr('data-file');
        console.log(dataFile);
        window.open(`download_csv/${dataFile}`);
    });

</script>