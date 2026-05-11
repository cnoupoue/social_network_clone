@extends('canevas')
@section('title', 'Login')
@section('content')
    @if(session('success'))
        <div class="alert-success">
            {{session('success')}}
        </div>
    @endif
    @guest
        <div class="auth-grid">
        <form action="{{route('auth.login')}}" method="post" class="auth-card">
            <div class="imgcontainer">
                <img src="/img/icons/logo_avatar.png" alt="Avatar" class="avatar">
            </div>
            @csrf
            <h2>Login</h2>
            <div class="container">
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>
                @error('email')
                {{$message}}
                @enderror
                <br>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                @error('password')
                {{$message}}
                @enderror

                <button type="submit" class="button-log">Login</button>
            </div>
        </form>
        <form action="{{route('auth.register')}}" method="post" class="auth-card">
            @csrf
            <h2>Register</h2>
            <div class="container">
                <label for="email"><b>Name</b></label>
                <input type="text" placeholder="Enter name" name="name" required>
                @error('name')
                {{$message}}
                @enderror
                <br>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" id="email" required>
                @error('email')
                {{$message}}
                @enderror
                <br>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="psw" required>
                @error('password')
                {{$message}}
                @enderror
                <button type="submit" class="button-log">Register</button>
            </div>
        </form>
        </div>
    @endguest
    @auth
        <div class="panel">
            <h1>Account information</h1>
            <br>
            <ul>
                <li>Name : {{ Auth::user()->name }}</li>
                <li>Email : {{ Auth::user()->email }}</li>
            </ul>
        </div>
        @if(isset($posts))
            <h2 class="section-heading">My posts</h2>
            <table>
                @foreach($posts as $post)
                    <tr>
                        <th>{{$post->name}}</th>
                        <td><a href="{{route('post.edit', $post->id)}}">Edit</a></td>
                        <td class="to-delete"><a href="{{route('post.delete', $post->id)}}">Delete</a></td>
                    </tr>
                @endforeach
            </table>
        @else
            You have no post.
        @endif
        <br>
        @if(isset($notifications))
            <h2 class="section-heading">My notifications</h2>
            <button><a href="{{route('notification.read', \Illuminate\Support\Facades\Auth::user())}}">Read all</a></button>
            <table>
                @foreach($notifications as $notification)
                    @php
                        $notificationContent = \App\Http\Controllers\NotificationController::getContent($notification);
                    @endphp
                    <tr>
                        <th>{{$notificationContent}}</th>
                    </tr>
                @endforeach
            </table>
        @else
            You have no notifications.
        @endif
    @endauth
@endsection
