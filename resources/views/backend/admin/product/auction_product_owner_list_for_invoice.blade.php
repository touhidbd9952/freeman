@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Auction Product Owner</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Auction Product Owner List </li>
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
                        Auction Product Owner List (Search Date: {{$enddate}})
                    </h5>    
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                               
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                                </div>
                    @endif


                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name </th>
                                    <th>Company </th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($auctionproductownerlist as $d)
                            <?php 
                            $companyname ="";
                            if($d->company_name_jp !="")
                            {
                                $companyname = $d->company_name_jp;
                            }
                            else if($d->company_name_en !="")
                            {
                                $companyname = $d->company_name_en;
                            }
                            else if($d->name_jp !="")
                            {
                                $companyname = $d->name_jp;
                            }
                            else if($d->name_en !="")
                            {
                                $companyname = $d->name_en;
                            }
                            ?>
                                <tr>
                                    <td>{{ $auctionproductownerlist->firstitem()+$loop->index }}</td>
                                    <td>{{ $d->name_en}}</td>
                                    <td>{{ $companyname}}</td>
                                    <td>{{ $d->email1 }}</td>
                                    <td>{{ $d->phone1 }}</td>
                                    <td>
                                        <a href="{{url('auction/product_owner_invoice/'.$d->id.'/'.$enddate)}}" class="btn btn-success">Generate Invoice</a>
                                    </td>
                                    
                                </tr>
                            @endforeach
                                
                            </tbody>
                            
                        </table>

                        {{ $auctionproductownerlist->links() }}

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection


