@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <ul class="list-unstyled">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">

        <span>{{ session()->get('success') }}</span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
