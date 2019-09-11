<style>
    .m-form__group {
        border: none !important;
    }
</style>

<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="width: 1000px">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Add Note
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">

            <form id="noteCreate" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="m-portlet">
                            <div class="m-portlet__body " style="margin: 20px 0; padding: 10px !important;">
                                <div class="form-group m-form__group row">

                                    <div class=" col-lg-12">
                                        Priority <span class="required">*</span>
                                        <div class="m-input-icon">
                                            <input type="text" name="priority" id="priority"
                                                   class="form-control m-input getValue" rel='note_priority'
                                                   data-lookup="/lookup/getData/note_priority"
                                                   autocomplete="Off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">

                                    <div class=" col-lg-12">
                                        Status <span class="required">*</span>
                                        <div class="m-input-icon">
                                            <input type="text" name="status" id="status"
                                                   class="form-control m-input getValue" rel='note_status'
                                                   data-lookup="/lookup/getData/note_status"
                                                   autocomplete="Off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--Client Section--}}
                        <div class="m-portlet">

                            <div class="m-portlet__body " style="margin: 20px 0; padding: 10px !important;">
                                <div class="m-widget4">
                                    <div class="m-widget4__item ">
                                        <div class="m-widget4__img m-widget4__img--icon">
                                            <i class="la la-user"></i>
                                        </div>
                                        <div class="m-widget4__info">
                                        <span class="m-widget4__text">
                                           rakesh shrestha
                                        </span>
                                        </div>
                                    </div>
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__img m-widget4__img--icon">
                                            <i class="la la-map-marker"></i>
                                        </div>
                                        <div class="m-widget4__info">
                                        <span class="m-widget4__text">
                                           Narayantar, Jorpati
                                        </span>
                                        </div>
                                    </div>
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__img m-widget4__img--icon">
                                            <i class="la la-phone"></i>
                                        </div>
                                        <div class="m-widget4__info">
                                        <span class="m-widget4__text">
                                           9841080357
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--application section--}}
                        <div class="m-portlet">
                            <div class="m-portlet__body " style="margin: 20px 0; padding: 10px !important;">
                                Application Section
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="m-portlet">
                            <div class="m-portlet__body " style="margin: 20px 0; padding: 10px !important;">

                                <div class="form-group m-form__group row">

                                    <div class=" col-lg-12">
                                        Title <span class="required">*</span>
                                        <div class="m-input-icon">
                                            <input type="text" name="title" placeholder="Title of Note" id="title"
                                                   class="form-control m-input ">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class=" col-lg-6">
                                        Reminder Date
                                        <div class="m-input-icon">
                                            <input type="text" class="form-control m-input" value="2018/03/16 00:30"
                                                   id="m_datetimepicker_3" name="reminder_timestamp">
                                        </div>
                                    </div>
                                    <div class=" col-lg-6">
                                        Todo Date
                                        <div class="m-input-icon">
                                            <input type="text" class="form-control m-input" value="2018/03/16 00:30"
                                                   id="m_datetimepicker_2" name="todo_timestamp">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class=" col-lg-6">
                                        Note Type <span class="required">*</span>
                                        <div class="m-input-icon">
                                            <input type="text" name="note_type" id="note_type"
                                                   class="form-control m-input " rel='note_type'
                                                   data-lookup="/lookup/getData/note_type"
                                                   autocomplete="Off">
                                        </div>
                                    </div>
                                    <div class=" col-lg-6">
                                        Activity
                                        <div class="m-input-icon">
                                            <input type="text" name="activity" id="note_activity"
                                                   class="form-control m-input "
                                                   data-lookup="/lookup/getData/note_activity"
                                                   autocomplete="Off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class=" col-lg-12">
                                        Note
                                        <div class="m-input-icon">
                                            <textarea class="form-control m-input " name="notes" rows="6"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill" id="submitNote" data-target="noteCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).off('click', '#submitNote').on('click', '#submitNote', function (e) {
        var form = $(this).attr('data-target');
        var data = $('#' + form).serializeArray();
        var request = {
            url: 'notes/store/{{$application->id}}',
            method: 'post',
            form: form
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                loadNotes({{$application->id}});
                removeFormLoader();
            });
        });
    });
</script>