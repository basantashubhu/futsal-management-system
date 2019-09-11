@if($organization->agreement)
    <div class="row">
        <div class="col">
            <div class="app-col-seperator m-b-30">
                <div class="app-col-header">
                    <div class="app-col-header-caption">
                        <span class="custom-header std-header">Agreement</span>
                    </div>
                    <div class="app-col-header-tool">
                        <!-- <button href="#" class="btn btn-outline-accent m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"><i class="la la-edit"></i></button> -->
                    </div>
                </div>
                <div class="app-col-body">
                    <form class="m-form">
                        <div class="row">
                            <div class="col-lg-12 terms-data">
                                <div class="m-portlet">
                                    <div class="m-portlet__body">
                                        <h5 class="text-center">{{$organization->agreement->terms_title}}</h5>
                                        <div class="terms-detail align-justify">
                                            {!! $organization->agreement->description !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet">
                                    <div class="m-portlet__body">
                                        <ul class="no-list-style no-m">
                                            @foreach($terms as $term)
                                                <li>
                                                    <label class="m-checkbox m-checkbox--solid">
                                                        <input type="checkbox"
                                                               @foreach($options as $option) @if($option->field_name == $term->value) checked="checked" @endif @endforeach>
                                                        {{$term->description}}
                                                        <span></span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="m-portlet">
                                    <div class="m-portlet__body">
                                        <ul class="no-list-style no-m">
                                            <li>
                                                Name: <strong>{{$organization->agreement->client_signed_by}}</strong>
                                            </li>
                                            <li>
                                                Signature:
                                                <strong>{{$organization->agreement->client_signature}}</strong>
                                            </li>
                                            <li>
                                                Signature Date:
                                                <strong>{{$organization->agreement->client_signature_date}}</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif