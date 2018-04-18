@extends('shared.layout')
@section('title', "Edit department")
@section('body')
    <div class="container">
        <div class="row">   
            {!! Form::model($department, ['route' => ['departments.update', $department -> id], 'method' => 'PUT', 'class' => 'col-md-12']) !!}      
            <div class="col col-lg-12 float-left">
                <div class="card">
                    <div class="card-block">
                        <div class="card-header">
                            <h4>Department Info</h4>
                            @foreach ($errors->all() as $error)     
                                <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('Department', null, ['class' => 'col-form-label']) }}
                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <br/>
                    <div class="col-md-12">
                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                            <a href="{{route('departments.index')}}" class="btn btn-danger">Cancel</a>
                        </div>
                        <br>
                </div>
                          
              </div>
                    
            </div>
           
            {!! Form::close() !!}
        </div>
    </div>
@endsection