@extends('layouts.admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-sm-12" style="margin-left: 5rem; margin-top: 5rem">
                @include('Alerts.success')
                @include('Alerts.danger')
                  <div class="widget-content widget-content-area br-6">
                    <a href="{!! route('create.plan') !!}" class="btn btn-primary float-right" style="margin: 1rem">Create new</a>
                    <h4 href="#" class="float-left" style="margin: 1rem">All Packages</h4>
                      <div class="table-responsive mb-4 mt-4">
                          <table id="zero-config" class="table table-hover" style="width:100%">
                              <thead>
                                  <tr>
                                      <th>Sl. No</th>
                                      <th>Title</th>
                                      <th>Cost</th>
                                      <th>Monthly / Yearly</th>
                                      <th>Actions</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($plans as $plan)
                                  <tr>
                                      <td>{{ $loop->index+1 }}</td>
                                      <td>{{ $plan->name }}</td>
                                      <td>${{ number_format($plan->cost, 2) }}</td>
                                      <td>{{ $plan->description }}</td>
                                      <td>
                                        @if ($plan->status == 0)
                                          <a href="{!! route('admin.active.plan', $plan->id) !!}" class="btn btn-success rounded bs-tooltip"  data-placement="right" title="Active"> Active </a>
                                        @else
                                          <a href="{!! route('admin.pause.plan', $plan->id) !!}" class="btn btn-danger rounded bs-tooltip"  data-placement="right" title="Pause"> Pause </a>
                                        @endif
                                      </td>
                                  </tr>
                                @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Sl. No</th>
                                  <th>Title</th>
                                  <th>Cost</th>
                                  <th>Monthly / Yearly</th>
                                  <th>Actions</th>
                                </tr>
                              </tfoot>
                          </table>
                      </div>
                  </div>
              </div>
    </div>
  </div>


@endsection
