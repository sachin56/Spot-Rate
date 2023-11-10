@extends('layouts.app')

@section('content')

<div class="modal fade " id="modal" data-backdrop="false" style="overflow: auto !important">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
            <div class="modal-header bg-white">
                <h4 class="modal-title">Add Credit Note</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                    placeholder="Enter ICPC No">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mount Code</label>
                                <input type="text" class="form-control" name="mount_code" id="mount_code"
                                    placeholder="Enter Mount Code">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Weight</label>
                                <input type="text" class="form-control" name="weight" id="weight"
                                    placeholder="Enter Weight">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name">
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Desination Of Package</label>
                              <input type="text" class="form-control" name="destination" id="destination"
                                  placeholder="Enter Desination Of Package">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Requested Rate</label>
                              <input type="text" class="form-control" name="ae_rate" id="ae_rate"
                                  placeholder="Enter Requested Rate">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Service</label>
                            <select class="form-control" id="service">
                                <option value="0">Select Service</option>
                                <option value="1">Inbount / IP</option>
                                <option value="2">Inbount / IPF</option>
                                <option value="3">Outbound / IP</option>
                                <option value="4">Outbound / IPF</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-12">
                        <div class="form-group">
                            <label>AE Comment</label>
                            <textarea type="text" class="form-control" name="ae_comment" id="ae_comment" placeholder="Enter Comment"></textarea>
                        </div>
                    </div>
                  </div>
                </form>
            </div>
          <div class="modal-footer bg-white">
            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-outline-success submit" id="submit">Save changes</button>
          </div>
      </div>
    </div>
</div>

