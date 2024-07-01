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
                    <li class="breadcrumb-item active" aria-current="page">{{__('Vendor List')}}</li>
                </ol>
            </nav>
        </div>
        @if(auth()->user()->can('user-create'))
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('vendor.create')}}">{{__('Vendor Create')}}</a>
            </div>
        </div>
        @endif
    </div>
    <div class="card">

        <div class="card-body">
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
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('Name')}}</th>
                        <th scope="col">{{__('Address')}}</th>
                        <th scope="col">{{__('Phone')}}</th>
                        <th scope="col">{{__('Payable')}}</th>
                        <th scope="col">{{__('Due')}}</th>
                        <th scope="col">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataList as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="text-bold-500">{{$data->name}}</td>
                        <td>{{$data->address}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->payable}}</td>
                        <td>{{$data->due}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{route('vendor.edit', $data->id)}}">{{__('Edit')}}</a>
                            <a class="btn btn-sm btn-danger" href="{{route('vendor.destroy', $data->id)}}" onclick="confirm('Are you sure you want to delete this user?') || event.stopImmediatePropagation()" wire:click="destroy({{$data->id}})">{{__('Delete')}}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('script')
    
@endpush