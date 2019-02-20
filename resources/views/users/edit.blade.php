@extends('layouts.app')
@section('title', 'Bleeter')
@section('content')
<div class="container">
<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <div class="col-md-4">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ url('users/'.$user->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="image">プロフィール画像</label>
                @if(!$user->image == null)
                    <figure>
                    <img src="/storage/{{$user->image}}" class="image_size_m">
                    </figure>
                @endif
                <input type="file" name="image">
                <label for="name">名前</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">{{ __('編集') }}</button>
        </form>
    </div>
</div>
@endsection