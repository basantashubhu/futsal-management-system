<div class="tab-pane" id="signature_section">
    <div class="m-portlet__body">
        <div class="row @if(!isset($sig->file_name)) hidden @endif" id="showSignature">
            <div class="col-12">
                <div class="app-col-seperator m-b-30">
                    <div class="app-col-header">
                        <div class="app-header std-header custom-header">Signature</div>
                        <div class="tools">
                            <!--begin: Selected Rows Group Action Form -->
                            <button class="btn btn-sm btn-success m-btn m-btn--icon m-btn--pill" data-show="hideSignature" data-hide="showSignature" id="editSig">
                                <span>
                                    <i class="fa fa-edit"></i>
                                    <span>
                                        Edit
                                    </span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-col-body m-signature-pad--body">
                        @if(isset($sig->file_name))
                        <img src="{{$sig->file_name}}" alt="" id="signatureImage">
                        @else
                        <img src="" alt="" id="signatureImage">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="m-form m-form--fit m-form--label-align-right @if(isset($sig->file_name)) hidden @endif" id="hideSignature">
        <div class="m-portlet__body">
            <div class="app-col-seperator" id="signature-pad">
                <div class="app-col-body m-signature-pad--body">
                    <canvas id="signpad_canvas_sig" style="width: 500px !important; height: 300px !important;"></canvas>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-12">
                        <button type="reset" class="btn btn-accent m-btn m-btn--pill m-btn--custom" id="saveSignature" >
                            Save
                        </button>
                        &nbsp;&nbsp;
                        <button class="btn btn-secondary m-btn--pill m-btn--custom" data-action="clear1">Clear</button>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
