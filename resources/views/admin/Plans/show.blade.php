@extends('layouts.admin')

@section('content')
  <div class="container">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="row ">
      <div class="col-md-6 m-auto">
        <div class="card">
          <div class="card-body">
              <form action="{{route('store.plan')}}" method="post">
                  @csrf
                  <div class="form-group">
                      <label for="plan name">Plan Name:</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Plan Name">
                  </div>
                  <div class="form-group">
                      <label for="cost">Cost:</label>
                      <input type="text" class="form-control" name="cost" placeholder="Enter Cost">
                  </div>
                  <div class="form-group">
                      <label for="cost">Mouthly / Yearly:</label>
                      <select class="form-control" required name="description">
                        <option value="Monthly">Monthly</option>
                        <option value="Yearly">Yearly</option>
                      </select>
                      <input type="hidden" name="status" value="1">
                  </div>
                  <button type="submit" class="btn btn-primary btn-block">Save</button>
              </form>
          </div>
      </div>
      </div>
    </div>
  </div>
@endsection
