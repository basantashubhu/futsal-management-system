@if(isset($support->id))
    <div class="m-portlet m-portlet--full-height support-border-color">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Posted By : {{$support->creator->member->fullname()}}
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="#" class="m-portlet__nav-link btn btn-warning btn-sm m-btn m-btn--pill">
                           Issue no: #{{$support->id}}
                        </a>
                    </li>
                    <li class="m-portlet__nav-item">
                        <a href="#" class="m-portlet__nav-link btn btn-secondary btn-sm m-btn m-btn--pill">
                            {{$support->support_department}}
                        </a>
                    </li>
                    <li class="m-portlet__nav-item">
                        <a href="#" class="m-portlet__nav-link btn btn-info btn-sm m-btn m-btn--pill">
                            {{$support->status}}
                        </a>
                    </li>
                    @if($assigned = $support->currentlyAssigned() )
                        <li class="m-portlet__nav-item">
                            <a href="#" class="m-portlet__nav-link btn btn-success btn-sm m-btn m-btn--pill">
                                Assigned To:
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m-section">
                <h3>{{$support->title}}</h3>
                <div class="m-scrollable m-scroller ps ps--active-y" data-scrollable="true" data-height="200"
                     data-scrollbar-shown="true">
                    {!! $support->description !!}
                </div>

                @if(isset($file->id))
                <div class="row">
                    <div class="col-sm-6">
                        @if($file->fileInfo("extension") == 'jpg' || $file->fileInfo("extension") == 'jpeg' || $file->fileInfo("extension") == 'png')
                        <img src="data:image/gif;base64, @php echo base64_encode(file_get_contents(storage_path('uploads/').getLogo('supports', $support->id)))@endphp" width="150">
                        @else
                        <div class="m-widget4">
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--icon">
                                    <img class="icon-img m-r-10"
                                         src="assets/images/file-icon/{{find_file_type_img($file->file_name)}}"
                                         alt="">
                                </div>
                                <div class="m-widget4__info">
                                                <span class="m-widget4__text">
                                                        {{$file->document_title}}
                                                </span>
                                </div>
                                <div class="m-widget4__ext">
                                    <div class="btn-group m-btn-group m-btn-group--pill" role="group"
                                         aria-label="...">
                                        <button type="button"
                                                data-file-url="support/file/{{$file->id}}"
                                                data-file-extension='{{ $file->fileInfo("extension") }}'
                                                class="m-btn btn btn-secondary btn-sm">
                                            <i class="la la-eye"></i>
                                        </button>
                                        <button type="button"
                                                class="m-btn btn btn-secondary btn-sm uploadedDownload"
                                                data-id="{{$file->id}}">
                                            <i class="la la-download"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <div class="m-section">
                <form class="m-form m-form--fit" style="display: none;" id="commentBox">
                    <textarea name="comment" class="form-control m-input" id="comment"></textarea>
                    <br>
                </form>
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-sm m-btn--pill btn-info" id="addCommentSupport">Add Comment
                        </button>
                        <a href="sendSupportUrl/{{$support->id}}" class="btn btn-sm m-btn--pill btn-secondary" id="sendUrl"
                        target="_blank">Send Url</a>
                        <button type="submit" class="btn btn-sm m-btn--pill btn-success" id="submitCommentSupport"
                                style="display: none;" data-target="commentBox">Comment
                        </button>
                        <button type="submit" class="btn btn-sm m-btn--pill btn-info" id="closeForm" style="display: none;">
                            Close
                        </button>
                    </div>
                </div>
            </div>
            @if(isset($support->comments))
            <div class="m-section">
                <span class="m-section__sub t-u">Comments:</span>
                <div id="appendComment"></div>
            @foreach($support->comments as $comment)
                <div class="alert m-alert m-alert--default " role="alert">
                    @if($comment->is_correct)
                        <div class="m-alert m-alert--outline alert alert-success  fade show"
                             role="alert">
                            <strong>Best Answer!</strong> This Answer Solves the issue.
                        </div>
                    @endif
                    <h6><i class="fa fa-user"></i> &nbsp; {{$comment->user->member->fullname()}}</h6>
                    <div style="background-color: #fff; padding: 5px 15px;   margin-top: 15px;" id="commentSection_{{$comment->id}}">
                        <p class="commentSection">{!! $comment->comment !!}</p>
                    </div>
                    <form class="m-form m-form--fit" id="commentEditBox_{{$comment->id}}"
                          style="display: none;">
                        <textarea name="comment"
                                  class="form-control m-input commentEdit">{!! $comment->comment !!}</textarea>
                        <br>
                        <button type="submit" class="btn btn-sm m-btn--pill btn-success updateComment"
                                data-target="commentEditBox_{{$comment->id}}" data-id="{{$comment->id}}"
                                data-parent-id="{{$support->id}}" id="update_{{$comment->id}}" data-comment-section="commentSection_{{$comment->id}}">Update
                        </button>
                        <button type="submit" class="btn btn-sm m-btn--pill btn-info closeFormReplay"
                                data-form-id="commentEditBox_{{$comment->id}}"
                                data-update-id="update_{{$comment->id}}"
                                data-edit-id="commentSection_{{$comment->id}}">Close
                        </button>
                    </form>
                    <br>
                    <a href="#"
                       class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only btn-custom-size editComment"
                       data-form-id="commentEditBox_{{$comment->id}}"
                       data-edit-id="commentSection_{{$comment->id}}">
                        <i class="la la-edit"></i>
                    </a>
                    <a href="#"
                       class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only btn-custom-size"
                       data-modal-route="comment/bestanswer/{{$support->id}}/{{$comment->id}}" title="This Solves my problem">
                        <i class="la la-check"></i>
                    </a>
                    <a href="#"
                       class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only btn-custom-size"
                       data-modal-route="comment/deleteComment/{{$support->id}}/{{$comment->id}}">
                        <i class="la la-trash"></i>
                    </a>
                    <form class="m-form m-form--fit" style="display: none;" id="commentReplayBox">
                        <br>
                        <textarea name="comment" class="form-control m-input" id="comment1"></textarea>
                        <br>
                        <button type="submit" class="btn btn-sm m-btn--pill btn-success"
                                id="submitCommentReplay"
                                style="display: none;" data-target="commentReplayBox" data-id="{{$comment->id}}"
                                data-parent-id="{{$support->id}}">Comment
                        </button>
                        <button type="submit" class="btn btn-sm m-btn--pill btn-info" id="closeFormReplay"
                                style="display: none;">Close
                        </button>
                    </form>
                </div>
            @endforeach
            </div>
            @endif
        </div>
    </div>
