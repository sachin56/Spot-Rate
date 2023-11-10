@extends('layouts.app')

@section('content')

{{-- Request Form --}}
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Rate Request Form</h4>
        <form  id="myForm" enctype="multipart/form-data">
          <input type="hidden" id="hid" name="hid">
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">ICPC No</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="icpc_no" name="icpc_no" placeholder="ICPC No">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Mount Code</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="mount_code" placeholder="Mount Code">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Weight</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="weight" placeholder="Weight">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Company Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="company_name" placeholder="Company Name">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Country</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="destination" placeholder="Country">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Rate Request</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="ae_rate" placeholder="Rate Request">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Service</label>
            <div class="col-sm-9">
              <select class="form-control" id="service">
                <option value="0">Select Service</option>
                <option value="1">Inbount / IP</option>
                <option value="2">Inbount / IPF</option>
                <option value="3">Outbound / IP</option>
                <option value="4">Outbound / IPF</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Comment</label>
            <div class="col-sm-9">
              <textarea type="text" class="form-control" id="ae_comment" name="ae_comment" placeholder="Description"></textarea>
            </div>
          </div>
        </form>
        <div align="right">
          <button type="button" class="btn btn-outline-primary submit" id="submit">Submit</button>
        </div>
      </div>
    </div>
  </div>
<script>
$(document).ready(function(){
  
    //csrf token error
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //when have document ready show tables
    show_request_rate();

    // Submit data in backend
    $(document).on("click",".submit",function(){
        var hid = $("#hid").val();
          //save Category
        if(hid == ""){
              var icpc_no =$("#icpc_no").val();
              var mount_code =$("#mount_code").val();
              var weight =$("#weight").val();
              var company_name =$("#company_name").val();
              var destination =$("#destination").val();
              var ae_rate =$("#ae_rate").val();
              var service =$("#service").val();
              var ae_comment =$("#ae_comment").val();

              Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Update it!'
              }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                    'type': 'ajax',
                    'dataType': 'json',
                    'method': 'post',
                    'data' : {icpc_no:icpc_no,mount_code:mount_code,weight:weight,company_name:company_name,destination:destination,ae_rate:ae_rate,service:service,ae_comment:ae_comment},
                    'url' : 'ae-requestform/store',
                    'async': false,
                    success:function(data){
                        if(data.validation_error){
                        validation_error(data.validation_error);//if has validation error call this function
                        }

                        if(data.db_error){
                        db_error(data.db_error);//if db error happend
                        }

                        if(data.db_success){
                          //form empty
                          empty_form();
                          toastr.success(data.db_success);//if data save
                          setTimeout(function(){
                              location.reload();//after data save reload
                          }, 2000);
                        }

                    },
                    error: function(jqXHR, exception) {
                        db_error(jqXHR.responseText);
                  }
                });
              }
          });
        };
    });

});
  //show datatables
    function show_request_rate(){

        $('#datatable').DataTable().clear();
        $('#datatable').DataTable().destroy();

        $("#datatable").DataTable({
            'processing': true,
            'serverSide': true,
            "bLengthChange": false,
            "autoWidth": false,
            "recordsFiltered": 28,
            'ajax': {
                        'method': 'get',
                        'url': 'ae-requestform/create',
                    },
            'columns': [
                {data: "icpc_no"},
                {data: "mount_code"},
                {data: "company_name"},
                {data: "weight"},
                {data: "destination"},
                {data: "ae_rate"},
                {
                    data: null,
                    render: function(d){
                        var html = "";
                        html+="&nbsp;<button class='btn btn-danger btn-sm delete' data='"+d.id+"'title='Delete'><i class='fas fa-trash'></i></button>";
                        html+="&nbsp;<a class='btn btn-success btn-sm' href='{{ url('credit_note_attachment/download/') }}/"+d.id+"'  'title='File Download'><i class='fas fa-download'></i></a>";
                        return html;

                    }

                }
            ]
        });
    }
    //after submit emty form
  function empty_form(){
    
      $("#hid").val("");
      $("#icpc_no").val("");
      $("#mount_code").val("");
      $("#destination").val("");
      $("#ae_rate").val("");
      $("#service").val("");
      $("#ae_comment").val("");
  }
  //if have validation error triger these things
  function validation_error(error){
      for(var i=0;i< error.length;i++){
          Swal.fire({
          icon: 'error',
          title: 'Error',
          text: error[i],
          });
      }
  }
  //f nackend have db error
  function db_error(error){
      Swal.fire({
          icon: 'error',
          title: 'Some Error Happend while Saving',
          text: error,
      });
  }

  function db_success(message){
      Swal.fire({
          icon: 'success',
          title: 'Success',
          text: message,
      });
  }
</script>
@endsection