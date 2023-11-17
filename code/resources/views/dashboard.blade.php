@if (Auth::guard('admin')->check())
  <?php $roles=App\Http\Controllers\URolesController::getrolesAdmin(); ?>
@else
  <?php $roles=App\Http\Controllers\URolesController::getroles(); ?>
@endif

@extends('layouts.app')

@section('content')

      <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2"> Overview dashboard </h2>
        <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
          <div class="btn-group bg-white p-3" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-link text-gray py-0 border-right">{{date("D")}}</button>
            <button type="button" class="btn btn-link text-dark py-0 border-right">{{date("M")}}</button>
            <button type="button" class="btn btn-link text-gray py-0">{{date("Y")}}</button>
          </div>
          <div class="dropdown ms-0 ml-md-4 mt-2 mt-lg-0">
            <button class="btn bg-white dropdown-toggle p-3 d-flex align-items-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-calendar me-1"></i>{{date("H:i:s")}} </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
              <h6 class="dropdown-header">Settings</h6>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="d-sm-flex justify-content-between align-items-center transaparent-tab-border {">
            <ul class="nav nav-tabs tab-transparent" role="tablist">
              <li class="nav-item">
                <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#" role="tab" aria-selected="true">Users</a>
              </li>
              @if($roles->contains('role_id',2))
              <li class="nav-item">
                <a class="nav-link active" id="business-tab" data-bs-toggle="tab" href="#business-1" role="tab" aria-selected="false">AE</a>
              </li>
              @endif

              @if($roles->contains('role_id',3))
              <li class="nav-item">
                <a class="nav-link" id="pricing-tab" data-bs-toggle="tab" href="#pricing" role="tab" aria-selected="false">Pricing</a>
              </li>
              @endif

              <li class="nav-item">
                <a class="nav-link" id="conversion-tab" data-bs-toggle="tab" href="#" role="tab" aria-selected="false">Conversion</a>
              </li>
            </ul>
            <div class="d-md-block d-none">
              <a href="#" class="text-light p-1"><i class="mdi mdi-view-dashboard"></i></a>
              <a href="#" class="text-light p-1"><i class="mdi mdi-dots-vertical"></i></a>
            </div>
          </div>
          <div class="tab-content tab-transparent-content">
            @if($roles->contains('role_id',2))
            <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
              <div class="row">
                <div class="col-xl-4 col-lg-6 col-sm-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body text-center">
                      <h5 class="mb-2 text-dark font-weight-normal">All Requested Rate</h5>
                      <h2 class="mb-4 text-dark font-weight-bold">{{$allCount}}</h2>
                      <div class="dashboard-progress dashboard-progress-1 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-lightbulb icon-md absolute-center text-dark"></i></div>
                      <p class="mt-4 mb-0">All Close Won Account Count</p>
                      <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{$closeWon}}</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body text-center">
                      <h5 class="mb-2 text-dark font-weight-normal">All Requested Rate</h5>
                      <h2 class="mb-4 text-dark font-weight-bold">{{$allCount}}</h2>
                      <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-account-circle icon-md absolute-center text-dark"></i></div>
                      <p class="mt-4 mb-0">All Close Lost Account Count</p>
                      <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{$closeLost}}</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4  col-lg-6 col-sm-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body text-center">
                      <h5 class="mb-2 text-dark font-weight-normal">All Requested Rate</h5>
                      <h2 class="mb-4 text-dark font-weight-bold">{{$allCount}}</h2>
                      <div class="dashboard-progress dashboard-progress-3 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-eye icon-md absolute-center text-dark"></i></div>
                      <p class="mt-4 mb-0">Pending Account</p>
                      <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{$pending}}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif

            @if($roles->contains('role_id',3))
            <div class="tab-pane fade show active" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
              <div class="row">
                <div class="col-xl-4 col-lg-6 col-sm-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body text-center">
                      <h5 class="mb-2 text-dark font-weight-normal">All Requested Rate</h5>
                      <h2 class="mb-4 text-dark font-weight-bold">{{$totalCount}}</h2>
                      <div class="dashboard-progress dashboard-progress-1 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-lightbulb icon-md absolute-center text-dark"></i></div>
                      <p class="mt-4 mb-0">All Close Won Account Count</p>
                      <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{$allWon}}</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body text-center">
                      <h5 class="mb-2 text-dark font-weight-normal">All Requested Rate</h5>
                      <h2 class="mb-4 text-dark font-weight-bold">{{$totalCount}}</h2>
                      <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-account-circle icon-md absolute-center text-dark"></i></div>
                      <p class="mt-4 mb-0">All Close Lost Account Count</p>
                      <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{$allLost}}</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4  col-lg-6 col-sm-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body text-center">
                      <h5 class="mb-2 text-dark font-weight-normal">All Requested Rate</h5>
                      <h2 class="mb-4 text-dark font-weight-bold">{{$totalCount}}</h2>
                      <div class="dashboard-progress dashboard-progress-3 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-eye icon-md absolute-center text-dark"></i></div>
                      <p class="mt-4 mb-0">Pending Account</p>
                      <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{$allPending}}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
    <!-- content-wrapper ends -->
  </div>
  @endsection
