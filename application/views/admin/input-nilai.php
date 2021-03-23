<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data hasil ujian siswa</h3>
            <?= $this->session->flashdata('message'); ?>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form style="margin-bottom:5px" action="" method="get">
                <select name="kategori" id="kategori">
                    <option value="">Pilih Jenis Ujian</option>
                    <?php foreach ($kategori as $k) : ?>
                        <option value="<?= $k['id']; ?>"><?= $k['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="tp" id="tp">
                    <option value="">Pilih Tahun Pelajaran</option>
                    <?php foreach ($tp as $t) : ?>
                        <option value="<?= $t['tp']; ?>"><?= $t['tp']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="kelas" id="kelas">
                    <option value="">Pilih Kelas</option>
                    <?php foreach ($kelas as $k) : ?>
                        <option value="<?= $k['id']; ?>"><?= $k['kelas']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="mapel" id="mapel">
                    <option value="">Pilih Mata Pelajaran</option>
                </select>
                <button type="submit" class="btn btn-primary">LIHAT</button>
            </form>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th width="15px">Nilai</th>
                    </tr>
                </thead>
                <form action="<?= base_url('admin/input_data'); ?>" method="POST">
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($data as $d) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td>
                                    <?= $d['nis']; ?>
                                    <input type="hidden" name="nis[]" id="nis" value="<?= $d['nis']; ?>">
                                    <input type="hidden" name="tp[]" id="tp" value="<?= $tp2; ?>">
                                    <input type="hidden" name="kategori[]" id="kategori" value="<?= $ktgr; ?>">
                                </td>
                                <td>
                                    <?= $d['nama']; ?>
                                    <input type="hidden" name="nama[]" id="nama" value="<?= $d['nama']; ?>">
                                </td>
                                <td>
                                    <?php
                                    $kls = $this->db->get_where('tbl_kelas', ['id' => $d['kelas']])->row_array();
                                    echo $kls['kelas'];
                                    ?>
                                    <input type="hidden" name="kelas[]" id="kelas" value="<?= $kls['id']; ?>">
                                </td>
                                <td>
                                    <?php
                                    $mpl = $this->db->get_where('tbl_mapel', ['id' => $mapel])->row_array();
                                    echo $mpl['mapel'];
                                    ?>
                                    <input type="hidden" name="mapel[]" id="mapel" value="<?= $mpl['id']; ?>">
                                </td>
                                <td>
                                    <input type="number" name="nilai[]" id="nilai" style="width: 100px;">
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </tbody>
            </table>
            <button type="submit" class="btn btn-primary mt-3 float-right">SIMPAN</button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
</div>
</div>