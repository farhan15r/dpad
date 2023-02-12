<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modal">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="arsipexcel" method="post" id="form-tambah" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="file" class="form-label">Masukkan File *</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                </div>
                <button type="submit" id="submit-form" hidden></button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-success me-auto" id="add-manual">Upload Manual</button>

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" id="submit-tambah">Tambah</button>
        </div>
    </div>
</div>

<script>
    $('#submit-tambah').click(function() {
        $('#submit-form').trigger('click')
    });

    $('#add-manual').click(function(e) {
        $.get("/api/addarsip", {},
            function(data) {
                $('#modal-data').html(data);
            },
        );
    });
</script>
