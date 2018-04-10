@extends('shared.layout')
@section('title', "Create new subject")
@section('body')
    <div class="container">
        <div class="row">   
            {!! Form::open(['route' => 'subjects.store', 'class' => 'col-md-12']) !!}  
         
            <div class="col col-lg-12 float-left">
                <div class="card">
                    <div class="card-block">
                        <div class="card-header">
                            <h4>Subject Info</h4>
                            @foreach ($errors->all() as $error)     
                                <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('Title', null, ['class' => 'col-form-label']) }}
                            {{ Form::text('title', '', ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('Credit', null, ['class' => 'col-form-label']) }}
                            {{ Form::number('credit', 1, ['class' => 'form-control']) }}
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