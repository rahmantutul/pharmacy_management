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
                    <li class="breadcrumb-item active" aria-current="page">{{__('User Create')}}</li>
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
                        <div class="card-header text-center"><h4>{{__('User create')}}</h4></div>
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
                            <form method="POST" method="post" action="{{ route('users.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{__('Name')}}</label>
                                    <input id="email" type="text" class="form-control " name="name" value="{{old('name')}}" required autofocus>
    
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{__('Email Address')}}</label>
                                    <input id="email" type="email" class="form-control " name="email" value="{{old('email')}}" required autofocus>
    
                                </div>
                                <div class="mb-3">
                                    <select class="form-select form-select-sm mb-3" name="roleId" aria-label=".form-select-sm example" required>
                                        <option >Assign Role</option>
                                        @foreach ($roleList as $role)
                                         <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label"> {{__('Password')}}</label>
                                    <input id="password" type="password" class="form-control " name="password"  autocomplete="password">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{__('Confirm Password')}}</label>
                                    <input id="password" type="password" class="form-control " name="password_confirmation"  autocomplete="confirm-password">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        {{__('Create')}}
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