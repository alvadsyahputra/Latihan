@extends("layouts.global")
@section("title") scan list Items @endsection
@section("content")
@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
<form action="{{route('scan.index')}}">
    <div class="row">
        <div class="col-md-6">
            <div class="input-group">
                <input value="{{Request::get('keyword')}}" name="keyword" class="form-control" type="text"
                    placeholder="Cari Items..." />
                <div class="input-group">
                        <input name="tgl_scan" class="form-control" type="date"
                            placeholder="" value="{{$dateScan}}"/>
                <input type="submit" value="Filter" class="btn btn-primary">
            </div>
                            
            </div>
        </div>
        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                </li>
            </ul>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{route('scan.create')}}" class="btn btn-primary"> New scan + </a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                
                <tr>
                    <td>No</td>
                    <th><b>Nama</b></th>
                    <th><b>Proses Number</b></th>
                    <th><b>Tanggal Scan</b></th>
                    {{-- <th><b>Action</b></th> --}}
                </tr>
            </thead>
            <tbody>
                
                @php
                    $no = 1;
                @endphp
                    @foreach($scan as $item)
                    <tr>
                    <td>{{$no++}}</td>
                    <td>{{ @$item->user_created->name }}</td>
                    <td>{{$item->barcode}}</td>
                    <td>{{date("d/m/y h:i:s",strtotime($item->created_at))}}</td>
                    {{-- <td>
                        <a class="btn btn-info text-white btn-sm" href="{{route('scan.edit', [$item->id])}}">Edit</a>
                        <form onsubmit="return confirm('Delete this items permanently?')" class="d-inline"
                            action="{{route('scan.destroy', [$item->id])}}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        {{$scan->links('pagination::bootstrap-4')}}
    </div>
</div>
@endsection
