<style>
    #NoteCreate .select2-selection.select2-selection--single, #LookupCreate .select2-selection.select2-selection--single, #lookupUpdate .select2-selection.select2-selection--single, #siteCreate .select2-selection.select2-selection--single, #siteUpdate .select2-selection.select2-selection--single, #organizationCreate .select2-selection.select2-selection--single, #organizationUpdate .select2-selection.select2-selection--single, #newCounty .select2-selection.select2-selection--single, #newStateCreate .select2-selection.select2-selection--single, #newRegionCreate .select2-selection.select2-selection--single, #newDistrictCreate .select2-selection.select2-selection--single, #newCityCreate .select2-selection.select2-selection--single {
        height: 30px !important;
    }

    .m-checkbox-list .m-checkbox, .m-checkbox-list .m-radio, .m-radio-list .m-checkbox, .m-radio-list .m-radio {
        display: inline;
    }

    .floatLabelForm .m-radio-list input {
        height: 20px !important;
    }

    textarea#note_desc {
        display: none;
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
<div class="modal-dialog" role="document" style="max-width: 1200px;">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Edit Note</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <div class="modal-body has-divider">
            <form id="NoteEdit" class="m-form m-form--label-align-right m-t-10">
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
                                                    <div class="col-md-12 no-padding">
                                                        <div class="row no-padding">
                                                            <div class="col-md-12 no-padding">
                                                                <table style="width: 100%;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td><h6>Name</h6></td>
                                                                        <td>
                                                                            <h6>
                                                                          <span class="m-widget24__desc"
                                                                                id="note_vol_name">
                                                                            {{ucfirst($volunteer?$volunteer->first_name:"Volunteer Not Selected")}} {{ucfirst($volunteer?$volunteer->last_name:"")}}
                                                                          </span>
                                                                                <input type="hidden" name="vol_id"
                                                                                       id="vol_id"
                                                                                       value="{{$note->vol_id}}">
                                                                            </h6>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><h6>Email</h6></td>
                                                                        <td>
                                                                            <h6>
                                                                          <span class="m-widget24__desc"
                                                                                id="note_vol_email">
                                                                                  {{ $volunteer?$volunteer->volunteer_contact->email??'':"VolunteerNotSelected" }}
                                                                          </span>
                                                                            </h6>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><h6>Contact</h6></td>
                                                                        <td>
                                                                            <h6>
                                                                          <span class="m-widget24__desc"
                                                                                id="note_vol_contact">
                                                                                  {{ $volunteer?format_cell($volunteer->volunteer_contact->cell_phone??''):"VolunteerNotSelected" }}
                                                                          </span>
                                                                            </h6>
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
                                                                <h6 class="ml-25">
                                                          <span class="m-widget24__desc" id="note_site_name">
                                                            {{$site?$site->site_name:"Site Not Selected"}}
                                                          </span>
                                                                    <input type="hidden" name="site_id" id="site_id"
                                                                           value="{{$note->site_id}}">
                                                                </h6>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6>Address</h6></td>
                                                            <td>
                                                                <h6 class="ml-25">
                                                          <span class="m-widget24__desc" id="note_site_addr">
                                                              {{$site?$site->address->add1??'':"Site Not Selected"}}
                                                          </span>
                                                                </h6>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6>Email</h6></td>
                                                            <td>
                                                                <h6 class="ml-25">
                                                          <span class="m-widget24__desc" id="note_site_email">
                                                              {{$site?$site->site_contact['email']??'':"Site Not Selected"}}
                                                          </span>
                                                                </h6>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 pt-10" id="noteFiles">
                                        <div class="m-widget24">
                                            <div class="m-widget24__item pt-10">
                                                <h4 class="m-widget24__title no-margin">
                                                    Files
                                                </h4>

                                            </div>
                                            <?php $note->files->push(app('App\Models\File')); // last row ?>
                                            @foreach($note->files as $fs)
                                            <div class="files-section d-flex m-t-5">
                                                <input type="text" class="form-control" placeholder="File Title"
                                                       @if($loop->last)name="file_title[]" @else disabled @endif value="{{ $fs->document_title }}">
                                                <div class="d-flex m-l-5">
                                                    <input @if($loop->last) type="file" name="file[]" @else type="text" name="existing_files[]" value="{{ $fs->id }}" @endif style="display: none">

                                                    <?php
                                                        // download name of file
                                                    $d_name = $fs->document_title;
                                                    if (!preg_match("#\.{$fs->document_type}$#", $d_name))
                                                        $d_name .= '.' . $fs->document_type;
                                                    ?>

                                                    <a href="{{ $loop->last ? 'javascript:;': "/notes/download/{$fs->file_name}" }}"
                                                       class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill {{ $loop->last ? 'uploadNoteFile' : '' }}"
                                                            {{ $loop->last ? '' : "download={$d_name}" }}>
                                                        <i class="la la-{{ $loop->last ? 'upload' : 'download' }}"></i>
                                                    </a>
                                                    <button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill removeRowFile"
                                                    @if(!$loop->last) style="display: inline-block !important;" @endif>
                                                        <i class="la la-remove"></i>
                                                    </button>
                                                    <button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill addNoteFileRow {{ $loop->last?:'d-none' }}">
                                                        <i class="la la-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
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
                                               name="title" id="title" autocomplete="off"
                                               value="{{ ucwords($note->title) }}">
                                    </div>
                                    <div class="col-lg-2 col-sm-6 mb-lg-0 mb-3">
                                        <label class="" for="last_name">Status</label>
                                        <input type="text" class="form-control form-control-sm m-input ucfirst"
                                               name="status" id="status" autocomplete="off"
                                               value="{{ ucwords($note->status) }}"
                                               data-lookup="/lookup/getData/note_status">
                                    </div>
                                    <div class="col-lg-2 col-sm-6 mb-lg-0 mb-3">
                                        <label class="" for="last_name">Priority</label>
                                        <input type="text" class="form-control form-control-sm m-input" name="priority"
                                               id="priority" autocomplete="off" value="{{$note->priority}}"
                                               data-lookup="/lookup/getData/note_priority">
                                    </div>
                                    <div class="col-lg-4 col-sm-12 mt-20">
                                        <label class="" for="last_name">Start & End Date</label>
                                        <input type="text" class="form-control form-control-sm m-input" name="start"
                                               id="start" autocomplete="off">
                                    </div>
                                    <div class="col-lg-2 col-sm-6 mt-20">
                                        <label for="ssn" title="Social Secuty Number">
                                            Remainder Date
                                        </label>
                                        <input type="text" class="form-control form-control-sm m-input note-datepicker"
                                               name="reminder_timestamp" id="reminder_timestamp" autocomplete="off"
                                               value="{{$note->reminder_timestamp?date('m/d/Y',strtotime($note->reminder_timestamp)):''}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-6 mt-20">
                                        <label for="ssn" title="Social Secuty Number">
                                            To Do Date
                                        </label>
                                        <input type="text" class="form-control form-control-sm m-input note-datepicker"
                                               name="todo_timestamp" id="todo" autocomplete="off"
                                               value="{{$note->todo_timestamp?date('m/d/Y',strtotime($note->todo_timestamp)):''}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-6 mt-20 ">
                                        <label for="ssn" title="Social Secuty Number">
                                            Note Code
                                        </label>
                                        <input type="text" class="form-control form-control-sm m-input" id="note_code"
                                               name="note_code" autocomplete="off" value="{{$note->note_code}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-6 mt-20 row">
                                        <label>
                                            Note Type
                                        </label>
                                        <input type="text" class="form-control form-control-sm m-input ucfirst"
                                               name="note_type" id="note_type" autocomplete="off"
                                               value="{{ ucfirst($note->note_type) }}"
                                               data-lookup="/lookup/getData/note_type" rel="note_type">
                                    </div>
                                    <div class="col-sm-12 mt-20">
                                        <label for="notes">Description</label>
                                        <textarea class="form-control form-control-sm m-input" name="note_desc" rows="5"
                                                  id="note_desc">{!! $note->note_desc !!}</textarea>
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
            <button type="button" class="btn btn-success m-btn--icon m-btn--pill float-right" id="updateNote"
                    data-target="NoteEdit">
                <span>
                    <span>Update</span>
                </span>
            </button>
        </div>
    </div>
