@foreach($comments as $comment)
{{-- {{dd($comments)}} --}}
@php $dep = $depth-1; @endphp
<div class="display-comment"   @if($comment->parent_id != null) style="margin-left:40px;" @endif>
    <div class="comment-list">
        <div class="single-comment">
            @if(isset($comment->user_info) && isset($comment->user_info['photo']))
                <img src="{{$comment->user_info['photo']}}" alt="#">
            @else 
                <img src="{{asset('backend/img/avatar.png')}}" alt="">
            @endif
            <div class="content">
                {{-- {{$post}} --}}
                <h4>
    {{ $comment->user_info['name'] ?? 'Ẩn danh' }}
    <span>
        lúc {{ $comment->created_at->locale('vi')->format('H:i') }}
        {{ $comment->created_at->locale('vi')->isoFormat('dddd, D MMMM, YYYY') }}
    </span>
</h4>
                <p>{{$comment->comment}}</p>
                @if($dep)
                <div class="button">
                    <a href="#" class="btn btn-reply reply" data-id="{{$comment->id}}"><i class="fa fa-reply" aria-hidden="true"></i>Trả lời</a>
                    <a href="" class="btn btn-reply cancel" style="display: none;" ><i class="fa fa-trash" aria-hidden="true"></i>Hủy</a>
                </div>
                @endif
            </div>
        </div>
    </div>
    @include('frontend.pages.comment', ['comments' => $comment->replies, 'depth' => $dep])

</div>    
@endforeach