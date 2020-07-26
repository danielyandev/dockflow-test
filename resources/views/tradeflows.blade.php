@extends('layouts.main')

@section('content')
    <h2>Tradeflows</h2>

    <div class="mb-2">
        <a href="{{ route('tradeflows', ['filter' => 'without-containers']) }}" class="btn btn-sm btn-warning">Without containers</a>
        <a href="{{ route('tradeflows', ['filter' => 'all']) }}" class="btn btn-sm btn-success ml-2">All</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Container</th>
            </tr>
            </thead>
            <tbody>
                @forelse($tradeflows as $tradeflow)
                    @forelse($tradeflow->containers as $container)
                        <tr>
                            <td>{{ $tradeflow->id }}</td>
                            <td>{{ $tradeflow->name }}</td>
                            <td>
                                {{ $container->reference }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>{{ $tradeflow->id }}</td>
                            <td>{{ $tradeflow->name }}</td>
                            <td>
                                -
                            </td>
                        </tr>
                    @endforelse
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

        {!! $tradeflows->links() !!}
    </div>
@endsection
