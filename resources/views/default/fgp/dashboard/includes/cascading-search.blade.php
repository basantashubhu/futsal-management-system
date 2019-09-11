<style>
    
  .cascading{
    padding: 1rem;
    height: 300px;
    overflow-y: hidden;
  }

  .cascading:hover{
    overflow-y: scroll;
    transition: all 300ms ease-in;
  }

  .cascading-grid{
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      /*grid-column-gap: 5px;*/
  }
  
  .cascading .search-items{
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 4px;
  }

  .search-items h4{
      font-size: 1rem;
      margin-bottom: 0;
  }

  .search-items h4 i{
      font-size: 1rem;
      margin-right: 8px;
  }

  .search-items:hover{
    background-color: #e8e8e8;
  }

  .search-items > i:last-child{
      font-size: 1.5rem;
  }

  .cascading-grid .m-portlet--creative{
      margin: 0;
  }

  /*  Active colors  */
  .active-county{
      background-color: #34bfa3;
      color: white;
  }
  .active-state{
      background-color: #ffb822;
  }
  .active-district{
      background: #5867dd;
      color: white;
  }
  .active-city{
      background: #36a3fb;
      color: white;
  }

  /* Checkbox colors  */

  .checkbox-yellow input:checked~span{
    background-color: #ffb822;
    border-color: #ffb822 !important;
  }

  .checkbox-green input:checked~span{
    background-color: #34bfa3;
    border-color: #34bfa3 !important;
  }

  .checkbox-green input:checked~span:after{
    border-color: white !important;
  }

  .checkbox-navy input:checked~span{
    background-color: #5867dd;
    border-color: #5867dd !important;
  }

  .checkbox-navy input:checked~span:after{
    border-color: white !important;
  }

  .checkbox-light-blue input:checked~span{
    background-color: #36a3f7;
    border-color: #36a3f7 !important;
  }

  .checkbox-light-blue input:checked~span:after{
    border-color: white !important;
  }   

   /* Scrollbars */

   .scrollbar-yellow::-webkit-scrollbar,
   .scrollbar-green::-webkit-scrollbar,
   .scrollbar-navy::-webkit-scrollbar,
   .scrollbar-light-blue::-webkit-scrollbar{
        width: 0.3em;
   }

   .scrollbar-yellow::-webkit-scrollbar-track,
   .scrollbar-green::-webkit-scrollbar-track,
   .scrollbar-navy::-webkit-scrollbar-track,
   .scrollbar-light-blue::-webkit-scrollbar-track
   {
        /*background-color: #ddd;*/
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
   }

   .scrollbar-yellow::-webkit-scrollbar-thumb{
        background-color: #ffb822;
        border-radius: 10px;
   }

   .scrollbar-green::-webkit-scrollbar-thumb{
        background-color: #34bfa3;
        border-radius: 10px;
   }

   .scrollbar-navy::-webkit-scrollbar-thumb{
        background-color: #5867dd;
        border-radius: 10px;
   }

   .scrollbar-light-blue::-webkit-scrollbar-thumb{
        background-color: #36a3f7;
        border-radius: 10px;
   }

   .cascading-searchbar{
        display: flex;
        align-items: center;
        justify-content: space-between;
   }

   .cascading-searchbar button{
        margin-left: 10px
   }


   /* Dropdown */

   .custom-dropdown{
        position: relative;
        /*height: 300px;*/
   }

   .cascading-container{
        display: none;
        position: absolute;
        width: 100%;
        z-index: 999;
        box-shadow: -3px 2px 10px rgba(0,0,0,0.2);
   }

   .arrow-up {
     width: 0; 
     height: 0; 
     border-left: 5px solid transparent;
     border-right: 5px solid transparent;     
     border-bottom: 5px solid black;
   }

  body .bootstrap-select.btn-group > .btn-redius {
      background-color: #fff;
       border-top-right-radius: 0px !important; 
       border-bottom-right-radius: 0px !important; 
      border-color: #ccc;
  }

 

</style>

