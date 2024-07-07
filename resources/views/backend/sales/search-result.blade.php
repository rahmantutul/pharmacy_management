@foreach($medicines as $medicine)
<div class="col-2 ">
  <a href="javascript:" class="text-dark" onclick="addToSalesCart({{$medicine->id}})">
    <div class="card" style="background: rgb(15 94 120 /30%)">
        <img src="{{asset('uploads/images/medicine/'.$medicine->image)}}" class="card-img-top" alt="{{$medicine->name}}">
        <div class="card-body">
          <p class="text-center"><strong>{{$medicine->name}}</strong></p>
        </div>
      </div>
  </a>
</div>
@endforeach
{{$medicines->links("pagination::bootstrap-4")}}