<div class="modal fade " id="modal_ae" data-backdrop="false" style="overflow: auto !important">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
            <div class="modal-header bg-white">
                <h4 class="modal-title-ae">Add Credit Note</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                <input type="text" class="form-control" name="icpc_no_ae" id="icpc_no_ae"
                                    placeholder="Enter ICPC No">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mount Code</label>
                                <input type="text" class="form-control" name="mount_code_ae" id="mount_code_ae"
                                    placeholder="Enter Mount Code">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Weight</label>
                                <input type="text" class="form-control" name="weight_ae" id="weight_ae"
                                    placeholder="Enter Weight" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" name="company_name_ae" id="company_nam_ae" placeholder="Enter Company Name" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Country</label>
                              <input type="text" class="form-control" name="destination_ae" id="destination_ae"
                                  placeholder="Enter Country" readonly>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Requested Rate</label>
                              <input type="text" class="form-control" name="ae_rate_ae" id="ae_rate_ae"
                                  placeholder="Enter Requested Rate" readonly>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Service</label>
                            <select class="form-control" id="service_ae" readonly>
                                <option value="0">Select Service</option>
                                <option value="1">Inbount / IP</option>
                                <option value="2">Inbount / IPF</option>
                                <option value="3">Outbound / IP</option>
                                <option value="4">Outbound / IPF</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-12">
                        <div class="form-group">
                            <label>AE Comment</label>
                            <textarea type="text" class="form-control" name="ae_comment_ae" id="ae_comment_ae" placeholder="Enter Comment" readonly></textarea>
                        </div>
                    </div>
                  </div>
                  <hr>
                  <h3 align="left">Pricing</h3>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Rate Offer</label>
                            <input type="text" class="form-control" name="offer_rate" id="offer_rate" placeholder="Enter Offer Rate" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Pricing Comment</label>
                            <textarea type="text" class="form-control" name="pricing_comment" id="pricing_comment" placeholder="Enter Comment" readonly></textarea>
                        </div>
                    </div>
                    <div id="pricing_status"></div>
                  </div>
                  <hr>
                  <h3 align="left">Finel Process</h3>
                  <br>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>AWB</label>
                            <input type="text" class="form-control" name="awb" id="awb"
                                placeholder="Enter Service">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fixed Rate</label>
                            <input type="text" class="form-control" name="awb" id="awb"
                                placeholder="Enter Service">
                        </div>
                    </div>
                  </div>
                </form>
            </div>
          <div class="modal-footer bg-white">
            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-outline-success submit" id="submit_ae">Save changes</button>
            <button type="button" class="btn btn-outline-danger submit" id="submit_reject">Save changes</button>
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
              <li class="breadcrumb-item active">Request Form</li>
            </ol>
          </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" align="right">
                    <button type="buttton" class="btn btn-outline-primary addNew"><i class="fa fa-plus"></i> Add New Rate</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>ICPC No</th>
                                <th>Mount Code</th>
                                <th>Weight</th>
                                <th>Company Name</th>
                                <th>Desination Of Package</th>
                                <th>Requested Rate</th>
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

    $(document).on("click",".addNew",function(){
        $("#modal").modal('show');
        $(".modal-title").html('Add Request Form');
        $("#submit").html('Add Request Form');
        $('#modal').modal({backdrop:'static', keyboard: false})
        $("#submit").click(function(){    
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
                            db_error(data.db_error);
                            }

                            if(data.db_success){
                            toastr.success(data.db_success);
                            setTimeout(function(){
                                location.reload();
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

        //complain edit
    $(document).on("click", ".edit", function(){
        $("#submit").css("display","none");
        var id = $(this).attr('data');
        pricing_status(id);
        empty_form();
        
        $("#hid").val(id);
        
        $("#modal").modal('show');
        $(".modal-title").html('Update Request Form');
        $("#submit").html('Update Request Form');
        // description_app ();
        $.ajax({
            'type': 'ajax',
            'dataType': 'json',
            'method': 'get',
            'url': 'ae-requestform/'+id,
            'async': false,
            success: function(data){
                $("#icpc_no").val(data.icpc_no);
                $("#mount_code").val(data.mount_code);
                $("#weight").val(data.weight);
                $("#company_name").val(data.company_name);
                $("#destination").val(data.destination);
                $("#ae_rate").val(data.ae_rate);
                $("#service").val(data.service);
                $("#ae_comment").html(data.ae_comment);
            }
        });
        //user button click submit data to controller
        $("#submit").click(function(){

            if($("#hid").val() != ""){
                var id =$("#hid").val();

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
                                'method': 'put',
                                'data' : {icpc_no:icpc_no,mount_code:mount_code,weight:weight,company_name:company_name,destination:destination,ae_rate:ae_rate,service:service,ae_comment:ae_comment},
                                'url': 'ae-requestform/'+id,
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

    $(document).on("click", ".ae", function(){
        var id = $(this).attr('data');
        pricing_status(id);
        empty_form();
        
        $("#hid").val(id);
        
        $("#modal_ae").modal('show');
        $(".modal-title-ae").html('Request Form');
        $("#submit_ae").html('Close Won');
        $("#submit_reject").html('Close Lost');
        // description_app ();
        $.ajax({
            'type': 'ajax',
            'dataType': 'json',
            'method': 'get',
            'url': 'ae-requestform/'+id,
            'async': false,
            success: function(data){
                $("#icpc_no_ae").val(data.icpc_no);
                $("#mount_code_ae").val(data.mount_code);
                $("#weight_ae").val(data.weight);
                $("#company_nam_ae").val(data.company_name);
                $("#destination_ae").val(data.destination);
                $("#ae_rate_ae").val(data.ae_rate);
                $("#service_ae").val(data.service);
                $("#ae_comment_ae").html(data.ae_comment);
                $("#offer_rate").val(data.rate_offer);
                $("#pricing_comment").html(data.pricing_comment);
            }
        });
        //user button click submit data to controller
        $("#submit_ae").click(function(){

            if($("#hid").val() != ""){
                var id =$("#hid").val();
                var awb =$("#awb").val();
                var icpc_no =$("#icpc_no").val();
                var mount_code =$("#mount_code").val();
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
                                'method': 'put',
                                'data' : {awb:awb,status:status,icpc_no:icpc_no,mount_code:mount_code},
                                'url': 'ae-requestform/status/'+id,
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
        $("#submit_reject").click(function(){

            if($("#hid").val() != ""){
                var id =$("#hid").val();
                var awb =$("#awb").val();
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
                                'method': 'put',
                                'data' : {awb:awb,status:status},
                                'url': 'ae-requestform/status/'+id,
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
            'ajax': {
                        'method': 'get',
                        'url': 'ae-requestform/create',
                    },
            'columns': [
                {data: "icpc_no"},
                {data: "mount_code"},
                {data: "weight"},
                {data: "company_name"},
                {data: "destination"},
                {data: "ae_rate"},
                {
                    data: null,
                    render: function(d){
                        var html = "";
                        html+="&nbsp;&nbsp;<td><button class='btn btn-primary btn-sm edit' data='"+d.id+"' title='Edit'><i class='fas fa-arrow-alt-circle-left'></i></i></button>";
                        if(d.staus == 1){
                            html+="&nbsp;&nbsp;<td><button class='btn btn-success btn-sm ae' data='"+d.id+"' title='Edit'><i class='mdi mdi-apple-keyboard-command'></i></i></button>";
                        }
                        html+="&nbsp;<button class='btn btn-danger btn-sm delete' data='"+d.id+"'title='Delete'><i class='fas fa-trash'></i></button>";
                        return html;

                    }

                }
            ]
        });
    }

    function pricing_status(id){
        var html = "";
        $.ajax({
            'type': 'ajax',
            'dataType': 'json',
            'method': 'get',
            'url': 'ae-requestform/'+id,
            'async': false,
            success: function(data){
                html +='<div class="row" align="right">'
                if(data.pricing_status == 0){
                     html+='<div class="text-right">';
                        html+='<i class="fa fa-check" style="color:green">Approved</i>&nbsp;&nbsp;';
                    html+='</div>';  
                }else{
                    html+='<div class="text-right">';
                        html+='<i class="fa fa-window-close" style="color:red">&nbsp;Reject</i>&nbsp;&nbsp;'; 
                    html+='</div>';  
                }
                html+='</div>';
                $("#pricing_status").append(html);
            }
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