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
              <form action="{{route('store.edit.plan', [$plan->id])}}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group">
                      <label for="plan name">Plan Name:</label>
                      <input type="hidden" name="plan_id" value="{{ $plan->plan_id }}">
                      <input type="text" class="form-control" name="name" placeholder="Enter Plan Name" value="{{ $plan->name }}">
                  </div>
                  <div class="form-group">
                      <label for="cost">Cost:</label>
                      <input type="text" class="form-control" name="cost" placeholder="Enter Cost" value="{{ $plan->cost }}">
                  </div>
                  <div class="form-group">
                      <label for="cost">Mouthly / Yearly:</label>
                      <select class="form-control" required name="description">
                        <option @if($plan->description == "monthly") selected @endif value="monthly">Monthly</option>
                        <option @if($plan->description == "yearly") selected @endif  value="yearly">Yearly</option>
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