<div class="custom-dropdown">
    {{-- <span class="arrow-up"></span> --}}
    <div class="m-portlet {{-- cascading-container --}}" {{-- id="cascading-filter" --}}>
        <div class="m-portlet__body  m-portlet__body--no-padding no-pd-i">
            <div class="row m-row--no-padding m-row--col-separator-xl cascading-grid" id="timesheet-cascading" style="background-color: #f2f3f8">
                <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                    <div class="m-portlet__head" style="height: 0rem">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">                                    
                                <h3 class="m-portlet__head-label m-portlet__head-label--warning">
                                    <span style="font-size: 0.9rem">Region</span>
                                </h3>
                            </div>
                        </div>                            
                    </div>
                    <div class="m-portlet__body pd-15 no-pd-right">
                        <div class="cascading-searchbar pd-r-10 pd-l-10">
                            <input type="text" class="form-control form-control-sm cascading-box-filters" placeholder="Search">
                            {{-- <button class="btn btn-default btn-sm cascading-clear">Clear</button> --}}
                            <button class="btn btn-default btn-sm no-pd pd-5-x-i clean-master" title="Clean Master" data-cascading-type="state">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M10.5278225,22.5278225 L8.79765312,20.7976531 L9.99546268,18.4463973 L7.35584531,19.3558453 L5.04895282,17.0489528 L8.15438502,11.6366281 L2.74206034,14.7420603 L1.30025253,13.3002525 L9.26548692,8.03126375 C11.3411817,6.65819522 14.1285885,7.15099488 15.6076701,9.15253022 C17.1660799,11.2614147 17.1219524,14.1519817 15.4998952,16.212313 L10.5278225,22.5278225 Z" id="Rectangle-124" fill="#000000" opacity="0.3"/>
                                        <path d="M22.4246212,4.91054166 L18.4071175,8.92804534 C17.6260689,9.70909393 16.359739,9.70909393 15.5786904,8.92804534 C14.7976418,8.14699676 14.7976418,6.8806668 15.5786904,6.09961822 L19.6029298,2.0753788 C19.7817428,2.41498256 19.9878937,2.74436937 20.2214305,3.06039796 C20.8190224,3.86907629 21.5791361,4.49033747 22.4246212,4.91054166 Z" id="Combined-Shape" fill="#000000" transform="translate(18.708763, 5.794605) rotate(-180.000000) translate(-18.708763, -5.794605) "/>
                                    </g>
                                </svg>
                            </button>
                        </div>
                        <div class="m-widget1 cascading scrollbar-yellow states-widget">
                            @foreach($all_regions as $region)
                                <div class="search-items">
                                   <label class="m-checkbox m-checkbox--bold checkbox-yellow">
                                     <input type="checkbox" data-cascading-type="state" data-value="{{$region->id}}"> {{ucwords($region->region_name)}}
                                     <span></span>
                                   </label>
                                   <i class="fa fa-angle-right"></i>
                                </div> 
                            @endforeach  
                        </div> 
                    </div>
                </div>            
                
                <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                    <div class="m-portlet__head" style="height: 0rem">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">                                    
                                <h3 class="m-portlet__head-label m-portlet__head-label--success">
                                    <span style="font-size: 0.9rem">County</span>
                                </h3>
                            </div>
                        </div>                            
                    </div>
                    <div class="m-portlet__body pd-15 no-pd-right">
                        <div class="cascading-searchbar pd-r-10 pd-l-10">
                            <input type="text" class="form-control form-control-sm cascading-box-filters" placeholder="Search">
                            {{-- <button class="btn btn-default btn-sm cascading-clear">Clear</button> --}}
                            <button class="btn btn-default btn-sm no-pd pd-5-x-i clean-master" title="Clean Master" data-cascading-type="county">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M10.5278225,22.5278225 L8.79765312,20.7976531 L9.99546268,18.4463973 L7.35584531,19.3558453 L5.04895282,17.0489528 L8.15438502,11.6366281 L2.74206034,14.7420603 L1.30025253,13.3002525 L9.26548692,8.03126375 C11.3411817,6.65819522 14.1285885,7.15099488 15.6076701,9.15253022 C17.1660799,11.2614147 17.1219524,14.1519817 15.4998952,16.212313 L10.5278225,22.5278225 Z" id="Rectangle-124" fill="#000000" opacity="0.3"/>
                                        <path d="M22.4246212,4.91054166 L18.4071175,8.92804534 C17.6260689,9.70909393 16.359739,9.70909393 15.5786904,8.92804534 C14.7976418,8.14699676 14.7976418,6.8806668 15.5786904,6.09961822 L19.6029298,2.0753788 C19.7817428,2.41498256 19.9878937,2.74436937 20.2214305,3.06039796 C20.8190224,3.86907629 21.5791361,4.49033747 22.4246212,4.91054166 Z" id="Combined-Shape" fill="#000000" transform="translate(18.708763, 5.794605) rotate(-180.000000) translate(-18.708763, -5.794605) "/>
                                    </g>
                                </svg>
                            </button>
                        </div>
                       <div class="m-widget1 cascading scrollbar-green counties-widget">
                        @foreach($all_counties as $county)
                            <div class="search-items">
                                <label class="m-checkbox m-checkbox--bold checkbox-green">
                                  <input type="checkbox" data-cascading-type="county" value="{{$county->id}}" data-value="{{$county->id}}"> {{$county->county_name}}
                                  <span></span>
                                </label>
                                <i class="fa fa-angle-right"></i>
                            </div>  
                        @endforeach                     
                       </div> 
                    </div>
                </div>

                <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                    <div class="m-portlet__head" style="height: 0rem">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">                                    
                                <h3 class="m-portlet__head-label m-portlet__head-label--success" style="background: #0b9eaf;">
                                    <span style="font-size: 0.9rem">District</span>
                                </h3>
                            </div>
                        </div>                            
                    </div>
                    <div class="m-portlet__body pd-15 no-pd-right">
                        <div class="cascading-searchbar pd-r-10 pd-l-10">
                            <input type="text" class="form-control form-control-sm cascading-box-filters" placeholder="Search">
                            <button class="btn btn-default btn-sm no-pd pd-5-x-i clean-master" title="Clean Master" data-cascading-type="district">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M10.5278225,22.5278225 L8.79765312,20.7976531 L9.99546268,18.4463973 L7.35584531,19.3558453 L5.04895282,17.0489528 L8.15438502,11.6366281 L2.74206034,14.7420603 L1.30025253,13.3002525 L9.26548692,8.03126375 C11.3411817,6.65819522 14.1285885,7.15099488 15.6076701,9.15253022 C17.1660799,11.2614147 17.1219524,14.1519817 15.4998952,16.212313 L10.5278225,22.5278225 Z" id="Rectangle-124" fill="#000000" opacity="0.3"/>
                                        <path d="M22.4246212,4.91054166 L18.4071175,8.92804534 C17.6260689,9.70909393 16.359739,9.70909393 15.5786904,8.92804534 C14.7976418,8.14699676 14.7976418,6.8806668 15.5786904,6.09961822 L19.6029298,2.0753788 C19.7817428,2.41498256 19.9878937,2.74436937 20.2214305,3.06039796 C20.8190224,3.86907629 21.5791361,4.49033747 22.4246212,4.91054166 Z" id="Combined-Shape" fill="#000000" transform="translate(18.708763, 5.794605) rotate(-180.000000) translate(-18.708763, -5.794605) "/>
                                    </g>
                                </svg>
                            </button>
                        </div>
                       <div class="m-widget1 cascading scrollbar-green districts-widget">
                        @foreach($all_districts as $district)
                            <div class="search-items">
                                <label class="m-checkbox m-checkbox--bold checkbox-green">
                                  <input type="checkbox" data-cascading-type="district" value="{{$district->id}}" data-value="{{$district->id}}"> {{$district->district_name}}
                                  <span></span>
                                </label>
                                <i class="fa fa-angle-right"></i>
                            </div>  
                        @endforeach                     
                       </div> 
                    </div>
                </div>
                <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                    <div class="m-portlet__head" style="height: 0rem">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">                                    
                                <h3 class="m-portlet__head-label m-portlet__head-label--danger">
                                    <span style="font-size: 0.9rem">Location</span>
                                </h3>
                            </div>
                        </div>                            
                    </div>
                    <div class="m-portlet__body pd-15 no-pd-right">
                      <div class="cascading-searchbar pd-r-10 pd-l-10">
                            <input type="text" class="form-control form-control-sm cascading-box-filters" placeholder="Search">
                            {{-- <button class="btn btn-default btn-sm cascading-clear">Clear</button> --}}
                            <button class="btn btn-default btn-sm no-pd pd-5-x-i clean-master" title="Clean Master" data-cascading-type="site">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M10.5278225,22.5278225 L8.79765312,20.7976531 L9.99546268,18.4463973 L7.35584531,19.3558453 L5.04895282,17.0489528 L8.15438502,11.6366281 L2.74206034,14.7420603 L1.30025253,13.3002525 L9.26548692,8.03126375 C11.3411817,6.65819522 14.1285885,7.15099488 15.6076701,9.15253022 C17.1660799,11.2614147 17.1219524,14.1519817 15.4998952,16.212313 L10.5278225,22.5278225 Z" id="Rectangle-124" fill="#000000" opacity="0.3"/>
                                        <path d="M22.4246212,4.91054166 L18.4071175,8.92804534 C17.6260689,9.70909393 16.359739,9.70909393 15.5786904,8.92804534 C14.7976418,8.14699676 14.7976418,6.8806668 15.5786904,6.09961822 L19.6029298,2.0753788 C19.7817428,2.41498256 19.9878937,2.74436937 20.2214305,3.06039796 C20.8190224,3.86907629 21.5791361,4.49033747 22.4246212,4.91054166 Z" id="Combined-Shape" fill="#000000" transform="translate(18.708763, 5.794605) rotate(-180.000000) translate(-18.708763, -5.794605) "/>
                                    </g>
                                </svg>
                            </button>
                        </div>
                       <div class="m-widget1 cascading sites-widget">
                          @foreach($sites as $site)
                          <div class="search-items">
                            <label class="m-checkbox m-checkbox--bold checkbox-green">
                              <input type="checkbox" data-cascading-type="site" data-value="{{$site->id}}"> {{$site->site_name}}
                              <span></span>
                            </label>
                          </div>
                          @endforeach 
                          <i class="fa fa-angle-right"></i>         
                       </div> 
                    </div>
                </div>  
                <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                    <div class="m-portlet__head" style="height: 0rem">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">                                    
                                <h3 class="m-portlet__head-label m-portlet__head-label--primary">
                                    <span style="font-size: 0.9rem">Volunteers</span>
                                </h3>
                            </div>
                        </div>                            
                    </div>
                    <div class="m-portlet__body pd-15 no-pd-right">
                        <div class="cascading-searchbar pd-r-10 pd-l-10">
                            <input type="text" class="form-control form-control-sm cascading-box-filters" placeholder="Search">
                            {{-- <button class="btn btn-default btn-sm cascading-clear">Clear</button> --}}
                            <button class="btn btn-default btn-sm no-pd pd-5-x-i clean-master" title="Clean Master" data-cascading-type="district">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M10.5278225,22.5278225 L8.79765312,20.7976531 L9.99546268,18.4463973 L7.35584531,19.3558453 L5.04895282,17.0489528 L8.15438502,11.6366281 L2.74206034,14.7420603 L1.30025253,13.3002525 L9.26548692,8.03126375 C11.3411817,6.65819522 14.1285885,7.15099488 15.6076701,9.15253022 C17.1660799,11.2614147 17.1219524,14.1519817 15.4998952,16.212313 L10.5278225,22.5278225 Z" id="Rectangle-124" fill="#000000" opacity="0.3"/>
                                        <path d="M22.4246212,4.91054166 L18.4071175,8.92804534 C17.6260689,9.70909393 16.359739,9.70909393 15.5786904,8.92804534 C14.7976418,8.14699676 14.7976418,6.8806668 15.5786904,6.09961822 L19.6029298,2.0753788 C19.7817428,2.41498256 19.9878937,2.74436937 20.2214305,3.06039796 C20.8190224,3.86907629 21.5791361,4.49033747 22.4246212,4.91054166 Z" id="Combined-Shape" fill="#000000" transform="translate(18.708763, 5.794605) rotate(-180.000000) translate(-18.708763, -5.794605) "/>
                                    </g>
                                </svg>
                            </button>
                        </div>
                        <div class="m-widget1 cascading scrollbar-navy districts-widget">
                        @foreach($volunteers as $volunteer)
                            <div class="search-items">
                                <label class="m-checkbox m-checkbox--bold checkbox-navy">
                                  <input type="checkbox" data-cascading-type="district" data-value="{{$volunteer->id}}"> {{$volunteer->first_name}} {{$volunteer->last_name}}
                                  <span></span>
                                </label>
                                <i class="fa fa-angle-right"></i>
                            </div> 
                        @endforeach
                        </div> 
                    </div>
                </div>
                {{-- <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                  <div class="m-portlet__head" style="height: 0rem">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">                                    
                                <h3 class="m-portlet__head-label m-portlet__head-label--primary pointer hide-cascading" style="right: -29px; border-radius: 199px; left: unset; height: 25px !important; width: 25px; padding: 0; background: #0b9eaf;">
                                    <i class="fa fa-minus mt-5" style="margin-left: 7px;"></i>
                                </h3>
                            </div>
                        </div>                            
                    </div>
                    <div class="m-portlet__body pd-15 no-pd-right">
                        <div class="cascading-searchbar pd-r-10 pd-l-10 pb-15">
                            <select class="form-control m-bootstrap-select m-input selectpicker m-input--pill" data-style="btn-redius" id="supervisors" multiple data-width="250px" title="Select Supervisor" data-selected-text-format="count > 3" name="type[]">
                              @foreach($supervisors as $supervisor)
                              <option value="{{$supervisor->id}}">{{ucfirst($supervisor->name)}}</option>
                              @endforeach
                            </select>
                            <button class="btn btn-default btn-sm no-pd pd-5-x-i  cascading-clear" title="Clean Master" >
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M10.5278225,22.5278225 L8.79765312,20.7976531 L9.99546268,18.4463973 L7.35584531,19.3558453 L5.04895282,17.0489528 L8.15438502,11.6366281 L2.74206034,14.7420603 L1.30025253,13.3002525 L9.26548692,8.03126375 C11.3411817,6.65819522 14.1285885,7.15099488 15.6076701,9.15253022 C17.1660799,11.2614147 17.1219524,14.1519817 15.4998952,16.212313 L10.5278225,22.5278225 Z" id="Rectangle-124" fill="#000000" opacity="0.3"/>
                                        <path d="M22.4246212,4.91054166 L18.4071175,8.92804534 C17.6260689,9.70909393 16.359739,9.70909393 15.5786904,8.92804534 C14.7976418,8.14699676 14.7976418,6.8806668 15.5786904,6.09961822 L19.6029298,2.0753788 C19.7817428,2.41498256 19.9878937,2.74436937 20.2214305,3.06039796 C20.8190224,3.86907629 21.5791361,4.49033747 22.4246212,4.91054166 Z" id="Combined-Shape" fill="#000000" transform="translate(18.708763, 5.794605) rotate(-180.000000) translate(-18.708763, -5.794605) "/>
                                    </g>
                                </svg>
                            </button>
                        </div>

                        <div class="cascading-searchbar pd-r-10 pd-l-10 pb-15">
                            <input type="text" class="form-control form-control-sm cascading-box-filters date-range"  placeholder="Date Range">
                            <button class="btn btn-default btn-sm no-pd pd-5-x-i  cascading-clear" title="Clean Master" >
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M10.5278225,22.5278225 L8.79765312,20.7976531 L9.99546268,18.4463973 L7.35584531,19.3558453 L5.04895282,17.0489528 L8.15438502,11.6366281 L2.74206034,14.7420603 L1.30025253,13.3002525 L9.26548692,8.03126375 C11.3411817,6.65819522 14.1285885,7.15099488 15.6076701,9.15253022 C17.1660799,11.2614147 17.1219524,14.1519817 15.4998952,16.212313 L10.5278225,22.5278225 Z" id="Rectangle-124" fill="#000000" opacity="0.3"/>
                                        <path d="M22.4246212,4.91054166 L18.4071175,8.92804534 C17.6260689,9.70909393 16.359739,9.70909393 15.5786904,8.92804534 C14.7976418,8.14699676 14.7976418,6.8806668 15.5786904,6.09961822 L19.6029298,2.0753788 C19.7817428,2.41498256 19.9878937,2.74436937 20.2214305,3.06039796 C20.8190224,3.86907629 21.5791361,4.49033747 22.4246212,4.91054166 Z" id="Combined-Shape" fill="#000000" transform="translate(18.708763, 5.794605) rotate(-180.000000) translate(-18.708763, -5.794605) "/>
                                    </g>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="cascading-searchbar pd-r-10 pd-l-10 pb-15">
                            <input type="text" class="form-control form-control-sm cascading-box-filters" placeholder="Period">
                            <button class="btn btn-default btn-sm no-pd pd-5-x-i  cascading-clear" title="Clean Master" >
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M10.5278225,22.5278225 L8.79765312,20.7976531 L9.99546268,18.4463973 L7.35584531,19.3558453 L5.04895282,17.0489528 L8.15438502,11.6366281 L2.74206034,14.7420603 L1.30025253,13.3002525 L9.26548692,8.03126375 C11.3411817,6.65819522 14.1285885,7.15099488 15.6076701,9.15253022 C17.1660799,11.2614147 17.1219524,14.1519817 15.4998952,16.212313 L10.5278225,22.5278225 Z" id="Rectangle-124" fill="#000000" opacity="0.3"/>
                                        <path d="M22.4246212,4.91054166 L18.4071175,8.92804534 C17.6260689,9.70909393 16.359739,9.70909393 15.5786904,8.92804534 C14.7976418,8.14699676 14.7976418,6.8806668 15.5786904,6.09961822 L19.6029298,2.0753788 C19.7817428,2.41498256 19.9878937,2.74436937 20.2214305,3.06039796 C20.8190224,3.86907629 21.5791361,4.49033747 22.4246212,4.91054166 Z" id="Combined-Shape" fill="#000000" transform="translate(18.708763, 5.794605) rotate(-180.000000) translate(-18.708763, -5.794605) "/>
                                    </g>
                                </svg>
                            </button>
                        </div>

                        <div class="m-portlet__foot m-portlet__foot--fit" style="border-top: none;">
                          <div class="m-form__actions m-form__actions">
                            <div class="row">
                              <div class="col-lg-9 ml-lg-auto">
                                <button type="submit" class="btn btn-secondary">Clear</button>
                                <button type="submit" class="btn btn-brand">Search</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div> --}}
                            
            </div>
        </div>
    </div>

