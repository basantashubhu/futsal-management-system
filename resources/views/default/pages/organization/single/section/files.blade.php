<div class="row">
    <div class="col">
        <div class="app-col-seperator  m-b-30">
            <div class="app-col-header">
                <div class="app-header std-header custom-header">Files</div>
                <div class="tools">
                    <button class="btn btn-sm btn-success m-btn m-btn--icon m-btn--pill"
                            data-modal-route="organization/upload/file/{{$organization->id}}">
                        <span>
                            <i class="fa fa-plus"></i>
                            <span>
                                Upload File
                            </span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-col-body">
                <div class="row">
                    <!-- Uploaded Files -->
                    <div class="col-sm-12 col-md-6 col-lg-6 border-right">
                        <label class="application-sub-header">Uploaded</label>
                        <div class="m-widget4">
                            @php $files=$organization->files() @endphp
                            @foreach($files as $file)
                                @if($file->document_segment=='uploaded' || $file->document_segment=='upload')
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
                                                        data-file-url="application/{{$organization->id}}/file/{{$file->id}}"
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
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!-- UPloaded Files : END -->

                    <!-- Genreated File -->
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="application-sub-header">Generated</label>
                        <div class="m-widget4">
                            @php $files=$organization->files() @endphp
                            @foreach($files as $file)
                                @if($file->document_segment!=='uploaded' && $file->document_segment!=='upload')
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
                                                        data-file-extension='{{ $file->fileInfo("extension") }}'
                                                        data-file-url="file/response/{{$file->id}}"
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
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!-- Generated Files: END -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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

</script>