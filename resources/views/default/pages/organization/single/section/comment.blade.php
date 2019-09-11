<div class="tab-pane" id="organizationComment" role="tabpanel" style="max-height: 570px; overflow: auto">

    @if($organization && $organization!=null)
        <div class="m-portlet">
            <form id="commentForm">
                <div class="form-group m-form__group">
                    <label for="exampleSelect1">
                        To :
                    </label>
                    <select class="form-control m-input m-input--square" name="comment_to">
                        @if(isset($organization->contactPerson->fname))
                            <option value="{{$organization->contactPerson->id}}">
                                {{$organization->contactPerson->fname}} {{$organization->contactPerson->mname}} {{$organization->contactPerson->lname}}
                                (service Provider)
                            </option>
                        @endif
                    </select>
                </div>
                <textarea name="comment" id="commentArea" class="form-control m-input"></textarea>
            </form>

            <div class="m-portlet__foot">
                <div class="row align-items-center">
                    <div class="col-lg-6 ">
                        <button type="submit" class="btn btn-success m-btn--pill" id="addComment" data-id="{{$organization->id}}" data-target="commentForm">
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div id="commentListHolder">
        @include('default.pages.organization.single.section.commentList')
    </div>
</div>
<script>
    // $('#commentArea').summernote();
    $('#addComment').on('click',function (e) {
        e.preventDefault();

        var id=$(this).attr('data-id');
        var request = {
            url: 'organization/addComment/'+id,
            method: 'post',
            form: $(this).attr('data-target')
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            // $('#commentArea').summernote('reset');
            $('#commentArea').val('');
            processForm(response,loadComment);
        });
    });

    function loadComment() {
        var id=$('#addComment').attr('data-id');
        var request = {
            url: 'organization/getComment/'+id,
            method: 'get',
        };
        ajaxRequest(request, function (response) {
            $('#commentListHolder').empty().html(response.data)
        });
    }

</script>