<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link rel="icon" href="{{asset('assets/images/favicon-32x32.png')}}" type="image/png" />
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/purchase.css')}}" />
    @stack('stylesheet')
	<title>{{ __('Pharmacy') }}</title>
    <style>
        .col-2 {
        padding: 2px !important;
        margin-bottom: -15px !important;
    }
    </style>
</head>
<body>
        <!-- livicons start -->
        <section id="font-livicons">
            <div class="row">
                <div class="col-12 m-auto ">
                    <div class="card">
                        <div class="card-header text-center text-white" style="background: rgb(15, 94, 120)"><h4 style="color:#fff;">{{__('New Sales (POS)')}}</h4></div>
                        <div class="row">
                            <div class="col-6 border">
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <input type="text" id="name" class="form-control" placeholder="Medicine Name">
                                    </div>
                                    <div class="col-md-4">
                                        <select id="supplier" class="form-control">
                                            <option value="">Select Supplier</option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="category" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button id="filter" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                                <div id="medicines-list" class="row mt-4">
                                    @include('backend.sales.search-result', ['medicines' => $medicines])
                                </div>
                            </div>
                            <div class="col-6">
                                 @include('backend.sales.cart-item',['medicines' => $medicines])
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
   

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
        function fetchMedicines(page) {
            var name = $('#name').val();
            var supplier = $('#supplier').val();
            var category = $('#category').val();

            $.ajax({
                url: "{{ route('sales.medicines.filter') }}?page=" + page,
                method: 'GET',
                data: {
                    name: name,
                    supplier: supplier,
                    category: category
                },
                success: function(response) {
                    $('#medicines-list').html(response);
                }
            });
        }

        $(document).on('keyup', '#name', function() {
            fetchMedicines(1);
        });

        $(document).on('change', '#supplier, #category', function() {
            fetchMedicines(1);
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetchMedicines(page);
        });
    });
</script>
<script>
    function addToSalesCart(medicineId) {
        $.ajax({
            url: '{{ route('sales.cart.add') }}',
            method: 'get',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                medicine_id: medicineId
            },
            success: function(response) {
                if (response.success) {
                   updateSalesCart(medicineId);
                }
            },
            error: function(response) {
                alert('Error adding medicine to cart');
            }
        });
    }

    function
</script>
</body>
</html>