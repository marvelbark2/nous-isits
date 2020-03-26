@extends('layouts.app', ['title' => __('Qe Index')])

@section('content')
 @include('users.partials.header', [
        'title' => __('Matieres'),
        'description' => __('Listes des matieres avec semestres'),
        'class' => 'col-lg-10'
    ])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                {{-- <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Matieres:</h3>
                        </div>
                    </div>
                </div> --}}

                <div class="col-12">
                                        </div>

                <div class="list-group">
        @foreach ($matiere as $item)
        @if ($item->semestre == "144")
            <a href="/qe/{{$item->id}}" class="list-group-item list-group-item-action">{{$item->matiere}} - S4</a>
        @else
             <a href="/qe/{{$item->id}}" class="list-group-item list-group-item-action">{{$item->matiere}} - S3</a>
        @endif
        @endforeach
    </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">

                    </nav>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection
