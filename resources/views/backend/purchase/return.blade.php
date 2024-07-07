@extends('backend.layouts.app')

@push('stylesheet')
<link rel="stylesheet" href="{{asset('assets/css/purchase.css')}}" />
<style>
    table, tr, td{
        padding: 2px !important;
    }
</style>
@endpush

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{__('Purchase')}}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('Purchase Return')}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="content-body">
        <!-- livicons start -->
        <section id="font-livicons">
            <div class="row">
                <div class="col-12 m-auto ">
                    <div class="card">
                        <div class="card-header text-center"><h4>{{__('Purchase Return')}}</h4></div>
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
                            <form method="POST" method="post" action="{{ route('purchase.return.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="dataId" value="{{$dataInfo->id}}" required>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">{{__('Date Today')}}</label>
                                            <input id="date" type="date" class="form-control " name="invoice_date" value="{{$dataInfo->invoice_date}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="Invoice" class="form-label">{{__('Invoice')}}</label>
                                            <input id="Invoice" type="text" class="form-control " name="invoice_no" value="{{$dataInfo->invoice_no}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="leafId" class="form-label">{{__('Manufacture/Suppliers')}}</label>
                                            <select class="form-select form-select-sm mb-3 single-select" name="supplierId" required aria-label=".form-select-sm example" required>
                                                <option value="">{{__('Select Suppliers')}}</option>
                                                @foreach ($suppliers as $supplier)
                                                  <option {{($supplier->id == $dataInfo->supplierId)?'selected':''}} value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <table id="cart-table" class="table table-responsive" border="1" >
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <td>#</td>
                                                    <td class="text-center">{{__('Image')}}</td>
                                                    <td class="text-center">{{__('Medicine')}}</td>
                                                    <td class="text-center">{{__('Generic Name')}}</td>
                                                    <td class="text-center">{{__('Supplier')}}</td>
                                                    <td class="text-center">{{__('Expire Date')}}</td>
                                                    <td class="text-center">{{__('Sell Price (Piece/Unit)')}}</td>
                                                    <td class="text-center">{{__('Buy Price Per Unit')}}</td>
                                                    <td class="text-center">{{__('Quantity')}}</td>
                                                    <td class="text-center">{{__('Subtotal')}}</td>
                                                    <td class="text-center">{{__('Discount')}}</td>
                                                    <td class="text-center">{{__('Total')}}</td>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataInfo->details as $key=>$data)
                                                <tr data-id="{{$data['id']}}">
                                                    <td width="1%">{{$key + 1}}</td>
                                                    <td width="6%"  class="text-center"><input type="hidden" name="medicineId[]" value="{{$data['medicine']['id']}}"/><img src="/uploads/images/medicine/{{$data['medicine']['image']}}" alt="{{$data['medicine']['name']}}" width="50"></td>
                                                    <td width="6%"  class="text-center">{{$data['medicine']['name']}}</td>
                                                    <td width="10%" class="text-center">{{$data['medicine']['genericname']}}</td>
                                                    <td width="10%" class="text-center">{{$data['medicine']['supplier']['name']}}</td>
                                                    <td class="text-center"><input id="expiryDate_{{$data['id']}}"type="date" class="form-control" value="{{$data['expiry_date']}}" name="expiry_date[]"  required autofocus></td>
                                                    <td class="text-center"><input id="sellPrice_{{$data['id']}}" type="number" class="form-control  text-right" value="{{$data['sell_price']}}" step="0.01" name="sell_price[]" required autofocus></td>
                                                    <td class="text-center"><input id="buyPrice_{{$data['id']}}" type="number" class="form-control  text-right" step="0.01" value="{{$data->buy_price}}" name="buy_price[]" oninput="updateRowTotal({{$data['id']}})" required autofocus></td>
                                                    <td class="text-center"><input id="Qty_{{$data['id']}}" type="number" class="form-control  text-right" name="qty[]" step="0.01" value="{{$data->qty}}" required oninput="updateRowTotal({{$data['id']}})" autofocus></td>
                                                    <td class="text-center"><input id="subTotal_{{$data['id']}}" type="number" class="form-control  text-right" step="0.01" value="{{$data->subtotal}}" name="subtotal[]" readonly required autofocus></td>
                                                    <td class="text-center"><input id="Discount_{{$data['id']}}" type="number" class="form-control  text-right" step="0.01" value="{{$data->discount}}" name="discount[]" required value="0.00" oninput="updateRowTotal({{$data['id']}})" autofocus></td>
                                                    <td class="text-center"><input id="Total_{{$data['id']}}" type="number" class="form-control  text-right" name="total[]" value="{{$data->total}}" step="0.01" required readonly autofocus></td>
                                                    <td class="text-center"><a class="btn btn-sm btn-danger" onclick="removeFromCart({{$data['id']}})"><i class="fadeIn animated bx bx-trash"></i></a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-7"></div>
                                    <div class="col-md-5 align-self-end">
                                        <table class="table estimate-acount-table text-right">
                                            <tbody>
                                                <tr>
                                                    <th>{{__('Total Amoun')}}t</th>
                                                    <td>{{__(':')}}</td>
                                                    <td>
                                                        <input class="form-control" id="grandTotal" readonly type="number" step="0.01" name="grand_total" value="{{$dataInfo->grand_total}}">
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <th>{{__('Invoice Discount')}}</th>
                                                    <td>:</td>
                                                    <td>
                                                       <div class="d-flex">
                                                        <input id="invoiceDiscountAmount" class="form-control" name="invoice_discount"  type="number" value="{{$dataInfo->invoice_discount}}">
                                                        <select id="invoiceDiscountType" onchange="payableTotalCount()" class="form-control" name="discount_type">
                                                            <option value="">{{__('Select')}}</option>
                                                            <option {{(1 == $dataInfo->discount_type)?'selected':''}} value="1">{{__('Fixed')}}</option>
                                                            <option {{(2 == $dataInfo->discount_type)?'selected':''}} value="2">{{__('Percentage(%)')}}</option>
                                                        </select>
                                                       </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{__('Payable Total')}}</th>
                                                    <td>{{__(':')}}</td>
                                                    <td><input type="number" name="payable_total" readonly class="form-control" value="{{$dataInfo->payable_total}}" step="0.01" id="payableTotal"></td>

                                                </tr>
                                                <tr>
                                                    <th>{{__('Paid Amount')}}</th>
                                                    <td>{{__(':')}}</td>
                                                    <td>
                                                        <input id="paidAmount"  oninput="updateDueAmount()" class="form-control" step="0.01" type="number" required name="paid_amount">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{__('Due Amount')}}</th>
                                                    <td>{{__(':')}}</td>
                                                    <td>
                                                        <input id="dueAmount" class="form-control" type="number" readonly name="due_amount" step="0.01" value="{{$dataInfo->due_amount}}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{__('Payment Method')}}</th>
                                                    <td>{{__(':')}}</td>
                                                    <td>
                                                    <select class="form-control" style="width: 100%;" required name="paymentId">
                                                        <option value="">{{__('Select One')}}</option>
                                                        @foreach ($methods as $meth)
                                                            <option {{($meth->id == $dataInfo->paymentId)?'selected':''}} value="{{$meth->id}}">{{$meth->name}}</option>
                                                        @endforeach
                                                    </select>
                                                        <span class="text-danger"></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            {{__('Save')}}
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
</script>

<script>

    var cart = {};
    function selectMedicine(medicineId) {
        addToPurchaseCart(medicineId);
        $('#results').empty(); // Hide the dropdown
        $('#search-input').val(''); // Clear the search input
    }

    function addToPurchaseCart(medicineId) {
        $.ajax({
            url: '{{ route('purchase.cart.add') }}',
            method: 'get',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                medicine_id: medicineId
            },
            success: function(response) {
                if (response.success) {
                    updateCartTable(response.cart);
                }
            },
            error: function(response) {
                alert('Error adding medicine to cart');
            }
        });
    }
    function removeFromCart(medicineId) {
        $.ajax({
            url: '{{ route('purchase.cart.remove') }}',
            method: 'get',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                medicine_id: medicineId
            },
            success: function(response) {
                if (response.success) {
                    updateCartTable(response.cart);
                }
            },
            error: function(response) {
                alert('Error removing medicine from cart');
            }
        });
    }

    function updateRowTotal(id) {
        var price = parseFloat($('#buyPrice_' + id).val()) || 0;
        var quantity = parseFloat($('#Qty_' + id).val()) || 0;
        var discount = parseFloat($('#Discount_' + id).val()) || 0;
        var subtotal = price * quantity;
        var total = subtotal - discount;
        $('#subTotal_' + id).val(subtotal);
        $('#Total_' + id).val(total);
        updateGrandTotal();
    }

    function updateGrandTotal() {
        var grandTotal = 0;
        $('#cart-table tbody tr').each(function() {
            var id = $(this).data('id');
            var total = parseFloat($('#Total_' + id).val()) || 0;
            grandTotal += total;
        });

        $('#grandTotal').val(grandTotal.toFixed(2));
        $('#payableTotal').val(grandTotal.toFixed(2));
        $('#paidAmount').val(grandTotal.toFixed(2));
    }

    function payableTotalCount() {
        var globalDiscountType = $('#invoiceDiscountType').val();
        var globalDiscountValue = parseFloat($('#invoiceDiscountAmount').val()) || 0;
        var grandTotal = parseFloat($('#grandTotal').val()) || 0;

        if (globalDiscountType == 2) {
            payableTotal = grandTotal - (grandTotal * (globalDiscountValue / 100));
        } else {
            payableTotal = grandTotal - globalDiscountValue;
        }

        $('#payableTotal').val(payableTotal.toFixed(2));
        $('#paidAmount').val(payableTotal.toFixed(2));
    }
    function updateDueAmount() {
        var payableTotal = parseFloat($('#payableTotal').val()) || 0;
        var paymentAmount = parseFloat($('#paidAmount').val()) || 0;
        var dueAmount = payableTotal - paymentAmount;
        $('#dueAmount').val(dueAmount.toFixed(2));
    }
</script>
@endpush