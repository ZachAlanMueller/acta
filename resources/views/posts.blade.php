@extends('blogParent')

@section('content')
      <div class="fh5co-narrow-content">
        <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft"></h2>
        <div class="animate-box" data-animate-effect="fadeInLeft">
          @foreach ($posts as $post)
          <div class="row animate-box" data-animate-effect="fadeInDown">
            <div class="col-md-4" style="display:inline-block;">
              <h3>{!!$post->title!!}</h3> 
            </div>
            <div class="col-md-4" style="display:inline-block;">
              <h5>Posted by {{$post->name}} on {{date('F jS, Y', strtotime($post->created_at))}}</h5>
            </div>
          </div>
          <hr>

          @endforeach
        </div>
      </div>


@endsection

@section('javascript')

@endsection