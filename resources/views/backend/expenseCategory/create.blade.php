@extends('backend.layouts.app')

@push('style')
    
@endpush

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{__('Expense')}}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('Category Create')}}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('ecategory.index')}}">{{__('Category List')}}</a>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- livicons start -->
        <section id="font-livicons">
            <div class="row">
                <div class="col-md-8 m-auto ">
                    <div class="card">
                        <div class="card-header text-center"><h4>{{__('Category create')}}</h4></div>
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
                            <form method="POST" method="post" action="{{ route('ecategory.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{__('Name')}}</label>
                                    <input id="email" type="text" class="form-control " name="name" value="{{old('name')}}" required autofocus>
    
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{__('Status')}}</label>
                                    <div class="mb-3">
                                        <select class="form-select form-select-sm mb-3" name="status" aria-label=".form-select-sm example" required>
                                            <option value="">Select Status</option>
                                             <option value="1">Active</option>
                                             <option value="0">Disable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">{{__('Description')}}</label>
                                    <textarea id="description" class="form-control" name="description" id="" cols="30" rows="10"></textarea>
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