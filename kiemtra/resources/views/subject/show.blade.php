@extends('shared.layout')
@section('title', "Instructors with subject ")
@section('body')
    <div class="container">
        <div class="row">   
            <div class="col col-lg-7">
                <div class="card">
                    <div class="card-block">
                        <div class="card-header">
                        <h4>Instructors teaching <a href="">#{{ $subject->title }}</a></h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($subject->instructors as $in)
                            <li class="list-group-item">
                            <a href="{{ route('instructors.show', $in['id']) }}">{{ $in['fullname'] }}</a>
                            </li>
                            @endforeach
                        </ul>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    
</script>
@endsection