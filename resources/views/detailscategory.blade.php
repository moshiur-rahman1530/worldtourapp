@extends('layouts.app')

@section('content')


 <!--Tours -->
 <div class="Tours">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Details For : {{$data->cat_name}}</h2>
                     
                  </div>
               </div>
            </div>
            <section id="demos">
               <div class="row text-center">
                  <div class="col-md-12">
                     
                        <div class="item">
                           <div class="detailsimage mb-3">
                              <img class="img-responsive img-fluid" src="{{$data->cat_img}}" alt="#" />
                           </div>
                           <h3>{{$data->cat_name}}</h3>
                          
                           <p>Description:</p>
                           <p>{{$data->cat_des}}</p>
                        </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
      <!-- end Tours -->


@endsection

@section('script')
<script type="text/javascript">

    


</script>



@endsection