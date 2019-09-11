<div id="developerPanel">
    <div id="handle" class="ui-resizable-handle ui-resizable-n"></div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Support
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <label rel="developerConsole" class="btn btn-outline-metal m-btn m-btn--icon m-btn--icon-only m-btn--pill">
                            <i class="la la-close"></i>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <form action="/developernote/store" id="DeveloperNoteForm">
                        <textarea class="form-control m-input" rows="12" name="text" id="NoteTextarea" placeholder="Write your note"></textarea>
                        <input type="hidden" name="page" value="" id="PageHolder">
                        <div class="form-footer">
                            <button type="submit" class="float-right btn btn-success m-btn--pill m-t-10" id="saveDeveloperNote">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="notes">
                        <div class="m-widget3" id="DeveloperNotesHolder">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function initSumernote() {
        if (typeof $ === 'undefined') return setTimeout(initSumernote, 500);
        return $('#NoteTextarea').summernote({
            height: 300,
            callbacks: {
                onInit() {
                    $('#DeveloperNoteForm .note-editing-area').prepend('<p><br><br></p>');
                }
            }
        });
    }
    initSumernote();
</script>