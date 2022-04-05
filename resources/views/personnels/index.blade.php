@extends('layouts.app')

@section('contenu')
<div class="row">
          <!-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box  text-light">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
              <a href="#" class="nav-link">
              <span class="info-box-text text-dark" style="font-size:13px">Settings</span>
              </a>
              </div>
            /.info-box-content -->
           <!--  </div>
            /.info-box
          </div> -->
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4 text-danger">
            <div class="info-box mb-3 bg-dark">
              <span class="info-box-icon  elevation-1 text-danger"><i class="fas fa-thumbs-down "></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sanctionné</span>
                <span class="info-box-number">{{$sanctions->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4 text-success ">
            <div class="info-box mb-3 bg-dark">
              <span class="info-box-icon  elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Personnel</span>
                <span class="info-box-number">{{$personnels->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4 text-warning">
            <div class="info-box mb-3 bg-dark ">
              <span class="info-box-icon  elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Utilisateur</span>
                <span class="info-box-number">{{$users->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
@endsection