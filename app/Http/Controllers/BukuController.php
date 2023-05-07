<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public $buku;
    // Membuat objek baru dari kelas Mahasiswa
    public function __construct()
    {
       $this->buku = new Buku;
    }
    public function home(Request $request)
    {
        $cari =  $request->search;
        $index = DB::table('bukus')
        ->join('kategoris','bukus.kategori_id','=','kategoris.id')
        ->join('penerbits','bukus.penerbit_id','=','penerbits.id')
        ->select('bukus.*','kategoris.*','penerbits.*')
        ->where('bukus.nama','LIKE', "%$cari%")
        ->get();
        // $index = Buku::all();
        // dd($index);
        return view('index', compact('index'));
    }
    public function admin()
    {
        $home = DB::table('bukus')
        ->join('kategoris','bukus.kategori_id','=','kategoris.id')
        ->join('penerbits','bukus.penerbit_id','=','penerbits.id')
        ->select('bukus.*','kategoris.*','penerbits.*')
        ->get();
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();

        return view('admin.admin', compact('penerbit', 'kategori', 'home'));
    }
    public function pengadaan(Request $request)
    {
        $ada = DB::table('bukus')
        ->join('kategoris','bukus.kategori_id','=','kategoris.id')
        ->join('penerbits','bukus.penerbit_id','=','penerbits.id')
        ->select('bukus.*','kategoris.*','penerbits.*')
        ->where('bukus.stok', '<=', '15', 'AND', '>=', '1')
        ->orderBy('bukus.stok', 'asc')
        ->get();
        // $index = Buku::all();
        // dd($index);
        return view('pengadaan', compact('ada'));
    }
    public function index()
    {
        
    }

    public function create()
    {
        $kategori = Kategori::all();
        $penerbit = Penerbit::all();
        return view('admin.buku.create', compact('kategori', 'penerbit'));
    }

    public function store(Request $request)
    {
         //fungsi untuk menyimpan data baru customer
         $rules = [
            'id_buku'   => 'required',
            'nama'   => 'required',
            'kategori_id'  => 'required',
            'penerbit_id'   => 'required',
            'harga'   => 'required|integer',
            'stok'   => 'required|integer',
        ];
 
        $messages = [
            'required'      => ":attribute gak boleh kosong",
            'integer'      => ":attribute hanya berupa angka",
        ];
 
        $this->validate($request, $rules, $messages);
 
        $this->buku->id_buku = $request->id_buku;
        $this->buku->nama = $request->nama;
        $this->buku->kategori_id = $request->kategori_id;
        $this->buku->penerbit_id = $request->penerbit_id;
        $this->buku->harga = $request->harga;
        $this->buku->stok = $request->stok;
 
        // simpan data menggunakan method save()
        $this->buku->save();
 
        // redirect halaman serta kirimkan pesan berhasil
        return redirect()->route('admin');
    }

    public function show(buku $buku)
    {
        //
    }

    public function edit($id)
    {
        $edit = Buku::findOrFail($id);
        $kategori = Kategori::all();
        $penerbit = Penerbit::all(); 
        return view('admin.buku.edit', compact('edit', 'kategori', 'penerbit'));
    }

    public function update(Request $request, $id)
    {
        $update = Buku::findOrFail($id);

        if ($update->id_buku == $request->id_buku && $update->nama == $request->nama && $update->kategori_id == $request->kategori_id 
        && $update->penerbit_id == $request->penerbit_id && $update->harga == $request->harga && $update->stok == $request->stok) {
            return redirect()->route('admin');
        } else{
            $rules = [
                'id_buku'   => 'required',
                'nama'   => 'required',
                'kategori_id'   => 'required',
                'penerbit_id'   => 'required',
                'harga'   => 'required|integer',
                'stok'   => 'required|integer',
            ];
            $messages = [
                'required'      => ":attribute gak boleh kosong",
                'integer'      => ":attribute hanya berupa angka",
            ];
     
            $this->validate($request, $rules, $messages);
     
            $this->buku->id_buku = $request->id_buku;
            $this->buku->nama = $request->nama;
            $this->buku->kategori_id = $request->kategori_id;
            $this->buku->penerbit_id = $request->penerbit_id;
            $this->buku->harga = $request->harga;
            $this->buku->stok = $request->stok;
        }
        // simpan data menggunakan method save()
        $update->id_buku = $request->id_buku;
        $update->nama = $request->nama;
        $update->kategori_id = $request->kategori_id;
        $update->penerbit_id = $request->penerbit_id;
        $update->harga = $request->harga;
        $update->stok = $request->stok;

        $update->save();
 
        // redirect halaman serta kirimkan pesan berhasil
        return redirect()->route('admin');
    }

    public function delete($id)
    {
        $destroy = Buku::findOrFail($id);
        $destroy->delete();
        return redirect()->route('admin');
    }
}
