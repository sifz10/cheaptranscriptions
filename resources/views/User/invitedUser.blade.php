@extends('layouts.users')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
      <br>
      <br>
      <br>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
          </div>

          <p>Hi <b> {{ Auth::user()->name }} </b>, Good to see you again. </p>
          <hr>

          <div class="container">
            <div class="row">
              <div class="col-md-12">
                @include('Alerts.success')
                @include('Alerts.danger')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/sent/user/invite" method="post">
                  {{ csrf_field() }}
                  <label for="">Name</label>
                  <input type="text" class="form-control mb-3" name="name">
                  <label for="">Email</label>
                  <input type="email" class="form-control mb-3" name="email">
                  <input type="hidden" class="form-control mb-3" name="password" value="{{ rand() }}">
                  <button type="submit" class="btn btn-success" name="button">Sent Invite</button>
                </form>
              </div>

              <div class="col-md-12 mt-5">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Handle</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                      <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          <a href="{!! route('user.users.delete', $user->id) !!}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                    @empty

                    @endforelse

                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </main>
@endsection
