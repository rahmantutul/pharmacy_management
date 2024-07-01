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
                    <li class="breadcrumb-item active" aria-current="page">{{__('Email Settings')}}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('gsetting.index')}}">{{__('Email Settings')}}</a>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- livicons start -->
        <section id="font-livicons">
            <div class="row">
                <div class="col-md-10 m-auto ">
                    <div class="card">
                        <div class="card-header text-center"><h4>{{__('Email Settings')}}</h4></div>
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
                            <form method="POST" action="{{ route('esetting.update') }}">
                                @csrf
                                <input type="hidden" name="dataId"  value="{{$dataInfo->id}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mail_driver" class="form-label">{{__('Mail Driver')}}</label>
                                            <input id="mail_driver" type="text" class="form-control " name="mail_driver" value="{{$dataInfo->mail_driver}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mail_host" class="form-label">{{__('Mail Host')}}</label>
                                            <input id="mail_host" type="text" class="form-control " name="mail_host" value="{{$dataInfo->mail_host}}"required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mail_port" class="form-label">{{__('Mail Port')}}</label>
                                            <input id="mail_port" type="text" class="form-control " name="mail_port" value="{{$dataInfo->mail_port}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mail_username" class="form-label">{{__('Mail Username')}}</label>
                                            <input id="mail_username" type="text" class="form-control " name="mail_username" value="{{$dataInfo->mail_username}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mail_password" class="form-label">{{__('Mail Password')}}</label>
                                            <input id="mail_password" type="text" class="form-control " name="mail_password" value="{{$dataInfo->mail_password}}" required autofocus>
            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mail_encryption" class="form-label">{{__('Mail Encryption')}}</label>
                                            <input id="mail_encryption" type="text" class="form-control " name="mail_encryption" value="{{$dataInfo->mail_encryption}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mail_from_address" class="form-label">{{__('Mail From Address')}}</label>
                                            <input id="mail_from_address" type="email" class="form-control " name="mail_from_address" value="{{$dataInfo->mail_from_address}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mail_from_name" class="form-label">{{__('Mail From Name')}}</label>
                                            <input id="mail_from_name" type="text" class="form-control " name="mail_from_name" value="{{$dataInfo->mail_from_name}}" required autofocus>
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