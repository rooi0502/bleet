@section('content')
<div class="container">
<form action="{{ url('posts') }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
        <textarea id="body" class="form-control" name="body" rows="8" required></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">{{ __('つぶやく') }}</button>
</form>
</div>
@endsection