
@extends('layouts.app', ['title' => __('Qe Show')])
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
         $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
@section('content')
 @include('users.partials.header', [
        'title' => $id->matiere->matiere,
        'description' => __(''),
        'class' => 'col-lg-10'
    ])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            {{ $id->questionn }}
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-primary btn-round text-right text-white pull-right" data-toggle="modal" data-target="#modelInv">{{ __('Invite') }}</button>
                        </div>
                    </div>
                </div>

                <div class="col-12"> </div>
                <div class="row">
        <div class="col-md-12">
            <div class="card text-left">
            <div class="card-body">
                <p class="card-text">{!! $id->content !!}</p>
            </div>
            </div>
        </div>
    </div>
     <div class="modal fade bd-example-modal-lg" id="modelInv" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inviter des camarades</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form action="/qe/{{$id->id}}/invite" method="post" id="form">
                        {!! csrf_field() !!}
                              <div class="form-group">
                                <label for="">Users</label>
                                <select class="form-control js-example-basic-multiple" name="user[]" style="width: 75%" multiple="multiple">
                                    @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                 </form>

            </div>
        </div>
    </div>
    <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Commentaire</h4>
                        <div class="card-text">@comments(['model' => $id])</div>
                    </div>
                </div>
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
