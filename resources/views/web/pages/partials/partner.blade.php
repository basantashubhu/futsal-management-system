@if(count($providers) >0)
    <div class="search-filter-results" id="search-filter-results-7385">
        Found {{count($providers)}} Results
        <br/> Page 1 of {{ceil(count($providers)/10)}}
        <br/>

        <div class="pagination">

            <div class="nav-previous">
                <a href="index0e44.html?sf_paged=2">View Previous Results</a>
            </div>
            <div class="nav-next"></div>
        </div>

        @foreach($providers as $provider)
            <div>
                <h2>{{ucfirst($provider->cname)}}</h2>
                <p>
                <p>{{ucfirst($provider->add1)}}
                    <br/> {{ucfirst($provider->city)}}, {{ucfirst($provider->state)}} {{$provider->zip}}
                    <br/> United States</p>
                </p>
                <p>{{$provider->phone}}4</p>
                <a href="http://wilmingtonanimalhospital.com/"
                   target="_blank">http://wilmingtonanimalhospital.com/</a>
                <br>
                <a href="#" target="_blank"></a>
                <p></p>


                <p>
                    <br/>
                </p>
                <p></p>


            </div>

            <hr style="color:#ccc !important;">
        @endforeach
        Page 1 of 9
        <br/>

        <div class="pagination">

            <div class="nav-previous">
                <a href="index0e44.html?sf_paged=2">View Previous Results</a>
            </div>
            <div class="nav-next"></div>
        </div>
    </div>
@else
    <div class="alert alert-danger" role="alert" style="
    margin: 20px 0;
    color: #fff;
    background-color: #f66e84;
    border-color: #f55f78;
    padding: 15px 10px;
">
        <strong>Oops!</strong> No providers available at selected Zip
    </div>
@endif
