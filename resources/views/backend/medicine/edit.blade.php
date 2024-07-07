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
                    <li class="breadcrumb-item active" aria-current="page">{{__('Medicine Edit')}}</li>
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
                <div class="col-md-8 m-auto ">
                    <div class="card">
                        <div class="card-header text-center"><h4>{{__('Medicine Edit')}}</h4></div>
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
                            <form method="POST" method="post" action="{{ route('medicine.update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="dataId" value="{{$dataInfo->id}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="qrcode" class="form-label">{{__('QR Core')}}</label>
                                            <input id="qrcode" type="text" class="form-control " name="qrcode" value="{{$dataInfo->qrcode}}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="hnscode" class="form-label">{{__('HNS Core')}}</label>
                                            <input id="hnscode" type="text" class="form-control " name="hnscode" value="{{$dataInfo->hnscode}}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{__('Name')}}</label>
                                            <input id="name" type="text" class="form-control " name="name" value="{{$dataInfo->name}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="strength" class="form-label">{{__('Strength')}}</label>
                                            <input id="strength" type="text" class="form-control " name="strength" value="{{$dataInfo->strength}}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="genericname" class="form-label">{{__('Generic Name')}}</label>
                                            <input id="genericname" type="text" class="form-control" name="genericname" value="{{$dataInfo->genericname}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="leafId" class="form-label">{{__('Box Size')}}</label>
                                            <select class="form-select form-select-sm mb-3 single-select" name="leafId" required aria-label=".form-select-sm example" required>
                                                <option value="">{{__('Box Size')}}</option>
                                                @foreach ($leaves as $key=>$leaf)
                                                 <option {{ ($dataInfo->leafId == $leaf->id)?'selected':'' }} value="{{$leaf->id}}">{{$leaf->name}}({{$leaf->qty}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="shelf" class="form-label">{{__('Shelf')}}</label>
                                            <input id="shelf" type="text" class="form-control" name="shelf" value="{{$dataInfo->shelf}}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="desc" class="form-label">{{__('Desc')}}</label>
                                            <input id="desc" type="text" class="form-control" name="desc" value="{{$dataInfo->desc}}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="Category" class="form-label">{{__('Category')}}</label>
                                            <select class="form-select form-select-sm mb-3 single-select" name="categoryId" required aria-label=".form-select-sm example" required>
                                                <option value="">{{__('Select Category')}}</option>
                                                @foreach ($categories as $key=>$cat)
                                                 <option {{ ($dataInfo->categoryId == $cat->id)?'selected':'' }} value="{{$cat->id}}">{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="vendorId" class="form-label">{{__('Vendor')}}</label>
                                            <select class="form-select form-select-sm mb-3 single-select" name="vendorId" required aria-label=".form-select-sm example" required>
                                                <option value="">{{__('Select Vendor')}}</option>
                                                @foreach ($vendors as $key=>$vendor)
                                                 <option {{ ($dataInfo->vendorId == $vendor->id)?'selected':'' }} value="{{$vendor->id}}">{{$vendor->name}}</option>
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
                                                 <option {{ ($dataInfo->supplierId==$sup->id)?'selected':'' }} value="{{$sup->id}}">{{$sup->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="igta" class="form-label">{{__('Igta')}}</label>
                                            <input id="igta" type="number" class="form-control" name="igta" value="{{$dataInfo->igta}}"  autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">{{__('Status')}}</label>
                                            <select class="form-select form-select-sm mb-3 single-select" name="status" required aria-label=".form-select-sm example" required>
                                                <option value="">{{__('Select Status')}}</option>
                                                 <option {{ ($dataInfo->status==1)?'selected':'' }} value="1">{{__('Active')}}</option>
                                                 <option {{ ($dataInfo->status==0)?'selected':'' }} value="0">{{__('Inactive')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex">
                                        <img style="height:100px; width:95px; border:1px solid #000; margin-right:20px;"  src=" {{asset('uploads/images/medicine/'.$dataInfo->image)}}" alt="Favicon Image"> <br><br>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">{{__('Image')}}</label><br>
                                            <input id="image" type="file" class="form-control" name="image" autofocus>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        {{__('Update')}}
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