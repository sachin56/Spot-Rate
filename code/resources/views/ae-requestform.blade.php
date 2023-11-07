@extends('layouts.app')

@section('content')

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Rate Request Form</h4>
        <p class="card-description"> Request Form </p>
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
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Destination</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="destination" placeholder="Destination">
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
              <input type="text" class="form-control" id="service" placeholder="Service">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Comment</label>
            <div class="col-sm-9">
              <textarea type="text" class="form-control" id="ae_comment" placeholder="Description"></textarea>
            </div>
          </div>
        </form>
        <div style="padding:right">
          <button type="button" class="btn btn-success submit" id="submit">Save changes</button>
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

    show_request_rate();

    // show_Books();
    $(document).on("click",".submit",function(){
        console.log('hi');
          var icpc_no =$("#icpc_no").val();
          console.log(icpc_no);
          empty_form();
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
                      db_error(data.db_error);
                    }

                    if(data.db_success){
                      db_success(data.db_success);
                      setTimeout(function(){
                        location.reload();
                    }, 2000);
                    }

                },
                error: function(jqXHR, exception) {
                    db_error(jqXHR.responseText);
                }
              });
        };
    });

});

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

function empty_form(){
    $("#hid").val("");
    $("#book_name").val("");
    $("#auther_name").val("");
    $("#stock").val("");
    $("#category_type").val("");
    $("#description").val("");
    $("#assign_user").val("");
}

function validation_error(error){
    for(var i=0;i< error.length;i++){
        Swal.fire({
        icon: 'error',
        title: 'Error',
        text: error[i],
        });
    }
}

function db_error(error){
    Swal.fire({
        icon: 'error',
        title: 'Database Error',
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