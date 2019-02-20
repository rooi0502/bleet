@php
    $title = env('APP_NAME');
@endphp

@extends('layouts.app')
@section('title', 'Bleeter')
@section('content')
<div class="container">
  <link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
  <!-- 投稿フォーム部分 -->
  <div class="row">
    <div class="col-md-4">
      <section class="user_info">
        <label for="name">{{ $user->name }}</label>
        <figure>
          @if ($user->image == null)
            <img src="/storage/no-image.png" class="image_size_m">
          @else
            <img src="/storage/{{$user->image}}"　class="image_size_m">
          @endif
        </figure>
      </section>
      <section class="post_form">
        <form action="{{ url('posts') }}" method="post">
            {{ csrf_field() }}
            <div class="field">
            <textarea id="content" name="content" required></textarea>
                @if ($errors->has('content'))
                  <span class="invalid-feedback" role="alert">
                    <p>{{ $errors->first('content') }}</p>
                  </span>
                @endif
            </div>
            <button type="submit" name="submit" class="btn btn-primary">{{ __('つぶやく') }}</button>
        </form>
      </section>
    </div>
    <div class="col-md-6">
      <!-- ▼twitter風ここから -->
      <div class="twitter__container">
        <!-- タイトル -->
        <div class="twitter__title">
          <span class="twitter-logo"></span>
        </div>
        <!-- ▼タイムラインエリア scrollを外すと高さ固定解除 -->
        <div class="twitter__contents ">
          <!-- 記事エリア -->
          @foreach ($posts as $post)
            <div class="twitter__block">
              <figure>
                @if ($user->image == null)
                  <img src="/storage/no-image.png">
                @else
                  <img src="/storage/{{$user->image}}">
                @endif
              </figure>
              <div class="twitter__block-text">
                <div class="name">{{ $user->name }}<span class="name_reply"></span></div>
                <div class="date">{{ $post->created_at }}</div>
                <div class="text">
                  {{ $post->content }}<br>
                </div>
                <div class="twitter__icon">
                  <span class="twitter-bubble"></span>
                  <span class="twitter-loop"></span>
                  <span class="twitter-heart"></span>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <!--　▲タイムラインエリア ここまで -->
      </div>
      {{ $posts->links() }}
      <!--　▲twitter風ここまで -->
    </div>
  </div>
</div>
<!-- ここまで -->
@endsection