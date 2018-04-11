@extends('shared.layout')
@section('title', "Instructor in detail")
@section('body')
    <div class="container">
        <div class="row">   
            <div class="col col-lg-6 float-left">
                <div class="card">
                    <div class="card-block">
                        <div class="card-header">
                            <h4>Instructor Info</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <img class="img img-circle" 
                                    width="150" src="{{ asset('images/'. $instructor->image) }}" 
                                    alt="{{ $instructor->fullname }}">
                            </li>
                            <li class="list-group-item">Fullname: {{ $instructor->fullname }}</li>
                            <li class="list-group-item">Gender: &nbsp; <?php echo $instructor ->gender == 0 ? "<i class='fa fa-male'></i> Male" : "<i class='fa fa-female'></i> Female"
                            ?>  </li>
                            <li class="list-group-item">Birthday: {{ \Carbon\Carbon::parse($instructor ->birthday)->format('d/m/Y') }}</li>
                            <li class="list-group-item">Phone: {{ $instructor->phone }}</li>
                            <li class="list-group-item">Email: {{ $instructor->email }}</li>
                            <li class="list-group-item">Address: {{ $instructor->address }}</li>
                            <li class="list-group-item">My Subjects: {{ $instructor->subjects()->count() }} &nbsp; 
                            
                                <a href="javascript:void(0)" class="btn btn-info btn-sm view-subject"> <i class="fa fa-eye"></i> <span class="subject-text">View</span></a>
                            
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('instructors.index')}}" class="btn btn-block btn-info">Back</a>
                            </li>
                        </ul>
                </div>
              </div>
            </div>
            <div class="col col-lg-6 hidden" id="subject-info">
                    <div class="card">
                        <div class="card-block">
                            <div class="card-header">
                                <h4>My Subjects</h4>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($instructor->subjects as $subject)
                                <li class="list-group-item">
                                        Subject name: <a href="{{ route('subjects.edit', $subject->id) }}">{{ $subject->title }}</a>
                                        <br/>
                                        Credit: <span class="badge badge badge-primary">{{ $subject->credit }}</span>
                                </li>
                                @endforeach
                                
                            </ul>
                        </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {
        $(".view-subject").on('click', function(){
            
            $("#subject-info").fadeIn('fast', function() {

                $(this).toggleClass("hidden");

                if($(this).hasClass("hidden"))
                    $(".subject-text").text("View");
                else
                    $(".subject-text").text("Hide");
            });           

        });
    });
</script>
@endsection