<script>
    $(document).ready(function () {
        $('#comment').summernote(std.config.editorConfig);
        $('.commentEdit').summernote(std.config.editorConfig);
    });
    $(document).off('click', '#addCommentSupport').on('click', '#addCommentSupport', function (e) {
        e.preventDefault();
        $('#commentBox').show();
        $(this).hide();
        $('#submitCommentSupport').show();
        $('#closeForm').show();
    });
    $(document).off('click', '#closeForm').on('click', '#closeForm', function (e) {
        e.preventDefault();
        $('#commentBox').hide();
        $(this).hide();
        $('#submitCommentSupport').hide();
        $('#addCommentSupport').show();
    });
    $(document).off('click', '#submitCommentSupport').on('click', '#submitCommentSupport', function (e) {
        e.preventDefault();
        var target = $(this).attr('data-target');
        var request = {
            url: 'support/commentStore/{{$support->id}}',
            method: 'post',
            form: target
        }
        addFormLoader();
        ajaxRequest(request, function (response) {
            if (response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('comment')) {
                var comment = response.data[0].element.comment;
                var t = `<div class="alert m-alert m-alert--default " role="alert">
                        <h6><i class="fa fa-user"></i> &nbsp; `+comment.name+`</h6>
                        <div style="background-color: #fff; padding: 5px 15px;   margin-top: 15px;" id="commentSection_`+comment.id+`">
                            <p class="commentSection">`+comment.comment+`</p>
                        </div>
                        <form class="m-form m-form--fit" id="commentEditBox_`+comment.id+`"
                              style="display: none;">
                            <textarea name="comment"
                                      class="form-control m-input commentEdit">`+comment.comment+`</textarea>
                            <br>
                            <button type="submit" class="btn btn-sm m-btn--pill btn-success updateComment"
                                    data-target="commentEditBox_`+comment.id+`" data-id="`+comment.id+`"
                                    data-parent-id="{{$support->id}}" id="update_`+comment.id+`">Update
                            </button>
                            <button type="submit" class="btn btn-sm m-btn--pill btn-info closeFormReplay"
                                    data-form-id="commentEditBox_`+comment.id+`"
                                    data-update-id="update_`+comment.id+`"
                                    data-edit-id="commentSection_`+comment.id+`">Close
                            </button>
                        </form>
                        <br>
                        {{-- <a href="#" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only btn-custom-size"
                            data-id="`+comment.id+`" data-parent-id="{{$support->id}}" id="commentReplay">
                             <i class="la la-mail-reply"></i>
                         </a>--}}
                        <a href="#"
                           class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only btn-custom-size editComment"
                           data-form-id="commentEditBox_`+comment.id+`"
                           data-edit-id="commentSection_`+comment.id+`">
                            <i class="la la-edit"></i>
                        </a>
                        <a href="#"
                           class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only btn-custom-size"
                           data-modal-route="comment/deleteComment/{{$support->id}}/`+comment.id+`">
                            <i class="la la-trash"></i>
                        </a>
                        <a href="#"
                           class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only btn-custom-size"
                           data-modal-route="comment/bestanswer/{{$support->id}}/`+comment.id+`" title="This Solves my problem">
                            <i class="la la-check"></i>
                        </a>
                        <form class="m-form m-form--fit" style="display: none;" id="commentReplayBox">
                            <br>
                            <textarea name="comment" class="form-control m-input" id="comment1"></textarea>
                            <br>
                            <button type="submit" class="btn btn-sm m-btn--pill btn-success"
                                    id="submitCommentReplay"
                                    style="display: none;" data-target="commentReplayBox" data-id="`+comment.id+`"
                                    data-parent-id="{{$support->id}}">Comment
                            </button>
                            <button type="submit" class="btn btn-sm m-btn--pill btn-info" id="closeFormReplay"
                                    style="display: none;">Close
                            </button>
                        </form>
                    </div>`;
                $('#appendComment').prepend(t);
                $('#closeForm').trigger('click');
            }
            $('#'+target+' textarea').val('');
        });
    });
    $(document).off('click', '#commentReplay').on('click', '#commentReplay', function (e) {
        e.preventDefault();
        $('#commentReplayBox').show();
        $('#submitCommentReplay').show();
        $('#closeFormReplay').show();
    });
    $(document).off('click', '.closeFormReplay').on('click', '.closeFormReplay', function (e) {
        e.preventDefault();
        var form = $(this).attr('data-form-id');
        var updateBtn = $(this).attr('data-update-id');
        var section = $(this).attr('data-edit-id');
        $('#' + form).hide();
        $('#' + updateBtn).hide();
        $(this).hide();
        $('#' + section).show();
    });
    $(document).off('click', '#submitCommentReplay').on('click', '#submitCommentReplay', function (e) {
        e.preventDefault();
        var target = $(this).attr('data-target');
        var commentID = $(this).attr('data-id');
        var supportID = $(this).attr('data-parent-id');
        var request = {
            url: 'support/commentReplay/' + supportID + '/' + commentID,
            method: 'post',
            form: target
        }
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function (response) {
                removeFormLoader();
                // console.log(response);
            });
        });
    });

    $(document).off('click', '.editComment').on('click', '.editComment', function (e) {
        e.preventDefault();
        var formID = $(this).attr('data-form-id');
        var sectionID = $(this).attr('data-edit-id');
        $('#' + formID).show();
        $('#' + sectionID).hide();
    });
    $(document).off('click', '.updateComment').on('click', '.updateComment', function(e){
        e.preventDefault();
        var target = $(this).attr('data-target');
        var id = $(this).attr('data-id');
        var parent_id = $(this).attr('data-parent-id');
        var id = $(this).attr('data-id');
        var comment_section = $(this).attr('data-comment-section');
        var request = {
            url: 'support/commentUpdate/'+id,
            method: 'post',
            form: target
        }
        ajaxRequest(request, function(response){
            var comment = response.data[0].element.comment.comment;
            $('#'+comment_section).show();
            $('#'+target).hide();
            $('#'+comment_section).innerHtml(comment);
        });
    });

    $(document).off('click', '*[data-file-url]').on('click', '*[data-file-url]', function (e) {
        e.preventDefault();
        var self = $(this);
        if (self.attr("data-file-url") && self.attr("data-file-extension")) {
            switch (self.attr("data-file-extension")) {
                case "jpg":
                case "jpeg":
                case "png":
                    ajaxRequest({
                        url: self.attr("data-file-url")
                    });
                    window.open(self.attr("data-file-url"));
                    break;
                default:
                    window.open(self.attr("data-file-url"));
                    break;
            }

        }
    });

    $(document).off('click', '*[data-app]').on('click', '*[data-app]', function (e) {
        e.preventDefault();
        var self = $(this);
        ajaxRequest({
            url: self.attr('data-app')
        });
        window.open(self.attr('data-app'));
    });
</script>
@endif