@extends('shared.layout')
@section('title', "Personal List")
@section('body')
    <div class="table-resposive">
        <h3><strong>Personal</strong> <a href="{{ route('personal.create') }}" class="btn btn-primary float-right" style="color: white">Add New Person</a> </h3>
        <br/>
        <table class="table">
            <thead>
              <tr>
                <th>Fullname</th>
                <th>Nickname</th>
                <th>Email</th>
                <th>Gender</th>
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
                    <td>{{ \Carbon\Carbon::parse($p ->birthday)->format('d/m/Y') }}</td>
                    <td>{{ $p ->hobbies }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('personal.edit', $p -> id) }}">
                          <i class="fa fa-edit"></i>  Edit
                        </a>
                        <a data-id="{{ $p ->id }}" class="btn btn-danger btn-sm delete-ticket" href="#">
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
        $(".delete-ticket").on('click', function(e){
            const link = $(e.target);
            if(!confirm("Are you sure that you want to delete this ticket?")) return;
            $.ajax({
                url: '/personal/' + $(this).data('id'),
                method: 'delete',
                data: { _token: '{{csrf_token()}}' },
                success: function(){
                    
                },
                error: function(err){
                    console.log(err);
                }
            });
        });
    </script>
@endsection