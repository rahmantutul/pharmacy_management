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
            <div class="row bg-secondary p-3" >
                <div class="col-md-2">
                    <input type="text" id="exname" class="form-control" placeholder="Medicine Name">
                </div>
                <div class="col-md-2">
                    <input type="date" id="exfromDate" class="form-control">
                </div>
                <div class="col-md-2">
                    <input type="date" id="extoDate" class="form-control">
                </div>
                <div class="col-md-2">
                    <select id="exsupplier" class="form-control">
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="excategory" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <button id="filter" class="btn btn-primary"><i class="fadeIn animated bx bx-search-alt"></i></button>
                </div>
            </div>
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('name')}}</th>
                        <th scope="col">{{__('Generic Name')}}</th>
                        <th scope="col">{{__('Strength')}}</th>
                        <th scope="col">{{__('Supplier')}}</th>
                        <th scope="col">{{__('Expired Date')}}</th>
                        <th scope="col">{{__('Qty (pcs)')}}</th>
                        <th scope="col">{{__('Image')}}</th>
                        <th scope="col">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody id="ex-medicine-list">
                    @foreach ($dataList as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td class="text-bold-500">{{$data?->medicine->name}}</td>
                            <td>{{$data?->medicine->genericname}}</td>
                            <td>{{$data?->medicine->strength}}</td>
                            <td>{{$data?->medicine->supplier->name}}</td>
                            <td>{{date("j F, Y", strtotime($data?->expire_date))}}</td>
                            <td><strong>{{$data?->total_qty}}</strong></td>
                            <td>
                                <img style="height:40; width:40px; border:1px solid #000;" src=" {{asset('uploads/images/medicine/'.$data?->medicine->image)}}" alt="Favicon Image"> <br><br>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{route('medicine.edit', $data?->medicine->id)}}">{{__('Rreturn To Supplier')}}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination col-md-12" id="pagination-links">
                {{$dataList->links("pagination::bootstrap-4")}}
              </div>
        </div>
    </div>
</div>
@endsection

@push('pagescript')
<script>
    $(document).ready(function() {
        function fetchMedicines(page) {
            var exname = $('#exname').val();
            var exfromDate = $('#exfromDate').val();
            var extoDate = $('#extoDate').val();
            var exsupplier = $('#exsupplier').val();
            var excategory = $('#excategory').val();
            $.ajax({
                url: "{{ route('filter.exppire.medicine') }}?page=" + page,
                method: 'GET',
                data: {
                    exname: exname,
                    exfromDate: exfromDate,
                    extoDate: extoDate,
                    exsupplier: exsupplier,
                    excategory: excategory
                },
                success: function(response) {
                $('#ex-medicine-list').html(''); // Clear the existing table body content
                response.data.forEach(function(exmed, index) {
                    let ExMedRow = '<tr>' +
                                        '<td>' + (index + 1) + '</td>' +
                                        '<td class="text-bold-500">' + exmed.medicine.name + '</td>' +
                                        '<td>' + exmed.medicine.genericname + '</td>' +
                                        '<td>' + exmed.medicine.strength + '</td>' +
                                        '<td>' + exmed.medicine.supplier.name + '</td>' +
                                        '<td>' + exmed.expire_date + '</td>' +
                                        '<td>' + '<strong>' + exmed.total_qty + '</strong>'+'</td>' +
                                        '<td>' + 
                                        '<img style="height:40; width:40px; border:1px solid #000;" src="/uploads/images/medicine/'+ exmed.medicine.image +'" alt="'+ exmed.medicine.name +'" width="50">' +
                                        '</td>' +
                                        '<td>' +
                                        '<a class="btn btn-sm btn-primary" href="{{ route("medicine.edit", "") }}/' + exmed.medicine.id + '">{{__("Rreturn To Supplier")}}</a>' +
                                        '</td>' +
                                    '</tr>';
                    $('#ex-medicine-list').append(ExMedRow);
                    // Update pagination links
                    $('#pagination-links').html(response.links);
                });
            }
        });
        }

        $(document).on('keyup', '#exname', function() {
            fetchMedicines(1);
        });

        $(document).on('change', '#exsupplier, #excategory, #exfromDate, #extoDate', function() {
            fetchMedicines(1);
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetchMedicines(page);
        });
    });
</script>
@endpush