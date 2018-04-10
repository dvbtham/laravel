@extends('shared.layout')
@section('title', "Create new instructor")
@section('body')
    <div class="container">
        <div class="row">   
            {!! Form::open(['route' => 'instructors.store', 'class' => 'col-md-12']) !!}  
         
            <div class="col col-lg-12 float-left">
                <div class="card">
                    <div class="card-block">
                        <div class="card-header">
                            <h4>Instructor Info</h4>
                            @foreach ($errors->all() as $error)     
                                <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('Fullname', null, ['class' => 'col-form-label']) }}
                            {{ Form::text('fullname', '', ['class' => 'form-control']) }}
                        </div>
                        <br/>
                        <div class="col-md-12">
                            <div class="form-group row">
                                {{ Form::label('Gender', null, ['class' => 'col-md-2 col-form-label']) }}
                                <div class="col-sm-3 form-group">
                                    <div style="padding-top: 7px; padding-left: 10px">
                                        <label class="radio-inline">
                                            {{ Form::radio('gender', '0', true) }} Male
                                        <label class="radio-inline">
                                            {{ Form::radio('gender', '1') }} Female
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                                {{ Form::label('Subjects', null, ['class' => 'col-form-label']) }}
                           <select class="form-control select-multiple" name="subjects[]" id="subjects" multiple>
                               @foreach($subjects as $s)
                                    <option value="{{ $s->id }}">{{ $s->title }}</option>
                               @endforeach
                           </select>
                        </div>
                        <br/>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('Birthday', null, ['class' => 'col-form-label']) }}                               
                                {{ Form::text('birthday','', ['class' => 'form-control', 'id' => 'datepicker']) }}
                                 
                            </div>
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('Phone', null, ['class' => 'col-form-label']) }}
                            {{ Form::number('phone', '', ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('Email', null, ['class' => 'col-form-label']) }}
                            {{ Form::email('email', '', ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('Address', null, ['class' => 'col-form-label']) }}
                            {{ Form::text('address', '', ['class' => 'form-control']) }}
                        </div>                      
                       
                    </div>
                    <br/>
                    <div class="col-md-12">
                        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                        <a href="{{route('instructors.index')}}" class="btn btn-danger">Cancel</a>
                    </div>
                    <br/>
                </div>
                          
              </div>
                    
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function () {
        $(".select-multiple").select2();
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy'
        });
    });
</script>
@endsection