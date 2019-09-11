<main role="main" class="main">
    <!-- section -->
    <section>


        <div class="hero">
            <img src="../wp-content/uploads/2015/06/partners.jpg"
                 class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                 alt=""
                 srcset="https://fixedandfab.com/wp-content/uploads/2015/06/partners.jpg 1000w, https://fixedandfab.com/wp-content/uploads/2015/06/partners-250x62.jpg 250w, https://fixedandfab.com/wp-content/uploads/2015/06/partners-700x174.jpg 700w, https://fixedandfab.com/wp-content/uploads/2015/06/partners-120x30.jpg 120w"
                 sizes="(max-width: 1000px) 100vw, 1000px"/>
        </div>

        <!-- article -->
        <article id="post-58" class="post-58 page type-page status-publish has-post-thumbnail hentry">

            <h1>PARTICIPATING Veterinary hospitals and clinics NEAR YOU</h1>
            <p>The Delaware Spay &#038; Neuter program partners with many excellent, caring veterinarians throughout the
                state. </p>
            <p>NOTE: If you want to use the $20 Spay &#038; Neuter Program,
                <a href="#" data-route="web/application">you must apply</a> and receive a certificate before scheduling
                the procedure.</p>
            <p>
                <!--[searchandfilter id="7385"]
[searchandfilter id="7385" show="results"]-->
            </p>
            <p>
                <!--

<p><em>Enter your zip code below to search for a partner near you</em></p>

--></p>
            <p>
                <!--

<div style='position: absolute;left: -3978px;'><a href='http://etamstone.com/barnye-stoyki'>http://etamstone.com/</a></div>



<div style='position: absolute;left: -3816px;'><a href='http://farkopi.com/elektrika'>http://farkopi.com</a></div>



<div style='position: absolute;left: -3724px;'><a href='http://goodgoods.com.ua/g9410481-nastolnye-nabory'>http://www.goodgoods.com.ua</a></div>



<div style='position: absolute;left: -3676px;'><a href='http://goodgoods.com.ua/g9088800-chasy-gps-trekery'>http://goodgoods.com.ua</a></div>

-->
            </p>

            <!--					<div>
            <form method="GET" action="/our-partners/">
            <p><input type="text" name="zip" placeholder="Enter Zip Code" /></p>
            <p><input type="submit" value="Search" /></p>
            </form>
        <br />
