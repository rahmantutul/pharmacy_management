@extends('backend.layouts.app')

@push('style')
    
@endpush

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{__('Sytstem Info')}}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('Medicine Create')}}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('medicine.index')}}">{{__('Medicine List')}}</a>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- livicons start -->
        <section id="font-livicons">
            <div class="row">
                <div class="col-md-10 m-auto ">
                    <div class="card">
                        <div class="card-header text-center"><h4>{{__('Medicine create')}}</h4></div>
                        @if (count($errors) > 0)
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                              <li class="alert alert-danger">{!! $error !!}</li>
                            @endforeach
                        </ul>
                        @endif 
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <form method="POST" method="post" action="{{ route('medicine.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="qrcode" class="form-label">{{__('QR Core')}}</label>
                                            <input id="qrcode" type="text" class="form-control " name="qrcode" value="{{old('qrcode')}}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="hnscode" class="form-label">{{__('HNS Core')}}</label>
                                            <input id="hnscode" type="text" class="form-control " name="hnscode" value="{{old('hnscode')}}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{__('Name')}}</label>
                                            <input id="name" type="text" class="form-control " name="name" value="{{old('name')}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="strength" class="form-label">{{__('Strength')}}</label>
                                            <input id="strength" type="text" class="form-control " name="strength" value="{{old('strength')}}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="genericname" class="form-label">{{__('Generic Name')}}</label>
                                            <input id="genericname" type="text" class="form-control" name="genericname" value="{{old('genericname')}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="leafId" class="form-label">{{__('Box Size')}}</label>
                                            <select class="form-select form-select-sm mb-3 single-select" name="leafId" required aria-label=".form-select-sm example" required>
                                                <option value="">{{__('Box Size')}}</option>
                                                @foreach ($leaves as $key=>$leaf)
                                                 <option value="{{$leaf->id}}">{{$leaf->name}}({{$leaf->qty}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="shelf" class="form-label">{{__('Shelf')}}</label>
                                            <input id="shelf" type="text" class="form-control" name="shelf" value="{{old('shelf')}}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="desc" class="form-label">{{__('Desc')}}</label>
                                            <input id="desc" type="text" class="form-control" name="desc" value="{{old('desc')}}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="Category" class="form-label">{{__('Category')}}</label>
                                            <select class="form-select form-select-sm mb-3 single-select" name="categoryId" required aria-label=".form-select-sm example" required>
                                                <option value="">{{__('Select Category')}}</option>
                                                @foreach ($categories as $key=>$cat)
                                                 <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">{{__('Image')}}</label><br>
                                            <input id="image" type="file" class="form-control" name="image" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">{{__('Price')}}</label>
                                            <input id="price" type="number" class="form-control" name="price" value="{{old('price')}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="vendorId" class="form-label">{{__('Vendor')}}</label>
                                            <select class="form-select form-select-sm mb-3 single-select" name="vendorId" required aria-label=".form-select-sm example" required>
                                                <option value="">{{__('Select Vendor')}}</option>
                                                @foreach ($vendors as $key=>$vendor)
                                                 <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="supplierId" class="form-label">{{__('Supplier')}}</label>
                                            <select class="form-select form-select-sm mb-3 single-select" name="supplierId" required aria-label=".form-select-sm example" required>
                                                <option value="">{{__('Select Supplier')}}</option>
                                                @foreach ($suppliers as $key=>$sup)
                                                 <option value="{{$sup->id}}">{{$sup->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="buyprice" class="form-label">{{__('Buy Price')}}</label>
                                            <input id="buyprice" type="number" class="form-control" name="buyprice" value="{{old('buyprice')}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="vat" class="form-label">{{__('Vat')}}</label>
                                            <input id="vat" type="number" class="form-control" name="vat" value="{{old('vat')}}"  autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="igta" class="form-label">{{__('Igta')}}</label>
                                            <input id="igta" type="number" class="form-control" name="igta" value="{{old('igta')}}"  autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">{{__('Status')}}</label>
                                            <select class="form-select form-select-sm mb-3 single-select" name="status" required aria-label=".form-select-sm example" required>
                                                <option value="">{{__('Select Status')}}</option>
                                                 <option value="1">{{__('Active')}}</option>
                                                 <option value="0">{{__('Inactive')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        {{__('Save')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- livicons end -->
    </div>
</div>
@endsection

@push('pagescript')
<script>
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
</script>
@endpush