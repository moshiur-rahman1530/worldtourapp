@extends('layouts.app')

@section('content')


 <!--Tours -->
 <div class="Tours">
         <div class="container">
                  <div class="titlepage">
                     <h2>All Tour Package List</h2>
                     
                  </div>


                  <div class="row">
                     @foreach($tours as $tour)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1 removeClass mb-3" id="removeClass">
                              <div class="item text-center text-md-left"> 
                                 <div class="divimgres">
                                    <img class="img-responsive resimg" src="{{$tour->tour_img}}" alt="#" />
                                 </div>
                                 <h3>
                                    {{$tour->tour_title}}
                                 </h3>
                                 <p>
                                    {{Str::limit($tour->tour_des, 200, $end='...')}}
                                 </p> 
                                 <a href="{{url('/tourpage/'.$tour->id)}}" class="readmorebtn">Read More</a>
                              </div>
                        </div>
                     @endforeach
                  </div>
         </div>
   </div>
          
      <!-- end Tours -->


@endsection

@section('script')
<script>


</script>



@endsection