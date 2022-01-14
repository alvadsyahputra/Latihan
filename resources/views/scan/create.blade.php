@extends("layouts.global")
@section("title") Create New Items @endsection
@section("content")
<div class="col-md-8">
@if(session('status'))
 <div class="alert alert-success">
 {{session('status')}}
 </div>
@endif
@if($errors->any())
<div class="alert alert-danger">
    {!! implode("",$errors->all("<p>:message</p>")) !!}
</div>
@endif
 <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('scan.store')}}" method="POST">
 @csrf
 <div class="form-group">
   <label for="">New Items</label>
   <input type="text" name="barcode" id="barcode" class="form-control" placeholder="barcode" aria-describedby="helpId" onblur="this.focus()" autofocus >
   <small id="helpId" class="text-muted">Barcode</small>
 </div>
 <input class="btn btn-primary" name="type" type="submit" value="Submit"/>
 </form>
 </div>
    @endsection