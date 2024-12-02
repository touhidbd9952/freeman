@extends('layouts.admin_master')

@section('content')

<style>
  .page{background: #fbfafa;}
  
  @font-face {
    font-family: 'password';
    font-style: normal;
    font-weight: 400;
    src: url(https://jsbin-user-assets.s3.amazonaws.com/rafaelcastrocouto/password.ttf);
  }
  input.myclass{font-family: 'password';width: 250px;border: 1px solid #ccc;}
  </style>
<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <?php 
            $loginuser = Illuminate\Support\Facades\Auth::user()->name;  
            ?>

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard &nbsp;: &nbsp;{{$loginuser}}</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
      <div class="col-md-6"></div>
       <div class="col-md-6" style="height: 30px;margin-bottom:20px;">
        <form action="{{route('admin.tokenno')}}" method="post" >
                       
          @csrf

          <div class="form-group row">
              <label for="fname"
                  class="col-sm-3 text-end control-label col-form-label" >User Token No</label>
              <div class="col-sm-9">
                  <input id="password" type="search"  name="password_token"  autocomplete="off" class="form-control myclass @error('password_token') is-invalid @enderror" required style="width: 200px;float: left;">
                  @error('password_token')
                      <span class="text-danger"> {{$message}}  </span>
                  @enderror
              
                  <button type="submit" class="btn btn-primary" style="float:left;margin-left:5px;">
                      Add
                  </button>
              </div>
          </div>
      </form> 
       </div>
    </div> 

    <div class="row">
        

        <?php 
        $worktypes = App\Models\Worktype::latest()->take(10)->get();  
        $works = App\Models\Work::latest()->with('worktype')->take(10)->get();  
        ?>

        <!----======= last 10  Categories  ==========---->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Worktypes <span style="float: right;font-size:10px;">last 10</span></h3>
                  
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                      <th>Title</th>
                      <th>Created_at</th>
                      <th>Updated_at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($worktypes as $c)      
                    <tr>
                      <td>{{$c->title}}</td>
                      <td>
                        {{$c->created_at}}
                      </td>
                      <td>
                        {{$c->updated_at}}
                      </td>
                    </tr>

                    @endforeach
                    
                    </tbody>
                  </table>
                </div>
              </div>

        </div>

        <!----======= last 10  Products  ==========---->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Works <span style="float: right;font-size:10px;">last 10</span></h3>
                  
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                      <th>Work_type</th>
                      <th>Work_title</th>
                      <th>Charge (per hour)</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($works as $p)
                    <?php 
                    if($p->work_type_id == 2)
                    {
                    ?>  
                    <tr>
                      <td>
                        {{$p->worktype->title}}
                      </td>
                      <td>{{$p->work_title}}</td>
                      <td>
                        {{$p->charge}}&nbsp;¥
                      </td>
                    </tr>
                    <?php 
                    }
                    ?>
                    @endforeach

                    @foreach($works as $p)
                    <?php 
                    if($p->work_type_id == 1)
                    {
                    ?>  
                    <tr>
                      <td>
                        {{$p->worktype->title}}
                      </td>
                      <td>{{$p->work_title}}</td>
                      <td>
                        {{$p->charge}}&nbsp;¥
                      </td>
                    </tr>
                    <?php 
                    }
                    ?>
                    @endforeach
                    
                    </tbody>
                  </table>
                </div>
              </div>

        </div>

    </div>
</div>
@endsection
