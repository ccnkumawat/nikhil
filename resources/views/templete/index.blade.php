@extends('layouts.main')

@section('main-container');
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="row">
        <div class="container">
            <div class="col-lg-2 float-right">
                {{-- <a class="btn btn-primary" href="#"> Create </a> --}}
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categorymodal">Create</button>

            <div class="modal fade" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="addcategorymodal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addcategorymodal">Add Category</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Category :</label>
                        <input type="text" class="form-control category" id="category" placeholder="Enter Catetory" name="category">
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_category" >Save</button>
                </div>
                </div>
            </div>
            </div>
            <div class="col-lg-10">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Category</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($result as $row)

                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
@section('ajax')

<script>
    $(document).ready(function ()
    {

        function fetchcategory()
        {
            $.ajax({
                type : "get",
                url  : "/index",
                success :function(response)
                {
                    // console.log(response.category);
                    $('tbody').HTML("")
                    $.each(response.result,function(key,item){
                        $('tbody').apend(
                            '<tr>\
                                <td>'+item.id+'</td>\
                                <td>'+item.category+'</td>\
                                <td>Edit</td>\
                                <td>Delete</td>\
                            </tr>'
                        );
                    });
                }
            });
        }
        $(document).on('click','.add_category',function(e){
            e.preventDefault();
            var data = {
                'category':$('.category').val()
            }
            // console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type : "post",
                url  : "/create",
                data : data,
                success :function(response)
                {
                    console.log(response);
                }
            });
        });
    });
</script>

@endsection

