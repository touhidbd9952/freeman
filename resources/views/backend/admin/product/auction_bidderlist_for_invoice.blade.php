@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Auction Winner Bidder</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Auction Winner Bidder List </li>
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
                        Auction Winner Bidder List (Search Date: {{$enddate}})
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
                                    <th>Bidder_ID </th>
                                    <th>Name </th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($auctionmaxbidderlist as $d)
                                <tr>
                                    <td>{{ $auctionmaxbidderlist->firstitem()+$loop->index }}</td>
                                    <td>{{ $d->usercodeno }}</td>
                                    <td>{{ $d->company_name !=""?$d->company_name:$d->name }}</td>
                                    <td>{{ $d->email1 }}</td>
                                    <td>{{ $d->phone1 }}</td>
                                    <td>
                                        <a href="{{url('auction/bidder_winner_invoice/'.$d->id.'/'.$enddate)}}" class="btn btn-success">Generate Invoice</a>
                                    </td>
                                    
                                </tr>
                            @endforeach
                                
                            </tbody>
                            
                        </table>

                        {{ $auctionmaxbidderlist->links() }}

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection


