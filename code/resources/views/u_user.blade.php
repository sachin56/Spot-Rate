@extends('layouts.app')

@section('content')

    <div class="modal fade" id="modal">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-white">
            <h4 class="modal-title">Add User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body bg-white" >
                <form>
                <input type="hidden" id="hid" name="hid">
                <div class="row">
                    <div class="form-group col-md-12">
                    <label for="name">Username</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Username" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                    <label for="email">Password</label>
                    <input type="email" class="form-control" id="password" name="password" placeholder="Enter Email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                    <label for="tele_no">User Role</label><br>
                    <select name="role_id" id="role_id" required class="form-control col-md-12" multiple="multiple">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->description }}</option>
                        @endforeach
                    </select>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">User Managment</li>
                <li class="breadcrumb-item active"><a href="#">User</a></li>
                </ol>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" align="right">
                        <button type="buttton" class="btn btn-outline-primary addNew"><i class="fa fa-plus"></i> Add New User</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="tbl_role">
                            <thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th style="width:15%">User Name</th>
                                    <th style="width:15%">Email</th>
                                    <th style="width:10%">Phone</th>
                                    <th style="width:10%">Action</th>
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

        // menu active
        $(".user_route").addClass('active');
        $(".user_tree").addClass('active');
        $(".user_tree_open").addClass('menu-open');
        $(".user_tree_open").addClass('menu-is-opening');


        //csrf token error
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#role_id').multiselect({
                includeSelectAllOption: true,
                enableFiltering: true,
                numberDisplayed: 50,
                maxHeight: 250,
                enableCaseInsensitiveFiltering:true,
                buttonWidth: '750px'
        });

        $('#project_id').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            numberDisplayed: 50,
            maxHeight: 250,
            enableCaseInsensitiveFiltering:true,
            buttonWidth: '750px'
        });

        show_role();

        $(document).on("blur",".form-control",function(){
            $("#submit").css("display","block");
        });

        $(document).on("click", ".addNew", function(){
            var id = $(this).attr('data');

            empty_form();
            $("#hid").val(id);
            $("#modal").modal('show');
            $(".modal-title").html('Add User');
            $("#submit").html('Add User');

            $("#submit").click(function(){

                if($("#hid").val() == ""){
                    var id = $("#hid").val();
                    var name =$("#name").val();
                    var email =$("#email").val();
                    var password =$("#password").val();
                    var role_id =$("#role_id").val()

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
                                    'data' : {name:name,email:email,role_id:role_id,password:password},
                                    'url': 'user',
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
                                        }, 1000);
                                        }
                                    },
                                });
                            }
                    });
                }
            });
        });

        $(document).on("click", ".edit", function(){

            var id = $(this).attr('data');

            empty_form();
            $("#hid").val(id);
            $("#modal").modal('show');
            $(".modal-title").html('Edit Role');
            $("#submit").html('Update Role');

            $.ajax({
                'type': 'ajax',
                'dataType': 'json',
                'method': 'get',
                'url': 'user/'+id,
                'async': false,
                success: function(data){
                    $("#hid").val(data.users.id);
                    $("#name").val(data.users.name);
                    $("#email").val(data.users.email);

                    var u_user_roles = [];
                    for(var i=0;i<data.u_user_roles.length;i++){
                        u_user_roles.push(data.u_user_roles[i].role_id);
                    }
                    $('#role_id').multiselect('select', u_user_roles);
                }

            });

            $("#submit").click(function(){

                if($("#hid").val() != ""){

                    var id = $("#hid").val();
                    var name =$("#name").val();
                    var email =$("#email").val();
                    var role_id =$("#role_id").val()

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
                                    'data' : {name:name,email:email,role_id:role_id},
                                    'url': 'user/'+id,
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
                                        }, 1000);
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
                            'url': 'user/'+id,
                            'async': false,
                            success: function(data){

                            if(data){
                                toastr.success('User Deleted');
                                setTimeout(function(){
                                location.reload();
                                }, 1000);

                            }

                            }
                        });

                    }

            });

        });
    });

    //Data Table show
    function show_role(){
            $('#tbl_role').DataTable().clear();
            $('#tbl_role').DataTable().destroy();

            $("#tbl_role").DataTable({
                'processing': true,
                'serverSide': true,
                "bLengthChange": false,
                'ajax': {
                            'method': 'get',
                            'url': 'user/create'
                },
                'columns': [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'phone'},
                    {
                    data: null,
                    render: function(d){
                        var html = "";
                        html+="<td><button class='btn btn-primary btn-sm edit' data='"+d.id+"' title='Edit'><i class='fas fa-edit'></i></button>";
                        html+="&nbsp;<button class='btn btn-danger btn-sm delete' data='"+d.id+"' title='Delete'><i class='fas fa-trash'></i></button>";
                        return html;

                    }

                    }
                ]
            });
    }

    function empty_form(){
        $("#hid").val("");
        $("#name").val("");
        $("#email").val("");
        $("#role_id").multiselect('clearSelection');
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