@extends('blogParent')

@section('content')
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      
      <div class="fh5co-narrow-content">
        <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Create New Post</h2>
        <div class="row animate-box" data-animate-effect="fadeInLeft">
          <div id="title">
            <h1>Post Title</h1>
          </div>
          <br>
          <!-- Create the toolbar container -->
          <div id="toolbar">
          </div>

          <!-- Create the editor container -->
          <div id="editor">
            <p>Hello World!</p>
          </div>
        </div>
      </div>
      <input id='submit-button' type="submit" class="btn btn-primary btn-md animate-box" data-animate-effect="fadeInLeft">
      <form id='post-form' action="/post/create" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id='input-title' name="title">
        <input type="hidden" id='input-content' name="content">
      </form>


@endsection

@section('javascript')
  <script>
    var title = new Quill('#title', {
      modules: { toolbar: false },
      theme: 'snow'
    });
    var toolbarOptions = [
      ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
      ['blockquote', 'code-block'],

      [{ 'header': 1 }, { 'header': 2 }],               // custom button values
      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      //[{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
      [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
      [{ 'direction': 'rtl' }],                         // text direction

      [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
      //[{ 'header': [1, 2, 3, 4, 5, 6, false] }],

      //[{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
      //[{ 'font': [] }],
      [{ 'align': [] }],

      ['clean']                                         // remove formatting button
    ];
    var editor = new Quill('#editor', {
      modules: { toolbar: toolbarOptions },
      theme: 'snow'
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#editor').children('.ql-editor').on('DOMSubtreeModified', function(){
      $('#input-content').val($('#editor').children('.ql-editor').html());
    });
    $('#title').children('.ql-editor').on('DOMSubtreeModified', function(){
      $('#input-title').val($('#title').children('.ql-editor').html());
    });


    $('#submit-button').on('click', function(){
      $('#post-form').trigger('submit');
    });
  </script>
@endsection