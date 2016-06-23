@extends('layouts/app')
@section('content')
<div class="row">
	<div class="container">
        <div class="col-md-10 col-md-offset-1">
		<h1 style="margin-left:15px;">New Project</h1>
			{{ Form::open(['url' => '/projects/new', 'method' => 'post', 'files' => true]) }}
            <fieldset  class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    {{ Form::text('name', $name = null, array('class' => 'form-control', 'placeholder' => 'Enter project name')) }}
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>              
            </fieldset >

            <fieldset  class="form-group">
                <div class="col-md-12">
                    {{Form::file('csv')}}
                    @if ($errors->has('csv'))
                        <span class="help-block">
                            <strong>{{ $errors->first('csv') }}</strong>
                        </span>
                    @endif
                </div>
            </fieldset >

            @if(Session::has('mongo_insert_success'))
            <fieldset  class="form-group taller">
                <div class="col-md-12">
                    <span class="alert alert-info">{{ Session::get('mongo_insert_success') }}</span>
                </div>
            </fieldset >
            @endif

            @if(Session::has('mongo_insert_error'))
            <fieldset  class="form-group taller">
                <div class="col-md-12">
                    <span class="alert alert-danger">{{ Session::get('mongo_insert_error') }}</span>
                </div>
            </fieldset >
            @endif            

            <div class="form-group">
            	<div class="col-md-12">
            		<!-- <input type="submit" name="upload" class="btn btn-primary" value="Upload"/> -->
            		{{Form::submit('Upload', ['class' => 'btn btn-primary'])}}
            	</div>
            </div>	
            {{Form::close()}}
        </div>    
	</div>
</div>
@stop