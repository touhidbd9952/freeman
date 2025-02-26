@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Work</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Work Edit Form</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Work Edit Form
                        <a href="{{route('work.view')}}"  style="float: right;">View</a>
                    </h5>    
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                               
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                                </div>
                    @endif


                    <form action="{{url('work/update/'.$work->id)}}" enctype="multipart/form-data"  method="POST" class="form-horizontal">

                        @csrf
                        
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Worktype <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <select name="work_type_id" id="work_type_id" autocomplete="off" class="form-control @error('work_type_id') is-invalid @enderror" required>
                                    <option></option>
                                    @foreach($worktypes as $d)
                                    <option value="{{$d->id}}" {{$work->work_type_id ==  $d->id ? 'selected="selected"':''}}?>{{ $d->title }}</option>
                                    @endforeach
                                </select>
                                
                                @error('work_type_id')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Work Title <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="work_title" value="{{$work->work_title}}" class="form-control @error('work_title') is-invalid @enderror">
                                @error('work_title')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Work Charge (per hour) <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <input type="number"  name="charge" value="{{$work->charge}}" class="form-control @error('charge') is-invalid @enderror">
                                @error('charge')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>

                </div>
            </div>

        </div>
    </div>
</div>


  
@endsection


