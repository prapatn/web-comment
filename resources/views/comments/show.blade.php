@foreach($comments as $comment)
<div class="display-comment" @if($comment->comment_id != null) style="margin-left:40px;" @endif>
    <strong>{{ $comment->user->name }}</strong>
    <p>{{ $comment->message }}</p>
    <form method="post" action="{{ route('comment.store') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="message" class="form-control" />
            <input type="hidden" name="post_id" value="{{ $post_id }}" />
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-warning" value="ตอบกลับ" />
        </div>
    </form>
    @include('comments.show', ['comments' => $comment->comments])
</div>
@endforeach
