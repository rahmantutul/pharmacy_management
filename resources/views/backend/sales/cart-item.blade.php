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
            <div class="col-md-12 mb-3">
                <table id="cart-table" class="table table-responsive" border="1" >
                    <thead class="bg-dark text-white">
                        <tr>
                            <td class="text-center d-none">#</td>
                            <td class="text-center">{{__('Image')}}</td>
                            <td class="text-center">{{__('Medicine')}}</td>
                            <td class="text-center">{{__('Supplier')}}</td>
                            <td class="text-center">{{__('Expire Date')}}</td>
                            <td class="text-center">{{__('Price)')}}</td>
                            <td class="text-center">{{__('Quantity')}}</td>
                            <td class="text-center d-none">{{__('Subtotal')}}</td>
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
                                <td width="1%" class="text-center d-none">{{$serialNumber + 1}}</td>
                                <td width="6%"  class="text-center"><input type="hidden" name="medicineId[]" value="{{$dataInfo['id']}}"/><img src="/uploads/images/medicine/{{$dataInfo['image']}}" alt="{{$dataInfo['name']}}" width="50"></td>
                                <td width="6%"  class="text-center">{{$dataInfo['name']}}</td>
                                <td width="10%" class="text-center">{{$dataInfo['supplier_name']}}</td>
                                <td class="text-center"><input id="expiryDate_{{$dataInfo['id']}}"type="date" class="form-control" name="expiry_date[]" required autofocus></td>
                                <td class="text-center"><input id="Price_{{$dataInfo['id']}}" type="number" class="form-control" step="0.01" name="price[]" oninput="updateRowTotal({{$dataInfo['id']}})" required autofocus></td>
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
            <div class="col-md-12 align-self-end">
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
                <div class="col-12">
                    <div class="mb-3">
                        <button type="submit" class="form-control btn btn-sm btn-primary">
                            {{__('Save')}}
                        </button>
                    </div>
                </div>
            </div>
            
    </form>
</div>