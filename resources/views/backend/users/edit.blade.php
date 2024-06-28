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
                    <li class="breadcrumb-item active" aria-current="page">{{__('User Edit')}}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('users.index')}}">{{__('User List')}}</a>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- livicons start -->
        <section id="font-livicons">
            <div class="row">
                <div class="col-md-8 m-auto ">
                    <div class="card">
                        <div class="card-header text-center"><h4>{{__('User Edit')}}</h4></div>
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
                            <form method="POST" method="post" action="{{ route('users.update') }}">
                                @csrf
                                <input type="hidden" name="dataId" value="{{$dataInfo->id}}">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{__('Name')}}</label>
                                    <input id="email" type="text" class="form-control " name="name" value="{{$dataInfo->name}}" required autofocus>
    
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{__('Email Address')}}</label>
                                    <input id="email" type="email" class="form-control " name="email" value="{{$dataInfo->email}}" required autofocus>
    
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{__('Current Password')}}</label>
                                    <input id="password" type="password" class="form-control " name="current_password"  autocomplete="current-password">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{__('New Password')}}</label>
                                    <input id="password" type="password" class="form-control " name="new_password"  autocomplete="new-password">
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