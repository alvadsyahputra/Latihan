@extends("layouts.global")
@section("title") Edit  @endsection
@section("content")
<div class="col-md-8">
@if(session('status'))
 <div class="alert alert-success">
 {{session('status')}}
 </div>
@endif
 <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('scan.update',[$scan->id])}}" method="POST">
 @csrf
 {{-- {{ method_field('put') }} --}}
 <fieldset disabled="disabled">
 <div class="form-group">
   <label for="">Nama</label>
   <input value="{{ @$scan->user_created->name }}" type="text" name="name" id="create_by" class="form-control" placeholder="name" aria-describedby="helpId">
   <small id="helpId" class="text-muted">nama</small>
 </div>
</fieldset>
 <div class="form-group">
   <label for="">Proses Number</label>
   <input value="{{ @$scan->barcode }}" type="text" name="barcode" id="barcode" class="form-control" placeholder="barcode" aria-describedby="helpId">
   <small id="helpId" class="text-muted">Proses Number</small>
 </div>
{{-- dibuatkan untuk menjadi otomatis/dihilangkan  --}}

 <div class="form-group">
   <label for="">Tanggal Scan</label>
   <input value="{{ date("d/m/y h:i:s",strtotime(@$scan->created_at)) }}" type="hidden" name="tanggalscan" id="created_at" class="form-control" placeholder="tanggalscan" aria-describedby="helpId">
   <small id="helpId" class="text-muted">tanggalscan</small>
 </div> 
 @method("PUT")
 <input class="btn btn-primary" name="type" type="submit" value="submit"/>
 </form>
 </div>
    @endsection