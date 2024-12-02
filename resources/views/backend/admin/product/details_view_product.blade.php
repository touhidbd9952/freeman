@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Product</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Edit Form</li>
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
                    Product Details View
                    <a href="javascript:" onclick="history.back(); return false;"  style="float: right;">Back</a>
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif
                    
                    <form action="{{route('product.update',[$product->id])}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="old_img" value="{{$product->thumbnail_image}}">
                        <input type="hidden" name="old_sm_img" value="{{$product->thumbnail_sm_image}}">
                        <input type="hidden" name="product_no" value="{{$product->product_no}}">

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Name</label>
                            <div class="col-sm-6">
                                <input type="text"  name="name_en" autocomplete="off" class="form-control @error('name_en') is-invalid @enderror" 
                                placeholder="Product Name In English" value="{{$product->name_en}}">
                                @error('name_en')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Name (JP)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="name_jp" autocomplete="off" class="form-control @error('name_jp') is-invalid @enderror"
                                    placeholder="Product Name In Japanese" value="{{$product->name_jp}}">
                                @error('title_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Category</label>
                            <div class="col-sm-6">
                                <select name="category_id" id="categoryList" autocomplete="off" class="form-control @error('category_id') is-invalid @enderror" required>
                                    <option></option>
                                    @foreach($categories as $cat)
                                    <option value="{{$cat->id}}" {{$product->category_id ==  $cat->id?'selected':''}}>{{ $cat->name_en }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Brand</label>
                            <div class="col-sm-6">
                                <select name="brand_id" id="brandList" autocomplete="off" class="form-control @error('brand_id') is-invalid @enderror" required>
                                    <option></option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}" {{$product->brand_id ==  $brand->id?'selected':''}}>{{ $brand->name_en }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Model No</label>
                            <div class="col-sm-6">
                                <input type="text"  name="model_no" autocomplete="off" class="form-control @error('model_no') is-invalid @enderror" 
                                placeholder="Product model number" value="{{$product->model_no}}">
                                @error('model_no')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Serial No</label>
                            <div class="col-sm-6">
                                <input type="text"  name="serial_no" autocomplete="off" class="form-control @error('serial_no') is-invalid @enderror" 
                                placeholder="Product serial number" value="{{$product->serial_no}}">
                                @error('serial_no')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Year</label>
                            <div class="col-sm-6">
                                <input type="number"  name="model_year" autocomplete="off" class="form-control @error('model_year') is-invalid @enderror" 
                                placeholder="Product year" value="{{$product->model_year}}">
                                @error('model_year')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Used hours</label>
                            <div class="col-sm-6">
                                <input type="number"  name="used_hour" autocomplete="off" class="form-control @error('used_hour') is-invalid @enderror" 
                                placeholder="Product used hours" value="{{$product->used_hour}}">
                                @error('used_hour')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Buy Price</label>
                            <div class="col-sm-6">
                                <input type="number"  name="buy_price" autocomplete="off" class="form-control @error('buy_price') is-invalid @enderror" 
                                placeholder="Product buy price" value="{{$product->buy_price}}">
                                @error('buy_price')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Sale Price</label>
                            <div class="col-sm-6">
                                <input type="number"  name="sale_price" autocomplete="off" class="form-control @error('sale_price') is-invalid @enderror" 
                                placeholder="Product sale price" value="{{$product->sale_price}}">
                                @error('sale_price')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Short Description</label>
                            <div class="col-sm-6">
                                <textarea  name="short_description" autocomplete="off" class="form-control @error('short_description') is-invalid @enderror"
                                    placeholder="Product Short Description">{{$product->short_description}}</textarea>
                                @error('short_description')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Short Description (JP)</label>
                            <div class="col-sm-6">
                                <textarea  name="short_description_jp" autocomplete="off" class="form-control @error('short_description_jp') is-invalid @enderror"
                                    placeholder="Product Short Description In Japanese">{{$product->short_description_jp}}</textarea>
                                @error('short_description_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Details Description</label>
                            <div class="col-sm-6">
                                <textarea  name="long_description" autocomplete="off" class="form-control @error('long_description') is-invalid @enderror"
                                    placeholder="Product Details Description" style="min-height: 120px">{{$product->long_description}}</textarea>
                                @error('long_description')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Details Description (JP)</label>
                            <div class="col-sm-6">
                                <textarea  name="long_description_jp" autocomplete="off" class="form-control @error('long_description_jp') is-invalid @enderror"
                                    placeholder="Product Details Description In Japanese" style="min-height: 120px">{{$product->long_description_jp}}</textarea>
                                @error('long_description_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Delivery Place</label>
                            <div class="col-sm-6">
                                
                                <select type="text"  name="delivery_place"  class="form-control" style="width: 50%;float: left;">
                                    <option value="" selected="selected">---</option>
                                      <option value="Narita" {{$product->delivery_place == "Narita"?'selected':''}}>Narita</option>
                                      <option value="Kobe" {{$product->delivery_place == "Kobe"?'selected':''}}>Kobe</option>
                                      <option value="Tomakomai" {{$product->delivery_place == "Tomakomai"?'selected':''}}>Tomakomai</option>
                                      <option value="Osaka" {{$product->delivery_place == "Osaka"?'selected':''}}>Osaka</option>
                                      <option value="Yokohama" {{$product->delivery_place == "Yokohama"?'selected':''}}>Yokohama</option>
                                      <option value="Kikugawa(Shizuoka Prf.)" {{$product->delivery_place == "Kikugawa(Shizuoka Prf.)"?'selected':''}}>Kikugawa</option>
                                      <option value="Koga" {{$product->delivery_place == "Koga"?'selected':''}}>Koga</option>
                                      <option value="Hakata" {{$product->delivery_place == "Hakata"?'selected':''}}>Hakata</option>
                                      <option value="Fukuoka" {{$product->delivery_place == "Fukuoka"?'selected':''}}>Fukuoka(Shingu)</option>
                                      <option value="Consignor" {{$product->delivery_place == "Consignor"?'selected':''}}>Consignor's</option>
                                </select>
                                <select type="text"  name="delivery_status"  class="form-control" style="width: 50%;display: inline-block;">
                                    <option value="" selected="selected">---</option>
                                      <option value="Arrived">Arrived(搬入済) </option>
                                      <option value="Coming">Coming (未搬入)</option>
                                </select>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Releasing charge</label>
                            <div class="col-sm-6">
                                <input type="number"  name="releasing_charge" autocomplete="off" class="form-control @error('releasing_charge') is-invalid @enderror" 
                                placeholder="Product releasing charge" value="{{$product->releasing_charge}}">
                                @error('releasing_charge')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Thumbnail Image</label>
                            <div class="col-sm-6">
                                {{-- <input type="file"  name="thumbnail_image" id="imgInp"  class="form-control @error('productimage') is-invalid @enderror" 
                                onchange="loadFile(event)"> --}}
                                    <img src="{{asset($product->thumbnail_image)}}" id="output" style="width: 300px;height:auto;margin-top:10px;border:1px solid #ccc;">
                            </div>
                        </div>
                        

                        
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Owner</label>
                            <div class="col-sm-6">
                                <select name="woner_id" id="wonerList" autocomplete="off" class="form-control @error('woner_id') is-invalid @enderror" required>
                                    <option></option>
                                    @foreach($product_woners as $woner)
                                    <option value="{{$woner->id}}" {{$product->woner_id == $woner->id? 'selected':''}}>{{ $woner->name_en }}&nbsp;{{ $woner->phone1 }}</option>
                                    @endforeach
                                </select>
                                @error('woner_id')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Publish stock</label>
                            <div class="col-sm-6">
                                <select name="stock" class="form-control @error('stock') is-invalid @enderror">
                                    <option value="available" {{$product->stock == 'available'?'selected':''}}>Available</option>
                                    <option value="negotiating" {{$product->stock == 'negotiating'?'selected':''}}>Negotiating</option>
                                    <option value="sold_out" {{$product->stock == 'sold_out'?'selected':''}}>Sold out</option>
                                </select>
                                @error('stock')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Publish status</label>
                            <div class="col-sm-6">
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="active" {{$product->status == 'active'?'selected':''}}>Publish</option>
                                    <option value="inactive" {{$product->status == 'inactive'?'selected':''}}>Unpublish</option>
                                </select>
                                @error('status')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Allow comment</label>
                            <div class="col-sm-6">
                                <select name="allow_comment" class="form-control @error('allow_comment') is-invalid @enderror">
                                    <option value="no" {{$product->allow_comment == 'no'?'selected':''}}>No</option>
                                    <option value="yes" {{$product->allow_comment == 'yes'?'selected':''}}>Yes</option>
                                </select>
                                @error('allow_comment')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


<script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
      }
    };
  </script>



@endsection


