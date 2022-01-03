<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scan;
use App\Models\User;


use Illuminate\Support\Facades\Auth;


class ScanController extends Controller
{
    
    public function __construct(){
        $this->middleware("auth");
 }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    // $scan = Scan::with('user_created')->paginate(10);
    // $scan = null;
    {
        $filterKeyword = $request->get('keyword');
        $filterDateScan = $request->get('tgl_scan');
        if($filterKeyword){
            $scan = Scan::select('*')
            ->join('users', 'scan.create_by', '=', 'users.id')
            ->where('barcode', 'LIKE',"%$filterKeyword%")
            ->orWhere('name', 'LIKE',"%$filterKeyword%");        
            if ($filterDateScan) {
                $scan->whereDate('scan.created_at', '=', $filterDateScan);
            }
        } else {
            if ($filterDateScan) {
                $scan = Scan::whereDate('created_at', '=', $filterDateScan);
            } else {
                $scan = Scan::whereDate('created_at', '=', date('Y-m-d'));
            }            
        }
        return view('scan.index', ['scan' => $scan->paginate(10), 'dateScan' => $filterDateScan ? $filterDateScan:date('Y-m-d')]);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("scan.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "barcode"=>"required|unique:scan,barcode"
        ]);
        
        $new_scan = new Scan; // ambil
        $new_scan->barcode = $request->get('barcode');
        $new_scan->create_by = Auth::user()->id;
        $new_scan->created_at = now();
        $new_scan->updated_at = null;
        $new_scan->save();
        return redirect()->route('scan.create')->with('status', 'item successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $data['scan'] = Scan::find($id);
         return view('scan.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scan = Scan::findOrFail($id);
        return view('scan.edit', ['scan' => $scan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    $scan = Scan::findOrFail($id);
    $scan->barcode = $request->get('barcode');
    $scan->create_by = Auth::user()->id;
    $scan->created_at = now();
    $scan->updated_at = null;
    $scan->save();
    return redirect()->route('scan.edit', [$id])->with('status', 'scan barcode succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scan = Scan::find($id); //ambil data by id
        $scan->delete(); //hapus
        return redirect('scan');
    }
}