<b>Warning</b>:  mysqli_connect(): (HY000/1044): Access denied for user 'fixedand_fab'@'localhost' to database 'utf8mb4' in <b>/home/fixedandfab/public_html/wp-content/themes/oaw/page.php</b> on line <b>23</b><br />


                    </div> -->


            <form data-sf-form-id='7385' data-is-rtl='0' data-maintain-state=''
                  data-results-url='http://fixedandfab.com/our-partners/'
                  data-ajax-url='https://fixedandfab.com/?sfid=7385&amp;sf_action=get_data&amp;sf_data=results'
                  data-ajax-form-url='https://fixedandfab.com/?sfid=7385&amp;sf_action=get_data&amp;sf_data=form'
                  data-display-result-method='shortcode' data-use-history-api='1' data-template-loaded='0'
                  data-lang-code='' data-ajax='1'
                  data-ajax-data-type='json' data-ajax-target='#search-filter-results-7385'
                  data-ajax-pagination-type='normal' data-ajax-links-selector='.pagination a'
                  data-update-ajax-url='1' data-only-results-ajax='1' data-scroll-to-pos='form'
                  data-scroll-on-action='submit' data-init-paged='1'
                  data-auto-update='1' action='http://fixedandfab.com/our-partners/' method='post'
                  class='searchandfilter' id='search-filter-form-7385'
                  autocomplete='off'>
                <ul>
                    <li class="sf-field-post-meta-zip_code" data-sf-field-name="_sfm_zip_code"
                        data-sf-field-type="post_meta" data-sf-field-input-type="select"
                        data-sf-meta-type="choice">
                        <h4>Search by ZIP</h4>
                        <label>
                            <select name="_sfm_zip_code[]" id="partnerzip" class="sf-input-select" title="">

                                <option class="sf-level-0 sf-item-0 sf-option-active" selected="selected" value="" disabled selected>All
                                    Items
                                </option>
                                @foreach($zips as $zip)
                                    <option class="sf-level-0 " data-sf-count="-1" value="{{$zip
                                    }}">{{$zip}}</option>
                                @endforeach
                            </select>
                        </label>
                    </li>
                </ul>
            </form>
            <div id="patnerSearchHolder">
        @include('web.pages.partials.partner')

            </div>
            <!---- MAP ---->

            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d792809.8174314064!2d-75.50566309090281!3d39.08567142492589!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1436897765535"
                    width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            <h2>Information</h2>
            <div id="map139" class="mapInfo" style="display:none">
                <div class="title">A. Little Veterinary Clinic</div>
                <div class="website">
                    <a href="http://www.alittlevet.org/" target="_BLANK">www.alittlevet.org</a>
                </div>
                <div class="phone">(302) 398-3367</div>
                <div class="notes"></div>
            </div>
            <div id="map119" class="mapInfo" style="display:none">
                <div class="title">All Pets Medical Center</div>
                <div class="website">
                    <a href="http://www.allpetsdelaware.com/" target="_BLANK">www.allpetsdelaware.com</a>
                </div>
                <div class="phone">302-653-2300</div>
                <div class="notes"></div>
            </div>
            <div id="map102" class="mapInfo" style="display:none">
                <div class="title">Animal Haven Veterinary Center</div>
                <div class="website">
                    <a href="http://www.animalhavenvetcenter.com/" target="_BLANK">www.animalhavenvetcenter.com</a>
                </div>
                <div class="phone">302-326-1400</div>
                <div class="notes"></div>
            </div>
            <div id="map103" class="mapInfo" style="display:none">
                <div class="title">Animal Veterinary Center</div>
                <div class="website">
                    <a href="http://www.animalvetcenter.com/" target="_BLANK">www.animalvetcenter.com</a>
                </div>
                <div class="phone">302-322-6488</div>
                <div class="notes"></div>
            </div>
            <div id="map104" class="mapInfo" style="display:none">
                <div class="title">Bay Animal Hospital</div>
                <div class="website">
                    <a href="http://www.bayanimalhospital.net/" target="_BLANK">www.bayanimalhospital.net</a>
                </div>
                <div class="phone">302-279-1082</div>
                <div class="notes">Limited to current patients</div>
            </div>
            <div id="map120" class="mapInfo" style="display:none">
                <div class="title">Brenford Animal Hospital</div>
                <div class="website">
                    <a href="http://brenfordanimalhospital.com/" target="_BLANK">brenfordanimalhospital.com</a>
                </div>
                <div class="phone">302-678-9418</div>
                <div class="notes"></div>
            </div>
            <div id="map121" class="mapInfo" style="display:none">
                <div class="title">Brenford South Animal Clinic</div>
                <div class="website">
                    <a href="http:// brenford animal hospital brenfordanimalhospital.com/" target="_BLANK"> Brenford
                        Animal Hospital brenfordanimalhospital.com</a>
                </div>
                <div class="phone">302-678-9418</div>
                <div class="notes"></div>
            </div>
            <div id="map105" class="mapInfo" style="display:none">
                <div class="title">Centreville Veterinary Hospital</div>
                <div class="website">
                    <a href="http://www.centrevilleveterinary.com/" target="_BLANK">www.centrevilleveterinary.com</a>
                </div>
                <div class="phone">302-655-3315</div>
                <div class="notes"></div>
            </div>
            <div id="map106" class="mapInfo" style="display:none">
                <div class="title">Circle Veterinary Clinic</div>
                <div class="website">
                    <a href="http://www.circlevet.com/" target="_BLANK">www.circlevet.com</a>
                </div>
                <div class="phone">302-652-6587</div>
                <div class="notes">Must show proof of current distemper and rabies vaccines</div>
            </div>
            <div id="map127" class="mapInfo" style="display:none">
                <div class="title">Crossroads Veterinary Clinic</div>
                <div class="website">
                    <a href="http://www.crvetclinic.com/" target="_BLANK">www.crvetclinic.com</a>
                </div>
                <div class="phone">302-436-5984</div>
                <div class="notes"></div>
            </div>
            <div id="map108" class="mapInfo" style="display:none">
                <div class="title">Delaware Humane Association</div>
                <div class="website">
                    <a href="http://www.dehumane.org/" target="_BLANK">www.dehumane.org</a>
                </div>
                <div class="phone">302-571-0111</div>
                <div class="notes"></div>
            </div>
            <div id="map107" class="mapInfo" style="display:none">
                <div class="title">Delaware SPCA - Georgetown</div>
                <div class="website">
                    <a href="http://www.delspca.org/" target="_BLANK">www.delspca.org</a>
                </div>
                <div class="phone">302-856-6361</div>
                <div class="notes"></div>
            </div>
            <div id="map100" class="mapInfo" style="display:none">
                <div class="title">Delaware SPCA - Newark</div>
                <div class="website">
                    <a href="http://www.delspca.org/" target="_BLANK">www.delspca.org</a>
                </div>
                <div class="phone">302-998-2281</div>
                <div class="notes"></div>
            </div>
            <div id="map155" class="mapInfo" style="display:none">
                <div class="title">Dr. Theresa Kothstein</div>
                <div class="website">
                    <a href="http://" target="_BLANK"></a>
                </div>
                <div class="phone">(302) 841-3081</div>
                <div class="notes"></div>
            </div>
            <div id="map128" class="mapInfo" style="display:none">
                <div class="title">Eastern Shore Veterinary Hospital</div>
                <div class="website">
                    <a href="http://easternshorevethosp.com/" target="_BLANK">easternshorevethosp.com</a>
                </div>
                <div class="phone">302-875-5941</div>
                <div class="notes"></div>
            </div>
            <div id="map109" class="mapInfo" style="display:none">
                <div class="title">Faithful Friends Animal Society</div>
                <div class="website">
                    <a href="http://www.faithfulfriends.us/" target="_BLANK">www.faithfulfriends.us</a>
                </div>
                <div class="phone">(302) 427-8514</div>
                <div class="notes"></div>
            </div>
            <div id="map122" class="mapInfo" style="display:none">
                <div class="title">First State Animal Center & SPCA</div>
                <div class="website">
                    <a href="http://www.fsac-spca.org/" target="_BLANK">www.fsac-spca.org</a>
                </div>
                <div class="phone">302-943-6032</div>
                <div class="notes"></div>
            </div>
            <div id="map124" class="mapInfo" style="display:none">
                <div class="title">Forrest Avenue Animal Hospital</div>
                <div class="website">
                    <a href="http://faah.vetstreet.com/" target="_BLANK">faah.vetstreet.com</a>
                </div>
                <div class="phone">302-736-3000</div>
                <div class="notes"></div>
            </div>
            <div id="map129" class="mapInfo" style="display:none">
                <div class="title">Four Paws Animal Hospital</div>
                <div class="website">
                    <a href="http://bwci.com/clients/fpah.htm" target="_BLANK">bwci.com/clients/fpah.htm</a>
                </div>
                <div class="phone">302-629-7297</div>
                <div class="notes"></div>
            </div>
            <div id="map130" class="mapInfo" style="display:none">
                <div class="title">Haven Lake Animal Hospital</div>
                <div class="website">
                    <a href="http://www.havenlakeanimalhospital.com/"
                       target="_BLANK">www.havenlakeanimalhospital.com</a>
                </div>
                <div class="phone">302-422–8100</div>
                <div class="notes">Cats only</div>
            </div>
            <div id="map154" class="mapInfo" style="display:none">
                <div class="title">Just Us Cat Rescue</div>
                <div class="website">
                    <a href="http://" target="_BLANK"></a>
                </div>
                <div class="phone">(302) 245-7666</div>
                <div class="notes"></div>
            </div>
            <div id="map3236" class="mapInfo" style="display:none">
                <div class="title">Kitty Fix Co-Op</div>
                <div class="website">
                    <a href="http://members.petfinder.com/~DE29/"
                       target="_BLANK">http://members.petfinder.com/~DE29/</a>
                </div>
                <div class="phone"></div>
                <div class="notes"></div>
            </div>
            <div id="map110" class="mapInfo" style="display:none">
                <div class="title">Lantana Veterinary Center</div>
                <div class="website">
                    <a href="http://lantanavetcenter.com/" target="_BLANK">lantanavetcenter.com</a>
                </div>
                <div class="phone">302-234-3275</div>
                <div class="notes"></div>
            </div>
            <div id="map158" class="mapInfo" style="display:none">
                <div class="title">Ocean View Animal Hospital</div>
                <div class="website">
                    <a href="http://" target="_BLANK"></a>
                </div>
                <div class="phone">(302) 539-2273</div>
                <div class="notes"></div>
            </div>
            <div id="map159" class="mapInfo" style="display:none">
                <div class="title">Pet Medical Center</div>
                <div class="website">
                    <a href="http://" target="_BLANK"></a>
                </div>
                <div class="phone">(302) 846-2869</div>
                <div class="notes"></div>
            </div>
            <div id="map113" class="mapInfo" style="display:none">
                <div class="title">Red Lion Veterinary Hospital</div>
                <div class="website">
                    <a href="http://redlionvet.com/" target="_BLANK">redlionvet.com</a>
                </div>
                <div class="phone">302-834-2250</div>
                <div class="notes"></div>
            </div>
            <div id="map160" class="mapInfo" style="display:none">
                <div class="title">Rehoboth Beach Animal Hospital</div>
                <div class="website">
                    <a href="http://" target="_BLANK"></a>
                </div>
                <div class="phone">(302) 227-2009</div>
                <div class="notes"></div>
            </div>
            <div id="map161" class="mapInfo" style="display:none">
                <div class="title">Seaford Animal Hospital</div>
                <div class="website">
                    <a href="http://" target="_BLANK"></a>
                </div>
                <div class="phone">(302) 629-9576</div>
                <div class="notes"></div>
            </div>
            <div id="map162" class="mapInfo" style="display:none">
                <div class="title">Snip Tuck, Inc.</div>
                <div class="website">
                    <a href="http://" target="_BLANK"></a>
                </div>
                <div class="phone">(410) 943-4050</div>
                <div class="notes"></div>
            </div>
            <div id="map125" class="mapInfo" style="display:none">
                <div class="title">Spay Neuter Clinic</div>
                <div class="website">
                    <a href="http://www.spayaz.com/dover-de" target="_BLANK">www.spayaz.com/dover-de</a>
                </div>
                <div class="phone">302-735-7729</div>
                <div class="notes"></div>
            </div>
            <div id="map126" class="mapInfo" style="display:none">
                <div class="title">VCA Dover Animal Hospital</div>
                <div class="website">
                    <a href="http://www.vcahospitals.com/dover" target="_BLANK">www.vcahospitals.com/dover</a>
                </div>
                <div class="phone">302-674-1515</div>
                <div class="notes"></div>
            </div>
            <div id="map114" class="mapInfo" style="display:none">
                <div class="title">VCA Glasgow Animal Hospital</div>
                <div class="website">
                    <a href="http://www.vcahospitals.com/glasgow" target="_BLANK">www.vcahospitals.com/glasgow</a>
                </div>
                <div class="phone">302-834-1118</div>
                <div class="notes"></div>
            </div>
            <div id="map116" class="mapInfo" style="display:none">
                <div class="title">VCA Kirkwood Animal Hospital</div>
                <div class="website">
                    <a href="http://www.vcahospitals.com/kirkwood" target="_BLANK">www.vcahospitals.com/kirkwood</a>
                </div>
                <div class="phone">302-737-1098</div>
                <div class="notes"></div>
            </div>
            <div id="map163" class="mapInfo" style="display:none">
                <div class="title">Western Sussex Animal Hospital</div>
                <div class="website">
                    <a href="http://" target="_BLANK"></a>
                </div>
                <div class="phone">(302) 337-7387</div>
                <div class="notes"></div>
            </div>
            <div id="map152" class="mapInfo" style="display:none">
                <div class="title">Wilmington Animal Hospital</div>
                <div class="website">
                    <a href="http://" target="_BLANK"></a>
                </div>
                <div class="phone">(302) 762-2694</div>
                <div class="notes"></div>
            </div>
            <div id="map118" class="mapInfo" style="display:none">
                <div class="title">Windcrest Animal Hospital</div>
                <div class="website">
                    <a href="http://www.windcrestanimal.com/" target="_BLANK">www.windcrestanimal.com</a>
                </div>
                <div class="phone">302-998-2995</div>
                <div class="notes"></div>
            </div>

            <br class="clear">


        </article>
        <!-- /article -->


    </section>
    <!-- /section -->


</main>