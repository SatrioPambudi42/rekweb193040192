<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Anggota</h2>
            <div class="card mb-4" style="max-width: 250px;">
                <div class="row g-0">
                    <div class="col-md-10">
                        <img src="/img/<?= $polisi['foto']; ?>" alt="" class="img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $polisi['nama_Anggota']; ?></h5>
                            <p class="card-text"><b>Pangkat :</b><?= $polisi['pangkat']; ?></p>
                            <p class="card-text"><small class="text-muted"><b>Jabatan : </b><?= $polisi['jabatan']; ?></small></p>

                            <a href="/polisi/edit/<?= $polisi['slug']; ?>" class="btn btn-warning">Edit</a>

                            <form action="/polisi/<?= $polisi['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin ingin menghapus data?');"> Delete</button>



                            </form>


                            <br><br>
                            <a href="/polisi">Kembali ke Daftar Anggota</a>
                        </div>
                    </div>
                </div>
            </div>




        </div>



    </div>



</div>
<?= $this->endSection(); ?>