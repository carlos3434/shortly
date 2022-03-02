@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Links</h2>

            <div class="alert alert-success" style="display: none"></div>

            <a href="{{ route('links.create') }}" class="btn btn-warning pull-right">Add new</a>

            @if(count($links) > 0)

                <table class="table table-bordered">
                    <tr>
                        <td>name</td>
                        <td>url</td>
                        <td>short</td>
                        <td>count</td>
                        <td>crawler</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($links as $link)
                        <tr data-id="{{ $link->id }}">
                            <td>{{ $link->name }}</td>
                            <td>{{ $link->url }}</td>
                            <td>{{ $link->short }}</td>
                            <td>{{ $link->count }}</td>

                            <td>
                                <form method="post" action="{{ route('links.update', ['link' => $link->id]) }}">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}

                                    <button class="btn btn-alert" type="submit" onclick="if(!confirm('Are you sure')) return false;"><i class="glyphicon glyphicon-edit"></i></button>
                                </form>
                            </td>

                            <td>
                                <a href="{{ url('dashboard/links/' . $link->id . '/edit') }}"><i class="glyphicon glyphicon-edit"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </table>

                @if(count($links) > 0)
                    <div class="pagination">
                        <?php echo $links->render();  ?>
                    </div>
                @endif

            @else
                <i>No links found</i>

            @endif
        </div>
    </div>

@endsection

@section('script')
@endsection