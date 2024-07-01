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
                    <li class="breadcrumb-item active" aria-current="page">{{__('Expense Edit')}}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-sm btn-primary d-block m-1" href="{{route('expense.index')}}">{{__('Expense List')}}</a>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- livicons start -->
        <section id="font-livicons">
            <div class="row">
                <div class="col-md-8 m-auto ">
                    <div class="card">
                        <div class="card-header text-center"><h4>{{__('Expense Edit')}}</h4></div>
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
                            <form method="POST" method="post" action="{{ route('expense.update') }}">
                                @csrf
                                <input type="hidden" name="dataId" value="{{$dataInfo->id}}">
                                <div class="mb-3">
                                    <label for="date" class="form-label">{{__('Date')}}</label>
                                    <input id="date" type="date" class="form-control " name="date" value="{{$dataInfo->date}}" required autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{__('Expense Category')}}</label>
                                    <div class="mb-3">
                                        <select class="form-select form-select-sm mb-3" name="category_id" aria-label=".form-select-sm example" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                             <option {{($dataInfo->category_id==$category->id)?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="expense_for" class="form-label">{{__('Expense For')}}</label>
                                    <input id="expense_for" type="text" class="form-control " name="expense_for" value="{{$dataInfo->expense_for}}" required autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">{{__('Amount')}}</label>
                                    <input id="amount" type="number" class="form-control " name="amount" value="{{$dataInfo->amount}}" required autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="note" class="form-label">{{__('Note')}}</label>
                                    <textarea id="note" class="form-control" name="note" id="" cols="30" rows="10">{{$dataInfo->note}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        {{__('Update')}}
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

@push('script')
    
@endpush