@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>

            <div class="card">
                <div class="card-header">No friends</div>

                <div class="card-body">
                  <table>
                  @foreach ($users as $user)
                  <tr>
                      <td>{{ $user->firstname }}</td>
                      <td>
                        <form method="POST" action="{{ route('store-friendship') }}">
                          @csrf
                          <input type="hidden" name="user_id" value="{{ $user->id }}" />
                          <button class="btn btn-primary" type="submit">Ask</button>
                        </form>
                      </td>
                  </tr>
                  @endforeach
                </table>
                </div>
              </div>

              <div class="card">
                  <div class="card-header">Friends</div>

                  <div class="card-body">
                    <table>
                    @foreach ($myFriends as $friend)
                    <tr>
                        <td>{{ $friend->firstname }}</td>
                    </tr>
                    @endforeach
                  </table>
                  </div>
                </div>
        </div>
    </div>
</div>
@endsection