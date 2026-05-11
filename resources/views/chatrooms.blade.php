@extends('canevas')
@section('title', 'Chatrooms')
@section('content')
<div class="channel-grid">
    @foreach ($channels as $channel)
        <a href="{{route('channels.messages', $channel->id)}}" class="channels">
            <span>{{ $channel->name }}</span>
            <small>Open room</small>
        </a>
    @endforeach
</div>
@endsection
