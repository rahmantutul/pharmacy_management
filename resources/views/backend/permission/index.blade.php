@extends('backend.layouts.app')

@push('style')
    
@endpush

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{__('Users')}}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('User List')}}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
              <a href="#" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-sm btn-primary">{{__('Add New')}}</a>
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
          <table class="table">
            <thead>
              <tr>
                  <th scope="col">{{__('Sys.ID')}}</th>
                  <th scope="col">{{__('Name')}}</th>
                  <th scope="col">{{__('Options')}}</th>
              </tr>
            </thead>
             <tbody>
               @foreach($dataList as $dataInfo)
               <tr>
                 <td>{{ $dataInfo->id }}</td>
                 <td>{{ $dataInfo->name }}</td>
                 <td>
                    <form  method="post" action="{{ url('/permission/destroy/'.$dataInfo->id) }}" class="delete_form">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <div class="btn-group btn-corner">
                        <a href="#" class="btn btn-xs btn-primary edit">Edit</a>
                        <button class='btn btn-danger btn-sm delete'  type="submit" onclick="return confirm('Are You Sure? Want to Delete It.');">{{__('Delete')}}</button>
                      </div>
                    </form>
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
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__('New Permission Creation')}}</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <br/>
          <form action="{{route('permission.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">

              <div class="row">
                <div class="col-md-8">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">{{__('Permission Name')}} &nbsp;:</span>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="" required>
                  </div>
              </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('Cancel')}}</button>
            </div>
          </form>

        </div>
      </div>
    </div>
<!-- End Add Modal -->

<!--- Start Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">	<b>Edit Role</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="#" method="post" id="editForm" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('POST') }}
        <input type="hidden" name="id" id="id" class="form-control" readonly="true" />
        <br/>
        <div class="modal-body">

          <div class="row">
             <div class="col-md-8">
               <div class="input-group mb-3">
                 <div class="input-group-prepend">
                   <span class="input-group-text">{{__('Permission Name')}}&nbsp;:</span>
                 </div>
                 <input type="text" name="name"  id="name"  class="form-control" placeholder="">
               </div>
   	       </div>
          </div>


        </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
           <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('Close')}}</button>
         </div>
       </form>

    </div>
  </div>
</div>
<!--- End Edit Modal -->
</div>

@endsection

@push('pagescript')
<script type="text/javascript">
  $(document).ready(function() {

    $('.edit').on('click',function() {
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();
        $('#id').val(data[0]);
        $('#name').val(data[1]);

        $('#editForm').attr('action','{{route("permission.update",$dataInfo)}}');
        $('#editModal').modal('show');
    });

  });
</script>
@endpush