@extends('main')

@section('content')
@if($message = Session::get('success'))

<div class="alert alert-info">
    {{ $message }}
</div>

@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center text-success">รายละเอียดโพส</h3>
                    <br />
                    <h2>หัวข้อ : {{ $post->title }}</h2>
                    <p>
                        {{ $post->message }}
                    </p>
                    <hr />
                    <h5>คอมเมนท์</h5>

                    @include('comments.show', ['comments' => $post->comments, 'post_id' => $post->id])

                    <hr />
                    <h5>เพิ่มคอมเมนท์</h5>
                    <form method="post" action={{ route('comment.store') }}>
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="message" required></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            <input type="hidden" name="user_id" value="{{ $post->user_id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Comment" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
