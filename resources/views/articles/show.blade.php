@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Articles</h1>
                    <article>
                    	<h3>{{ $article->title }}</h3>
                    	<div class="body">{{ $article->body }}</div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection