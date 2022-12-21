@extends('layouts.app')

@section('content')
<section class="searchsection">
         <div class="banner-main">
            <img src="images/banner.jpg" alt="#"/>
            <div class="container">
               <div class="text-bg">
                  <h1><strong class="blue"> World</strong ><br><strong class="white">Tour Management System</strong></h1>
                  <div class="button_section"> <a class="main_bt" href="{{url('/about')}}">Read More</a> </div>
                  <div class="container">
                     <!-- <form class="main-form"> -->
                        <div class="main-form">

                        
                        <h3>Find Your Tour</h3>
                        <div class="row">
                           <div class="col-md-9">
                              <div class="row">
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label >Keywords</label>
                                    <input class="form-control" placeholder="" type="text" name="" id="keysearch">
                                 </div>
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label >Category</label>
                                    <!-- <select class="form-control" name="Any" id="categorysearch">
                                       <option>Any</option>
                                       <option>Option 1</option>
                                       <option>Option 2</option>
                                       <option>Option 3</option>
                                    </select> -->
                                    <select class="form-control" name="Any" id="categorysearch">
                                    <option value="">Select Category</option>
                                        @foreach($cats as $catsid)
                                        
                                        <option value="{{ $catsid->id }}" >{{$catsid->cat_name}}</option>
                                        @endforeach
                                    </select>
                                 </div>
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label >Min Price</label>
                                    <input class="form-control" placeholder="00.0" type="text" name="00.0" id="minpricesearch">
                                 </div>
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label >Duration</label>
                                    <input class="form-control" placeholder="Any" id="durationsearch" type="text" name="Any">
                                 </div>
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label >Date</label>
                                    <input class="form-control" id="datesearch" placeholder="Any" type="date" name="Any">
                                 </div>
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label >Max Price</label>
                                    <input class="form-control" id="maxpricesearch" placeholder="00.0" type="text" name="00.0">
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                              <a id="confirmsearch">search</a>
                              <!-- <input type="submit" class="searchbtn" value="search" id="confirmsearch"> -->
                           </div>
                        </div>
                     <!-- </form> -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <div class="container">
            <div class="search_result row">

            </div>
      </div>
    <div class="main_wrap">
            <!-- about -->
        <div id="about" class="about">
            <div class="container">
                <div class="row">
                <div class="col-md-12 ">
                    <div class="titlepage">
                        <h2>About  our travel agency</h2>
                        <span> fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</span>
                    </div>
                </div>
                </div>
            </div>
            <div class="bg">
                <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="about-box">
                            <p> <span>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure thereThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there</span></p>
                            <div class="palne-img-area">
                            <img src="images/plane-img.png" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <a href="{{url('/about')}}">Read More</a>
            </div>
        </div>
        <!-- end about -->
        <!-- traveling -->
        <div id="travel" class="traveling">
            <div class="container">
                <div class="row">
                <div class="col-md-12 ">
                    <div class="titlepage">
                        <h2>Select Offers For Traveling</h2>
                        <span>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</span> 
                    </div>
                </div>
                </div>
                <div class="row">

                @php 
                    $categories = DB::table('categories')->get();
                @endphp

                @foreach($categories as $category)
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="traveling-box">
                        <i><img src="{{$category->cat_img}}" alt="icon"/></i>
                        <h3>{{$category->cat_name}}</h3>
                        <p> {{Str::limit($category->cat_des, 40, $end='...')}} </p>
                        <div class="read-more">
                            <a  href="{{url('/travel/'.$category->id)}}">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="traveling-box">
                        <i><img src="icon/travel-icon.png" alt="icon"/></i>
                        <h3>Different Countrys</h3>
                        <p> going to use a passage of Lorem Ipsum, you need to be </p>
                        <div class="read-more">
                            <a  href="#">Read More</a>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="traveling-box">
                        <i><img src="icon/travel-icon2.png" alt="icon"/></i>
                        <h3>Mountains Tours</h3>
                        <p> going to use a passage of Lorem Ipsum, you need to be </p>
                        <div class="read-more">
                            <a  href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="traveling-box">
                        <i><img src="icon/travel-icon3.png" alt="icon"/></i>
                        <h3>Bus Tours</h3>
                        <p> going to use a passage of Lorem Ipsum, you need to be </p>
                        <div class="read-more">
                            <a  href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="traveling-box">
                        <i><img src="icon/travel-icon4.png" alt="icon"/></i>
                        <h3>Summer Rest</h3>
                        <p> going to use a passage of Lorem Ipsum, you need to be </p>
                        <div class="read-more">
                            <a  href="#">Read More</a>
                        </div>
                    </div>
                </div> -->
                </div>
            </div>
        </div>
        <!-- end traveling -->
        <!--London -->
        <div class="London">
            <div class="container">
                <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Weekend in Zhengzhou, Henan China</h2>
                        <span>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</span> 
                    </div>
                </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="London-img">
                <figure><img src="images/London.jpg" alt="img"/></figure>
                </div>
            </div>
        </div>
    
        <!-- Destination Start -->
        <div class="container-fluid py-5">
            <div class="container pt-5 pb-3">
                <div class="text-center mb-3 pb-3">
                    <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Destination</h6>
                    <h1>Explore Top Destination</h1>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="img/destination-1.jpg" alt="">
                            <a class="destination-overlay text-dark text-decoration-none" href="">
                                <h5 class="text-dark">United States</h5>
                                <span>100 Cities</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="img/destination-2.jpg" alt="">
                            <a class="destination-overlay text-dark text-decoration-none" href="">
                                <h5 class="text-dark">United Kingdom</h5>
                                <span>100 Cities</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="img/destination-3.jpg" alt="">
                            <a class="destination-overlay text-dark text-decoration-none" href="">
                                <h5 class="text-dark">Australia</h5>
                                <span>100 Cities</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="img/destination-4.jpg" alt="">
                            <a class="destination-overlay text-dark text-decoration-none" href="">
                                <h5 class="text-dark">India</h5>
                                <span>100 Cities</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="img/destination-5.jpg" alt="">
                            <a class="destination-overlay text-dark text-decoration-none" href="">
                                <h5 class="text-dark">South Africa</h5>
                                <span>100 Cities</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="img/destination-6.jpg" alt="">
                            <a class="destination-overlay text-dark text-decoration-none" href="">
                                <h5 class="text-dark">Indonesia</h5>
                                <span>100 Cities</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Destination Start -->

      <!-- end London -->
      <!--Tours -->
      <div class="Tours">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>The Best Tours</h2>
                     <span>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</span> 
                  </div>
               </div>
            </div>
            <section id="demos">
               <div class="row">
                  <div class="col-md-12">
                     <div class="owl-carousel owl-theme">


                    @php 
                        $tours = DB::table('tours')->get();
                    @endphp

                    @foreach($tours as $tour)
                        <div class="item">
                           <div class="divimgres">
                           <img class="img-responsive resimg" height="100" src="{{$tour->tour_img}}" alt="#" />
                           </div>
                           <h3>{{$tour->tour_title}}</h3>
                           <p>{{Str::limit($tour->tour_des, 100, $end='...')}}</p>
                        </div>
                    @endforeach



                        
                        <!-- <div class="item">
                           <img class="img-responsive" src="images/1.jpg" alt="#" />
                           <h3>Holiday Tour</h3>
                           <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in soe suffk even slightly believable. If y be sure there</p>
                        </div>
                        <div class="item">
                           <img class="img-responsive" src="images/2.jpg" alt="#" />
                           <h3>GUANGZHOU</h3>
                           <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in soe suffk even slightly believable. If y be sure there</p>
                        </div>
                        <div class="item">
                           <img class="img-responsive" src="images/3.jpg" alt="#" />
                           <h3>London</h3>
                           <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in soe suffk even slightly believable. If y be sure there</p>
                        </div>
                        <div class="item">
                           <img class="img-responsive" src="images/2.jpg" alt="#" />
                           <h3>Holiday Tour</h3>
                           <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in soe suffk even slightly believable. If y be sure there</p>
                        </div> -->
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
      <!-- end Tours -->

      <!-- Amazing -->
      <div class="amazing">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="amazing-box">

                  @php 
                  $firsttour = DB::table('tours')->first();
                  @endphp
                     <h2>{{$firsttour->tour_title}}</h2>
                     <span>{{Str::limit($firsttour->tour_des, 200, $end='...')}}</span>
                     <a href="{{url('/tourpage/'.$firsttour->id)}}">Book Now</a><a href="{{url('/all-tours')}}">Get More</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end Amazing -->
      <!-- our blog -->
      <div id="blog" class="blog">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Our Blog</h2>
                     <span>Lorem Ipsum is that it has a more-or-less normal distribution of letters,</span> 
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                  <div class="blog-box">
                     <figure><img src="images/blog-image0.jpg" alt="#"/>
                        <span>4 Feb 2019</span>
                     </figure>
                     <div class="travel">
                        <span>Post  By :  Travel  Agency</span> 
                        <p><strong class="Comment"> 06 </strong>  Comment</p>
                        <p><strong class="like">05 </strong>Like</p>
                     </div>
                     <h3>Beijing Amazing Tour</h3>
                     <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web</p>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                  <div class="blog-box">
                     <figure><img src="images/blog-image.jpg" alt="#"/>
                        <span>10 Feb 2019</span>
                     </figure>
                     <div class="travel">
                        <span>Post  By :  Travel  Agency</span> 
                        <p><strong class="Comment"> 06 </strong>  Comment</p>
                        <p><strong class="like">05 </strong>Like</p>
                     </div>
                     <h3>Zhengzhou Amazing Tour</h3>
                     <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end our blog -->
