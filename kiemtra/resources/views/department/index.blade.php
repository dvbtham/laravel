@extends('shared.layout')
@section('title', "Department List")
@section('body')
<div class="row">
<div class="col-md-12">
    <div class="table-resposive">
        <h3><strong>Departments</strong> <a href="{{ route('departments.create') }}" class="btn btn-primary float-right" style="color: white">New Department</a> </h3>
        <br/>
        <table class="table">
            <thead>
              <tr>
                <th>Department name</th>
                <th>Students</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($departments as $d)
                <tr>
                    <td>{{ $d ->name }} </td>
                    <td>{{ $d ->students->count() }} </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('departments.edit', $d -> id) }}">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                        <a data-id="{{ $d ->id }}" class="btn btn-danger btn-sm delete-item" href="#">
                            <i class="fa fa-trash"></i>  Delete
                        </a>
                    </td>
                </tr>   
              @endforeach
                 
            </tbody>
          </table>
          <div class="center">
              {!! $departments -> links() !!}
          </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
    <script>
        $(".delete-item").on('click', function(e){
            const link = $(e.target);
            if(!confirm("Are you sure that you want to delete this record?")) return;
            $.ajax({
                url: '/departments/' + $(this).data('id'),
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