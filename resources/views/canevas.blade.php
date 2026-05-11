<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Cameron Noupoué">
    <meta name="keywords" content="Cameron,Noupoué,Site Personnel, Blog">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Polices -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    <link rel="stylesheet" type="text/css" href="/styles/social.css">
    <script defer src="script/social.js"></script>
</head>
@php
    $routeName = request()->route()->getName();
@endphp
<body>
    <header class="topbar">
        <a href="{{route('index')}}" class="topbar-logo">
            <span class="brand-mark">N</span>
            <span>Network</span>
        </a>
        <nav class="topbar-nav">
            <a href="{{route('auth.login')}}" @class(['active' => str_starts_with($routeName, 'auth.')])>@auth My account @endauth @guest Login @endguest</a>
        </nav>
    </header>
    <section class="hero">
        <div class="container hero-inner">
            <div>
                <p class="eyebrow">Social space</p>
                <h1>Share what's alive today.</h1>
            </div>
            <a href="{{route('post.create')}}" class="hero-action">Create post</a>
        </div>
    </section>
    <div class="container site">
        <nav class="sidebar">
            <a href="{{route('index')}}" @class(['sidebar-home', 'active' => str_starts_with($routeName, 'index')])>News</a>
            <a href="{{route('chatrooms')}}" @class(['sidebar-messages', 'active' => str_starts_with($routeName, 'chatrooms')])>Chatrooms</a>
            <a href="#" @class(['sidebar-events', 'active' => str_starts_with($routeName, 'events.')])>Events</a>
            <a href="{{route('friend.index')}}" @class(['sidebar-amis', 'active' => str_starts_with($routeName, 'friend.')])>Friends</a>
        </nav>
        <main class="main">
            @if(session('success'))
                <div class="alert-success">
                    {{session('success')}}
                </div>
            @elseif(session('wrong'))
                <div class="alert-wrong">
                    {{session('wrong')}}
                </div>
            @endif
            @yield('content')
        </main>
        <aside class="aside">
            <article class="card">
                <header class="card-header card-header-avatar">
                    <section>
                        <img src="/img/icons/avatar.png" width="45" height="45" class="card-avatar" alt="Profile picture">
                    </section>
                    <section>
                        @auth
                        <div class="card-title">{{ Auth::user()->name }}</div>
                        <div class="card-date">Registered since {{Auth::user()->created_at}}</div>
                        <form method="get" action="{{route('post.create')}}" class="side-form">
                            @csrf
                            <button type="submit">New post</button>
                        </form>
                        <form method="POST" action="{{route('auth.logout')}}" class="side-form">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>

                        @endauth
                        @guest
                        <div class="card-title">As a guest</div>
                        @endguest
                    </section>
                </header>
                <div class="card-body">
                    <p>
                        @guest
                        <a href="{{route('auth.login')}}">Login/Sign Up</a>.
                        @endguest
                    </p>
                </div>
            </article>
            <div class="sidebar-title">Suggestions</div>
            <div class="friends-list">
                @foreach($suggestions as $suggest)
                    <div class="friend">
                        <img src="/img/icons/avatar.png" width="40" height="40" alt="">
                        <div class="friend-body">
                            <a href="#" class="friend-name">{{ $suggest->name }}</a>
                            @auth
                            <div class="friend-connections">3 common friends</div>
                            <a href="{{ route('friend.add', ['person1' => \Illuminate\Support\Facades\Auth::id(), 'person2' => $suggest->id]) }}" class="friend-add">Add friend</a>
                            @endauth
                            @guest
                                You have to be logged to add this friend.
                            @endguest
                        </div>
                    </div>
                @endforeach
            </div>
        </aside>
    </div>
    <footer>

    </footer>
</body>

</html>
