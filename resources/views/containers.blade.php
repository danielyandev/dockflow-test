@extends('layouts.main')

@section('content')
    <h2>Containers</h2>
    <div class="mb-2">
        <a href="{{ route('containers', ['filter' => 'invalid']) }}" class="btn btn-sm btn-warning">Only invalid</a>
        <a href="{{ route('containers', ['filter' => 'all']) }}" class="btn btn-sm btn-success ml-2">All</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Reference</th>
                <th>Is valid</th>
            </tr>
            </thead>
            <tbody>
                @forelse($containers as $container)
                    <tr>
                        <td>{{ $container->id }}</td>
                        <td>{{ $container->reference }}</td>
                        <td>
                            @if($container->is_valid)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="3">
                            Nothing found. Import your data from
                            <a href="{{ route('index') }}">dashboard</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {!! $containers->links() !!}
    </div>
@endsection
