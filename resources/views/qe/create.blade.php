<!doctype html>
<html lang="en">
  <head>
  <title>{{$m_id->matiere}}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('lib')}}/mathquill.css" rel="stylesheet">
    <link href="{{asset('lib')}}/matheditor.css" rel="stylesheet">
  </head>
  <body>
    <div class="card text-left">
      <div class="card-body">
        <h4 class="card-title">New Qe</h4>
        <div class="card-text">
            @if(session('message'))
          <div class="alert alert-success" role="alert">
              <strong>{{ session('message') }}</strong>
          </div>
          @endif

        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
    <script src="{{asset('/lib')}}/mathquill.min.js"></script>
    <script src="{{asset('/lib')}}/matheditor.js"></script>
    @include('sweetalert::alert')

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
  </body>
</html>
