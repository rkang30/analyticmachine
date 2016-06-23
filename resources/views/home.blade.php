@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Welcome
            	@if(Auth::user()) 
            		{{Auth::user()->name}} 
            	@endif
            	!</h1>
            <p>This is just a prototype of analytic machine.</p>
        </div>
    </div>
</div>
@endsection
