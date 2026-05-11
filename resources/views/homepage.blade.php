@extends('canevas')
@section('title', 'Create a post')
@section('content')
    @foreach($posts as $post)
        <article class="card profil">
            <header class="card-header card-header-avatar">
                <section>
                    <img src="img/icons/avatar.png" width="45" height="45" class="card-avatar" alt="profile picture">
                </section>
                <section>
                    @php
                        $user = \App\Models\User::find($post->owner);
                    @endphp
                    <div class="card-title">{{$user->name}}</div>
                    <div class="card-date">{{$post->created_at}} @if($post->updated_at != $post->created_at) <b>(edited)</b> @endif</div>
                </section>
            </header>
            <div class="card-body">
                @if($post->picture_link)
                    <img src="{{$post->imageUrl()}}" alt="paysage" class="fullwidth">
                @endif
                <h3>{{$post->name}}</h3>
                <p>{{$post->content}}</p>
            </div>
            <footer class="card-footer">
                <a href="#" class="card-like">{{$post->likes}} likes</a>
                <a href="#" class="card-comments">252 commentaires</a>
            </footer>
        </article>
    @endforeach
    <div class="pagination">
        {{ $posts->links() }}
    </div>
@endsection
