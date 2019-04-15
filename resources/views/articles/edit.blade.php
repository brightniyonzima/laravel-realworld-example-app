@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Edit article</h1>
                    {{ Form::model($article, ['method'=>'PUT','url' => 'articles/'.$article->id]) }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{ Form::label('title','Title') }}
                            {{ Form::text('title',$article->title,['class'=>'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('slug','Slug') }}
                            {{ Form::text('slug',$article->slug,['class'=>'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('description','Description') }}
                            {{ Form::textarea('description',$article->description,['class'=>'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('body','Body') }}
                            {{ Form::textarea('body',$article->body,['class'=>'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('category','Category') }}
                            {{ Form::select('category_id',$categories,'',['class' => 'form-control']) }}
                        </div>

                        {{ Form::submit('Submit',['class' => 'btn btn-success']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection