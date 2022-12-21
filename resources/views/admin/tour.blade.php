@extends('admin.layouts.app')
@section('title','Tour')
@section('content')
<div id="TourMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Tour Lists</h6></div>
      <div class="col-md-6"> <button id="addNewTour" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fas fa-plus"></i> Add New</button></div>
    </div>

      <div class="table-responsive" style="overflow-x:auto;">
        <table id="TourDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
          	  <th class="th-sm" width="2%">ID</th>
                <th class="th-sm">Image</th>
              <th class="th-sm">Title</th>
          	  <th class="th-sm">Description</th>
              <th class="th-sm">Category</th>
              <th class="th-sm">Price</th>
              <th class="th-sm">Duration</th>
              <th class="th-sm">Date</th>
          	  <th class="th-sm">Status</th>
          	  
          	  <th class="th-sm">Edit</th>
          	  <th class="th-sm">Delete</th>
            </tr>
          </thead>
          <tbody id="TourTableBody">

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div id="loaderTourDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongTourDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete course -->
<div class="modal fade" id="deleteTourModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
         <h5 class="modal-title" id="deleteModalTourId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this product!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="TourDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for adding product -->
<div class="modal fade" id="addTourModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title text-center">Add New Tour</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
       <div class="container">
         <div class="row">
           <div class="col-md-6 col-12">

             <input id="TourtitleId" type="text" class="form-control mb-3" placeholder="Tour title">
             <textarea id="TourDesId" rows="5" class="form-control mb-3" placeholder="Tour Description"></textarea>

             <select id="TourCatSelect" class="w-100 mb-3" style="height:36px" name="Category">
               <option value="">Select Category</option>
               @foreach($cats as $cat)
               <option value="{{ $cat->id }}" >{{$cat->cat_name}}</option>
               @endforeach
             </select>

             <input type="text" name="price" id="tourPrice" class="form-control mb-3" placeholder="Tour Price">
             
           </div>
           <div class="col-md-6 col-12">

           <input type="date" name="date" class="form-control mb-3" placeholder="mm/dd/yyyy" id="tourdate">

           <input type="text" name="price" class="form-control mb-3" id="tourDuration" placeholder="Tour Duration">
             
             <!-- select status -->
             <select name="status" id="status" class="status form-control">
              <option value="0">Inactive</option>
              <option value="1">Active</option>
             </select>

              <div class="my-2 text-start-important">
                <input class="form-check-input form-control" name='is_featured' type="checkbox" value="1" id="is_featured" checked>
                <label class="form-check-label" for="is_featured">
                Is Featured
                </label>
              </div>
            <input class="form-control mb-3" class="form-control mb-3" type="file" name="img" id="TourImg">
            <img id="TourImagePreview" src="https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png" alt="your image" class="img-fluid m-3" />
           </div>
           <!-- <div id="image_preview"></div> -->
          </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="TourAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for update Tour -->
<div class="modal fade" id="updateTourModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Tour</h5>
        <h5 id="UpdateTourId"> </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateTourLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongTourUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateTourModalDNone">

       <div class="container">
        <div class="row">
                <div class="col-md-6 col-12">

                    <input id="TourUpdatetitleId" type="text" class="form-control mb-3" placeholder="Tour title">
                
                    <textarea id="TourUpdateDesId" rows="5" class="form-control mb-3" placeholder="Tour Description"></textarea>
                

                    <select id="TourUpdateCatSelect" class="w-100 mb-3" style="height:36px" name="Category">
                    <option value="">Select Category</option>
                    @foreach($cats as $catsid)
                    
                    <option value="{{ $catsid->id }}" >{{$catsid->cat_name}}</option>
                    @endforeach
                    </select>

                    <input type="text" name="price" id="tourUpdatePrice" class="form-control mb-3" placeholder="Tour Price">

                    

                </div>
                <div class="col-md-6 col-12">
                    

                <input type="date" name="date" class="form-control mb-3" placeholder="mm/dd/yyyy" id="tourUpdatedate">

                <input type="text" name="duration" class="form-control mb-3" id="tourUpdateDuration" placeholder="Tour Duration">

                    <!-- select status -->
                    <select name="status" id="TourUpdatestatus" class="status form-control">
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                    </select>


                    <div class="my-2 text-start-important">
                        <input class="form-check-input form-control" name='is_featured' type="checkbox" value="1" id="Updateis_featured" checked>
                        <label class="form-check-label" for="is_featured">
                        Is Featured
                        </label>
                    </div>

                    <input class="form-control mb-3" class="form-control mb-3" type="file" name="img" id="TourUpdateImg">
                    <img id="Update_image_preview" src="" alt="your image" class="img-fluid m-3" />
                </div>
                
               
           </div>
        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="TourUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script type="text/javascript">


