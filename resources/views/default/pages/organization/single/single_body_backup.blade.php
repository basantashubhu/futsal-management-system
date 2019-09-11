<div class="m-content">
    <div class="row">
        <div class="col-sm-8">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Basic Portlet
                                <small>
                                    portlet sub title
                                </small>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <div class="row m-row--col-separator-xl">
                        <div class="col">
                            <span class="custom-header std-header">Detail</span>
                            <span class="d-b">Name: <strong>{{$organization->cname}}</strong></span>
                            <span class="d-b">Phone: <strong>{{$organization->contact->phone}}</strong></span>
                            <span class="d-b">Address: <strong>{{$organization->address->add1}}</strong></span>
                            <span class="d-b">Zip Code: <strong>{{$organization->address->zip->zip_code}}</strong></span>
                            <span class="d-b">State: <strong>{{$organization->address->zip->state}}</strong></span>
                            <span class="d-b">County: <strong>{{$organization->address->zip->county}}</strong></span>
                        </div>
                        <div class="col">
                            <span class="custom-header std-header">Eligibility</span>
                            <ul class="no-list-style">
                                <li>
                                    <label class="m-checkbox m-checkbox--solid">
                                        <input type="checkbox" checked="checked">
                                        Temporary Assistance to Neddy Familes
                                        <span></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="m-checkbox m-checkbox--solid">
                                        <input type="checkbox">
                                        General Assistance
                                        <span></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="m-checkbox m-checkbox--solid">
                                        <input type="checkbox" checked="checked">
                                        Medical Aid
                                        <span></span>
                                    </label>
                                </li>

                                <li>
                                    <label class="m-checkbox m-checkbox--solid">
                                        <input type="checkbox" checked="checked">
                                        Tanf
                                        <span></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="col">
                            <span class="custom-header std-header">Complecation</span>
                            <span class="d-b">Rabin Bhandari</span>
                            <span class="d-b">9845645241</span>
                            <span class="d-b">01145-854-545</span>
                            <span class="d-b">776 Farmington </span>
                            <span class="d-b">Suit 2 </span>
                            <span class="d-b">West Hastford, CT-06199</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="top-border-seperetor">
                                <div class="m-t-20">
                                    <span class="custom-header std-header">Pets</span>
                                    <div class="m-accordion__item-content pet bg-form-box row no-m pd-t-10">
                                            <div class="col-sm-3">
                                                <label for="pet_name" class="f-w-500">
                                                    Pet Name
                                                </label>
                                                <p> Pet Name</p>
                                            </div>

                                            <div class="col-lg-1">
                                                <label class="f-w-500">
                                                    Type
                                                </label>
                                                <p class="m-input-icon">
                                                    Dog
                                                </p>
                                            </div>

                                            <div class="col-lg-1">
                                                <label for="age_type" class="f-w-500">
                                                    Sex
                                                </label>
                                                <div class="m-input-icon">
                                                    Female
                                                </div>
                                            </div>

                                            <div class="col-lg-1">
                                                <label for="age_type" class="f-w-500">
                                                    Age Type
                                                </label>
                                                <p class="m-input-icon">
                                                    Yearly
                                                </p>
                                            </div>

                                            <div class="col-lg-1">
                                                <label for="age_of_pet" class="f-w-500">
                                                    Age
                                                </label>
                                                <p>Age</p>
                                            </div>

                                            <div class="col-lg-1">
                                                <label for="weight" class="f-w-500">
                                                    Weight <!-- <sub>(kg)</sub> -->
                                                </label>
                                                <p>Weight</p>
                                            </div>

                                            <div class="col">
                                                <label for="species" class="f-w-500">
                                                    Species
                                                </label>
                                                <p>Species</p>
                                            </div>

                                            <div class="col-sm-2">
                                                <label for="color" class="f-w-500">
                                                    Color
                                                </label>
                                                <p>Color</p>
                                            </div>

                                            <div class="col-lg-3">
                                                <label for="breed" class="f-w-500">
                                                    Breed
                                                </label>
                                                <p>Breed</p>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="unqiue_traits" class="f-w-500">
                                                    Unique Traits
                                                </label>
                                                <p>Unique Traits</p>
                                            </div>


                                            <div class="col-lg-4">
                                                <label for="where_obtained" class="f-w-500">
                                                    Pet Origin
                                                </label>
                                                <p>Pet Origin</p>
                                            </div>
                                    </div>
                                </div>

                                <div class="m-t-20">
                                    <div class="m-accordion__item-content pet bg-form-box row no-m pd-t-10">
                                            <div class="col-sm-3">
                                                <label for="pet_name" class="f-w-500">
                                                    Pet Name
                                                </label>
                                                <p> Pet Name</p>
                                            </div>

                                            <div class="col-lg-1">
                                                <label class="f-w-500">
                                                    Type
                                                </label>
                                                <p class="m-input-icon">
                                                    Dog
                                                </p>
                                            </div>

                                            <div class="col-lg-1">
                                                <label for="age_type" class="f-w-500">
                                                    Sex
                                                </label>
                                                <div class="m-input-icon">
                                                    Female
                                                </div>
                                            </div>

                                            <div class="col-lg-1">
                                                <label for="age_type" class="f-w-500">
                                                    Age Type
                                                </label>
                                                <p class="m-input-icon">
                                                    Yearly
                                                </p>
                                            </div>

                                            <div class="col-lg-1">
                                                <label for="age_of_pet" class="f-w-500">
                                                    Age
                                                </label>
                                                <p>Age</p>
                                            </div>

                                            <div class="col-lg-1">
                                                <label for="weight" class="f-w-500">
                                                    Weight <!-- <sub>(kg)</sub> -->
                                                </label>
                                                <p>Weight</p>
                                            </div>

                                            <div class="col">
                                                <label for="species" class="f-w-500">
                                                    Species
                                                </label>
                                                <p>Species</p>
                                            </div>

                                            <div class="col-sm-2">
                                                <label for="color" class="f-w-500">
                                                    Color
                                                </label>
                                                <p>Color</p>
                                            </div>

                                            <div class="col-lg-3">
                                                <label for="breed" class="f-w-500">
                                                    Breed
                                                </label>
                                                <p>Breed</p>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="unqiue_traits" class="f-w-500">
                                                    Unique Traits
                                                </label>
                                                <p>Unique Traits</p>
                                            </div>


                                            <div class="col-lg-4">
                                                <label for="where_obtained" class="f-w-500">
                                                    Pet Origin
                                                </label>
                                                <p>Pet Origin</p>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="col-sm-4">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Basic Portlet
                                <small>
                                    portlet sub title
                                </small>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.
                </div>
            </div>
        </div>
    </div>
</div>