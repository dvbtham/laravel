@extends('shared.layout')
@section('title', "Subject List")
@section('body')
<div class="row">
<div class="col-md-12">
    <div class="table-resposive">
        <h3><strong>Subjects</strong> <a href="{{ route('subjects.create') }}" class="btn btn-primary float-right" style="color: white">New Subject</a> </h3>
        <br/>
        <table class="table">
            <thead>
              <tr>
                <th>Title</th>
                <th>Credit</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($subjects as $s)
                <tr>
                    <td>{{ $s ->title }} </td>  
                    <td>{{ $s ->credit }} </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('subjects.edit', $s -> id) }}">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                        <a data-id="{{ $s ->id }}" class="btn btn-danger btn-sm delete-item" href="#">
                            <i class="fa fa-trash"></i>  Delete
                        </a>
                    </td>
                </tr>   
              @endforeach
                 
            </tbody>
          </table>
          <div class="center">
              {!! $subjects -> links() !!}
          </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
    <script>
        $(".delete-item").on('click', function(e){
            const link = $(e.target);
            if(!confirm("Are you sure that you want to delete this subject?")) return;
            $.ajax({
                url: '/subjects/' + $(this).data('id'),
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