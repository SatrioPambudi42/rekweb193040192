<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">

            <a href="/polisi/create" class="btn btn-primary mt-3">Tambah Data Anggota </a>
            <br>

            <h1="mt-4">(DAFTAR ANGGOTA BAGPSIPOL ROPSI SSDM POLRI.)</h1>

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>

                <?php endif; ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($polisi as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><img src="/img/<?= $p['foto']; ?>" alt="" class="foto"></td>
                                <td><?= $p['nama_Anggota']; ?></td>
                                <td>
                                    <a href="/polisi/<?= $p['slug']; ?>" class="btn btn-success">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

        </div>


    </div>

</div>


<?= $this->endSection(); ?>