</div>
@endsection

@section('script')
<script type="text/javascript">

    $('#confirmsearch').click(function(){
        var key = $('#keysearch').val();
        var minprice = $('#minpricesearch').val();
        var maxprice = $('#maxpricesearch').val();
        var category = $('#categorysearch').val();
        var duration = $('#durationsearch').val();
        var date = $('#datesearch').val();

        
        filterTour(key,minprice,maxprice,category,date,duration);
    })

// filterTour
    function filterTour(key,minprice,maxprice,category,date,duration){
       
                axios.post("/filterTour",{key:key,minprice:minprice,maxprice:maxprice,category:category,date:date, duration:duration}).then(function(response){
                    console.log(response.data);
                    var jsonData = response.data;

                    $('.search_result').html('');
                    $('.main_wrap').addClass('d-none');
                
                if (jsonData.length==0) {
                    $('<div class="col-lg-12 pb-1 removeClass" id="removeClass">').html(
                        "<div class='mainbox'><div class='msgnotfound'>Nothing Found <p>Let's go <a  class='homeredirect'>home</a> and try from there.</p></div></div>").appendTo('.search_result');
                }

                $('.homeredirect').click(function(){
                    window.location.href = '/'
                })

                $.each(jsonData, function(i, item){

                    var desc = item.tour_des;
                    if(desc.length > 60) desc = desc.substring(0,60)+'...';

                    // console.log(item);
                    $('<div class="col-lg-4 col-md-12 pb-1 removeClass" id="removeClass">').html(
                        "<div class='item'> <div class='divimgres'><img class='img-responsive resimg' src="+item.tour_img+" alt='#' /></div><h3>"+item.tour_title+"</h3><p>"+desc+"</p> <a href='{{url('/tourpage')}}/"+item.id+"' class='readmorebtn' data-id=" + item.id + ">Read More</a></div>"
                    ).appendTo('.search_result');

                });

                // edit modal open
            // $('.readmorebtn').click(function(e){
            //     e.preventDefault();
            //     const id = $(this).data('id');
            //     location.href = ""; 
            // });
                    
                }).catch(function(error){

                })
    }



</script>



@endsection