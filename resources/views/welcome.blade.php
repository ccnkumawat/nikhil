<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </head>
    <body class="antialiased">
        <div class="container mt-3">
            <button type="button" class="btn btn-primary" id="add_name">Add Name</button>
            <table class="table table-bordered">
                <thead>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Action</th>
                </thead>
                <tbody id="list_name">
                    @foreach ($names as $name )
                        <tr id="row_name{{$name->id}}">
                            <td>{{$name->id}}</td>
                            <td>{{$name->name}}</td>
                            <td>
                                <button type="button" id="edit_name" data-id="{{$name->id}}" class="btn btn-info ml-1">Edit</button>
                                <button type="button" id="delete_name" data-id="{{$name->id}}" class="btn btn-danger ml-1">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>

          <!-- The Modal -->
          <div class="modal" id="Modal_name">
            <div class="modal-dialog">
              <div class="modal-content">
                    <form action="" id="form_name">

                        <div class="modal-header">
                        <h4 class="modal-title" id="model_title"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" id="id" name="id" >
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" >
                        </div>

                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="close">Close</button>
                        </div>
                    </form>
              </div>
            </div>
          </div>
          <script type="text/javascript">
                $(document).ready(function(){
                    $.ajaxSetup({
                        headers:{
                            'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                });
                $("#add_name").on('click',function(){
                    $("#id").val('');
                    $("#form_name").trigger('reset');
                    $("#model_title").html('Add name');
                    $("#Modal_name").modal('show');
                });

                $("body").on('click','#edit_name',function(){
                    var id = $(this).data('id');
                    $.get('names/'+id+'/edit',function(res){
                        $("#model_title").html('Edit Name');
                        $("#id").val(res.id);
                        $("#name").val(res.name);
                        $("#Modal_name").modal('show');
                    })
                });
                $(document).on("click", "#delete_name" , function() {
                    var delete_id = $(this).data('id');
                    let validate = confirm('Are You sure want to delete name ?');
                    if(!validate)
                    {
                        return false;
                    }
                    var el = this;
                    $.ajax({
                        url: "names/destroy/"+delete_id,
                        type: 'DELETE',
                        success: function(response){
                            $(el).closest( "tr" ).remove();
                        }
                    });
                });

                // Save Data
                $("form").on('submit',function(e){
                    e.preventDefault();
                    $.ajax({
                        url :"names/store",
                        data : $("#form_name").serialize(),
                        type : "POST",
                    }).done(function(res){
                            var row = '<tr id="row_name"'+res.id+'>';
                            row += '<td>'+res.id+'</td>'
                            row += '<td>'+res.name+'</td>'
                            row += '<td>'+'<button type="button" id="edit_name" data-id="'+res.id+'" class="btn ml-1 btn-info">Edit</button>'
                                +'<button type="button" id="delete_name" data-id="'+res.id+'" class="btn ml-1 btn-danger">Delete</button>'+'</td>'

                            if($("#id").val()){
                                $("#row_name" + res.id).replaceWith(row);
                            }else{
                                $("#list_name").prepend(row);
                            }
                            $("#form_name").trigger('reset');
                            $("#Modal_name").modal('hide');
                        });
                });
          </script>
    </body>
</html>
