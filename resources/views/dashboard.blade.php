@extends('main')

@section('content')
@if($message = Session::get('success'))

<div class="alert alert-info">
    {{ $message }}
</div>

@endif

<div class="py-12">
    <div class="container">
        <div class="row">
            {{-- Table --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ตารางรายการโพส</div>
                    <div class="card-body">
                        <div class="py-12">
                            <div class="container">
                                <div class="row">

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>หัวข้อ</th>
                                                <th>ผู้โพส</th>
                                                <th>เมื่อ</th>
                                                <th>แก้ไขล่าสุด</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($posts as $row)
                                            <tr>
                                                <th>{{$row->title}}</th>
                                                <th>{{$row->user->name}}</th>
                                                <td>{{ $row->created_at }}</td>
                                                <td>{{ $row->updated_at }}</td>
                                                <td>
                                                    <a href={{ route('posts.show', ['id'=>$row->id]) }} class="btn
                                                        btn-primary">รายละเอียด</a>
                                                    @if (Auth::user()->id==$row->user_id)
                                                    <a href={{ route('dashboard', ['id'=>$row->id]) }} class="btn
                                                        btn-warning">แก้ไข</a>
                                                    <a href={{ route('posts.delete', ['id'=>$row->id]) }} class="btn
                                                        btn-danger"
                                                        onclick="return confirm('ต้องการลบโพสนี้หรือไม่')" >ลบ</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- Tab page --}}
                                    {{ $posts->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- Form --}}
            <div class="col-md-4">
                <div class="card">
                    @if ($post)
                    <div class="card-header">แก้ไขโพส</div>
                    <div class="card-body">
                        <form method="POST" action={{ route('posts.update', ['id'=>$post->id]) }}>
                            <div class="form-group">
                                @csrf
                                <label class="label">Post Title: </label>
                                <input type="text" name="title" class="form-control" required
                                    value="{{$post->title}}" />
                            </div>
                            <div class="form-group">
                                <label class="label">Post Message: </label>
                                <textarea name="message" rows="10" cols="30" class="form-control"
                                    required>{{ old('message', $post->message) }}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" />
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="card-header">สร้างโพส</div>
                    <div class="card-body">
                        <form method="POST" action={{ route('posts.store') }}>
                            <div class="form-group">
                                @csrf
                                <label class="label">Post Title: </label>
                                <input type="text" name="title" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label class="label">Post Message: </label>
                                <textarea name="message" rows="10" cols="30" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" />
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection('content')
