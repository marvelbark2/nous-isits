@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'La tache'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                            <p class="text-center text-info">La tache est complete , <span style="background-color:black; color:white;padding: 1px 5px 3px 5px;
                                -webkit-border-radius: 3px;
                                -moz-border-radius: 3px;
                                border-radius: 3px;">Merci Beaucoup ! <i class="fa fa-heart heart"></i></span> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
