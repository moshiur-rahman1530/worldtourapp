@extends('layouts.app')

@section('content')


 <!--Tours -->
 <div class="Tours">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Details For : {{$data->tour_title}}</h2>
                     
                  </div>
               </div>
            </div>
            <section id="demos">
               <div class="row">
                  <div class="col-md-12">
                     
                        <div class="item detailtourstyle">
                           <div class="detailsimage mb-3">
                              <img class="img-responsive img-fluid" src="{{$data->tour_img}}" alt="#" />
                           </div>
                           <h3>{{$data->tour_title}}</h3>
                           <p>Price: {{$data->price}}</p>
                           <p>Duration: {{$data->duration}}</p>
                           
                           <p>Travel Posible Date: {{$data->date}}</p>
                           <p>Description:</p>
                           <p>{{$data->tour_des}}</p>


                          <div class="bookContainer">
                              <a id="bookTour" data-id="{{$data->id}}" class="bookTour mr-4">Book Now</a><a href="{{url('/all-tours')}}" class="bookTour">Get More</a>
                              <!-- <a href="{{url('/bookTour/'.$data->id)}}" id="bookTour" data-id="{{$data->id}}" class="bookTour mr-4">Book Now</a><a href="#" class="bookTour">Get More</a> -->
                          </div>
                           
                        </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
      <!-- end Tours -->


@endsection

@section('script')
<script>

$(document).ready(function() {
   $('#bookTour').click(function(e){
      e.preventDefault();
      const id = $(this).data('id');
      const url = `/bookTour/${id}`;
      axios.get(url).then(function(response){
         if (response.data==1) {
            toastr.success('You Successfully Booked Tour.');
         } else if(response.data==2) {
            toastr.warning('Already booked this tour.')
         }else {
            toastr.error('Failled.')
         }
            
      }).catch(function(error){
         console.log(error);
      })
   })
})

</script>



@endsection