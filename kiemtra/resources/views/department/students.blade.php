@foreach($students as $s)
<tr>
    <td>{{ $s->fullname}} </td>
    <td>
        <a class="btn btn-info btn-sm" href="{{ route('personal.edit', $s->id) }}">
            <i class="fa fa-edit"></i>  Edit
        </a>  
    </td>
</tr>   
@endforeach
