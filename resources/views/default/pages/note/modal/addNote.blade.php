<style>
    #NoteCreate .select2-selection.select2-selection--single, #LookupCreate .select2-selection.select2-selection--single, #lookupUpdate .select2-selection.select2-selection--single, #siteCreate .select2-selection.select2-selection--single, #siteUpdate .select2-selection.select2-selection--single, #organizationCreate .select2-selection.select2-selection--single, #organizationUpdate .select2-selection.select2-selection--single, #newCounty .select2-selection.select2-selection--single, #newStateCreate .select2-selection.select2-selection--single, #newRegionCreate .select2-selection.select2-selection--single, #newDistrictCreate .select2-selection.select2-selection--single, #newCityCreate .select2-selection.select2-selection--single {
        height: 30px !important;
    }

    .m-checkbox-list .m-checkbox, .m-checkbox-list .m-radio, .m-radio-list .m-checkbox, .m-radio-list .m-radio {
        display: inline !important;
    }

    .floatLabelForm .m-radio-list input {
        height: 20px !important;
    }

    .removeRowFile {
        display: none !important;
    }
    .files-section {
        position: relative;
    }
    .files-section .badge.badge-danger.badge-pill {
        left:-6px;top:-3px;position:absolute;
    }

</style>
<div class="modal-dialog modal-custom-width" role="document" >
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Add Note</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <div class="modal-body has-divider">
            <form id="NoteCreate" enctype="multipart/form-data" class="m-form m-form--label-align-right">
                {{--                <input type="hidden" name="full_validate" value="true">--}}
                <div class="row no-padding">
                    <div class="col-md-4 no-padding" style="border-right: 1px solid #e4e4e4;">
                        <div class="m-portlet m-portlet--creative m-portlet--bordered-semi no-margin no-padding"
                             style="height: 100%; background: #eee;">
                            <div class="m-portlet__body no-pd-i" style="padding-bottom: 10px !important;">
                                <div class="form-group m-form__group row"
                                     style="padding: 20px 5px 20px 5px !important;">
                                    <div class="col-lg-12">
                                        <div class="m-widget24">
                                            <div class="m-widget24__item">
                                                <h4 class="m-widget24__title no-margin">
                                                    Volunteer
                                                </h4>
                                                <button type="button"
                                                        class="btn btn-metal btn-xs m-btn--icon m-btn--pill float-right"
                                                        data-sub-modal-route="note/selectVolunteer"
                                                        data-backdrop="static" data-keyboard="false">
                                            <span>
                                                <span>Change</span>
                                            </span>
                                                </button>
                                                <div class="row no-padding mt-10"
                                                     style="padding-bottom: 15px !important; border-bottom: 1px solid #ccc;">
                                                    {{-- <div class="col-md-2 mt-5 no-padding">
                                                        <img class="m--img-rounded grid-img" src="../../assets/app/media/img/users/user1.jpg" title="" style="max-width: 100%;">
                                                    </div> --}}
                                                    <div class="col-md-12 no-padding">
                                                        <div class="row no-padding">
                                                            <div class="col-md-12 no-padding">
                                                                <table style="width: 100%;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td><h6>Name</h6></td>
                                                                        <td>
                                                                            @if(isset($volunteer))
                                                                            <h6 class="ml-25">
                                                                                <span class="m-widget24__desc" id="note_vol_name"> {{$volunteer->first_name}} {{$volunteer->midle_name}} {{$volunteer->last_name}}</span>
                                                                                <input type="hidden" name="vol_id" id="vol_id" value="{{$volunteer->id}}">
                                                                            </h6>
                                                                            @else
                                                                            <h6 class="ml-25">
                                                                                <span class="m-widget24__desc" id="note_vol_name"> Please Select Volunteer </span>
                                                                                <input type="hidden" name="vol_id" id="vol_id">
                                                                            </h6>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><h6>Email</h6></td>
                                                                        <td>
                                                                            @if(isset($volunteer))
                                                                            <h6 class="ml-25">
                                                                                <span class="m-widget24__desc" id="note_vol_email">{{($volunteer->volunteer_contact->email)?? "Not Assigned"}}</span>
                                                                            </h6>
                                                                            @else
                                                                            <h6 class="ml-25">
                                                                                <span class="m-widget24__desc" id="note_vol_email"> Please Select Volunteer </span>
                                                                            </h6>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><h6>Contact</h6></td>
                                                                        <td>
                                                                            @if(isset($volunteer))
                                                                            <h6 class="ml-25">
                                                                                <span class="m-widget24__desc" id="note_vol_contact">  {{ ($volunteer->volunteer_contact->cell_phone)?? "Not Assigned"}} </span>
                                                                            </h6>
                                                                            @else
                                                                            <h6 class="ml-25">
                                                                                <span class="m-widget24__desc" id="note_vol_contact">  Please Select Volunteer </span>
                                                                            </h6>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 pt-10">
                                        <div class="m-widget24">
                                            <div class="m-widget24__item">
                                                <h4 class="m-widget24__title no-margin">
                                                    Site
                                                </h4>
                                                <button type="button"
                                                        class="btn btn-metal btn-xs m-btn--icon m-btn--pill float-right"
                                                        data-sub-modal-route="note/selectSite" data-backdrop="static"
                                                        data-keyboard="false">
                                            <span>
                                                <span>Change</span>
                                            </span>
                                                </button>
                                                <div class="col-md-12 no-padding mt-10"
                                                     style="padding-bottom: 15px !important; border-bottom: 1px solid #ccc;">
                                                    <table style="width: 100%;">
                                                        <tbody>
                                                        <tr>
                                                            <td><h6>Name</h6></td>
                                                            <td>
                                                                @if(isset($volunteer) && $volunteer->defaultSite()->site_name)
                                                                    <h6> <span class="m-widget24__desc" id="note_site_name">{{($volunteer->defaultSite()->site_name)?? "Not Assigned"}} </span>
                                                                        <input type="hidden" name="site_id" id="site_id" value="{{$volunteer->defaultSite()->id}}">
                                                                    </h6>
                                                                @else
                                                                    <h6> <span class="m-widget24__desc" id="note_site_name"> PLease select Site </span>
                                                                        <input type="hidden" name="site_id" id="site_id">
                                                                    </h6>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6>Address</h6></td>
                                                            <td>
                                                                @if(isset($volunteer) && $volunteer->defaultSite() && $volunteer->defaultSite()->address)
                                                                    <h6>
                                                                        <span class="m-widget24__desc" id="note_site_addr">  {{($volunteer->defaultSite()->address->add1)??"Not Assigned"}}</span>

                                                                    </h6>

                                                                @else
                                                                    <h6>
                                                                        <span class="m-widget24__desc" id="note_site_addr">  PLease select Site </span>
                                                                    </h6>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6>Email</h6></td>
                                                            <td>
                                                                @if(isset($volunteer) 
                                                                && $volunteer->defaultSite() 
                                                                && $volunteer->defaultSite()->site_contact
                                                                && $volunteer->defaultSite()->site_contact['email'])
                                                                    <h6>
                                                                        <span class="m-widget24__desc" id="note_site_email"> {{($volunteer->defaultSite()->site_contact['email'])??"Not Assigned"}} </span>
                                                                    </h6>
                                                                @else
                                                                    <h6>
                                                                        <span class="m-widget24__desc" id="note_site_email"> PLease select Site </span>
                                                                    </h6>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="is_active" value="0">
                                    <input type="hidden" name="is_completed" value="0">
                                    <input type="hidden" name="is_seen" value="0">

                                    <div class="col-lg-12 pt-10" id="noteFiles">
                                        <div class="m-widget24">
                                            <div class="m-widget24__item pt-10">
                                                <h4 class="m-widget24__title no-margin">
                                                    Files
                                                </h4>

                                                {{-- <button type="button" class="btn btn-metal btn-xs m-btn--icon m-btn--pill float-right" id="addFile">
                                                  <span>Add</span>
                                                </button>
                                                <input type="file" id="openFileUpload" name="note_files[]" multiple="multiple" style="display: none !important;"><br>
                                                <div id="selectedFiles" class="mt-3"></div> --}}
                                            </div>
                                        </div>
                                        <div class="files-section d-flex m-t-5">
                                            <input type="text" class="form-control" placeholder="File Title"
                                                   name="file_title[]">
                                            <div class="d-flex m-l-5">
                                                <input type="file" name="file[]" style="display: none">
                                                <button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill uploadNoteFile">
                                                    <i class="la la-upload"></i>
                                                </button>
                                                <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill removeRowFile">
                                                    <i class="la la-remove"></i>
                                                </button>
                                                <button class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill addNoteFileRow">
                                                    <i class="la la-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 no-padding">
                        <div class="m-portlet m-portlet--creative m-portlet--bordered-semi no-margin"
                             style="background: #eee; height: 100%;">
                            <div class="m-portlet__body no-pd-i" style="padding-bottom: 10px !important;">
                                <div class="form-group m-form__group row no-pd-right no-pd-left m-t-10">
                                    <div class="col-lg-8 col-sm-12 mb-lg-0 mb-3">
                                        <label class="" for="last_name">Title</label>
                                        <input type="text" class="form-control form-control-sm m-input ucfirst"
                                               name="note_title" id="title" autocomplete="off">
                                    </div>
                                    <div class="col-lg-2 col-sm-6 mb-lg-0 mb-3">
                                        <label class="" for="last_name">Status</label>
                                        <input type="text" class="form-control form-control-sm m-input ucfirst"
                                           name="status" id="status" autocomplete="off" value="{{"Not Done"}}"
                                               data-lookup="/lookup/getData/note_status">
                                    </div>
                                    <div class="col-lg-2 col-sm-6 mb-lg-0 mb-3">
                                        <label class="" for="last_name">Priority</label>
                                        <input type="text" class="form-control form-control-sm m-input" name="priority"
                                               id="priority" autocomplete="off" value="Standard"
                                               data-lookup="/lookup/getData/note_priority">
                                    </div>
                                    <div class="col-lg-4 col-sm-12 mt-20">
                                        <label class="" for="last_name">Start & End Date</label>
                                        <input type="text" class="form-control form-control-sm m-input" name="start"
                                               id="start" autocomplete="off">
                                    </div>
                                    <div class="col-lg-2 col-sm-6  mt-20">
                                        <label for="ssn" title="Social Secuty Number">
                                            Remainder&nbsp;Date
                                        </label>
                                        <input type="text" class="form-control form-control-sm m-input note-datepicker"
                                               name="reminder_timestamp" id="reminder_timestamp" autocomplete="off">
                                    </div>
                                    <div class="col-lg-2 col-sm-6  mt-20">
                                        <label for="ssn" title="Social Secuty Number">
                                            To Do Date
                                        </label>
                                        <input type="text" class="form-control form-control-sm m-input note-datepicker"
                                               name="todo_timestamp" id="todo" autocomplete="off">
                                    </div>
                                    <div class="col-lg-2 col-sm-6 mt-20 ">
                                        <div class="col-md-12  no-padding">
                                            <label>
                                                Note Type
                                            </label>
                                            <input type="text" class="form-control form-control-sm m-input ucfirst"
                                            data-lookup="/lookup/getData/note_type" name="note_type"
                                            id="note_type" rel="note_type" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 mt-20 row">
                                        <div class="col-md-12  no-padding">
                                            <label for="ssn" title="Social Secuty Number">
                                                Note Code
                                            </label>
                                            <input type="text" class="form-control form-control-sm m-input"
                                                    id="note_code" name="note_code" autocomplete="off" data-advanced="" data-lookup="/lookup/getData/note_code">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-20">
                                        <label for="note_desc" {{-- class="required" --}}>Description</label>
                                        <textarea class="form-control form-control-sm m-input" name="note_desc" rows="5"
                                                  id="note_desc"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success m-btn--icon m-btn--pill float-right" id="submitNote"
                    data-target="NoteCreate">
                <span>
                    <span>Save</span>
                </span>
            </button>
        </div>
    </div>
