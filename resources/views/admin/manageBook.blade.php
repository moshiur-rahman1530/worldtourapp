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
              <th class="th-sm">User Name</th>
              <th class="th-sm">Email</th>
              <th class="th-sm">Price</th>
              <th class="th-sm">Duration</th>
              <th class="th-sm">Book Date</th>
              <th class="th-sm">Tour Date</th>
          	  <th class="th-sm">Status</th>
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

@endsection
@section('script')
<script type="text/javascript">


getAllTours();

function getAllTours(){
  axios.get('/managetourbook').then(function(response){

    if (response.status==200) {
        $('#TourMainDiv').removeClass('d-none');
        $('#loaderTourDiv').addClass('d-none');

        $('#TourDataTable').DataTable().destroy();
        $('#TourTableBody').empty();

        var data = response.data;

        

        $.each(data, function(i, item){

            console.log(item.user.name);

            if (data[i].status==1) {
                var status= 'Make Cancel';
                var finalStatus = "<a class='catStatusBtns btn btn-sm btn-success' data-id=" + data[i].id + ">"+ status +"</a>"
            }else{
                  var status= 'Make Confirm';
                   var finalStatus = "<a class='catStatusBtns btn btn-sm btn-danger' data-id=" + data[i].id + ">"+ status +"</a>"
            }

            // console.log(JSON.parse(data[i].product_img));

          $('<tr>').html(
            "<td>"+data[i].id+"</td>"+
            "<td><img class='table-img' src=" + data[i].tour_img + "></td>"+
            "<td>"+data[i].tour_name+"</td>"+
            "<td>"+data[i].user.name+"</td>"+
            "<td>"+data[i].user.email+"</td>"+
            "<td>"+data[i].price+"</td>"+
            "<td>"+data[i].duration+"</td>"+
            "<td>"+data[i].book_date+"</td>"+
            "<td>"+data[i].tour_date+"</td>"+
            "<td>"+finalStatus+"</td>" +
            "<td><a  class='PeroductDeleteBtn'  data-id=" + data[i].id +" ><i class='fas fa-trash-alt'></i></a></td>"
          ).appendTo('#TourTableBody');
        });


        // change status click
        $('.catStatusBtns').click(function(){
                var id = $(this).data('id');
                cnangeTourStatus(id);
            });

       
        // delete product modal show
        $('.PeroductDeleteBtn').click(function(){
          var id = $(this).data('id');
          $('#deleteModalTourId').html(id);
          $('#deleteTourModal').modal('show');
        })

       


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
  axios.post('/tourBookStatus',{
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


$('#TourDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalTourId').html();
  $('#TourDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/bookTourDelete',{
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


</script>
@endsection
