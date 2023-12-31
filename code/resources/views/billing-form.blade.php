@extends('layouts.app')

@section('content')

<div class="modal fade " id="modal" data-backdrop="false" style="overflow: auto !important">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
            <div class="modal-header bg-white">
                <h4 class="modal-title" >Add Credit Note</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white">
                <form  id="myForm" enctype="multipart/form-data">
                    <input type="hidden" id="hid" name="hid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ICPC No</label>
                                <input type="text" class="form-control" name="icpc_no" id="icpc_no"
                                    placeholder="Enter ICPC No" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mount Code</label>
                                <input type="text" class="form-control" name="mount_code" id="mount_code"
                                    placeholder="Enter Mount Code" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Weight</label>
                                <input type="text" class="form-control" name="weight" id="weight"
                                    placeholder="Enter Weight" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Country</label>
                              <input type="text" class="form-control" name="destination" id="destination"
                                  placeholder="Enter Country" readonly>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Requested Rate</label>
                              <input type="text" class="form-control" name="ae_rate" id="ae_rate"
                                  placeholder="Enter Requested Rate" readonly>
                          </div>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-md-6">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Service</label>
                        <div class="col-sm-9">
                        <select class="form-control" id="service" readonly>
                            <option value="0">Select Service</option>
                            <option value="1">Inbound / IP</option>
                            <option value="2">Inbound / IPF</option>
                            <option value="3">Outbound / IP</option>
                            <option value="4">Outbound / IPF</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>AWB</label>
                            <input type="text" class="form-control" name="awb" id="awb"
                                placeholder="Enter AWB" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>AE Comment</label>
                            <textarea type="text" class="form-control" name="ae_comment" id="ae_comment" placeholder="Enter Comment" readonly></textarea>
                        </div>
                    </div>
                  </div>
                  <hr>
                  <h3 align="center">Pricing</h3>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Rate Offer</label>
                            <input type="text" class="form-control" name="offer_rate" id="offer_rate"
                                placeholder="Enter Offer Rate" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Pricing Comment</label>
                            <textarea type="text" class="form-control" name="pricing_comment" id="pricing_comment" placeholder="Enter Comment" readonly></textarea>
                        </div>
                    </div>
                  </div>
                </form>
            </div>
          <div class="modal-footer bg-white">
            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-dark"></h1>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Main</a></li>
              <li class="breadcrumb-item active">Biiling</li>
            </ol>
          </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if (Auth::guard('admin')->check())
                <div class="card-header">
                    <a type="buttton" class="btn btn-outline-success addNew" href="{{route('admin.export')}}"> Export All Detail</a>
                </div>
                @else
                    <div class="card-header">
                        <a type="buttton" class="btn btn-outline-success addNew" href="{{route('export')}}"> Export All Detail</a>
                    </div>
                @endif
                <div class="card-body">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Weight</th>
                                <th>Country</th>
                                <th>Stage</th>
                                <th>Pricing Status</th>
                                <th>AE Status</th>
                                <th>AE</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
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
        //datatable show
        show_request_rate();

        //complain edit
        $(document).on("click", ".edit", function(){
            var id = $(this).attr('data');

            empty_form();
            
            $("#hid").val(id);
            
            $("#modal").modal('show');
            $(".modal-title").html('Update Request Form');
            // description_app ();
            $.ajax({
                'type': 'ajax',
                'dataType': 'json',
                'method': 'get',
                'url': 'ae-requestform/'+id,
                'async': false,
                success: function(data){
                    console.log(data);
                    $("#icpc_no").val(data.icpc_no);
                    $("#mount_code").val(data.mount_code);
                    $("#weight").val(data.weight);
                    $("#company_name").val(data.company_name);
                    $("#destination").val(data.destination);
                    $("#ae_rate").val(data.ae_rate);
                    $("#service").val(data.service);
                    $("#ae_comment").html(data.ae_comment);
                    $("#awb").val(data.awb);
                    $("#offer_rate").val(data.rate_offer);
                    $("#pricing_comment").html(data.pricing_comment);
                }
            });
            //user button click submit data to controller
            $("#submit").click(function(){

                if($("#hid").val() != ""){
                    var id =$("#hid").val();
                    console.log(id);
                    var offer_rate =$("#offer_rate").val();
                    var pricing_comment =$("#pricing_comment").val();
                    var status ='0';

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
                                    'data' : {offer_rate:offer_rate,pricing_comment:pricing_comment,status:status,id:id},
                                    'url': 'pricing-form',
                                    'async': false,
                                    success:function(data){
                                    if(data.validation_error){
                                        validation_error(data.validation_error);//if has validation error call this function
                                        }

                                        if(data.db_error){
                                        db_error(data.db_error);
                                        }

                                        if(data.db_success){
                                        toastr.success(data.db_success);
                                        setTimeout(function(){
                                            $("#modal").modal('hide');
                                            location.reload();
                                        }, 2000);
                                        }
                                    },
                                });
                            }
                        });
                }
            });
            $("#submitreject").click(function(){

            if($("#hid").val() != ""){
                var id =$("#hid").val();
                console.log(id);
                var offer_rate =$("#offer_rate").val();
                var pricing_comment =$("#pricing_comment").val();
                var status ='1';

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
                                'data' : {offer_rate:offer_rate,pricing_comment:pricing_comment,status:status,id:id},
                                'url': 'pricing-form',
                                'async': false,
                                success:function(data){
                                if(data.validation_error){
                                    validation_error(data.validation_error);//if has validation error call this function
                                    }

                                    if(data.db_error){
                                    db_error(data.db_error);
                                    }

                                    if(data.db_success){
                                    toastr.success(data.db_success);
                                    setTimeout(function(){
                                        $("#modal").modal('hide');
                                        location.reload();
                                    }, 2000);
                                    }
                                },
                            });
                        }
                    });
            }
            });
        });   

        $(document).on("click", ".delete", function(){
            var id = $(this).attr('data');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            'type': 'ajax',
                            'dataType': 'json',
                            'method': 'delete',
                            'url': 'ae-requestform/'+id,
                            'async': false,
                            success: function(data){

                            if(data){
                                toastr.success('Rate Deleted');
                                setTimeout(function(){
                                location.reload();
                                }, 2000);

                            }

                            }
                        });

                    }
            });

        });


    });

    //Data Table show
    function show_request_rate(){

        $('#datatable').DataTable().clear();
        $('#datatable').DataTable().destroy();

        $("#datatable").DataTable({
            'processing': true,
            'serverSide': true,
            "bLengthChange": false,
            "autoWidth": false,
            "recordsFiltered": 28,
            "columnDefs": [ {
                    "targets": 7,
                    "format": 'D MMM YYYY ',
            } ],
            'ajax': {
                        'method': 'get',
                        'url': 'billing-form/create',
                    },        
            'columns': [
                {data: "company_name"},
                {data: "weight"},
                {data: "destination"},
                {
                    data: null,
                    render: function(d){
                        var html = "";
                        if(d.staus==0){
                            html+='&nbsp;&nbsp;<label class="badge badge-warning"><b>Pricing</b></label>&nbsp;&nbsp;</br>';
                        }else if(d.staus == 1){
                            html+='&nbsp;&nbsp;<label class="badge badge-info"><b>AE</b></label>&nbsp;&nbsp;</br>';
                        }else{
                            html+='&nbsp;&nbsp;<label class="badge badge-success"><b>Submitted</b></label>&nbsp;&nbsp;</br>';
                        }
                        return html;

                    }

                },
                {
                    data: null,
                    render: function(d){
                        var html = "";
                        if(d.pricing_status == 0){
                            html+='&nbsp;&nbsp;<label class="badge badge-primary"><b>Approved</b></label>&nbsp;&nbsp;</br>';
                        }else if(d.pricing_status == 1){
                            html+='&nbsp;&nbsp;<label class="badge badge-danger"><b>Rejected</b></label>&nbsp;&nbsp;</br>';
                        }else{
                            html+='&nbsp;&nbsp;<label class="badge badge-warning"><b>Pending</b></label>&nbsp;&nbsp;</br>';
                        }
                        return html;

                    }

                },
                {
                    data: null,
                    render: function(d){
                        var html = "";
                        if(d.ae_status == 0){
                            html+='&nbsp;&nbsp;<label class="badge badge-info"><b>Close Won</b></label>&nbsp;&nbsp;</br>';
                        }else if(d.ae_status == 1){
                            html+='&nbsp;&nbsp;<label class="badge badge-danger"><b>Close Lost</b></label>&nbsp;&nbsp;</br>';
                        }else{
                            html+='&nbsp;&nbsp;<label class="badge badge-warning"><b>Pending</b></label>&nbsp;&nbsp;</br>';
                        }
                        return html;

                    }

                },
                {data:"username"},
                {data:"created_at"},
                {
                    data: null,
                    render: function(d){
                        var html = "";
                        html+="&nbsp;&nbsp;<td><button class='btn btn-primary btn-sm edit' data='"+d.id+"' title='Edit'><i class='fas fa-arrow-alt-circle-left'></i></i></button>";
                            @if(Auth::guard('admin')->check())
                                html+="&nbsp;<button class='btn btn-danger btn-sm delete' data='"+d.id+"'title='Delete'><i class='fas fa-trash'></i></button>";
                            @endif
                        return html;

                    }

                }
            ]
        });
    }

        function empty_form(){
        
        $("#reference_no").val("");
        $("#customer_name").val("");
        $("#credit_note_amount").val("");
        $("#add_invove_no").val("");
        $("#awb").val("");
        $("#calculation").val("");
        $("#credit_note_reasone").val("");
        $("#crm_description").val("");
        $("#credit_date").val("");
        $("#credit_status").val("");
        $("#credit_issue").val("");
        $("#credit_note_cost").val("");
        $("#responsibale_persone").val("");
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