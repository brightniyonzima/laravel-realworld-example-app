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

                    <h1>Categories</h1>
                    <div><a href="{{ url('categories/create') }}" class="btn btn-success btn-xs">add category</a></div>
                    @php $counter = 1; @endphp
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Parent category</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $counter  }}
                                        </td>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            {{ is_null($category->parent_category_id) ? '' :  $parent_categories[$category->parent_category_id] }}
                                        </td>
                                        <td>
                                            <a href="categories/{{ $category->id }}/edit" class="btn btn-info btn-xs">Edit</a>
                                        </td>
                                        <td>
                                            @if(is_null($category->deleted_at))
                                                {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $category->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                                {!! Form::close() !!}
                                            @else
                                                {!! Form::open(['method' => 'POST','url' => "categories/restore/{$category->id}",'style'=>'display:inline']) !!}
                                                {!! Form::submit('Restore', ['class' => 'btn btn-default btn-sm']) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection