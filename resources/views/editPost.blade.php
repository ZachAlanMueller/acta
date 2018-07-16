@extends('blogParent')

@section('content')
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      
      <div class="fh5co-narrow-content">
        <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Edit Post</h2>
        <div class="row animate-box" data-animate-effect="fadeInLeft">
          <div id="title">
            {!!$post->title!!}
          </div>
          <br>
          <!-- Create the toolbar container -->
          <div id="toolbar">
          </div>

          <!-- Create the editor container -->
          <div id="editor">
            {!!$post->content!!}
          </div>

          <div class="form-group animate-box" data-animate-effect='fadeInLeft'>
          <select class="form-control" id="tags" style="margin-top:5px; width:inherit; display:inline-block; font-size:80%; height:80%;">
          </select>
          
        </div>
        </div>
      </div>
      <input id='submit-button' type="submit" class="btn btn-primary btn-md">
      <input id='submit-draft-button' type="submit" class="btn btn-info btn-md pull-right">
      <form id='post-form' action="/post/edit/{{$id}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id='input-title' name="title">
        <input type="hidden" id='input-content' name="content">
        <input type="hidden" id='input-tags' name="tag_id" value='{{$post->tag_id}}'>
        <input type="hidden" id='input-status' name="status">

      </form>


@endsection

@section('javascript')
  <script>
    $('#input-status').val(1);
    $('#submit-draft-button').val('Save as Draft');
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
    $('#tags').change(function(){
      $('#input-tags').val($('#tags').val());
    });

    


    $('#submit-button').on('click', function(){
      $('#input-content').val($('#editor').children('.ql-editor').html());
      $('#input-title').val($('#title').children('.ql-editor').html());
      $('#post-form').trigger('submit');
    });

    $('#submit-draft-button').on('click', function(){
      $('#input-status').val('3');
      $('#post-form').trigger('submit');
    });


    function getTags(){
      $.ajax({
        type:'GET',
        url:'/ajax/getTags',
        data:'_token = <?php echo csrf_token() ?>',
        success:function(data){
          console.log(data);
          console.log(data['info'].length);
          $('#tags').empty();
          for(i = 0; i < data['info'].length; i++){
            $('#tags').append('<option value="'+data['info'][i]['id']+'">'+data['info'][i]['label']+'</option>');
          }
          $('#tags').val({{$post->tag_id}});
        },
        error:function (xhr, options, err){
          console.log(xhr);
        }
      });
    }

    
    $(document).ready(function(){
      getTags();
    });
  </script>
@endsection