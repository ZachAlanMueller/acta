@extends('blogParent')

@section('content')
      <div class="fh5co-narrow-content">
        <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft"></h2>
        <div class="row animate-box" data-animate-effect="fadeInLeft">
          <div class="col-md-8">
            <div id="title">
              {!! $post->title !!}
            </div>
            <div id="content">
              {!!$post->content!!}
            </div>
            <hr>
            <h5 class="pull-right" id="author">
              Posted by {{$post->name}} on {{date('F jS, Y', strtotime($post->created_at))}}
            </h5>
          </div>
        </div>
      </div>


@endsection

@section('javascript')

@endsection