@extends('shared.layout')
@section('title', "Instructor List")
@section('body')
<div class="row">
<div class="col-md-12">
    <div class="table-resposive">
        <h3><strong>Instructors</strong> <a href="{{ route('instructors.create') }}" class="btn btn-primary float-right" style="color: white">New Instructor</a> </h3>
        <br/>
        <table class="table">
            <thead>
              <tr>
                <th>Fullname</th>
                <th>Gender</th>
                <th>Birthday</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($instructors as $in)
                <tr>
                    <td>{{ $in ->fullname }} </td>
                    <td>
                        <?php 
                            echo $in ->gender == 0 ? "<i class='fa fa-male'></i> Male" : "<i class='fa fa-female'></i> Female"
                        ?>                   
                    </td>
                    <td>{{ \Carbon\Carbon::parse($in ->birthday)->format('d/m/Y') }} </td>
                    <td>{{ $in ->phone }} </td>
                    <td>{{ $in ->email }} </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('instructors.edit', $in ->id) }}">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                        <a class="btn btn-primary btn-sm" href="{{ route('instructors.show', $in->id) }}">
                            <i class="fa fa-eye"></i> Details
                        </a>
                        <a data-id="{{ $in ->id }}" class="btn btn-danger btn-sm delete-item" href="#">
                            <i class="fa fa-trash"></i>  Delete
                        </a>
                    </td>
                </tr>   
              @endforeach
                 
            </tbody>
          </table>
          <div class="center">
              {!! $instructors -> links() !!}
          </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
    <script>
        $(".delete-item").on('click', function(e){
            const link = $(e.target);
            if(!confirm("Are you sure that you want to delete this instructor?")) return;
            $.ajax({
                url: '/instructors/' + $(this).data('id'),
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