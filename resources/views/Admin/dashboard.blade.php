@extends('layout.admin')
@section('title', '')

@section('content')
    <section>
        <div class="container">
            <h1 class="text-center">Our Dashboard</h1>
            <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-primary">
                    <div class="inner">
                      <h3>{{ $blogpost_count }}</h3>

                      <p>Blog Posts</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-paper-outline"></i>
                    </div>
                    <a href="/dashboard/blog" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>{{ $service_items_count }}</h3>

                      <p>Services</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-flag-outline"></i>
                    </div>
                    <a href="/dashboard/services" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>{{ $portfolio_count }}</h3>

                      <p>Porfolio</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-briefcase-outline"></i>
                    </div>
                    <a href="/dashboard/clients" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-dark">
                    <div class="inner">
                      <h3>{{ $activities_gallery_count }}</h3>

                      <p>Activity</p>
                    </div>
                    <div class="icon text-gray">
                      <i class="ion ion-ios-pulse-strong"></i>
                    </div>
                    <a href="/dashboard/galleries" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
        </div>
    </section>
@endSection
