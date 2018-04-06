@extends('shared.layout')
@section('title', "Class List")
@section('body')
<div class="row">
<div class="col-md-6">
    <div class="table-resposive">
        <h3><strong>Classes</strong> <a href="{{ route('class.create') }}" class="btn btn-primary float-right" style="color: white">New Class</a> </h3>
        <br/>
        <table class="table">
            <thead>
              <tr>
                <th>Class name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($classes as $c)
                <tr>
                    <td>{{ $c ->class_name }} </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('class.edit', $c -> id) }}">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                        <a class="btn btn-primary btn-sm view-students" data-id="{{ $c ->id }}" href="javascript:void(0)">
                            <i class="fa fa-users"></i> Students
                          </a>
                        <a data-id="{{ $c ->id }}" class="btn btn-danger btn-sm delete-item" href="#">
                            <i class="fa fa-trash"></i>  Delete
                        </a>
                    </td>
                </tr>   
              @endforeach
                 
            </tbody>
          </table>
          <div class="center">
              {!! $classes -> links() !!}
          </div>
    </div>
</div>
<div class="col-md-6">
    <div class="table-resposive">
        <h3><strong>Students</strong> <a href="{{ route('personal.create') }}" class="btn btn-primary float-right" style="color: white">New Student</a> </h3>
        <br/>
        <table class="table">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr id="loading" hidden>
                  <td colspan="2" class="text-center">
                      <i class="fa fa-spinner fa-spin text-info"></i>
                  </td>
              </tr>
            </tbody>
            <tbody id="students"></tbody>
          </table>
          <div class="center">
              {!! $classes -> links() !!}
          </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
    <script>
        $(".delete-item").on('click', function(e){
            const link = $(e.target);
            if(!confirm("Are you sure that you want to delete this ticket?")) return;
            $.ajax({
                url: '/class/' + $(this).data('id'),
                method: 'delete',
                data: { _token: '{{csrf_token()}}' },
                success: function(){
                    link.parents("tr").fadeOut(() => $(this).remove());
                    alert("Data was successfully deleted!");                   
                },
                error: function(err){
                    alert("Error!");
                    console.log(err);
                }
            });
        });

         $(".view-students").on('click', function(e){
            const link = $(e.target);
            var loader = $("#loading");
            $("#students").attr("hidden", true);
            loader.attr("hidden", false);
            $.ajax({
                url: '/class/'+ $(this).data('id') +'/students',
                method: 'get',
                data: { _token: '{{csrf_token()}}' },
                success: function(data){
                    $("#students").attr("hidden", false);
                    $("#students").fadeIn(function(){
                        $(this).html(data);
                    });
                    loader.attr("hidden", true);
                },
                error: function(err){
                    alert("Error!");
                    console.log(err);
                }
            });
        });
    </script>
@endsection