// add new product
$('#addNewTour').click(function(){
  $('#addTourModal').modal('show');
})


$('#TourAddConfirmBtn').click(function(){
  var ptitle = $('#TourtitleId').val();
  var pDes = $('#TourDesId').val();
  var pCat = $('#TourCatSelect').val();
  var pImg =$('#TourImg')[0].files[0];
  var feature = $('#is_featured').val();
  var price = $('#tourPrice').val();
  var date = $('#tourdate').val();
  var duration = $('#tourDuration').val();
  var status = $('#status').val();
  addTour(ptitle,pDes,pCat,pImg,feature,price,date,duration,status);
})


function addTour(ptitle,pDes,pCat,pImg,feature,price,date,duration,status) {
  $('#TourAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

  var form_data = new FormData(); 
  form_data.append("tour_title", ptitle);
  form_data.append("tour_cat", pCat);
  form_data.append('tour_img',pImg);
  form_data.append("tour_des", pDes);
  form_data.append("is_featured", feature);
  form_data.append("price", price);
  form_data.append("duration", duration);
  form_data.append("status", status);
  form_data.append("date", date);

  axios.post('/admin/tour', form_data).then(function(response){
    $('#TourAddConfirmBtn').html("Save");
    if (response.status==200) {
        if (response.data==1) {
          $('#addTourModal').modal('hide');
          $('#image_preview').html('');
          $('#TourtitleId').val('');
          $('#TourDesId').val('');
          $('#TourCatSelect').val('');
          $('#TourImg').val('');
        //   $('#is_featured').val('');
          $('#tourPrice').val('');
          $('#tourdate').val('');
          $('#tourDuration').val('');


          toastr.success('Tour Add successfully!!');
          getAllTours();
        }else{
          $('#addTourModal').modal('hide');
          toastr.error('Tour Add Fail!!');
          getAllTours();
        }
    } else {
      $('#addTourModal').modal('hide');
      toastr.error('Tour Add Fail!!');
    }
  }).catch(function(error){
    $('#addTourModal').modal('hide');
    toastr.error('Something Went Wrong!!');
  })
}
getAllTours();

function getAllTours(){
  axios.get('/alltour').then(function(response){

    if (response.status==200) {
        $('#TourMainDiv').removeClass('d-none');
        $('#loaderTourDiv').addClass('d-none');

        $('#TourDataTable').DataTable().destroy();
        $('#TourTableBody').empty();

        var data = response.data;

        $.each(data, function(i, item){

          var desc = data[i].tour_des;
              if(desc.length > 60) desc = desc.substring(0,60)+'...';

            if (data[i].status==1) {
                var status= 'Active';
                var finalStatus = "<a class='catStatusBtns btn btn-sm btn-success' data-id=" + data[i].id + ">"+ status +"</a>"
            }else{
                  var status= 'Inactive';
                   var finalStatus = "<a class='catStatusBtns btn btn-sm btn-danger' data-id=" + data[i].id + ">"+ status +"</a>"
            }

            // console.log(JSON.parse(data[i].product_img));

          $('<tr>').html(
            "<td>"+data[i].id+"</td>"+
            "<td><img class='table-img' src=" + data[i].tour_img + "></td>"+
            "<td>"+data[i].tour_title+"</td>"+
            "<td>"+desc+"</td>"+
            "<td>"+data[i].tour_cat+"</td>"+
            "<td>"+data[i].price+"</td>"+
            "<td>"+data[i].duration+"</td>"+
            "<td>"+data[i].date+"</td>"+
            "<td>"+finalStatus+"</td>" +
            "<td><a  class='PeroductEditBtn' data-id=" + data[i].id + "><i class='fas fa-edit'></i></a></td>" +
            "<td><a  class='PeroductDeleteBtn'  data-id=" + data[i].id +" ><i class='fas fa-trash-alt'></i></a></td>"
          ).appendTo('#TourTableBody');
        });


        // change status click
        $('.catStatusBtns').click(function(){
                var id = $(this).data('id');
                cnangeTourStatus(id);
            });

        // add attribute modal show
        $('.PeroductAddAttrBtn').click(function(){
          var id = $(this).data('id');
          $('#AttrTourModalId').val(id);
          $('#AttrTourModal').modal('show');
        })
        // delete product modal show
        $('.PeroductDeleteBtn').click(function(){
          var id = $(this).data('id');
          $('#deleteModalTourId').html(id);
          $('#deleteTourModal').modal('show');
        })

        // edit modal open
        $('.PeroductEditBtn').click(function(){
                $('#updateTourModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateTourId').html(id);
                updateTourDetails(id);
            });



        $('#TourDataTable').DataTable({"order":false});
        $('.dataTables_length').addClass('bs-select');

    } else {
      $('#loaderTourDiv').addClass('d-none');
      $('#WrongTourDiv').removeClass('d-none');
    }
  }).catch(function(error){
    $('#loaderTourDiv').addClass('d-none');
    $('#WrongTourDiv').removeClass('d-none');
  })
}


// status update
function cnangeTourStatus(id){
  axios.post('/tourStatus',{
    id:id
  }).then(function(response){
    if (response.status==200) {
      if (response.data==1) {
        toastr.success('Tour Status Change!!');
        getAllTours();
      } else {
        toastr.error('Tour Status Change fail!!');
        getAllTours();
      }
    } else {
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    toastr.error(error);
  })
}

// update deatils product fetch
function updateTourDetails(id){
  axios.post('/tourDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateTourModalDNone').removeClass('d-none');
            $('#UpdateTourLoader').addClass('d-none');
            var jsonData = response.data;
            console.log(jsonData);
            $('#TourUpdatetitleId').val(jsonData[0].tour_title);
            $('#TourUpdateDesId').val(jsonData[0].tour_des);
            $('#TourUpdateCatSelect').val(jsonData[0].tour_cat);
            $('#tourUpdatePrice').val(jsonData[0].price);
            // $('#tourUpdatedate').datepicker("setDate",jsonData[0].date);
            $('#tourUpdatedate').val(jsonData[0].date);
            $('#tourUpdateDuration').val(jsonData[0].duration);
            $('#TourUpdatestatus').val(jsonData[0].status);
            $('#Updateis_featured').val(jsonData[0].is_featured);
            // console.log(imgData);

            $('#Update_image_preview').attr('src',jsonData[0].tour_img);

           
           

        } else{
          $('#UpdateTourLoader').addClass('d-none');
          $('#WrongTourUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateTourLoader').addClass('d-none');
    $('#WrongTourUpdate').removeClass('d-none');
  })
 }




 //  update confirm

