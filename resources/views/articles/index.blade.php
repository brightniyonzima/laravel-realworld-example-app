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

                    <h1>Articles</h1>
                    <div><a href="{{ url('articles/create') }}" class="btn btn-default btn-xs">Create new article</a></div>
                    @foreach($articles as $article)
                        <article>
                        	<h3><a href="articles/{{ $article->id }}">{{ $article->title }}</a></h3>
                        	<div class="body">
	                        	{{ $article->body }}
	                        	<br>
                                @php 
                                    $category = \App\ArticleCategory::where(['article_id'=>$article->id])->get();
                                @endphp
                                <div>
                                @if(!is_null($category) && !is_null($category->first()))
                                    <strong>Category : <font color="maroon">{{ $categories[$category->first()->category_id]  }}</font></strong>
                                @else
                                    <a href="articles/{{ $article->id }}/edit" class="btn btn-success btn-xs">add category</a>
                                @endif
                                {!! Form::open(['method' => 'DELETE','route' => ['articles.destroy', $article->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete article', ['class' => 'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!}</div>
                        	</div>
                        </article>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection