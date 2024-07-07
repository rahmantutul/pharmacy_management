@extends('backend.layouts.app')

@push('style')
    
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
                    <li class="breadcrumb-item active" aria-current="page">{{__('Purchase List')}}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('purchase.create')}}">{{__('New Purchase')}}</a>
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
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('Date')}}</th>
                        <th scope="col">{{__('Invoice')}}</th>
                        <th scope="col">{{__('Supplier')}}</th>
                        <th scope="col">{{__('Subtotal')}}</th>
                        <th scope="col">{{__('Invoicer Discount')}}</th>
                        <th scope="col">{{__('Total')}}</th>
                        <th scope="col">{{__('Paid Amount')}}</th>
                        <th scope="col">{{__('Invoice Due')}}</th>
                        <th scope="col">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataList as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="text-bold-500">{{$data->invoice_date}}</td>
                        <td>{{$data->invoice_no}}</td>
                        <td>{{$data?->supplier->name}}</td>
                        <td>{{$data->grand_total}}</td>
                        <td>{{$data->invoice_discount}}</td>
                        <td>{{$data->payable_total}}</td>
                        <td>{{$data->paid_amount}}</td>
                        <td>{{$data->due_amount}}</td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-id="{{$data->id}}" data-bs-target="#medicineModal" class="btn btn-sm btn-primary actionButton">{{__('Details')}}</a>
                            <a href="{{route('purchase.return',$data->id)}}" class="btn btn-sm btn-warning">{{__('Return')}}</a>
                            <a href="{{route('purchase.delete',$data->id)}}" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this?') || event.stopImmediatePropagation()">{{__('Delete')}}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-md-12">
                {{$dataList->links("pagination::bootstrap-4")}}
              </div>
        </div>
    </div>
        <!-- Start Add Modal -->
        <div class="modal fade" id="medicineModal" tabindex="-1" role="dialog" aria-labelledby="medicineModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="medicineModalLabel">{{__('Purchase Details')}}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Med Name')}}</th>
                                    <th>{{__('Expiry Date')}}</th>
                                    <th>{{__('Sell Price')}}</th>
                                    <th>{{__('Buy Price')}}</th>
                                    <th>{{__('Qty')}}</th>
                                    <th>{{__('Subtotal')}}</th>
                                    <th>{{__('Discount')}}</th>
                                    <th>{{__('Total')}}</th>
                                </tr>
                            </thead>
                            <tbody id="medicineTableBody">
                                <!-- AJAX loaded data will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
      <!-- End Add Modal -->
</div>
@endsection

@push('pagescript')
<script>
    $(document).ready(function() {
        $('.actionButton').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route('purchase.details', ':id') }}'.replace(':id', id),
                method: 'GET',
                success: function(data) {
                    var tableBody = $('#medicineTableBody');
                    tableBody.empty();
                    data.forEach(function(details) {
                        var row = `<tr>
                                        <td><img src="/uploads/images/medicine/${details.medicine.image}" alt="${details.medicine.name}" width="50"> </td>
                                        <td>${details.medicine.name}</td>
                                        <td>${details.expiry_date}</td>
                                        <td>${details.sell_price}</td>
                                        <td>${details.buy_price}</td>
                                        <td>${details.qty}</td>
                                        <td>${details.subtotal}</td>
                                        <td>${details.discount}</td>
                                        <td>${details.total}</td>
                                    </tr>`;
                        tableBody.append(row);
                    });
                    $('#medicineModal').modal('show');
                },
                error: function() {
                    alert('Failed to fetch medicine list.');
                }
            });
        });
    });
</script>
@endpush