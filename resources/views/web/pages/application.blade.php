<style>
    .haserror {
        border: 1px solid red !important;
    }
</style>
<main role="main" class="main" id="ApplicationHolder">
    <!-- section -->
    @if($message = session()->get('ApplicationSent'))
        <div class="alert alert-success" role="alert" style="
    margin: 15px;
    padding: 15px;
    color: #f6fcfb;
    background-color: #45ccb1;
    border-color: #39c9ac;
">
            <strong>Congratulations !</strong> {{$message}}
        </div>
    @endif
    @if($message = session()->get('ApplicationFailed'))
        <div class="alert alert-danger" role="alert" style="
    margin: 15px;
    padding: 15px;
    color: #f6fcfb;
    background-color: #e74c3c;
    border-color: #c0392b;
">
            <strong>Sorry !</strong> {{$message}}
        </div>
    @endif
    <section>


        <div class="hero">
            <img src="../wp-content/uploads/2015/05/application.jpg"
                 class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                 alt=""
                 srcset="https://fixedandfab.com/wp-content/uploads/2015/05/application.jpg 1000w, https://fixedandfab.com/wp-content/uploads/2015/05/application-250x62.jpg 250w, https://fixedandfab.com/wp-content/uploads/2015/05/application-700x174.jpg 700w, https://fixedandfab.com/wp-content/uploads/2015/05/application-120x30.jpg 120w"
                 sizes="(max-width: 1000px) 100vw, 1000px"/>
        </div>

        <!-- article -->
        <article id="post-9" class="post-9 page type-page status-publish has-post-thumbnail hentry">

            <p>Thank you for your interest in the Delaware $20 Spay &#038; Neuter Program, from the Delaware Division
                of Public Health’s Office of Animal Welfare and its partners. Complete all lines of the application.
                Applications are processed on a first-come, first-served basis, as funding allows. Funding is limited
                and is generated through a $3 surcharge on all rabies vaccinations given to cats and dogs in Delaware.
                Applicants may expect to receive a response via mail within 30 days. If your pet needs immediate
                medical attention, call your veterinarian, or take them to the nearest veterinary emergency care
                facility.</p>
            <p>
                <b>TO COMPLETE APPLICATION:</b>
                <br/> 1. Read Disclaimer, Accept Terms of Eligibility Agreement and click “Agree”.
                <br/> 2. Fill out the
                <em>Spay &amp; Neuter Income Eligibility Application</em> below. Be sure to fill all form fields.
                <br
                /> 3. Upload a copy or photo of a valid
                <b>Delaware State Photo I.D.</b> as proof of identity.
                <br/> Those on Federal assistance must upload a copy of their
                <b>latest Annual Proof of Benefits Letter</b>.
                <br/> 4. Type your full name in the box below to act as your Electronic Signature. Once completed click
                “Submit”.</p>
            <p>A box will appear giving you confirmation of a successful submission. You can then leave this page</p>
            <div class="section" style="max-height: none;">
                <h3>INCOME ELIGIBLE APPLICATION DISCLAIMER (YOU MUST CLICK AGREE TO CONTINUE)</h3>
                <p>I hereby consent to the surgical spaying or neutering of my cat(s) and/or dog(s) by a Delaware
                    licensed
                    veterinarian. If my animal is not currently immunized against rabies, I hereby consent to the
                    administration of a rabies immunization to my animal at the time of the surgical procedure.</p>
                <p>I understand that some veterinary practices may require additional care, tests, or vaccines, and
                    I am responsible to pay for these extra services. I understand it is my responsibility to ask
                    whether the veterinarian requires other care, tests, or vaccines when I call to schedule the
                    spay or neuter surgery. I understand that if I reject these tests, the veterinarian may elect
                    not to perform the spay or neuter procedure. I understand I need to follow pre-surgical and
                    post-surgical
                    care instructions given to me by the surgery provider. I understand there are inherent risks
                    involved in medical procedures and surgery.</p>
                <p>I agree to update the Spay &amp; Neuter Program coordinator if my contact information changes.</p>
                <p>I agree to notify the Spay &amp; Neuter Program coordinator if I decide not to follow through with
                    the spay/neuter surgery.</p>
                <p>I authorize release of the information above for the purpose of determining my eligibility for the
                    Spay &amp; Neuter Program.</p>
                <p>I understand submitting an incomplete application may delay the processing of that application.</p>
                <p>I affirm that I am the owner/keeper of the animal(s) listed on this application.</p>
                <p>I understand that under Delaware code, Title 16, Chapter 30F, Subchapter II: Any person who knowingly
                    falsifies proof of eligibility for, or participation in, any program established under this chapter,
                    or who knowingly furnishes any licensed veterinarian with inaccurate information concerning
                    ownership
                    of a pet submitted for sterilization, or who falsifies an animal sterilization certificate shall
                    be guilty of an unclassified misdemeanor and shall be subject to a minimum mandatory fine, which
                    shall not be subject to suspension, of $250.</p>
                <p>
                    <a class="button agree" href="#">Agree</a>
                </p>
            </div>
            <div class="frm_forms  with_frm_style frm_style_formidable-style" id="frm_form_2_container">
                <form enctype="multipart/form-data" method="post" class="frm-show-form  frm_pro_form  frm_ajax_submit"
                      id="form_app">
                    <div class="frm_form_fields ">
                        <fieldset>


                            <div id="frm_field_129_container" class="frm_form_field frm_section_heading form-field ">
                                <h3 class="frm_pos_top">DELAWARE SPAY &amp; NEUTER PROGRAM INCOME ELIGIBLE
                                    APPLICATION</h3>
                                <div class="frm_description frm_section_spacing">A new application is required each
                                    fiscal year and/or for additional animals not
                                    listed below. Authorized under TITLE 16, CHAPTER 30F, SUBCHAPTER II: Any
                                    falsification
                                    of information is subject to an administrative fine of up to $250.
                                </div>

                                <div id="frm_field_8_container"
                                     class="frm_form_field form-field  frm_required_field frm_none_container">
                                    <label for="field_6pho6s" class="frm_primary_label">Legal Applicant Name
                                        <span class="frm_required">*</span>
                                    </label>
                                    <input type="text" id="field_6pho6s" name="legalName" value="" data-sectionid="129"
                                           placeholder="Legal Applicant Name"
                                           data-reqmsg="This field cannot be blank."/>


                                </div>
                                <div id="frm_field_9_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_3b799f" class="frm_primary_label">D.O.B.
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_3b799f" name="dob" value="" data-sectionid="129"
                                           placeholder="D.O.B."/>


                                </div>
                                <div id="frm_field_10_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_juerar" class="frm_primary_label">Social Security Number (Last 4
                                        Digits)
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_juerar" name="ssn" value="" data-sectionid="129"
                                           maxlength="4" placeholder="Social Security Number (Last 4 Digits)"
                                    />


                                </div>
                                <div id="frm_field_11_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_2ywsu1" class="frm_primary_label">Mailing Address
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_2ywsu1" name="add1" value="" data-sectionid="129"
                                           placeholder="Mailing Address"/>


                                </div>
                                <div id="frm_field_12_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_ed4rqz" class="frm_primary_label">City
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_ed4rqz" name="city" value="" data-sectionid="129"
                                           placeholder="City"/>


                                </div>
                                <div id="frm_field_13_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_fmg9md" class="frm_primary_label">Zip Code
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_fmg9md" name="zip" data-sectionid="129"
                                           placeholder="Zip Code"/>


                                </div>

                                <div id="frm_field_16_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_5zj7xx" class="frm_primary_label">Primary Email
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="email" id="field_5zj7xx" name="personal_email" value=""
                                           data-sectionid="129" placeholder="Primary Email"/>


                                </div>
                                <div id="frm_field_18_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_egiyr" class="frm_primary_label">How did you hear about the Spay
                                        &amp; Neuter Program
                                        <span class="frm_required"></span>
                                    </label>
                                    <textarea name="item_meta[18]" id="field_egiyr" rows="12" data-sectionid="129"
                                              placeholder="How did you hear about the Spay &amp; Neuter Program?"></textarea>


                                </div>
                                <div id="frm_field_15_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_ewn65x" class="frm_primary_label">Primary Phone
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_ewn65asx" name="cell_phone" value=""
                                           data-sectionid="129" placeholder="Alternative Phone"/>


                                </div>
                                <div id="frm_field_15_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_ewn65x" class="frm_primary_label">Alternative Phone
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_ewn65x" name="alt_phone" value="" data-sectionid="129"
                                           placeholder="Alternative Phone"/>


                                </div>
                                <div id="frm_field_17_container" class="frm_form_field form-field  frm_top_container">
                                    <label class="frm_primary_label">Have you previously applied to the Spay &amp;
                                        Neuter Program?
                                        <span class="frm_required"></span>
                                    </label>
                                    <div class="frm_opt_container">
                                        <div class="frm_radio">
                                            <label for="field_lh89th-0">
                                                <input type="radio" name="item_meta[17]" id="field_lh89th-0" value="Yes"
                                                       data-sectionid="129"/> Yes</label>
                                        </div>
                                        <div class="frm_radio">
                                            <label for="field_lh89th-1">
                                                <input type="radio" name="item_meta[17]" id="field_lh89th-1" value="No"
                                                       data-sectionid="129"/> No</label>
                                        </div>
                                    </div>


                                </div>
                                <div id="frm_field_134_container"
                                     class="frm_form_field  frm_top_container frm_html_container form-field">
                                    <h3>ANIMAL OWNER ELIGIBILITY</h3>
                                    <p>You must receive benefits from at least one of the following programs to qualify
                                        for the Spay & Neuter Program. </p>
                                    <p>Please check which type of assistance you receive.</p>
                                </div>
                                <div id="frm_field_20_container" class="frm_form_field form-field  frm_top_container">
                                    <label class="frm_primary_label">State Assistance
                                        <span class="frm_required"></span>
                                    </label>
                                    <div class="frm_opt_container">
                                        <div class="frm_checkbox" id="frm_checkbox_20-129-0">
                                            <label for="field_9kn8ln-0">
                                                <input type="checkbox" name="is_tanf" id="field_9kn8ln-0" value="1"
                                                       data-sectionid="129"/> Temporary Assistance to Needy Families, DE
                                                Medical Assistance (Medicaid,
                                                DPAP, QMB, etc.), General Assistance or Food Stamps</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_20-129-1">
                                            <label for="field_9kn8ln-1">
                                                <input type="checkbox" name="is_wic" id="field_9kn8ln-1" value="1"
                                                       data-sectionid="129"/> Women, Infants and Children (WIC)</label>
                                        </div>
                                    </div>


                                </div>
                                <div id="frm_field_21_container" class="frm_form_field form-field  frm_top_container">
                                    <label class="frm_primary_label">Federal Assistance*
                                        <span class="frm_required"></span>
                                    </label>
                                    <div class="frm_opt_container">
                                        <div class="frm_checkbox" id="frm_checkbox_21-129-0">
                                            <label for="field_si4vq8-0">
                                                <input type="checkbox" name="is_ssi" id="field_si4vq8-0" value="1"
                                                       data-sectionid="129"/> Supplemental Security Income (SSI)</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_21-129-1">
                                            <label for="field_si4vq8-1">
                                                <input type="checkbox" name="is_ssd" id="field_si4vq8-1" value="1"
                                                       data-sectionid="129"/> Social Security Disability</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_21-129-2">
                                            <label for="field_si4vq8-2">
                                                <input type="checkbox" name="is_vad" id="field_si4vq8-2" value="1"
                                                       data-sectionid="129"/> Veterans Administration Disability
                                                Compensation with disability
                                                rating of 50% or higher</label>
                                        </div>
                                    </div>
                                    <div class="frm_description">*Applicants who receive Federal assistance must attach
                                        a scan or photo of your
                                        annual Proof of Benefits letter. If you do not have a copy of your Proof
                                        of Benefits letter, you may request one through the Social Security
                                        Administration
                                        or Veterans Administration. Standard retirement or widow benefits do not
                                        qualify.
                                    </div>

                                </div>
                                <div id="frm_field_133_container"
                                     class="frm_form_field  frm_top_container frm_html_container form-field">
                                    <h3>ANIMAL INFORMATION</h3>
                                    <p>You may apply to have up to three animals (cats or dogs) spayed or neutered per
                                        State fiscal year (July 1 – June 30).</p>
                                </div>
                                <div id="frm_field_136_container"
                                     class="frm_form_field  frm_top_container frm_html_container form-field">
                                    <b>Animal 1</b>
                                </div>
                                <div id="frm_field_24_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_o3bsg9" class="frm_primary_label">Name
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_o3bsg9" name="pet_name1" value="" data-sectionid="129"
                                           placeholder="Name"/>


                                </div>
                                <div id="frm_field_25_container"
                                     class="frm_form_field form-field  frm_required_field frm_none_container">
                                    <label class="frm_primary_label">Sex
                                        <span class="frm_required">*</span>
                                    </label>
                                    <div class="frm_opt_container">
                                        <div class="frm_radio">
                                            <label for="field_hfa110-0">
                                                <input type="radio" name="sex1" id="field_hfa110-0" value="Male"
                                                       data-sectionid="129" data-reqmsg="This field cannot be blank."/>
                                                Male</label>
                                        </div>
                                        <div class="frm_radio">
                                            <label for="field_hfa110-1">
                                                <input type="radio" name="sex1" id="field_hfa110-1" value="Female"
                                                       data-sectionid="129" data-reqmsg="This field cannot be blank."/>
                                                Female</label>
                                        </div>
                                    </div>


                                </div>
                                <div id="frm_field_26_container"
                                     class="frm_form_field form-field  frm_required_field frm_none_container">
                                    <label class="frm_primary_label">Type
                                        <span class="frm_required">*</span>
                                    </label>
                                    <div class="frm_opt_container">
                                        <div class="frm_radio">
                                            <label for="field_bhstlz-0">
                                                <input type="radio" name="species1" id="field_bhstlz-0" value="cat"
                                                       data-sectionid="129" data-reqmsg="This field cannot be blank."/>
                                                Cat</label>
                                        </div>
                                        <div class="frm_radio">
                                            <label for="field_bhstlz-1">
                                                <input type="radio" name="species1" id="field_bhstlz-1" value="dog"
                                                       data-sectionid="129" data-reqmsg="This field cannot be blank."/>
                                                Dog</label>
                                        </div>
                                    </div>


                                </div>
                                <input type="hidden" id="field_rlgiar" name="age_type1" value="Yearly"
                                       data-sectionid="129" placeholder="Age"/>
                                <div id="frm_field_27_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_rlgiar" class="frm_primary_label">Age
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_rlgiar" name="age_of_pet1" value=""
                                           data-sectionid="129" placeholder="Age"/>


                                </div>
                                <div id="frm_field_28_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_y88fjc" class="frm_primary_label">Breed
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_y88fjc" name="breed1" value="" data-sectionid="129"
                                           placeholder="Breed"/>


                                </div>
                                <div id="frm_field_29_container" class="frm_form_field form-field  frm_top_container">
                                    <label class="frm_primary_label">Where did you obtain the animal listed above?
                                        <span class="frm_required"></span>
                                    </label>
                                    <div class="frm_opt_container">
                                        <div class="frm_checkbox" id="frm_checkbox_29-129-0">
                                            <label for="field_cocozx-0">
                                                <input type="radio" name="where_obtained1" id="field_cocozx-0"
                                                       value="Friend/Family"
                                                       data-sectionid="129"/> Friend/Family</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_29-129-1">
                                            <label for="field_cocozx-1">
                                                <input type="radio" name="where_obtained1" id="field_cocozx-1"
                                                       value="Pet Store / Breeder"
                                                       data-sectionid="129"/> Pet Store / Breeder</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_29-129-2">
                                            <label for="field_cocozx-2">
                                                <input type="radio" name="where_obtained1" id="field_cocozx-2"
                                                       value="Shelter / Rescue"
                                                       data-sectionid="129"/> Shelter / Rescue</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_29-129-3">
                                            <label for="field_cocozx-3">
                                                <input type="radio" name="where_obtained1" id="field_cocozx-3"
                                                       value="Stray"
                                                       data-sectionid="129"/> Stray</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_29-129-4">
                                            <label for="field_cocozx-4">
                                                <input type="radio" name="where_obtained1" id="field_cocozx-4"
                                                       value="Other"
                                                       data-sectionid="129"/> Other</label>
                                        </div>
                                    </div>


                                </div>
                                <div id="frm_field_137_container"
                                     class="frm_form_field  frm_top_container frm_html_container form-field">
                                    <b>Animal 2</b>
                                </div>
                                <div id="frm_field_30_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_fsdrn4" class="frm_primary_label">Name
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_fsdrn4" name="pet_name2" value="" data-sectionid="129"
                                           placeholder="Name"/>


                                </div>
                                <div id="frm_field_31_container" class="frm_form_field form-field  frm_none_container">
                                    <label class="frm_primary_label">Sex
                                        <span class="frm_required"></span>
                                    </label>
                                    <div class="frm_opt_container">
                                        <div class="frm_radio">
                                            <label for="field_s9gasp-0">
                                                <input type="radio" name="sex2" id="field_s9gasp-0" value="Male"
                                                       data-sectionid="129"/> Male</label>
                                        </div>
                                        <div class="frm_radio">
                                            <label for="field_s9gasp-1">
                                                <input type="radio" name="sex2" id="field_s9gasp-1" value="Female"
                                                       data-sectionid="129"/> Female</label>
                                        </div>
                                    </div>


                                </div>

                                <div id="frm_field_32_container" class="frm_form_field form-field  frm_none_container">
                                    <label class="frm_primary_label">Type (Required if adding 2nd animal)
                                        <span class="frm_required"></span>
                                    </label>
                                    <div class="frm_opt_container">
                                        <div class="frm_radio">
                                            <label for="field_46d31c-0">
                                                <input type="radio" name="species2" id="field_46d31c-0" value="cat"
                                                       data-sectionid="129"/> Cat</label>
                                        </div>
                                        <div class="frm_radio">
                                            <label for="field_46d31c-1">
                                                <input type="radio" name="species2" id="field_46d31c-1" value="dog"
                                                       data-sectionid="129"/> Dog</label>
                                        </div>
                                    </div>


                                </div>
                                <input type="hidden" id="field_rlgiar" name="age_type2" value="Yearly"
                                       data-sectionid="129" placeholder="Age"/>
                                <div id="frm_field_33_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_fm7e5w" class="frm_primary_label">Age
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_fm7e5w" name="age_of_pet2" value=""
                                           data-sectionid="129" placeholder="Age"/>


                                </div>
                                <div id="frm_field_34_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_3vo1kp" class="frm_primary_label">Breed (Required if adding 2nd
                                        animal)
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_3vo1kp" name="breed2" value="" data-sectionid="129"
                                           placeholder="Breed (Required if adding 2nd animal)"
                                    />


                                </div>
                                <div id="frm_field_35_container" class="frm_form_field form-field  frm_top_container">
                                    <label class="frm_primary_label">Where did you obtain the animal listed above?
                                        <span class="frm_required"></span>
                                    </label>
                                    <div class="frm_opt_container">
                                        <div class="frm_checkbox" id="frm_checkbox_35-129-0">
                                            <label for="field_noakg6-0">
                                                <input type="radio" name="where_obtained2" id="field_noakg6-0"
                                                       value="Friend/Family"
                                                       data-sectionid="129"/> Friend/Family</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_35-129-1">
                                            <label for="field_noakg6-1">
                                                <input type="radio" name="where_obtained2" id="field_noakg6-1"
                                                       value="Pet Store / Breeder"
                                                       data-sectionid="129"/> Pet Store / Breeder</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_35-129-2">
                                            <label for="field_noakg6-2">
                                                <input type="radio" name="where_obtained2" id="field_noakg6-2"
                                                       value="Shelter / Rescue"
                                                       data-sectionid="129"/> Shelter / Rescue</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_35-129-3">
                                            <label for="field_noakg6-3">
                                                <input type="radio" name="where_obtained2" id="field_noakg6-3"
                                                       value="Stray"
                                                       data-sectionid="129"/> Stray</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_35-129-4">
                                            <label for="field_noakg6-4">
                                                <input type="radio" name="where_obtained2" id="field_noakg6-4"
                                                       value="Other"
                                                       data-sectionid="129"/> Other</label>
                                        </div>
                                    </div>


                                </div>
                                <div id="frm_field_138_container"
                                     class="frm_form_field  frm_top_container hide-field frm_html_container form-field">
                                    <b>Animal 3</b>
                                </div>
                                <div id="frm_field_36_container"
                                     class="frm_form_field form-field  frm_none_container hide-field">
                                    <label for="field_b8a3vg" class="frm_primary_label">Name
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_b8a3vg" name="pet_name3" value="" data-sectionid="129"
                                           placeholder="Name"/>


                                </div>
                                <div id="frm_field_37_container"
                                     class="frm_form_field form-field  frm_none_container hide-field">
                                    <label class="frm_primary_label">Sex
                                        <span class="frm_required"></span>
                                    </label>
                                    <div class="frm_opt_container">
                                        <div class="frm_radio">
                                            <label for="field_1s2a3i-0">
                                                <input type="radio" name="sex3" id="field_1s2a3i-0" value="Male"
                                                       data-sectionid="129"/> Male</label>
                                        </div>
                                        <div class="frm_radio">
                                            <label for="field_1s2a3i-1">
                                                <input type="radio" name="sex3" id="field_1s2a3i-1" value="Female"
                                                       data-sectionid="129"/> Female</label>
                                        </div>
                                    </div>


                                </div>
                                <div id="frm_field_38_container"
                                     class="frm_form_field form-field  frm_none_container hide-field">
                                    <label class="frm_primary_label">Type (Required if adding 3rd animal)
                                        <span class="frm_required"></span>
                                    </label>
                                    <div class="frm_opt_container">
                                        <div class="frm_radio">
                                            <label for="field_6m54ju-0">
                                                <input type="radio" name="species3" id="field_6m54ju-0" value="cat"
                                                       data-sectionid="129"/> Cat</label>
                                        </div>
                                        <div class="frm_radio">
                                            <label for="field_6m54ju-1">
                                                <input type="radio" name="species3" id="field_6m54ju-1" value="dog"
                                                       data-sectionid="129"/> Dog</label>
                                        </div>
                                    </div>


                                </div>

                                <input type="hidden" id="field_rlgiar" name="age_type3" value="Yearly"
                                       data-sectionid="129" placeholder="Age"/>
                                <div id="frm_field_39_container"
                                     class="frm_form_field form-field  frm_none_container hide-field">
                                    <label for="field_d480z1" class="frm_primary_label">Age
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_d480z1" name="age_of_pet3" value=""
                                           data-sectionid="129" placeholder="Age"/>


                                </div>
                                <div id="frm_field_40_container"
                                     class="frm_form_field form-field  frm_none_container hide-field">
                                    <label for="field_qdx148" class="frm_primary_label">Breed (Required if adding 3rd
                                        animal)
                                        <span class="frm_required"></span>
                                    </label>
                                    <input type="text" id="field_qdx148" name="breed3" value="" data-sectionid="129"
                                           placeholder="Breed (Required if adding 3rd animal)"
                                    />


                                </div>
                                <div id="frm_field_41_container"
                                     class="frm_form_field form-field  frm_top_container hide-field">
                                    <label class="frm_primary_label">Where did you obtain the animal listed above?
                                        <span class="frm_required"></span>
                                    </label>
                                    <div class="frm_opt_container">
                                        <div class="frm_checkbox" id="frm_checkbox_41-129-0">
                                            <label for="field_pyfrtb-0">
                                                <input type="radio" name="where_obtained3" id="field_pyfrtb-0"
                                                       value="Friend/Family"
                                                       data-sectionid="129"/> Friend/Family</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_41-129-1">
                                            <label for="field_pyfrtb-1">
                                                <input type="radio" name="where_obtained3" id="field_pyfrtb-1"
                                                       value="Pet Store / Breeder"
                                                       data-sectionid="129"/> Pet Store / Breeder</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_41-129-2">
                                            <label for="field_pyfrtb-2">
                                                <input type="radio" name="where_obtained3" id="field_pyfrtb-2"
                                                       value="Shelter / Rescue"
                                                       data-sectionid="129"/> Shelter / Rescue</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_41-129-3">
                                            <label for="field_pyfrtb-3">
                                                <input type="radio" name="where_obtained3" id="field_pyfrtb-3"
                                                       value="Stray"
                                                       data-sectionid="129"/> Stray</label>
                                        </div>
                                        <div class="frm_checkbox" id="frm_checkbox_41-129-4">
                                            <label for="field_pyfrtb-4">
                                                <input type="checkbox" name="where_obtained3" id="field_pyfrtb-4"
                                                       value="Other"
                                                       data-sectionid="129"/> Other</label>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div id="frm_field_123_container" class="frm_form_field frm_section_heading form-field ">
                                <h3 class="frm_pos_top frm_section_spacing">Upload Your Attachments</h3>


                                <div id="frm_field_125_container"
                                     class="frm_form_field form-field  frm_required_field frm_none_container">
                                    <label for="field_srfyjc" class="frm_primary_label">Attach
                                        <span class="frm_required">*</span>
                                    </label>

                                    <div class="frm_dropzone frm_single_upload" id="file125_dropzone">
                                        <div class="fallback">
                                            <input type="file" name="photoIdProofTitle" id="field_srfyjc"
                                                   data-sectionid="123" data-reqmsg="This field cannot be blank."
                                                   data-invmsg="Attach is invalid"
                                            />
                                            <div class="frm_clearfix "></div>

                                            <div id="frm_loading"
                                                 style="display:none;background:url(../wp-content/plugins/formidable/pro/images/grey_bg.png);">
                                                <div id="frm_loading_content">
                                                    <h3>Uploading Files. Please Wait.</h3>
                                                    <div class="progress progress-striped active">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="100"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dz-message needsclick">
                                            <span class="frm_icon_font frm_upload_icon"></span>
                                            <span class="frm_upload_text">Drop a file here or click to upload</span>
                                            <span class="frm_compact_text">Choose File</span>
                                            <div class="frm_small_text">
                                                Maximum upload size: 8.39MB
                                            </div>
                                        </div>
                                    </div>

                                    <div class="frm_description">
                                        <em>Valid</em>
                                        <b>Delaware State Photo I.D.</b> as proof of identity.
                                    </div>

                                </div>
                                <div id="frm_field_126_container" class="frm_form_field form-field  frm_none_container">
                                    <label for="field_t9f8fq" class="frm_primary_label">Attach
                                        <span class="frm_required"></span>
                                    </label>

                                    <div class="frm_dropzone frm_single_upload" id="file126_dropzone">
                                        <div class="fallback">
                                            <input type="file" name="anualProofTitle" id="field_t9f8fq"
                                                   data-sectionid="123" data-invmsg="Attacg is invalid"/>
                                            <div class="frm_clearfix "></div>
                                        </div>
                                        <div class="dz-message needsclick">
                                            <span class="frm_icon_font frm_upload_icon"></span>
                                            <span class="frm_upload_text">Drop a file here or click to upload</span>
                                            <span class="frm_compact_text">Choose File</span>
                                            <div class="frm_small_text">
                                                Maximum upload size: 8.39MB
                                            </div>
                                        </div>
                                    </div>

                                    <div class="frm_description">
                                        <em>Latest</em>
                                        <b>Annual Proof of Benefits Letter</b>.
                                    </div>

                                </div>
                            </div>
                            <div id="frm_field_128_container"
                                 class="frm_form_field form-field  frm_required_field frm_none_container">
                                <label for="field_rn4hnm" class="frm_primary_label">Signature
                                    <span class="frm_required">*</span>
                                </label>
                                <input type="text" id="field_rn4hnm" name="signature" value=""
                                       placeholder="Signature (Type Your Name Here)"
                                       data-reqmsg="This field cannot be blank."/>


                            </div>
                            <div class="frm_submit">

                                <input type="submit" id="submitApp" value="Submit Application"/>
                            <!-- <img class="frm_ajax_loading" src="{{ asset('img/ajax_loader.gif') }}" alt="Sending"/> -->

                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </article>

    </section>
    <!-- /section -->

</main>