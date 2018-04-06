@extends('shared.layout')
@section('title', "Student List")
@section('body')
    <div class="table-resposive">
        <h3><strong>Students</strong> <a href="{{ route('personal.create') }}" class="btn btn-primary float-right" style="color: white">New Student</a> </h3>
        <br/>
        <table class="table">
            <thead>
              <tr>
                <th>Fullname</th>
                <th>Nickname</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Class</th>
                <th>Birthday</th>
                <th>Hobbies</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($people as $p)
                <tr>
                    <td>{{ $p ->fullname }} </td>
                    <td><span>@</span>{{ $p ->nickname }} </td>
                    <td><a href="mailto:{{ $p ->email }}">{{ $p ->email }}</a> </td>
                    <td>{{ $p ->gender == 0 ? "Male" : "Female" }}</td>
                    <td>{{ $p ->class != null ? $p ->class->class_name : "Class not linked for this student" }}</td>
                    <td>{{ \Carbon\Carbon::parse($p ->birthday)->format('d/m/Y') }}</td>
                    <td>{{ $p ->hobbies }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('personal.edit', $p -> id) }}">
                          <i class="fa fa-edit"></i>  Edit
                        </a>
                        <a data-id="{{ $p ->id }}" class="btn btn-danger btn-sm delete-item" href="#">
                            <i class="fa fa-trash"></i>  Delete
                        </a>
                    </td>
                </tr>   
              @endforeach
                 
            </tbody>
          </table>
          <div class="center">
              {!! $people -> links() !!}
          </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(".delete-item").on('click', function(e){
            const link = $(e.target);
            if(!confirm("Are you sure that you want to delete this ticket?")) return;
            $.ajax({
                url: '/personal/' + $(this).data('id'),
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
    </script>
@endsection