</div>



<script>    
  $('#supervisors').selectpicker({
        liveSearch: true,
        showTick: true,
        actionsBox: true,
    });

  $('.date-range').daterangepicker({opens: 'left',});
  // $('.hide-cascading').on('click', function(e){
  //   $('#timesheet-cascading').slideUp('slow');
  //   $('#timesheet-cascading-btn').slideDown('slow');
  //   $(this).hide(slow);
  // });

  $('#timesheet-cascading-btn').on('click', function(e){
    $('#timesheet-cascading').toggle('slow');
  });
    
    var filter = {};

    /*  Returns Cascading filter */

    function getCascadingFilter(){
        return filter;
    }

    /* Assign to filter{} */

    function assignToFilter(key, value){

        let created_obj = {};

        created_obj[key] = value; 

        filter = value.length > 0 ? Object.assign({}, filter, created_obj) : filter;

        return filter;

    }

    /*
    *   Get filter results 
    *   @param type: type of data checked 
    *   @param select: condition if it is triggered by checked or other events
    */
    function cascadingSearchAjax(type, select = false){

        ajaxRequest({
           url : 'cascading/filter?filter='+JSON.stringify(filter),
           method: "get"
        }, function(resp){

            /*
                Only update the right hand sides tabs
            */
            let counties = $('.counties-widget');
            let districts = $('.districts-widget'); /**/
            let cities = $('.cities-widget');
            let sites = $('.sites-widget');

            let county_html         = '';
            let city_html           = '';
            let district_html       = '';
            let sites_html       = '';

            if(type === "state"){                    

                $.each(resp, function(index, data){
                  console.log(data);
                     $.each(data.county, function(i, county){
                        county_html += generateHtml('county','checkbox-green', county);
                    }); 

                    $.each(data.district, function(i, district){
                        district_html += generateHtml('district','checkbox-navy', district);
                    });

                    $.each(data.city, function(i, city){
                        city_html += generateHtml('city','checkbox-light-blue', city);
                    });
                                           
                });
                counties.html(county_html);
                districts.html(district_html);
                cities.html(city_html);
                     
            }else if (type === "county"){
                /* Calibrated county without state */
                let has_no_state = ! filter.hasOwnProperty('state') && select;

                let parent_states = [];

                $.each(resp, function(index, data){   

                    if(has_no_state){
                        // let pre_state_html='';
                        $.each(data.state, function(i, state){
                            // pre_state_html += generateHtml('state','checkbox-yellow', state);
                            // $('.states-widget').prepend(pre_state_html);
                            $('.states-widget input').each(function(i,el){
                                if( $(el).attr('data-value').toLowerCase() === state.toLowerCase() ){
                                    $(el).attr("checked", "checked");
                                }
                            });

                            parent_states.push(state);

                        });                            
                    }    

                    $.each(data.city, function(i, city){
                        city_html += generateHtml('city','checkbox-light-blue', city);
                    });

                    $.each(data.district, function(i, district){
                        district_html += generateHtml('district','checkbox-navy', district);
                    });                       
                });

                cities.html(city_html);
                districts.html(district_html);

                assignToFilter('state', parent_states);

            }else if(type === "district"){
                /* Calibrated district without state/county */
                let has_no_state = ! filter.hasOwnProperty('state') && select;
                let has_no_county = ! filter.hasOwnProperty('county') && select;

                let parent_states = [];
                let parent_counties = [];

                $.each(resp, function(index, data){                       

                    if(has_no_state){
                        $.each(data.state, function(i, state){
                            $('.states-widget input').each(function(i,el){
                                if( $(el).attr('data-value').toLowerCase() === state.toLowerCase() ){
                                    $(el).attr("checked", "checked");
                                }
                            });

                            parent_states.push(state);  

                        });  

                    } 

                    if(has_no_county){
                        $.each(data.county, function(i, county){
                            $('.counties-widget input').each(function(i,el){
                                if( $(el).attr('data-value').toLowerCase() === county.toLowerCase() ){
                                    $(el).attr("checked", "checked");
                                }
                            });

                            parent_counties.push(county);

                        });                            
                    } 

                    $.each(data.city, function(i, city){
                        city_html += generateHtml('city','checkbox-light-blue', city);
                    });
                                          
                });

                cities.html(city_html);

                assignToFilter('state', parent_states);
                assignToFilter('county', parent_counties);

            }else if(type === "city"){/* If it is city selection */

                /* Calibrated district without state/county */

                let has_no_state = ! filter.hasOwnProperty('state') && select;
                let has_no_county = ! filter.hasOwnProperty('county') && select;
                let has_no_district = ! filter.hasOwnProperty('district') && select;

                let parent_states = [];
                let parent_counties = [];
                let parent_districts = [];

                $.each(resp, function(index, data){                       

                    if(has_no_state){
                        $.each(data.state, function(i, state){
                            $('.states-widget input').each(function(i,el){
                                if( $(el).attr('data-value').toLowerCase() === state.toLowerCase() ){
                                    $(el).attr("checked", "checked");
                                }
                            });

                            parent_states.push(state);

                        });                            
                    } 

                    if(has_no_county){
                        $.each(data.county, function(i, county){

                            $('.counties-widget input').each(function(i,el){
                                if( $(el).attr('data-value').toLowerCase() === county.toLowerCase() ){
                                    $(el).attr("checked", "checked");
                                }
                            });

                            parent_counties.push(county);

                        });                            
                    }

                    if(has_no_district){
                        $.each(data.district, function(i, district){

                            $('.districts-widget input').each(function(i,el){
                                if( $(el).attr('data-value').toLowerCase() === district.toLowerCase() ){
                                    $(el).attr("checked", "checked");
                                }
                            });

                            parent_districts.push(district);

                        });                            
                    }                      
                                          
                });

                assignToFilter('state', parent_states);
                assignToFilter('county', parent_counties);
                assignToFilter('city', parent_districts);

            }
        });

    }

    $(document).on('click','input[type="checkbox"]', function(e){
        let type = $(this).attr('data-cascading-type');
        let value = $(this).attr('data-value');

        /* Function to remove right side previous cached keys from filter obj */
        clearFilterWRTCascadingType(type);

        if($(this).is(':checked')){            
            if(type in filter){
                filter[type].push(value)
            }else{
                filter[type] = [value];
            }            
            
            cascadingSearchAjax(type, "true");

        }else{ //On uncheck
            if(type in filter){
                let index = filter[type].indexOf(value);
                if( index > -1){ //means exists
                    filter[type].splice(index, 1);
                    
                    if(filter[type].length <= 0){
                        delete filter[type];
                    }
                }

            }
            cascadingSearchAjax(type);
            // ajaxRequest({
            //    url : 'cascading/filter?filter='+JSON.stringify(filter),
            //    method: "get"
            // }, function(resp){
            //     /*
            //         only update the right hand sides tabs
            //     */
            //     let counties = $('.counties-widget');
            //     let districts = $('.districts-widget');
            //     let cities = $('.cities-widget');
            //     let sites = $('.sites-widget');

            //     let county_html         = '';
            //     let city_html           = '';
            //     let district_html       = '';

            //     if(type === "state"){                    

            //         $.each(resp, function(index, data){
            //              $.each(data.county, function(i, county){
            //                 county_html += generateHtml('county','checkbox-green', county);
            //             }); 

            //             $.each(data.district, function(i, district){
            //                 district_html += generateHtml('district','checkbox-navy', district);
            //             });

            //             $.each(data.city, function(i, city){
            //                 city_html += generateHtml('city','checkbox-light-blue', city);
            //             });
                                               
            //         });
            //         counties.html(county_html);
            //         districts.html(district_html);
            //         cities.html(city_html);
                         
            //     }else if (type === "county"){
            //         /* Calibrated county without state */
            //         let has_no_state = ! filter.hasOwnProperty('state');

            //         $.each(resp, function(index, data){   

            //             if(has_no_state){
            //                 // let pre_state_html='';
            //                 $.each(data.state, function(i, state){
            //                     // pre_state_html += generateHtml('state','checkbox-yellow', state);
            //                     // $('.states-widget').prepend(pre_state_html);
            //                     $('.states-widget input').each(function(i,el){
            //                         if( $(el).attr('data-value').toLowerCase() === state.toLowerCase() ){
            //                             $(el).attr("checked", "checked");
            //                         }
            //                     });
            //                 });                            
            //             }    

            //             $.each(data.city, function(i, city){
            //                 city_html += generateHtml('city','checkbox-light-blue', city);
            //             });

            //             $.each(data.district, function(i, district){
            //                 district_html += generateHtml('district','checkbox-navy', district);
            //             });                       
            //         });
            //         cities.html(city_html);
            //         districts.html(district_html);
            //     }else if(type === "district"){
            //         /* Calibrated district without state/county */
            //         let has_no_state = ! filter.hasOwnProperty('state');
            //         let has_no_county = ! filter.hasOwnProperty('county');
            //         $.each(resp, function(index, data){                       

            //             if(has_no_state){
            //                 $.each(data.state, function(i, state){
            //                     $('.states-widget input').each(function(i,el){
            //                         if( $(el).attr('data-value').toLowerCase() === state.toLowerCase() ){
            //                             $(el).attr("checked", "checked");
            //                         }
            //                     });
            //                 });                            
            //             } 

            //             if(has_no_county){
            //                 $.each(data.county, function(i, county){
            //                     $('.counties-widget input').each(function(i,el){
            //                         if( $(el).attr('data-value').toLowerCase() === county.toLowerCase() ){
            //                             $(el).attr("checked", "checked");
            //                         }
            //                     });
            //                 });                            
            //             } 

            //             $.each(data.city, function(i, city){
            //                 city_html += generateHtml('city','checkbox-light-blue', city);
            //             });
                                              
            //         });
            //         cities.html(city_html);
            //     }else if(type === "city"){/* If it is city selection */
            //         /* Calibrated district without state/county */
            //         let has_no_state = ! filter.hasOwnProperty('state');
            //         let has_no_county = ! filter.hasOwnProperty('county');
            //         let has_no_district = ! filter.hasOwnProperty('district');
            //         $.each(resp, function(index, data){                       

            //             if(has_no_state){
            //                 $.each(data.state, function(i, state){
            //                     $('.states-widget input').each(function(i,el){
            //                         if( $(el).attr('data-value').toLowerCase() === state.toLowerCase() ){
            //                             $(el).attr("checked", "checked");
            //                         }
            //                     });
            //                 });                            
            //             } 

            //             if(has_no_county){
            //                 $.each(data.county, function(i, county){
            //                     $('.counties-widget input').each(function(i,el){
            //                         if( $(el).attr('data-value').toLowerCase() === county.toLowerCase() ){
            //                             $(el).attr("checked", "checked");
            //                         }
            //                     });
            //                 });                            
            //             }

            //             if(has_no_district){
            //                 $.each(data.district, function(i, district){
            //                     $('.districts-widget input').each(function(i,el){
            //                         if( $(el).attr('data-value').toLowerCase() === district.toLowerCase() ){
            //                             $(el).attr("checked", "checked");
            //                         }
            //                     });
            //                 });                            
            //             }                      
                                              
            //         });
            //     }
            // });
        }
    });

    $(document).on('keyup', '.cascading-box-filters', function(e){

        let sText = $(this).val();

        let length_of_input = sText.length;

        let items = $(this).parent().parent().find('.cascading .search-items');

        if(length_of_input >= 2){

            $(items).each(function(i ,current_el){

                let current_el_value = $(current_el).find('input[type="checkbox"]').attr('data-value').toLowerCase();
                
                current_el_value.includes(sText) ? $(this).fadeIn() : $(this).fadeOut();                

            });

        }else{

            clearSearch(items);

        }
    });

    $(document).on('click', '.cascading-clear', function(e){

        e.stopPropagation();

        let parent_el = $(this).parent();

        let sText = $(parent_el).find('input').first().val('');

        let items = $(this).parent().parent().find('.cascading .search-items');

        clearSearch(items);

    });

    $(document).on('click', '.clean-master', function(e){


        let type = $(this).attr('data-cascading-type');

        /*
        *   This function only clears the right side of it
        *   Doesn't clears itself so first lets clear it
        */

        let items = $(this).parent().parent().find('.cascading .search-items');        

        $(items).each(function(i, current_el){

            $(current_el).find('input[type="checkbox"]').prop("checked", false);

        });

        clearFilterWRTCascadingType(type, type);

        cascadingSearchAjax(type); //Get searched data from server

        $(this).parent().find('input').first().val(''); //Clears the input field

        clearSearch(items);

    });

    function clearSearch(elements){

        $(elements).each(function(i ,current_el){

            $(this).fadeIn();                    

        });

    }

    function generateHtml(type, class_name, value){
        return `<div class="search-items">
                    <label class="m-checkbox m-checkbox--bold ${class_name}">
                      <input type="checkbox" data-cascading-type="${type}" data-value="${value}"> ${value}
                      <span></span>
                    </label>
                    <i class="fa fa-angle-right"></i>
                </div>`;
    }

    /*
    *   Clear filter with respect to the type
    *   Clears child data filters
    *   @param type of checked box clicked
    *   @params master_clean_to: clears all filters of which is request to master clean
    */

    function clearFilterWRTCascadingType(cascadingtype, master_clean_to = false){


        /* Clear districts, cities and site filters*/
        if(cascadingtype === 'state'){

            filterKeyRemover(['state']);

        }else if(cascadingtype === 'county'){

            filterKeyRemover(['state', 'county']);  

        }else if(cascadingtype === 'district'){

            let excludes = ['state', 'county', 'district'];            

            filterKeyRemover(excludes, master_clean_to); 

        }else if(cascadingtype === "cities"){

            filterKeyRemover(['state', 'county', 'district', 'city']);   

        }else{

        }

    }

    /*
    *   Function to remove all other existing keys except given array
    *   @param except: array
    */

    function filterKeyRemover(except, master_clean_to){

        let all_keys = ['state', 'county', 'district', 'city', 'sites'];

        if(master_clean_to){

            delete filter[master_clean_to];

        }else{

            $(all_keys).each(function(i, v){
                if(except.indexOf(v)  ===  -1){
                    delete filter[v];
                }
            });

        }
        
    }

    $('.dash-location-ad-search').on('click', function(e){
        e.preventDefault();
        let target = $(this).attr('data-target');

        $(target).slideToggle();

        if($(this).find('i').hasClass('fa-bars')){

            $(this).html("<i class='fa fa-close'></i>");

        }else{

            $(this).html("<i class='fa fa-bars'></i>");      

        }

    });
    // .on('blur', function(){
    //     let target = $(this).attr('data-target');
    //     $(target).slideUp();
    // })



</script>