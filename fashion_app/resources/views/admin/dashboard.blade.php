@extends('admin.master')
@section('content')
    <h1>Chức năng hệ thống</h1>
    <div class="row">
        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-primary bubble-shadow-small">
                    <i class="fas fa-clipboard-list"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">Đơn hàng</h4>
                    <a href="{{route('admin.orders')}}" class="btn btn-black card-title">Đi đến</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fas fa-box"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">Sản phẩm</h4>
                    <a href="{{route('admin.products')}}" class="btn btn-black card-title">Đi đến</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center icon-success bubble-shadow-small"
                  >
                  <i class="fas fa-users"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">Khách hàng</h4>
                    <a href="{{route('admin.customers')}}" class="btn btn-black card-title">Đi đến</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center icon-secondary bubble-shadow-small"
                  >
                    <i class="fas fa-envelope-square"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <h4 class="card-title">Tin nhắn</h4>
                    <a href="/admin" class="btn btn-black card-title">Đi đến</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

@endsection