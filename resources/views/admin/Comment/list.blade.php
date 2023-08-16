
@extends('admin.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID User</th>
            <th>User</th>
            <th>Product</th>
            <th>Content</th>
            <th>Time Created</th>
            <th>Time Updated</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->user_id }}</td>
                <td>{{ $comment->users->name }}</td>
                <td>{{ $comment->products->name }}</td>
                <td>{{ $comment->content }}</td>
                <td>{{ $comment->created_at }}</td>
                <td>{{ $comment->updated_at }}</td>
                <td>
                    <a class="btn btn-danger btn-sm" href="#"
                       onclick="removeRow({{$comment->id}},'/admin/comment/destroy')">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $comments->links() !!}
@endsection


