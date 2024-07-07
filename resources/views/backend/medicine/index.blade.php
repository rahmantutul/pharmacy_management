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
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('name')}}</th>
                        <th scope="col">{{__('Generic Name')}}</th>
                        <th scope="col">{{__('Strength')}}</th>
                        <th scope="col">{{__('Supplier')}}</th>
                        <th scope="col">{{__('Image')}}</th>
                        <th scope="col">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataList as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="text-bold-500">{{$data->name}}</td>
                        <td>{{$data->genericname}}</td>
                        <td>{{$data->strength}}</td>
                        <td>{{$data?->supplier->name}}</td>
                        <td>
                            <img style="height:40; width:40px; border:1px solid #000;" src=" {{asset('uploads/images/medicine/'.$data->image)}}" alt="Favicon Image"> <br><br>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{route('medicine.edit', $data->id)}}">{{__('Edit')}}</a>
                            <a class="btn btn-sm btn-danger" href="{{route('medicine.destroy', $data->id)}}" onclick="confirm('Are you sure you want to delete this medicine?') || event.stopImmediatePropagation()" wire:click="destroy({{$data->id}})">{{__('Delete')}}</a>
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
</div>
@endsection

@push('script')
    
@endpush