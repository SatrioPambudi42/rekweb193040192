<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-10">
            <h2 class="my-4">Form Tambah Data Anggota</h2>

            <form action="/polisi/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group row mt-2">
                    <label for="nama_Anggota" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_Anggota')) ? 'is-invalid' : ''; ?>" id="nama_Anggota" name="nama_Anggota" autofocus value="<?= old('nama_Anggota'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_Anggota'); ?>
                        </div>

                    </div>
                    <div class="form-group row mt-2">
                        <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?= old('pangkat'); ?>">
                        </div>
                    </div>

                    <div class=" form-group row mt-2">
                        <label for="jabatan" class="col-sm-2 col-form-label">jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= old('jabatan'); ?>">
                        </div>
                    </div>

                    <div class=" form-group row mt-2">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-2">
                            <img src="/img/tr.png" class="img-thumbnail img-preview">


                        </div>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="form-control" <?= ($validation->hasError('foto'))
                                                                            ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewImg()">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto'); ?>
                                </div>
                                <label class="custom-file-label" for="foto"></label>

                            </div>
                        </div>
                    </div>


                    <div class="form-group row mt-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>