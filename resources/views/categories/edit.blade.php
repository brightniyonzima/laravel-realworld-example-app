@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <h1>Create category</h1>
                    {{ Form::model($category, ['method'=>'PUT','url' => 'categories/'.$category->id]) }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{ Form::label('name','Name') }}
                            {{ Form::text('name',$category->name,['class'=>'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('parent_category','Parent Category') }}
                            {{ Form::select('parent_category',$categories,$category->parent_category_id,['class' => 'form-control']) }}
                        </div>

                        {{ Form::submit('Submit',['class' => 'btn btn-success']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection