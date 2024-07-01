@extends('backend.layouts.app')

@push('style')
<link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
@endpush

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{__('Settings')}}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('General Settings')}}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('gsetting.index')}}">{{__('Generale Settings')}}</a>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- livicons start -->
        <section id="font-livicons">
            <div class="row">
                <div class="col-md-10 m-auto ">
                    <div class="card">
                        <div class="card-header text-center"><h4>{{__('General Settings')}}</h4></div>
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
                            <form method="POST"action="{{ route('gsetting.update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="dataId"  value="{{$dataInfo->id}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="dataId" value="{{$dataInfo->id}}">
                                        <div class="mb-3">
                                            <label for="appname" class="form-label">{{__('App Name')}}</label>
                                            <input id="appname" type="text" class="form-control " name="appname" value="{{$dataInfo->appname}}" required autofocus>
            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="currency" class="form-label">{{__('Currency')}}</label>
                                            <input id="currency" type="text" class="form-control " name="currency" value="{{$dataInfo->currency}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{__('Email')}}</label>
                                            <input id="email" type="text" class="form-control " name="email" value="{{$dataInfo->email}}"required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">{{__('Phone')}}</label>
                                            <input id="phone" type="text" class="form-control " name="phone" value="{{$dataInfo->phone}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">{{__('Address')}}</label>
                                            <input id="address" type="text" class="form-control " name="address" value="{{$dataInfo->address}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="expiryalert" class="form-label">{{__('Upcoming Expire Alert')}}</label>
                                            <input id="expiryalert" type="number" class="form-control " name="expiryalert" value="{{$dataInfo->expiryalert}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lowstockalert" class="form-label">{{__('Low Stock Alert')}}</label>
                                            <input id="lowstockalert" type="number" class="form-control " name="lowstockalert" value="{{$dataInfo->lowstockalert}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lowstockalert" class="form-label">{{__('Time Zone')}}</label>
                                            <select class="form-select form-select-sm mb-3 single-select" name="timezone" required aria-label=".form-select-sm example" required>
                                                <option value="">{{__('Time Zone')}}</option>
                                                @foreach ($timeZones as $key=>$zone)
                                                 <option {{($key == $dataInfo->timezone) ?'selected':''}} value="{{$key}}">{{$key}}--{{$zone}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="logo" class="form-label">{{__('Logo')}}</label><br>
                                            <img style="height:100px; width:95px;" src=" {{asset('uploads/images/settings/'.$dataInfo->logo)}}" alt="Favicon Image"><br> <br>
                                            <input id="logo" type="file" class="form-control" value="{{$dataInfo->logo}}" name="logo" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="favicon" class="form-label">{{__('Favicon')}}</label><br>   
                                            <img style="height:100px; width:95px;" src=" {{asset('uploads/images/settings/'.$dataInfo->favicon)}}" alt="Favicon Image"> <br><br>
                                            <input id="favicon" type="file" class="form-control" value="{{$dataInfo->favicon}}" name="favicon" autofocus>
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