</div>

<script>

    $("#addFile")
    .off("click")
    .on("click", function (e) {
        $("#openFileUpload").click();
    });

    $(document)
    .off("click", ".uploadNoteFile")
    .on("click", ".uploadNoteFile", function (e) {

        e.preventDefault();

        $(this)
        .closest(".files-section")
        .find('[name="file[]"]')
        .trigger("click");
    });


BootstrapSelect.init();
    $(".note-datepicker").datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'mm/dd/yyyy'
    });

    $('#start').daterangepicker();

    // $('#start').on('apply.daterangepicker', function(ev, picker) {
    //     $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    // });

    // $('#start').on('cancel.daterangepicker', function(ev, picker) {
    //     $(this).val('');
    // });


    $(document).off('click', '#submitNote').on('click', '#submitNote', function (e) {
        const form = $(this).attr('data-target');
        const request = {
            url: '/note/noteStore',
            method: 'post',
            data: new FormData(document.getElementById(form)),
            loader: true,
            processData: false, contentType: false
        };
        try {
            sendAjax(request, function (response) {
                processAjaxForm(response, processModal);
                reloadDatatable('.note_datatable');
                reloadDatatable('.note_datatable_done');
                // partials
                $('#notes-todo').load('/notes/todo/today');
                $('#notes-reminder').load('/notes/reminders/today');
            }, processAjaxForm);
        } catch (e) {
            removeFormLoader();
        }
    });

    $(function () {
        $('#note_desc').summernote(std.config.editorConfig);
        replaceLookups(document.getElementById('NoteCreate'));

        $('#NoteCreate').off('change', '[name="file[]"]').on('change', '[name="file[]"]', function() {
            const target = $(this).closest('.files-section').find('[name="file_title[]"]');
            const fileCount = this.files.length;
            if(fileCount) {
                updateCount(target, fileCount);
                if(target.val()) return;
                for(const file of this.files) {
                    target.attr('title', file.name).val(file.name);
                }
            } else {
                target.attr('title', '').val('');
                updateCount(target, fileCount);
            }
        });
    })

    function updateCount(target, fileCount) {
        target.each(function() {
            if($(this).next('span.badge').length) $(this).next('span.badge').text(fileCount);
            else $(this).after('<span class="badge badge-danger badge-pill">'+ fileCount +'</span>');
        })
    }

    $(document).off('click', '.addNoteFileRow').on('click', '.addNoteFileRow', function (e) {

        e.preventDefault();

        let html = `
        
        <div class="files-section d-flex m-t-5">
          <input type="text" class="form-control" placeholder="File Title" name="file_title[]">
          <div class="d-flex m-l-5">
            <input type="file" name="file[]" style="display: none">

            <button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill uploadNoteFile">
                <i class="la la-upload"></i>
            </button>
            <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill removeRowFile">
                <i class="la la-remove"></i>
            </button>
            <button class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill addNoteFileRow">
                <i class="la la-plus"></i>
            </button>
          </div>                                      
        </div>

      `.trim();

        $(this).hide();
        $(this).parent().find('.removeRowFile').css("cssText", "display: block !important");
        $(html).insertBefore($('#noteFiles .files-section:first'))

    });

    $(document)
    .off('click', '.removeRowFile')
    .on('click', '.removeRowFile', function (e) {

        e.preventDefault()

        $(this).closest('.files-section').remove();

    })

</script>