<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pb-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Informasi Nilai Hasil Ujian</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Laporan Hasil Ujian Siswa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form style="margin-bottom:5px" action="" method="get">
                    <!-- <select name="wali" id="wali">
                        <option value="">Pilih Wali Kelas</option>
                        <?php foreach ($wali as $w) : ?>
                            <option value="<?= $w['id']; ?>"><?= $w['name']; ?></option>
                        <?php endforeach; ?>
                    </select> -->
                    <select name="tp" id="tp">
                        <option value="">Pilih Tahun Pelajaran</option>
                        <?php foreach ($tp as $t) : ?>
                            <option value="<?= $t['id']; ?>"><?= $t['tp']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="kelas" id="kelas">
                        <option value="">Pilih Kelas</option>
                        <?php foreach ($kelas as $k) : ?>
                            <option value="<?= $k['id']; ?>"><?= $k['kelas']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <select name="mapel" id="mapel">
                        <option value="">Pilih Mata Pelajaran</option>
                    </select> -->
                    <button type="submit" class="btn btn-primary">LIHAT</button>
                </form>
                <table id="example1" class="table table-bordered table-striped">
                    <p style="margin: 0;">Catatan:</p>
                    <p>Cetak dengan kertas F4(215 mm x 330 mm)</p>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Tahun Pelajaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($data as $d) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $d['nis']; ?></td>
                                <td><?= $d['nama']; ?></td>
                                <td>
                                    <?php
                                    $kls = $this->db->get_where('tbl_kelas', ['id' => $d['kelas']])->row_array();
                                    echo $kls['kelas'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $kls = $this->db->get_where('tbl_tp', ['id' => $d['tp']])->row_array();
                                    echo $kls['tp'];
                                    ?>
                                </td>
                                <td>
                               <a href="<?= base_url('home/cetak/').$d['nis'];?>"> <button class="btn btn-primary">Cetak</button></a>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>