$('#TourUpdateConfirmBtn').click(function(){
  var id = $('#UpdateTourId').html();
  var updareTourTitle =  $('#TourUpdatetitleId').val();
  var description = $('#TourUpdateDesId').val();
  var productcat = $('#TourUpdateCatSelect').val();
  var tourUpdatePrice = $('#tourUpdatePrice').val();
  var tourUpdateDuration = $('#tourUpdateDuration').val();
  var tourUpdatedate = $('#tourUpdatedate').val();
  var status = $('#TourUpdatestatus').val();
  var isFeatured = $('#Updateis_featured').val();
  var tourupdateimage =$('#TourUpdateImg')[0].files[0];
  
  var form_data = new FormData(); 
  
  form_data.append("tour_title", updareTourTitle);
  form_data.append("tour_des", description);
  form_data.append("id", id);
  form_data.append("status", status);
  form_data.append("tour_cat", productcat);
  form_data.append("price", tourUpdatePrice);
  form_data.append("duration", tourUpdateDuration);
  form_data.append("img", tourupdateimage);
  form_data.append("is_featured", isFeatured);
  form_data.append("date", tourUpdatedate);
  

  
   $('#TourUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateTour', form_data).then(function(response){
          $('#TourUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#updateTourModal').modal('hide');
                toastr.success('Update Barnd Success');
              getAllTours();
            } else {
                $('#updateTourModal').modal('hide');
                toastr.error('Update Barnd Fail');
              getAllTours();
            }
          }
          else{
            $('#updateTourModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#updateTourModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})



$('#TourDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalTourId').html();
  $('#TourDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/tourDelete',{
    id:id
  }).then(function(response){
    $('#TourDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteTourModal').modal('hide');
        toastr.success('Tour delete successfully!!');
        getAllTours();
      } else {
        $('#deleteTourModal').modal('hide');
        toastr.error('Tour delete fail!!');
        getAllTours();
      }
    } else {
      $('#deleteTourModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteTourModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})


TourImg.onchange = evt => {
  const [file] = TourImg.files
  if (file) {
    TourImagePreview.src = URL.createObjectURL(file)
  }
}
TourUpdateImg.onchange = evt => {
  const [file] = TourUpdateImg.files
  if (file) {
    Update_image_preview.src = URL.createObjectURL(file)
  }
}





</script>
@endsection
