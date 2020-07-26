@extends('layouts.main')

@section('content')
    <h2>Dashboard</h2>

    @include('partials.alerts')

    <div class="d-flex">
        <a href="{{ route('tradeflows',  ['filter' => 'all']) }}" class="text-decoration-none">
            <div class="card text-center">
                <h5 class="card-header">Total tradeflows</h5>
                <div class="card-body">
                    <h5 class="card-title">{{ $tradeflows_total }}</h5>
                </div>
            </div>
        </a>

        <a href="{{ route('tradeflows',  ['filter' => 'without-containers']) }}" class="text-decoration-none">
            <div class="card text-center ml-2">
                <h5 class="card-header">Tradeflows without containers</h5>
                <div class="card-body">
                    <h5 class="card-title">{{ $tradeflows_without_containers }}</h5>
                </div>
            </div>
        </a>

        <a href="{{ route('containers', ['filter' => 'all']) }}" class="text-decoration-none">
            <div class="card text-center ml-2">
                <h5 class="card-header">Total containers</h5>
                <div class="card-body">
                    <h5 class="card-title">{{ $total_containers }}</h5>
                </div>
            </div>
        </a>

        <a href="{{ route('containers', ['filter' => 'invalid']) }}" class="text-decoration-none">
            <div class="card text-center ml-2">
                <h5 class="card-header">Invalid containers</h5>
                <div class="card-body">
                    <h5 class="card-title">{{ $invalid_containers }}</h5>
                </div>
            </div>
        </a>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="file">Import file (.xls, .xlsx formats allowed)</label>
                <input type="file" name="file" id="file" class="form-control-file">

                <button type="submit" class="btn btn-sm btn-success mt-2">Import</button>
            </form>
        </div>
    </div>
@endsection
