@extends('layouts.app', ['title' => __('Sondages')])
@section('content')
 @include('users.partials.header', [
        'title' => "Nouveau Sondage",
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
                        </div>
                        <div class="col-4 text-right">

                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <form id="sondage" action="{{route('survey-store')}}" method="post">
                        @csrf
                        <div class="form-group">
                          <label for="">Titre de sondage</label>
                          <input type="text"
                            class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-muted">Titre de sondage</small>
                        </div>
                        <div class="form-group">
                          <label for="">Question</label>
                          <input type="text"
                            class="form-control" name="question" id="question" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-muted">Question posee</small>
                        </div>
                        <div class="form-group">
                          <label for="">Choix</label>
                          <div class="row">
                              <div class="col-10">
                                  <input type="text"
                                    class="form-control" name="options[]" id="options" aria-describedby="helpId" placeholder="">
                                <input type="text"
                                    class="form-control" name="options[]" id="options" aria-describedby="helpId" placeholder="">
                                    <div id="choi"></div>
                                <small id="helpId" class="form-text text-muted">Choix de question</small>
                              </div>
                              <div class="col-ml-2">
                                  <div class="btn-group btn-group-sm" role="group">
                                    <button id="add_choice" type="button" class="btn btn-outline-default btn-sm">+ choix</button>
                                    <button id="remove_choice" type="button" class="btn btn-outline-default btn-sm">- choix</button>
                                </div>
                              </div>

                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    @include('layouts.footers.auth')
</div>

@endsection
@push('js')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" ></script>
    <script>
        $(document).ready(function () {
            $("#add_choice").click(function() {
                $("#options").clone().appendTo("div#choi").val("");
            });
            $("#remove_choice").click(function() {
                $('#choi #options:last').remove();
            });
            // $('#sondage').submit(function (e) {
            //     let that = e.currentTarget;
            //     e.preventDefault();
            //     //reset();
            //     $.ajax({
            //         method: $(that).attr('method'),
            //         url: $(that).attr('action'),
            //         data: $(that).serialize()
            //     })
            //     .done(function (data) {
            //         console.log(data);
            //     })
            //     .fail(function (res) {
            //         console.log(res);
            //     })

            // })
        });
    </script>
@endpush
