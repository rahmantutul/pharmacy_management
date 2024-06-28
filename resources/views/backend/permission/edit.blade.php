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
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('role.index')}}">{{__('User List')}}</a>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- livicons start -->
        <section id="font-livicons">
            <div class="row">
                <div class="col-md-10 m-auto ">
                    <div class="card">
                        <div class="card-header text-center"><h4>{{__('Role Update')}}</h4></div>
                        @if (count($errors) > 0)
                        <ul>
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
                            <form class="row" action="{{route('role.update')}}" method="post">
                                @csrf
                               <input type="hidden" name="id" value="{{$dataInfo->id}}">
                                <div class="col-12 form-group mb-5">
                                    <strong>Role Name</strong>
                                    <input type="text" name="name" placeholder="Role Name" class="form-control" value="{{$dataInfo->name}}" required>
                                     <span style="color:red" ></span>
                                </div>
                                <div class="col-12 form-group">
                                    <strong>Permission:</strong>
                                    <div class="row">
                                     @foreach($permission as $value)
                                        <div class="col-3">
                                            <div class="custom-control custom-control-success custom-checkbox">
                                                <input type="checkbox" name="permission[]" value="{{$value->id}}"{{(in_array($value->id, $rolePermissions)) ? 'checked' : ''}} id="permission_{{$value->id}}" class="custom-control-input">
                                                
                                                <label class="custom-control-label" for="permission_{{$value->id}}">{{$value->name}}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-row-reverse">
                                    <button class="btn btn-primary btn-icon" type="submit">
                                       <i data-feather='save'></i> Update
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