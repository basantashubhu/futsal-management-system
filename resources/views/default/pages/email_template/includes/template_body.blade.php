<div class="m-content">
    <div class="m-portlet m-portlet--mobile with-border">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-bottom">
                <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                    <!-- Advance Filter -->
                    <!-- Advance Filter -->
                    <form class="form form-inline" id="siteSettingsFilter">
                        <div class="col-auto">
                            <div class="input-group m-input-group" style="border-radius: 20px !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                          style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                        Template Name
                                    </span>
                                </div>
                                <input type="text" name="temp_name" id="TemplateName"
                                           class="form-control m-input applicationIDFilter"
                                           style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;" autocomplete="off"
                                           >
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="input-group m-input-group" style="border-radius: 20px !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                          style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                        Template Type
                                    </span>
                                </div>
                                <input type="text" name="temp_type" id="TemplateType"
                                           class="form-control m-input applicationIDFilter"
                                           style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;" autocomplete="off"
                                           >
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="input-group m-input-group" style="border-radius: 20px !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                          style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                        Section
                                    </span>
                                </div>
                                <input type="text" name="section" id="TemplateSection"
                                           class="form-control m-input applicationIDFilter"
                                           style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;" autocomplete="off"
                                           >
                            </div>
                        </div>
                    </form>
                    <div class="col-auto">
                        <button title="Reset Search" data-route="email_template" class="btn btn-sm btn-outline-primary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill">
                            <i class="fa fa-undo"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <div class="template_datatable" id="template_datatable"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>