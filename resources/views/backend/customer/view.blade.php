@extends('backend.layouts.app')

@push('style')
    
@endpush

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{__('Customer')}}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('Customer View')}}</li>
                </ol>
            </nav>
        </div>
        @if(auth()->user()->can('user-create'))
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('customer.index')}}">{{__('Customer List')}}</a>
            </div>
        </div>
        @endif
    </div>
    <div class="card">

        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <div class="mt-3">
                                    <h4>{{$dataInfo->name}}</h4>
                                    <p class="text-secondary mb-1">{{$dataInfo->email}}</p>
                                    <p class="text-muted font-size-sm">{{$dataInfo->phone}}</p>
                                    <p class="text-muted font-size-sm">{{$dataInfo->address}}</p>
                                    <button class="btn btn-success disabled">Total Buy 255$</button>
                                    <button class="btn btn-danger disabled">Total Due 100$</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                          <h4> {{__(' Customer Invoice/s')}}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table datatable-project">
                                <thead>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Total Price</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>INV2739106</td>
                                        <td>$90.00</td>
                                        <td>$0.00</td>
                                        <td>$90.00</td>
                                        <td>
                                            <a href="javascript:" title="Pay due amount" class="btn btn-primary btn-sm">
                                                <i class="lni lni-wallet"></i>
                                            </a>
                                            <a href="" title="View Invoice" class="btn btn-warning btn-circle btn-sm">
                                                <i class="fadeIn animated bx bx-fast-forward-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>INV1306729</td>
                                        <td>$45.00</td>
                                        <td>$45.00</td>
                                        <td>$0.00</td>
                                        <td>
                                            <a href="javascript:" title="Pay due amount" class="btn btn-primary btn-sm">
                                                <i class="lni lni-wallet"></i>
                                            </a>
                                            <a href="" title="View Invoice" class="btn btn-warning btn-circle btn-sm">
                                                <i class="fadeIn animated bx bx-fast-forward-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>INV5042913</td>
                                        <td>$90.00</td>
                                        <td>$0.00</td>
                                        <td>$90.00</td>
                                        <td>
                                            <a href="javascript:" title="Pay due amount" class="btn btn-primary btn-sm">
                                                <i class="lni lni-wallet"></i>
                                            </a>
                                            <a href="" title="View Invoice" class="btn btn-warning btn-circle btn-sm">
                                                <i class="fadeIn animated bx bx-fast-forward-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    
@endpush