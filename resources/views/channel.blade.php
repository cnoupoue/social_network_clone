@extends('canevas')
@section('title', 'Channel')
@section('content')
@auth
@if(empty($messages[0]->name))
<div class="empty-state">This chat is empty, post a new message to start it!</div>
@else
<div class="channel-head">
          <h1>{{ $messages[0]->name }}</h1>
          <p>{{ $messages[0]->topic }}</p>
</div>
<div class="messages-list">
@foreach ($messages as $message)
<div class="message">
          <h3 class="msgContent">{{ $message->username }} - <span class="dateMessage">{{ $message->updated_at }}</span></h3>
          <p class="msgContent">{{ $message->content }}</p>
</div>
@endforeach
  </div>
<h3 class="msgContent new-message-title">New message</h3>
<form method="POST" action="{{route('channels.messages', $messages[0]->id)}}">
          @csrf
          <textarea name="message" rows="4" cols="50" required></textarea>
          <br>
          <button type="submit">Publish</button>
</form>
<br>
@endif
@endauth
@guest
<p>You have to be <a href="{{route('auth.login')}}" class="backLink">logged</a> to watch this discussion</p>
@endguest
<a href="{{route('chatrooms')}}" class="backLink">Back to chatrooms</a>
@endsection
