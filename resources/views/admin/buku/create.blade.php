@extends('template')
@section('konten')
<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="card-title">Tambah Data Nilai</h3>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('buku.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jd">Id Buku</label>
                                        <input type="text" name="id_buku" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jd">Nama Buku</label>
                                        <input type="text" name="nama" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
												<label for="exampleFormControlSelect1">Kategori</label>
												<select class="form-control" name="kategori_id" id="exampleFormControlSelect1">
                                                    <option hidden>-== Pilih Kategori ==-</option>
                                                    @foreach ($kategori as $item)
                                                    <option value="{{$item->id}}">{{$item->kategori}}</option>
                                                    @endforeach
												</select>
											</div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
												<label for="exampleFormControlSelect1">Penerbit</label>
												<select class="form-control" name="penerbit_id" id="exampleFormControlSelect1">
                                                    <option hidden>-== Pilih Nama Penerbit ==-</option>
                                                    @foreach ($penerbit as $item)
                                                    <option value="{{$item->id}}">{{$item->nama_penerbit}}</option>
                                                    @endforeach
												</select>
											</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jd">Harga</label>
                                                <input type="text" name="harga" class="form-control {{ $errors->first('harga') ? "is-invalid":""}}"  placeholder="Masukkan Total Nilai">

                                                @error('harga')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                            @enderror
 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jd">Stok</label>
                                                <input type="text" name="stok" class="form-control {{ $errors->first('stok') ? "is-invalid":""}}">

                                                @error('stok')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <center>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection