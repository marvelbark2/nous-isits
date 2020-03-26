@extends('layouts.app', ['title' => __('Toutes')])

@push('js')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
    <script src="{{asset('/lib')}}/mathquill.min.js"></script>
    <script src="{{asset('/lib')}}/matheditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        function tiny() {
            tinymce.init({
            selector:"textarea.form-control",
            plugins: 'print preview fullpage paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
      imagetools_cors_hosts: ['picsum.photos'],
      menubar: 'file edit view insert format tools table help',
      toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
      toolbar_sticky: true,
      autosave_ask_before_unload: true,
      autosave_interval: "30s",
      autosave_prefix: "{path}{query}-{id}-",
      autosave_restore_when_empty: false,
      autosave_retention: "2m",
      image_advtab: true,
      content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tiny.cloud/css/codepen.min.css'
      ],
      link_list: [
        { title: 'My page 1', value: 'http://www.tinymce.com' },
        { title: 'My page 2', value: 'http://www.moxiecode.com' }
      ],
      image_list: [
        { title: 'My page 1', value: 'http://www.tinymce.com' },
        { title: 'My page 2', value: 'http://www.moxiecode.com' }
      ],
      image_class_list: [
        { title: 'None', value: '' },
        { title: 'Some class', value: 'class-name' }
      ],
      importcss_append: true,
      height: 400,
      file_picker_callback: function (callback, value, meta) {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
          callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
        }

        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
          callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
        }

        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
          callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
        }
      },
      templates: [
            { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
        { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
        { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
      ],
      template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
      template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
      height: 600,
      image_caption: true,
      quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
      noneditable_noneditable_class: "mceNonEditable",
      toolbar_drawer: 'sliding',
      contextmenu: "link image imagetools table",
        });
        }
        function math() {
        var me = new MathEditor('content');
        me.removeButtons(['fraction']);
        me.setTemplate('floating-toolbar');
        me.buttons = ["fraction","square_root","cube_root","root",'superscript','subscript','multiplication','division','plus_minus','pi','degree','not_equal','greater_equal','less_equal','greater_than','less_than','angle','parallel_to','perpendicular','triangle','parallelogram'];["fraction","square_root","cube_root","root",'superscript','subscript','multiplication','division','plus_minus','pi','degree','not_equal','greater_equal','less_equal','greater_than','less_than','angle','parallel_to','perpendicular','triangle','parallelogram'];
        me.removeButtons(["fraction","square_root"]);
        me.default_toolbar_tabs = ["General","Symbols","Geometry"];
        me.setTemplate('keypad');
        me.getValue();
        me.styleMe({
            width: 500,
            height: 40,
            textarea_background:"#FFFFFF",
            textarea_foreground:"#000000",
            textarea_border:"#000000",
            toolbar_background:"#FFFFFF",
            toolbar_foreground:"#000000",
            toolbar_border:"#000000",
            button_background:"#FFFFFF",
            button_border:"#000000",
    });
        };
    $("#type_c").change(function()
      {
        var opt = $(this).val();
        var conte = document.getElementsByName('content');
        var text = document.getElementsByClassName('tox-tinymce');
        var maths = document.getElementsByClassName('matheditor-wrapper-math');
        switch (opt) {
            case "1":
            if(maths){
                $(".matheditor-wrapper-content" ).hide();
                $(".tox-tinymce" ).show();
                tiny();
            }else{
                tiny()
            }
                break;

            case "2":
            if (text){
                $(".tox-tinymce" ).hide();
                $(".matheditor-wrapper-content" ).show();
                math()
            }else{
                $(".matheditor-wrapper-content" ).show();
                math()
            }
                break;
        }

      });


    </script>
    <script>
        $(function(){
        $('.js-example-basic-multiple').select2();
          $('#form').submit(function(e) {
            e.preventDefault()
            $.ajaxSetup({
                headers: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var $form = $(this)

            $.post($form.attr('action'), $form.serialize())
            .done(function(data) {
              $('#html').html(data)
              $('#modelId').modal('hide')
              Swal.fire(
              'QE Saved!',
              'success'
            )
            setTimeout(function () {
             location.reload()
             }, 200);
            })
            .fail(function() {
              alert('ça ne marche pas...')
            })
          })
          $('.modal').on('shown.bs.modal', function(){
            $('input:first').focus()
          })
        })
    </script>
    <script>
function connf(id) {
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: true
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
      $.ajax({
        url: '/qe/delete/' + id,
        type: 'GET',
        success: function(data){
            swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your QE has been deleted.',
            'success'
            )
            setTimeout(function () {
             location.reload()
             }, 1000);
        }
      })

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your QE is safe :)',
      'error'
    )
  }
})

        }
    </script>
@endpush
@section('content')
 @include('users.partials.header', [
        'title' => $m_id->matiere,
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
                            @if (count($m_id->qe) > "0")
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modelId">{{ __('Nouveau') }}</button>
                                <a href="/qe/{{$m_id->id}}/print" class="btn btn-sm btn-primary"> Print</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12"> </div>
                <div class="row">
        <div class="col-md-12">
            <div class="card text-left">
            <div class="card-body">
                <ul class="list-group">
                @forelse ($m_id->qe as $i)
                @if(True)
                <a href="/qe/{{$i->id}}/show">
                    <li class="list-group-item text-left">{{$i->questionn}}</li>
                </a>
                <li class="list-group-item text-right">
                    {{$i->created_at}}
                <a href="/qe/{{$i->id}}/edit">
                        <i class="fas fa-edit"></i>
                    </a>
                <a href="#" onclick="connf({{$i->id}})" >
                        <i class="fas fa-trash-alt"></i>
                    </a>

                </li>
                @endif
                @empty
                <p class="text-center">empty qe here</p>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
                    Add a new Qe
                  </button>
                @endforelse

            </ul>
            </div>
            </div>
        </div>
    </div>
     <div class="modal fade bd-example-modal-lg" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$m_id->matiere}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form action="/qe/{{$m_id->id}}/add" method="post" id="form">
                        {!! csrf_field() !!}
                            <div class="form-group">
                              <label for="">Question</label>
                              <input type="text"
                                class="form-control" name="questionn" id="question" aria-describedby="helpId" placeholder="">
                              <small id="helpId" class="form-text text-muted">add the question</small>
                            </div>
                            <div class="form-group">
                              <label for="">select the type</label>
                              <select class="form-control" name="type" id="type">
                                <option value="1">QE</option>
                                <option value="2">Tache</option>
                                <option value="3">Liste</option>
                              </select>
                            </div>

                              <div class="form-group">
                                <label for="type_c">content type</label>
                                <small id="emailHelp" class="form-text text-muted">Latex pour maths, (on mode DEMO).</small>
                                <select class="form-control" aria-describedby="emailHelp" name="type_c" id="type_c">
                                  <option value="">Select the type content</option>
                                  <option value="1">Text</option>
                                  <option value="2">Latex</option>
                                </select>
                              </div>
                            <div class="form-group">
                              <label for="">content</label>
                              <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="m_id" value={{$m_id->id}}>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
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
