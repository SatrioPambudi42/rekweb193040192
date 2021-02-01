<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-10">
            <h2 class="my-3">Form Ubah Data Anggota</h2>

            <form action="/polisi/update/<?= $polisi['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $polisi['slug']; ?>">
                <input type="hidden" name="fotoLama" value="<?= $polisi['foto']; ?>">
                <div class="form-group row">
                    <label for="nama_Anggota" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_Anggota')) ? 'is-invalid' : ''; ?>" id="nama_Anggota" name="nama_Anggota" autofocus value="<?= (old('nama_Anggota')) ? old('nama_Anggota') : $polisi['nama_Anggota'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_Anggota'); ?>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?= (old('pangkat')) ? old('pangkat') : $polisi['pangkat'] ?>">
                        </div>
                    </div>

                    <div class=" form-group row">
                        <label for="jabatan" class="col-sm-2 col-form-label">jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= (old('jabatan')) ? old('jabatan') : $polisi['jabatan'] ?>">
                        </div>
                    </div>

                    <div class=" form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-2">
                            <img src="/img/<?= $polisi['foto']; ?>" class="img-thumbnail img-preview">


                        </div>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="form-control <?= ($validation->hasError('foto'))
                                                                            ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewImg()">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto'); ?>
                                </div>
                                <label class="custom-file-label" for="foto"><?= $polisi['foto']; ?></label>

                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Ubah Data</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>