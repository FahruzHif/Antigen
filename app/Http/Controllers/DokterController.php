<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DokterController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $dokter = Dokter::all();

        return view('data.dokter', [
            'dokter' => $dokter,
            "title" => "Dokter",
            "judultabel" => "Data Dokter",
        ]);
    }

    public function getDokter(Request $request, Dokter $dokter)
    {
        $data = $dokter->latest();
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '
                    <a href="/dokter/'.$data->id.'" class ="btn btn-primary btn-md text-decoration-none text-white fa fa-eye" > Detail</a>
                    <button type="button" class="btn btn-success btn-md fa fa-pencil" id="getEditDokterData" data-id="'.$data->id.'"> Ubah</button>
                    <button type="button" class="btn btn-danger btn-md fa fa-times" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteDokterModal" id="getDeleteId"> Hapus</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Dokter $dokter)
    {
        
        $validator = \Validator::make($request->all(), [
            'no_dok'    => 'required',
            'nama_dok'  => 'required',
            'jns_dok'   => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $dokter->storeData($request->all());

        return response()->json(['success'=>'Dokter added successfully']);
    }

    public function show(Dokter $dokter)
    {       
        return view("data.detaildokter",[
            "title" => "Dokter",
            "judultabel" => "Data Dokter",
            "dokter" => $dokter,
        ]);
    }

    public function edit($id)
    {
        $dokter = new Dokter;
        $data = $dokter->findData($id);
        $l = "Laki-Laki";
        $p = "Perempuan";
        
        // Select Jns_Dokter
        $sjns_dok = $data->jns_dok;
        if ($sjns_dok == $l) {
            $jns_satu = $l;
            $jns_dua = $p;
        } else {
            $jns_satu = $p;
            $jns_dua = $l;
        }
        
        $html = '
        <table class="borderless">
        <tr>
            <td>        
                <div class="form-group">
                    <label>No Dokter :</label>
                    <input type="text" class="form-control" name="no_dok" id="editNo_dok" value="'.$data->no_dok.'">
                </div>
            </td>
        </tr>
        
        <tr>
            <td>
                <div class="form-group">
                    <label>Nama Dokter :</label>
                    <input type="text" class="form-control" name="nama_dok" id="editNama_dok" value="'.$data->nama_dok.'">
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <div class="form-group">
                    <label>Jenis Kelamin :</label>
                    <select class="form-control mb-1" name="jns_dok" id="editJns_dok">
                        <option value="'.$jns_satu.'" >'.$jns_satu.'</option>
                        <option value="'.$jns_dua.'" >'.$jns_dua.'</option>
                    </select>
                </div>
            </td>
        </tr>
        </table>';

        return response()->json(['html'=>$html]);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'no_dok'    => 'required',
            'nama_dok'  => 'required',
            'jns_dok'   => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $dokter = new Dokter;
        $dokter->updateData($id, $request->all());

        return response()->json(['success'=>'Dokter updated successfully']);
    }

    public function destroy($id)
    {
        $dokter = new Dokter;
        $dokter->deleteData($id);

        return response()->json(['success'=>'Dokter deleted successfully']);
    }
}
