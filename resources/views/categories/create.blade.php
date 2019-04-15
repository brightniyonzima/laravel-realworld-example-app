@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Create category</h1>
                    {{ Form::open(['method'=>'post','url' => 'categories']) }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{ Form::label('name','Name') }}
                            {{ Form::text('name','',['class'=>'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('parent_category','Parent Category') }}
                            {{ Form::select('parent_category',$categories,'',['class' => 'form-control']) }}
                        </div>

                        {{ Form::submit('Submit',['class' => 'btn btn-success']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection