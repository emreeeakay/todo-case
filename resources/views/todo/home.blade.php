<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <title>Hello, world!</title>
</head>
<body style="background-image: linear-gradient(to right, red , yellow);">
<div class="container">
    <div class="card m-5">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        Gedik | Test Case - TODOLIST
                    </div>
                    <div class="col-4 ">
                        <a class="btn btn-primary" style="float: right" href="#" data-bs-toggle="modal" data-bs-target="#newTaskModal" role="button">
                            <i class="fa-thin fa-plus"></i> Add New Task
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if(!empty($lists))
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($lists as $data)
                                    <tr>
                                        <th scope="row">{{ $data->id }}</th>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->description }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary edit-button" data-id="{{$data->id}}">Edit</button>
                                            <button type="button" class="btn btn-outline-danger delete-button" data-id="{{$data->id}}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="newTaskTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="newTaskTitle" placeholder="Title">
                </div>
                <div class="mb-3">
                    <label for="newTaskDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="newTaskDescription" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="newTaskSubmit">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="newTaskTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="updateTaskTitle" placeholder="Title">
                    <input type="hidden" class="form-control" id="updateTaskId" placeholder="Title">
                </div>
                <div class="mb-3">
                    <label for="newTaskDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="updateTaskDescription" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="updateTaskSubmit">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3" id="deleteContent">

                </div>
                <input type="hidden" value="" id="deleteTaskId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="deleteTaskSubmit" data-id="0">Delte</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {

        // new task request
        $('#newTaskSubmit').click(function () {
            $.ajax({
                url:"/todolist/save",
                type: "post",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'title': $('#newTaskTitle').val(),
                    'description': $('#newTaskDescription').val()
                },
                success: function (data) {
                    if (data.status === 'ok') {
                        alert("İşlem Başarılı");
                        location.reload();
                    } else {
                        alert("İşlem Sırasında Bir Hata Oluştu");
                    }
                },
                error: function (data) {
                    var errors = $.parseJSON(data.responseText);
                    var text = '';
                    $.each(errors.errors, function (key, value) {
                       text += value[0] + '\n' ;
                    });
                    alert(text);
                }
            });

        });

        //  task detail request
        $('.edit-button').click(function (){
               $.ajax({
                   url:"/todolist/getData/"+$(this).data('id') ,
                   type: "get",
                   dataType: "json",
                   success: function (data) {
                       console.log(data)
                       if (data.status === 'ok') {
                           $('#updateTaskTitle').val(data.data.title);
                           $('#updateTaskId').val(data.data.id);
                           $('#updateTaskDescription').val(data.data.description);
                           var myModal = new bootstrap.Modal(document.getElementById('updateTaskModal'), {
                               keyboard: false
                           })
                           myModal.show()
                       } else {
                           alert("İşlem Sırasında Bir Hata Oluştu");
                       }
                   },
                   error: function (data) {
                       var errors = $.parseJSON(data.responseText);
                       var text = '';
                       $.each(errors.errors, function (key, value) {
                           text += value[0] + '\n' ;
                       });
                       alert(text);
                   }
               });
        });

        // Update task request
        $('#updateTaskSubmit').click(function () {
            $.ajax({
                url:"/todolist/update",
                type: "post",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id' : $('#updateTaskId').val(),
                    'title': $('#updateTaskTitle').val(),
                    'description': $('#updateTaskDescription').val()
                },
                success: function (data) {
                    if (data.status === 'ok') {
                        alert("İşlem Başarılı");
                        location.reload();
                    } else {
                        alert("İşlem Sırasında Bir Hata Oluştu");
                    }
                },
                error: function (data) {
                    var errors = $.parseJSON(data.responseText);
                    var text = '';
                    $.each(errors.errors, function (key, value) {
                        text += value[0] + '\n' ;
                    });
                    alert(text);
                }
            });

        });

        //delete modal
        $('.delete-button').click(function (){
            $.ajax({
                url:"/todolist/getData/"+$(this).data('id') ,
                type: "get",
                dataType: "json",
                success: function (data) {
                    console.log(data)
                    if (data.status === 'ok') {
                        $('#deleteContent').html(
                            '<h2>'+  data.data.title + '</h2> <br>' +
                            '<p class="text-start">' + data.data.description+ '</p>'
                        );
                        $('#deleteTaskId').val( data.data.id);
                        var myModal = new bootstrap.Modal(document.getElementById('deleteTaskModal'), {
                            keyboard: false
                        })
                        myModal.show()
                    } else {
                        alert("İşlem Sırasında Bir Hata Oluştu");
                    }
                },
                error: function (data) {
                    var errors = $.parseJSON(data.responseText);
                    var text = '';
                    $.each(errors.errors, function (key, value) {
                        text += value[0] + '\n' ;
                    });
                    alert(text);
                }
            });
        })

        $('#deleteTaskSubmit').click(function (){
            $.ajax({
                url:"/todolist/delete",
                type: "post",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id' : $('#deleteTaskId').val()
                },
                success: function (data) {
                    if (data.status === 'ok') {
                        alert("İşlem Başarılı");
                        location.reload();
                    } else {
                        alert("İşlem Sırasında Bir Hata Oluştu");
                    }
                },
                error: function (data) {
                    var errors = $.parseJSON(data.responseText);
                    var text = '';
                    $.each(errors.errors, function (key, value) {
                        text += value[0] + '\n' ;
                    });
                    alert(text);
                }
            });
        })
    });
</script>
</body>
</html>
