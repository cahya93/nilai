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
            <!-- <p>Keterangan:</p>
            <ol style="background-color: white;">
                <li style="color: blue;">Teks berwarna biru nilai sudah ada</li>
                <li style="color: chartreuse">Teks berwarna hijau sudah buat soal dengan lengkap</li>
                <li style="color:orange">Teks berwarna orange sudah terjadwal</li>
            </ol> -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data hasil ujian siswa</h3>
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
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                            <th>Status</th>
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
                                    $mpl = $this->db->get_where('tbl_mapel', ['id' => $mapel])->row_array();
                                    echo $mpl['mapel'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $nilai = $this->db->get_where('tbl_nilai', ['nis' => $d['nis'], 'id_kategori' => $ktgr, 'id_mapel' => $mapel, 'tp' => $tp2])->row_array();
                                    $score = $nilai['nilai'];
                                    if ($score == 0) {
                                        echo "<span class='btn btn-danger'>0</span>";
                                    } else if ($score < 75) {
                                        echo "<span class='btn btn-warning'>$score</span>";
                                    } else if ($score >= 75) {
                                        echo "<span class='btn btn-success'>$score</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $nilai = $this->db->get_where('tbl_nilai', ['nis' => $d['nis'], 'id_kategori' => $ktgr, 'id_mapel' => $mapel, 'tp' => $tp2])->row_array();
                                    $score = $nilai['nilai'];
                                    if ($score < 75) {
                                        echo "<span class='btn btn-danger'>Remidi</span>";
                                    } else if ($score >= 75) {
                                        echo "<span class='btn btn-success'>Tuntas</span>";
                                    }
                                    ?>
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