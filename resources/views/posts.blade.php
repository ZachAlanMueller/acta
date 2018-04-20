@extends('blogParent')

@section('content')
      <div class="fh5co-narrow-content">
        @if (Auth::id() == 1)
        <a href="/post/create" class="btn btn-primary btn-sm animate-box pull-right" data-animate-effect="fadeInLeft">New Post</a>
        @endif
        <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft"></h2>
        <div class="animate-box" data-animate-effect="fadeInLeft">
          @foreach ($posts as $post)
          <div class="row animate-box" data-animate-effect="fadeInDown">
            <div class="col-md-8" style="display:inline-block;">
              <h3><a href="/post/{{$post->id}}">{!!$post->title!!}</a></h3> 
              <div  style="display:inline-block;">
                @if ($post->status == 1)
                <h5>Posted by {{$post->name}} on {{date('F jS, Y', strtotime($post->created_at))}}</h5>

                @elseif ($post->status == 3)
                  <h5>Draft saved on {{date('F jS, Y', strtotime($post->created_at))}}</h5>
                @else

                @endif
              </div>
            </div>
            <div class="col-md-4">
              @if ($post->author_id == Auth::id())
                <a href="/post/edit/{{$post->id}}">Edit</a>
              @endif
            </div>
            
          </div>
          <hr>

          @endforeach
        </div>
      </div>


@endsection

@section('javascript')

@endsection