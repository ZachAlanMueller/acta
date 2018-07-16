@extends('blogParent')

@section('content')
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      
      <div class="fh5co-narrow-content">
        <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Create New Post</h2>
        <div class="animate-box" data-animate-effect="fadeInLeft">
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
        <hr>
        
        <div class="form-group animate-box" data-animate-effect='fadeInLeft'>
          <select class="form-control" id="tags" style="margin-top:5px; width:inherit; display:inline-block; font-size:80%; height:80%;">
          </select>
          
        </div>


        <input id='submit-button' type="submit" class="btn btn-primary btn-md animate-box" data-animate-effect="fadeInLeft" style="margin-top:5px;">
        <input id='submit-draft-button' type="submit" class="btn btn-info btn-md animate-box" data-animate-effect="fadeInLeft" style="margin-top:5px;">
        

      </div>
      <form id='post-form' action="/post/create" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id='input-title' name="title">
        <input type="hidden" id='input-content' name="content">
        <input type="hidden" id='input-tags' name="tag_id" value='1'>
        <input type="hidden" id='input-status' name="status">
      </form>


@endsection

@section('javascript')
  <script>
    $('#input-status').val(1);
    $('#submit-draft-button').val('Save to Drafts');
    $('#submit-button').val('Submit Post');
    var title = new Quill('#title', {
      modules: { toolbar: false },
      theme: 'snow'
    });
    var toolbarOptions = [
      ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
      ['blockquote', 'code-block'],

      [{ 'header': 1 }, { 'header': 2 }],               // custom button values
      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
      [{ 'direction': 'rtl' }],                         // text direction

      [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown

      [{ 'align': [] }]

      //['clean']                                         // remove formatting button
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
            $('#tags').append('<option value="'+data['info'][i]['id']+'"">'+data['info'][i]['label']+'</option>');
          }
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