<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modal">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="arsip/{{ $arsip->id }}" method="post" id="form-tambah">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="kode_klasifikasi" class="form-label">Kode Klasifikasi<span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="kode_klasifikasi" name="kode_klasifikasi"
                            value="{{ $arsip->kode_klasifikasi }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="jenis_arsip" class="form-label">Jenis Arsip<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="jenis_arsip" name="jenis_arsip"
                            value="{{ $arsip->jenis_arsip }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="deskripsi" class="form-label">Deskripsi<span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3" disabled>{{ $arsip->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-3">
                        <label for="tahun" class="form-label">Tahun<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="tahun" name="tahun"
                            value="{{ $arsip->tahun }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="tingkat_perkembangan" class="form-label">Tingkat Perkembangan</label>
                        <input type="text" class="form-control" id="tingkat_perkembangan" name="tingkat_perkembangan"
                            value="{{ $arsip->tingkat_perkembangan }}">
                    </div>
                    <div class="col-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah"
                            value="{{ $arsip->jumlah }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            value="{{ $arsip->keterangan }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="lokasi_depot" class="form-label">Lokasi Depot</label>
                        <input type="number" class="form-control" id="lokasi_depot" name="lokasi_depot"
                            value="{{ $arsip->lokasi_depot }}">
                    </div>
                    <div class="col-6">
                        <label for="lokasi_rak" class="form-label">Lokasi Rak</label>
                        <input type="number" class="form-control" id="lokasi_rak" name="lokasi_rak"
                            value="{{ $arsip->lokasi_rak }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="nomor_box" class="form-label">Nomor Box</label>
                        <input type="number" class="form-control" id="nomor_box" name="nomor_box"
                            value="{{ $arsip->no_box }}">
                    </div>
                    <div class="col-6">
                        <label for="nomor_folder" class="form-label">Nomor Folder</label>
                        <input type="number" class="form-control" id="nomor_folder" name="nomor_folder"
                            value="{{ $arsip->no_folder }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="jangka_simpan" class="form-label">Jangka Simpan dan Nasib Akhir</label>
                        <input type="text" class="form-control" id="jangka_simpan" name="jangka_simpan"
                            value="{{ $arsip->jangka_simpan }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="kategori_arsip" class="form-label">Kategori Arsip</label>
                        <input type="text" class="form-control" id="kategori_arsip" name="kategori_arsip"
                            value="{{ $arsip->kategori_arsip }}">
                    </div>
                </div>
                <button type="submit" id="submit-form" hidden></button>
            </form>
            <form action="arsip/{{ $arsip->id }}" method="post" id="form-delete">
                @csrf
                @method('DELETE')
                <button type="submit" id="submit-delete" hidden></button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger me-auto" id="delete">Hapus</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" id="submit-update">Perbarui</button>
        </div>
    </div>
</div>

<script>
    $('#submit-update').click(function() {
        $('#submit-form').trigger('click')
    });

    $('#delete').click(function() {
        $('#submit-delete').trigger('click')
    });
</script>
