@extends('layouts.app')

@section('content')

    <div class="panel-body">
        @include('common.errors')
        <form action="{{ url('categories') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Categories</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">Add categories</button>
                </div>
            </div>
        </form>
    </div>
    @if (count($categories) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">Current Tasks</div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Categories</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $category->name }}</div>
                                </td>
                                <td>
                                    <form action="{{ url('category/'.$category->id) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection