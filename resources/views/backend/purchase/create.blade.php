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
        <div class="breadcrumb-title pe-3">{{__('Sytstem Info')}}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('Purchase Create')}}</li>
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
                        <div class="card-header text-center"><h4>{{__('Purchase create')}}</h4></div>
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
                            <form method="POST" method="post" action="{{ route('purchase.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">{{__('Date Today')}}</label>
                                            <input id="date" type="date" class="form-control " name="invoice_date" value="{{$today}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="Invoice" class="form-label">{{__('Invoice')}}</label>
                                            <input id="Invoice" type="text" class="form-control " name="invoice_no" value="{{$invoice}}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="leafId" class="form-label">{{__('Manufacture/Suppliers')}}</label>
                                            <select class="form-select form-select-sm mb-3 single-select" name="supplierId" required aria-label=".form-select-sm example" required>
                                                <option value="">{{__('Select Suppliers')}}</option>
                                                @foreach ($suppliers as $supplier)
                                                 <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" class="search-input form-control" id="search-input" placeholder="Search for a medicine">
                                            <div class="results" id="results"></div>
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
                                                @if(session()->get('cart'))
                                                @php
                                                    $cart = session()->get('cart');
                                                @endphp
                                                    @foreach ($cart as $serialNumber=>$dataInfo)
                                                    <tr data-id="{{$dataInfo['id']}}">
                                                        <td width="1%">{{$serialNumber + 1}}</td>
                                                        <td width="6%"  class="text-center"><input type="hidden" name="medicineId[]" value="{{$dataInfo['id']}}"/><img src="/uploads/images/medicine/{{$dataInfo['image']}}" alt="{{$dataInfo['name']}}" width="50"></td>
                                                        <td width="6%"  class="text-center">{{$dataInfo['name']}}</td>
                                                        <td width="10%" class="text-center">{{$dataInfo['genericname']}}</td>
                                                        <td width="10%" class="text-center">{{$dataInfo['supplier_name']}}</td>
                                                        <td class="text-center"><input id="expiryDate_{{$dataInfo['id']}}"type="date" class="form-control" name="expiry_date[]" required autofocus></td>
                                                        <td class="text-center"><input id="sellPrice_{{$dataInfo['id']}}" type="number" class="form-control" step="0.01" name="sell_price[]" required autofocus></td>
                                                        <td class="text-center"><input id="buyPrice_{{$dataInfo['id']}}" type="number" class="form-control" step="0.01" name="buy_price[]" oninput="updateRowTotal({{$dataInfo['id']}})" required autofocus></td>
                                                        <td class="text-center"><input id="Qty_{{$dataInfo['id']}}" type="number" class="form-control" name="qty[]" step="0.01" required oninput="updateRowTotal({{$dataInfo['id']}})" autofocus></td>
                                                        <td class="text-center"><input id="subTotal_{{$dataInfo['id']}}" type="number" class="form-control" step="0.01" name="subtotal[]" readonly required autofocus></td>
                                                        <td class="text-center"><input id="Discount_{{$dataInfo['id']}}" type="number" class="form-control" step="0.01" name="discount[]" required value="0.00" oninput="updateRowTotal({{$dataInfo['id']}})" autofocus></td>
                                                        <td class="text-center"><input id="Total_{{$dataInfo['id']}}" type="number" class="form-control" name="total[]" step="0.01" required readonly autofocus></td>
                                                        <td class="text-center"><a class="btn btn-sm btn-danger" onclick="removeFromCart({{$dataInfo['id']}})"><i class="fadeIn animated bx bx-trash"></i></a></td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                                
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
                                                        <input class="form-control" id="grandTotal" readonly type="number" step="0.01" name="grand_total" value="0">
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <th>{{__('Invoice Discount')}}</th>
                                                    <td>:</td>
                                                    <td>
                                                       <div class="d-flex">
                                                        <input id="invoiceDiscountAmount" class="form-control" name="invoice_discount" type="number" value="0">
                                                        <select id="invoiceDiscountType" onchange="payableTotalCount()" class="form-control" name="discount_type">
                                                            <option value="">{{__('Select')}}</option>
                                                            <option value="1">{{__('Fixed')}}</option>
                                                            <option value="2">{{__('Percentage(%)')}}</option>
                                                        </select>
                                                       </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{__('Payable Total')}}</th>
                                                    <td>{{__(':')}}</td>
                                                    <td><input type="number" name="payable_total" readonly class="form-control" step="0.01" id="payableTotal"></td>

                                                </tr>
                                                <tr>
                                                    <th>{{__('Paid Amount')}}</th>
                                                    <td>{{__(':')}}</td>
                                                    <td>
                                                        <input id="paidAmount"  oninput="updateDueAmount()" class="form-control" step="0.01" type="number" name="paid_amount">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{__('Due Amount')}}</th>
                                                    <td>{{__(':')}}</td>
                                                    <td>
                                                        <input id="dueAmount" class="form-control" type="number" readonly name="due_amount" step="0.01" value="0.00">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{__('Payment Method')}}</th>
                                                    <td>{{__(':')}}</td>
                                                    <td>
                                                    <select class="form-control" style="width: 100%;" required name="paymentId">
                                                        <option value="">{{__('Select One')}}</option>
                                                        @foreach ($methods as $meth)
                                                            <option value="{{$meth->id}}">{{$meth->name}}</option>
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
    $(document).ready(function() {
        $('#search-input').on('input', function() {
            let query = $(this).val();
            if (query.length > 0) {
                fetchMedicines(query);
            } else {
                hideResults();
            }
        });
        function fetchMedicines(query) {
            $.ajax({
                url: '/purchase/seaarch-medicine',
                type: 'GET',
                data: { query: query },
                success: function(response) {
                    displayResults(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function displayResults(medicines) {
            let resultsDiv = $('#results');
            resultsDiv.empty();
            medicines.forEach(function(medicine) {
                let resultItem = $('<div class="result-item"></div>');
                resultItem.append(`<a href="javascript:" onclick="selectMedicine(${medicine.id})" class="searchItem nav-link">
                                        <div class="search-content">
                                        <span class="singleItem medicienImage">
                                            <img class="img-fluid" src="/uploads/images/medicine/${medicine.image}" alt="${medicine.name}">
                                        </span>
                                        <span class="singleItem itemBody" title="Panadol 500g"> ${medicine.name}
                                            <span class="sku" title="Tablet">${medicine.strength}</span>
                                            <span class="medName text-muted">Generic Name: ${medicine.genericname}</span>
                                            <span class="medName text-muted">Supplier: ${medicine.supplier.name}</span>
                                        </span>
                                        </div> 
                                    </a>`);
                resultsDiv.append(resultItem);
            });
            resultsDiv.show();
        }
        function hideResults() {
            $('#results').hide();
        }
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

    function updateCartTable(cart) {
        var tableBody = $('#cart-table tbody');
        tableBody.empty();
        var serialNumber = 1;
        $.each(cart, function(id, item) {
            var price = item.price || 0;
            var quantity = item.quantity || 1;
            var discount = item.discount || 0;
            var subtotal = price * quantity;
            var total = subtotal - discount;
            tableBody.append(
                '<tr data-id="' + id + '">' +
                    '<td width="1%">' + serialNumber +'</td>' +
                    '<td width="6%"  class="text-center"><input type="hidden" name="medicineId[]" value=" '+id+' "/><img src="/uploads/images/medicine/' + item.image + '" alt="' + item.name + '" width="50"></td>' +
                    '<td width="6%"  class="text-center">' + item.name + '</td>' +
                    '<td width="10%" class="text-center">' + item.genericname + '</td>' +
                    '<td width="10%" class="text-center">' + item.supplier_name + '</td>' +
                    '<td class="text-center"><input id="expiryDate_' + id + '"type="date" class="form-control" name="expiry_date[]" required autofocus></td>' +
                    '<td class="text-center"><input id="sellPrice_' + id + '" type="number" class="form-control" step="0.01" name="sell_price[]" required autofocus></td>' +
                    '<td class="text-center"><input id="buyPrice_' + id + '" type="number" class="form-control" step="0.01" name="buy_price[]" oninput="updateRowTotal(' + id + ')" required autofocus></td>' +
                    '<td class="text-center"><input id="Qty_' + id + '" type="number" class="form-control" name="qty[]" step="0.01" required oninput="updateRowTotal(' + id + ')" autofocus></td>' +
                    '<td class="text-center"><input id="subTotal_' + id + '" type="number" class="form-control" step="0.01" name="subtotal[]" readonly required autofocus></td>' +
                    '<td class="text-center"><input id="Discount_' + id + '" type="number" class="form-control" step="0.01" name="discount[]" required value="0.00" oninput="updateRowTotal(' + id + ')" autofocus></td>' +
                    '<td class="text-center"><input id="Total_' + id + '" type="number" class="form-control" name="total[]" step="0.01" required readonly autofocus></td>' +
                    '<td class="text-center"><a class="btn btn-sm btn-danger" onclick="removeFromCart(' + id + ')"><i class="fadeIn animated bx bx-trash"></i></a></td>' +
                '</tr>'
            );
            serialNumber++;
        });
        // updateGrandTotal();
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