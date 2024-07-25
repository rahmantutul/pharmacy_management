@extends('backend.layouts.app')

@push('stylesheet')
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
                    <li class="breadcrumb-item active" aria-current="page">{{__('Medicine List')}}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('medicine.create')}}">{{__('Create Medicine')}}</a>
            </div>
        </div>
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
            <form action="" method="GET"> @csrf
                <div class="row bg-secondary p-3">
                    <div class="col-2">
                        <input type="date" class="form-control" id="fromDate" value="{{request()->fromDate}}" name="fromDate">
                    </div>
                    <div class="col-2">
                        <input type="date" class="form-control" id="toDate" name="toDate" value="{{request()->toDate}}">
                    </div>
                    <div class="col-md-4">
                        <select id="customer" class="form-control single-select" name="customerId">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option {{(request()->customerId == $customer->id ? 'selected' : '')}} value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button id="filter" type="submit" name="submit" value="search" class="btn btn-primary" title="Search"><i class="fadeIn animated bx bx-search-alt"></i></button>
                        <button id="filter" type="submit" name="submit" value="pdf" class="btn btn-warning" title="Download PDF"><i class="fadeIn animated bx bx-file"></i></button>
                    </div>
                    
                </div>
            </form>
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center">{{__('Date')}}</th>
                        <th scope="col" class="text-center">{{__('Invoice')}}</th>
                        <th scope="col" class="text-center">{{__('Customer')}}</th>
                        <th scope="col" class="text-center">{{__('Subtotal')}}</th>
                        <th scope="col" class="text-center">{{__('Invoicer Discount')}}</th>
                        <th scope="col" class="text-center">{{__('Total')}}</th>
                        <th scope="col" class="text-center">{{__('Paid Amount')}}</th>
                        <th scope="col" class="text-center">{{__('Invoice Due')}}</th>
                    </tr>
                </thead>
                @php
                    $total=0;
                    $totalDiscount=0;
                    $payableTotal=0;
                    $paidTotal=0;
                    $dueTotal=0;    
                @endphp
                <tbody>
                    @foreach ($dataList as $key=>$data)
                    @php
                        $total = $data->grand_total;
                        $totalDiscount = $data->invoice_discount;
                        $payableTotal = $data->payable_total;
                        $paidTotal = $data->paid_amount;
                        $dueTotal = $data->due_amount;
                    @endphp
                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="text-bold-500 text-center">{{$data->invoice_date}}</td>
                        <td class="text-center">{{$data->invoice_no}}</td>
                        <td class="text-center">{{$data?->customer->name}}</td>
                        <td class="text-center">{{number_format($data->grand_total,2)}}</td>
                        <td class="text-center">{{number_format($data->invoice_discount,2)}}</td>
                        <td class="text-center">{{number_format($data->payable_total,2)}}</td>
                        <td class="text-center">{{number_format($data->paid_amount,2)}}</td>
                        <td class="text-center">{{number_format($data->due_amount,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <th colspan="4"></th>
                    <th class="text-center">{{number_format($total,2)}}</th>
                    <th class="text-center">{{number_format($totalDiscount,2)}}</th>
                    <th class="text-center">{{number_format($payableTotal,2)}}</td>
                    <th class="text-center">{{number_format($paidTotal,2)}}</th>
                    <th class="text-center">{{number_format($dueTotal,2)}}</th>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@push('pagescript')
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script>
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
</script>
@endpush