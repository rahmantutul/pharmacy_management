@extends('backend.layouts.app')

@push('style')
    
@endpush

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{__('Vendor')}}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('Vendor Update')}}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('vendor.index')}}">{{__('Vendor List')}}</a>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- livicons start -->
        <section id="font-livicons">
            <div class="row">
                <div class="col-md-8 m-auto ">
                    <div class="card">
                        <div class="card-header text-center"><h4>{{__('Vendor create')}}</h4></div>
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
                            <form method="POST" method="post" action="{{ route('vendor.update') }}">
                                @csrf
                                <input type="hidden" name="dataId" value="{{$dataInfo->id}}">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{__('Name')}}</label>
                                    <input id="email" type="text" class="form-control " name="name" value="{{$dataInfo->name}}" required autofocus>
    
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">{{__('Phone')}}</label>
                                    <input id="phone" type="text" class="form-control " name="phone" value="{{$dataInfo->phone}}" required autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="payable" class="form-label">{{__('Payable')}}</label>
                                    <input id="payable" type="number" class="form-control" name="payable" value="{{$dataInfo->payable}}" required autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="due" class="form-label">{{__('Due')}}</label>
                                    <input id="due" type="number" class="form-control" name="due" value="{{$dataInfo->due}}" required autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">{{__('Address')}}</label>
                                    <textarea id="address" class="form-control" name="address" id="" cols="30" rows="10"> {{$dataInfo->address}}</textarea>
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

@push('script')
    
@endpush