</div>

<script>
    $("#addFile").off('click').on('click', function (e) {
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
    })



    $(document).off('click', '#updateNote').on('click', '#updateNote', function (e) {
        var form = $(this).attr('data-target');
        var request = {
            url: '/note/noteUpdate/{{$note->id}}',
            method: 'post',
            form: form
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.note_datatable');
                reloadDatatable('.note_datatable_done');
                // partials
                $('#notes-todo').load('/notes/todo/today');
                $('#notes-reminder').load('/notes/reminders/today');
                removeFormLoader();
            });
        });
    });

    /*--------- category select 2 --------*/
    $('#volunteer').select2({
        width: "100%",
        dropdownParent: $('#modalContainer'),
        ajax: {
            url: 'volunteer/all',
            processResults: function (data) {
                let program = [];
                $.each(data, function (index, value) {
                    program.push({id: value.id, text: value.value});
                });
                return {
                    results: program
                };
            }
        }
    });

    /*--------- category select 2 --------*/
    $('#site').select2({
        width: "100%",
        dropdownParent: $('#modalContainer'),
        ajax: {
            url: '/sites/fetchAll',

            processResults: function (data) {
                let program = [];
                $.each(data, function (index, value) {
                    program.push({id: value.id, text: value.value});
                });
                return {
                    results: program
                };
            }
        }
    });

    $(function () {
        $('#note_desc').summernote(std.config.editorConfig);
        replaceLookups(document.getElementById('NoteEdit'));

        $('#noteFiles').off('change', '[name="file[]"]').on('change', '[name="file[]"]', function() {
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

         $('.files-section:first').before($('.files-section:last'));
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

    $('#start').daterangepicker({
        startDate: new Date('{{ $start_date }}'),
        endDate: new Date('{{ $end_date }}')
    });
</script>