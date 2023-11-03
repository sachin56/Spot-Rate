@extends('layouts.app')

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Recipient:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Book</li>
            </ol>
          </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary addNew"><i class="fa fa-plus"></i> Add New Book</button>
                    </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tbl_book">
                        <thead>
                            <tr>
                                <th style="width:5%">ID</th>
                                <th style="width:20%">Book Name</th>
                                <th style="width:20%">Book Auther Name</th>
                                <th style="width:10%">Book Category</th>
                                <th style="width:5%">Book Stock</th>
                                <th style="width:20%">Action</th>
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
    $(".book_route").addClass('active');
    $(".book_tree").addClass('active');
    $(".book_tree_open").addClass('menu-open');
    $(".book_tree_open").addClass('menu-is-opening');


    //csrf token error
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // show_Books();

    $(document).on("blur",".form-control",function(){
        $("#submit").css("display","block");
    });

    $(".addNew").click(function(){
        empty_form();
        $("#exampleModal").modal('show');
        $(".modal-title").html('Save Book');
        $("#submit").html('Save Book');
        $("#submit").click(function(){
            $("#submit").css("display","none");
            var hid = $("#hid").val();
            //save Category
            if(hid == ""){
                var book_name =$("#book_name").val();
                var auther_name =$("#auther_name").val();
                var stock =$("#stock").val();
                var category_type =$("#category_type").val();
                var description =$("#description").val();
                var assign_user =$("#assign_user").val();

                $.ajax({
                'type': 'ajax',
                'dataType': 'json',
                'method': 'post',
                'data' : {book_name:book_name,auther_name:auther_name,stock:stock,category_type:category_type,description:description,assign_user:assign_user},
                'url' : '/admin/book',
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
                        $("#modal").modal('hide');
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

    $(document).on("click", ".read", function(){

        var id = $(this).attr('data');

        empty_form();
        $("#hid").val(id);
        $("#modal").modal('show');
        $(".modal-title").html('Edit Category');
        $("#submit").css("display","none");

        $.ajax({
            'type': 'ajax',
            'dataType': 'json',
            'method': 'get',
            'url': 'book/'+id,
            'async': false,
            success: function(data){

                $("#hid").val(data.id);
                $("#book_name").val(data.book_name);
                $("#auther_name").val(data.auther_name);
                $("#stock").val(data.stock);
                $("#category_type").val(data.category_type);
                $("#description").val(data.description);
                $("#assign_user").val(data.assign_user);
            }

        });
    });

    $(document).on("click", ".assign_book", function(){

        var id = $(this).attr('data');

        empty_form();
        $("#hid").val(id);
        $("#modal_assign_book").modal('show');
        $(".modal-title-assign-book").html('Assign User');
        $("#submit_assign_book").html('Assign User');

        $.ajax({
            'type': 'ajax',
            'dataType': 'json',
            'method': 'get',
            'url': 'book/'+id,
            'async': false,
            success: function(data){

                $("#hid").val(data.id);
                $("#bookname").val(data.book_name);
            }

        });

        $("#submit_assign_book").click(function(){

            if($("#hid").val() != ""){

                var id = $("#hid").val();
                var bookname =$("#bookname").val();
                var assignuser =$("#assignuser").val();

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
                                'data' : {id:id,bookname:bookname,assignuser:assignuser},
                                'url': 'book/assign_book',
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
                                        $("#modal_assign_book").modal('hide');
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
        $(".modal-title").html('Edit Category');
        $("#submit").html('Update Category');

        $.ajax({
            'type': 'ajax',
            'dataType': 'json',
            'method': 'get',
            'url': 'book/'+id,
            'async': false,
            success: function(data){

                $("#hid").val(data.id);
                $("#book_name").val(data.book_name);
                $("#auther_name").val(data.auther_name);
                $("#stock").val(data.stock);
                $("#category_type").val(data.category_type);
                $("#description").val(data.description);
                $("#assign_user").val(data.assign_user);
            }

        });

        $("#submit").click(function(){

            if($("#hid").val() != ""){

                var id = $("#hid").val();
                var book_name =$("#book_name").val();
                var auther_name =$("#auther_name").val();
                var stock =$("#stock").val();
                var category_type =$("#category_type").val();
                var description =$("#description").val();
                var assign_user =$("#assign_user").val();

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
                                'data' : {book_name:book_name,auther_name:auther_name,stock:stock,category_type:category_type,description:description,assign_user:assign_user},
                                'url': 'book/'+id,
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
                        'url': 'book/'+id,
                        'async': false,
                        success: function(data){

                        if(data){
                            toastr.success('Delete Book');
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
function show_Books(){
        $('#tbl_book').DataTable().clear();
        $('#tbl_book').DataTable().destroy();

        $("#tbl_book").DataTable({
            'processing': true,
            'serverSide': true,
            "bLengthChange": false,
            'ajax': {
                        'method': 'get',
                        'url': 'book/create'
            },
            'columns': [
                {data: 'id'},
                {data: 'book_name'},
                {data: 'auther_name'},
                {data: 'category_type'},
                {data: 'stock'},
                {
                data: null,
                render: function(d){
                    var html = "";
                    @if (Auth::guard('admin')->check())
                        html+="<td><button class='btn btn-warning btn-sm edit' data='"+d.id+"' title='Edit'><i class='fas fa-edit'></i></button>";
                        html+="&nbsp;<button class='btn btn-danger btn-sm delete' data='"+d.id+"' title='Delete'><i class='fas fa-trash'></i></button>";
                        html+="&nbsp;<td><button class='btn btn-primary btn-sm assign_book' data='"+d.id+"' title='Edit'><i class='fa fa-user'></i></button>";
                    @elseif(Auth::guard('reader')->check())
                        html+="<td><button class='btn btn-success btn-sm read' data='"+d.id+"' title='Edit'><i class='fa-solid fa-book'></i></button>";
                    @else
                        html+="<td><button class='btn btn-warning btn-sm edit' data='"+d.id+"' title='Edit'><i class='fas fa-edit'></i></button>";
                        html+="&nbsp;<td><button class='btn btn-primary btn-sm assign_book' data='"+d.id+"' title='Edit'><i class='fa fa-user'></i></button>";
                    @endif
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