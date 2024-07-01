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
                    <li class="breadcrumb-item active" aria-current="page">{{__('Expense List')}}</li>
                </ol>
            </nav>
        </div>
        @if(auth()->user()->can('user-create'))
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('expense.create')}}">{{__('Expense Create')}}</a>
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
                        <th scope="col">{{__('Expense Date')}}</th>
                        <th scope="col">{{__('Category')}}</th>
                        <th scope="col">{{__('Expense For')}}</th>
                        <th scope="col">{{__('Amount')}}</th>
                        <th scope="col">{{__('Note')}}</th>
                        <th scope="col">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataList as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="text-bold-500">{{ date('j F, Y', strtotime($data->date)) }}
                        <td><span class="badge bg-success">{{$data?->category->name}}</span></td>
                        <td>{{$data->expense_for}}</td>
                        <td>{{$data->amount}}</td>
                        <td>{{$data->note}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{route('expense.edit', $data->id)}}">{{__('Edit')}}</a>
                            <a class="btn btn-sm btn-danger" href="{{route('expense.destroy', $data->id)}}" onclick="confirm('Are you sure you want to delete this user?') || event.stopImmediatePropagation()" wire:click="destroy({{$data->id}})">{{__('Delete')}}</a>
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