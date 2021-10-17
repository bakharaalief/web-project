@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-2">
        <h1>Blog Dashboard</h1>
    </div>

    <div class="row justify-content-center mb-4">
        <a class="btn btn-success" href="{{ route('blog.create')}}">Crete Post</a>
    </div>

    <div class="row justify-content-center">
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
              <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th scope="col">Body</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td><a class="btn btn-warning" href="{{ route('blog.edit', ['blog'=> $post->id]) }}">Edit</a></td>
                    <td>
                        <form method="POST" action="{{ route('blog.destroy', ['blog'=> $post->id]) }}">
                            @csrf
                            @method('Delete')

                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
    </div>        
</div>
@endsection
