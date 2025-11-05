<div class="row">
    <div class="col-md-6">
        <label>Kode Obat</label>
        <input type="text" name="kode_obat" class="form-control" value="{{ old('kode_obat', $obat->kode_obat ?? '') }}" required>

        <label class="mt-2">Nama Obat</label>
        <input type="text" name="nama_obat" class="form-control" value="{{ old('nama_obat', $obat->nama_obat ?? '') }}" required>

        <label class="mt-2">Satuan</label>
        <input type="text" name="satuan" class="form-control" value="{{ old('satuan', $obat->satuan ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ old('stok', $obat->stok ?? 0) }}">

        <label class="mt-2">Harga Beli</label>
        <input type="number" name="harga_beli" step="0.01" class="form-control" value="{{ old('harga_beli', $obat->harga_beli ?? 0) }}">

        <label class="mt-2">Harga Jual</label>
        <input type="number" name="harga_jual" step="0.01" class="form-control" value="{{ old('harga_jual', $obat->harga_jual ?? 0) }}">

        <label class="mt-2">Kadaluwarsa</label>
        <input type="date" name="kadaluwarsa" class="form-control" value="{{ old('kadaluwarsa', $obat->kadaluwarsa ?? '') }}">
    </div>

    <div class="col-12 mt-3">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan', $obat->keterangan ?? '') }}</textarea>
    </div>
</div>
