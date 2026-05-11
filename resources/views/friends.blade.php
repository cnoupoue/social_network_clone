@extends('canevas')
@section('title', 'Friends')
@section('content')
    @auth
        @if(isset($friends))
            <h2 class="section-heading">My friends</h2>
            <table>
                @foreach($friends as $friend)
                    @if($friend->status == 'confirmed')
                        <tr>
                        @php
                        if($friend->person1 == \Illuminate\Support\Facades\Auth::id()) {
                            $other = \App\Models\User::find($friend->person2);
                        } else {
                            $other = \App\Models\User::find($friend->person1);
                        }
                        @endphp
                        <th>{{$other->name}}</th>
                        <td class="to-delete"><a href="{{ route('friend.remove', ['person1' => $friend->person1, 'person2' => $friend->person2]) }}">Delete</a></td>
                    </tr>
                    @endif
                @endforeach
            </table>
            <h2 class="section-heading">My friends requests</h2>
            <table>
                @foreach($friends as $friend)
                    @if($friend->status == 'pending' && $friend->person1 != \Illuminate\Support\Facades\Auth::id())
                        <tr>
                            @php
                                if($friend->person1 == \Illuminate\Support\Facades\Auth::id()) {
                                    $other = \App\Models\User::find($friend->person2);
                                } else {
                                    $other = \App\Models\User::find($friend->person1);
                                }
                            @endphp
                            <th>{{$other->name}}</th>
                            <td><a href="{{ route('friend.accept', ['friendship' => $friend]) }}">Accept</a></td>
                            <td class="to-delete"><a href="{{ route('friend.remove', ['person1' => $friend->person1, 'person2' => $friend->person2]) }}">Delete</a></td>
                        </tr>
                    @endif
                @endforeach
            </table>
        @else
            You have no friends.
        @endif
    @endauth
    @guest
        <p>You have to be <a href="{{route('auth.login')}}" class="backLink">logged</a> to watch this discussion</p>
    @endguest
@endsection
