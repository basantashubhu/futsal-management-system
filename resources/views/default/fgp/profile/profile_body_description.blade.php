<div class="col-xl-9 col-lg-8">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#user_sites"
                           role="tab">
                            <i class="flaticon-share m--hide"></i>
                            Sites
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#Volunteers"
                           role="tab">
                            <i class="flaticon-share m--hide"></i>
                            Volunteers
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#update_profile"
                           role="tab">
                            <i class="flaticon-share m--hide"></i>
                            Update Profile
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#change_password" role="tab">
                            Change Password
                        </a>
                    </li>
                    <!-- <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#signature_section" role="tab">
                            Signature
                        </a>
                    </li> -->
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#user_activity" role="tab">
                            Activity
                        </a>
                    </li>
                    @if(auth()->user()->role_id==1)
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#user_messages" role="tab">
                                Messages
                            </a>
                        </li>
                    @endif
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#user_settings" role="tab">
                            Settings
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#emailSettings" role="tab">
                            Email Settings
                        </a>
                    </li>
                    <!-- <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-route="layout_builder">
                            Layout Builder
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div id="user_sites" class="tab-pane active">
                @include('default.fgp.profile.user_sites')
            </div>
            @include('default.fgp.profile.volunteers')
            @include('default.fgp.profile.update_profile')
            @include('default.fgp.profile.change_password')
            @include('default.fgp.profile.signature')
            @include('default.fgp.profile.activity')
            @include('default.fgp.profile.message')
            @include('default.fgp.profile.settings')
            @include('default.fgp.profile.emailSettings')
            @include('default.fgp.profile.layout_builder')
        </div>
    </div>
</div>
<script>
    BootstrapDatepicker.init();
    BootstrapSelect.init();

    $(document).off('click', '#submitPass').on('click', '#submitPass', function (e) {
        var old_password = $('#old_password').val();
        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();

        if (old_password) {
            $('#old_password').css('border', '');
            $('#wrong1').css('display', 'none');
            if (new_password == confirm_password) {
                $('#confirmation').css('display', 'none');
                var request = {
                    url: '/changePass/{{$client->user_id}}',
                    method: 'post',
                    form: $(this).attr('data-target')
                };

                addFormLoader();
                ajaxRequest(request, function (response) {
                    processForm(response,function (response) {
                        removeFormLoader();
                    })

                });
            }
            else {
                $('#confirmation').css('display', 'block');
            }
        }
        else {
            $('#old_password').css('border', '1px solid red');
            $('#wrong1').css('display', 'block');
        }
    });

    function checkPassword(event) {
        var old = $(event).val();
        var request = {
            url: 'userCheckPass/{{$client->user_id}}?pass=' + old,
            method: 'get'
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            // console.log(response.data.pass);
            removeFormLoader();
            if (response.data.pass == 'true') {
                $('#old_password').css('border', '');
                $('#submitPass').removeAttr('disabled');
                $('#wrong').css('display', 'none');
            }
            else {
                $('#old_password').css('border', '1px solid red');
                $('#submitPass').attr('disabled', 'disabled');
                $('#wrong').css('display', 'block');
            }
            // processForm(response, function () {
            //     reloadDatatable('.m_datatable');
            // });
        });
    }

    $(document).off('click', '#editSig').on('click', '#editSig', function(e){
        e.preventDefault();
        var show = $(this).data('show');
        var hide = $(this).data('hide');
        $('#'+show).show();
        $('#'+show).removeClass('hidden');
        $('#'+hide).hide();
        initSignature1();
    });

    function initSignature1(){

        var canvas1 = $("#signpad_canvas_sig")[0],
            signaturePad1;

        // Adjust canvas coordinate space taking into account pixel ratio,
        // to make it look crisp on mobile devices.
        // This also causes canvas to be cleared.
        function resizeCanvas1() {
            // When zoomed out to less than 100%, for some very strange reason,
            // some browsers report devicePixelRatio as less than 1
            // and only part of the canvas is cleared then.
            var ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas1.width = canvas1.offsetWidth * ratio;
            canvas1.height = canvas1.offsetHeight * ratio;
            canvas1.getContext("2d");
        }

        window.onresize = resizeCanvas1;
        resizeCanvas1();

        signaturePad1 = new SignaturePad(canvas1);


        $(document).off('click', "*[data-action=clear1]").on('click', "*[data-action=clear1]", function (e) {
            e.preventDefault();
            signaturePad1.clear();
        });

        $(document).off('click', '#saveSignature').on('click', '#saveSignature', function () {

            if (signaturePad1.isEmpty()) {
                toastr.error("Please provide signature first.");
            } else {
                $("#signatureImage").attr('src', signaturePad1.toDataURL());
                var data = {'signature': signaturePad1.toDataURL()};
                var request = {
                    url: 'insertSignature',
                    method: 'post',
                    data: data
                }

                ajaxRequest(request, function(response){
                    if(response.status == 200){
                        $("#showSignature").removeClass('hidden');
                        $("#showSignature").show();
                        $("#signatureImage").attr('src', signaturePad1.toDataURL());
                        $("#signatureImage").attr('alt', $("input[name=initial_signature_name]").val());
                        $('#hideSignature').addClass('hidden');
                        return toastr.success("Signature uploaded Succesfully.");
                    }else{
                        return toastr.error("Could not upload");
                    }
                });
            }
        });
    }
    initSignature1();
</script>