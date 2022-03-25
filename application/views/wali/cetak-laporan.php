<style type="text/css">
@page {
        margin-top: 0.5cm;
        margin-bottom: 0.5cm;
        margin-left: 1.0cm;
        margin-right: 1.0cm;
    }
.kop-surat img{
    display: flex;
    justify-content: center;
}
.header-surat {
    margin-bottom: 10px;
}
.header-surat h3{
    text-align: center;
    margin: 0;
}

.header-data {
    display: flex;
    justify-content: center;
}
.konten {
    display: flex;
    justify-content: center;
}
.bottom {
    margin-top: 15px;
}
</style>
<?php
    // $nilai = $this->db->get_where('master',['id_siswa'=>$nis, 'id_mapel' => 2])->row_array();
    // $nilai_akhir = ($nilai['nilai_p'] + $nilai['nilai_k'])/2;
?>
<div>
    <div class="kop-surat">
        <img src="<?= base_url('/assets/image/kop.png')?>" alt="kop smk muhka">
    </div>
    <div class="header-surat">
        <h3>Laporan Hasil Belajar</h3>
        <h3>Penilaian Tengah Semester Ganjil</h3>
        <h3>Tahun Pelajaran 2021/2022</h3>
    </div>
    <table class="header-data">
        <tbody>
            <tr>
                <td>Nama Sekolah</td>
                <td>:</td>
                <td>SMK Muhammadiyah Karangmoojo</td>
                <td>Kelas</td>
                <td>:</td>
                <td>X TKRO</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td width="420px">Jl. Karangmoojo - Ponjong KM 0.5, Karangmojo</td>
                <td>Semester</td>
                <td>:</td>
                <td>1 (Gasal)</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>
                    <?php
                    $nama = $this->db->get_where('tbl_siswa',['nis' => $nis])->row_array();
                    echo $nama['nama'];
                    ?>
                </td>
                <td>Tahun Pelajaran</td>
                <td>:</td>
                <td>2021/2022</td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td><?= $nis ?></td>
            </tr>
        </tbody>
    </table>
    <div class="konten">
        <h4>A. Nilai Akademik</h4>
        <table border="1" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th width="50%">Mata Pelajaran</th>
                    <th>Pengetahuan</th>
                    <th>Keterampilan</th>
                    <th>Nilai Akhir</th>
                    <th>Predikat</th>
                </tr>
                <tr>
                    <th colspan="6" style="text-align: left;">Kelompok A (Muatan Nasional)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Pendidikan Agama dan Budi Pekerti</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>C</td>
                </tr>
                <?php foreach ($pai as $p) : ?>
                    <?php
                    $nilai = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=>8, 'id_mapel' => $p['id_mapel']])->row_array();
                    $nilai_akhir = ($nilai['nilai_p'] + $nilai['nilai_k'])/2;
                    $mapel = $this->db->get_where('mapel',['kode_mapel'=>$p['id_mapel'],'id_kelompok'=>8])->row_array();
                    ?>
                <tr>
                    <td></td>
                    <td>- <?=  $mapel['mapel'] ?></td>
                    <td align="center">
                        <?= $nilai['nilai_p']?>
                    </td>
                    <td align="center">
                    <?= $nilai['nilai_k']?>
                    </td>
                    <td align="center"><?= $nilai_akhir ?></td>
                    <td align="center">
                        <?php 
                        if($nilai_akhir >= 95) {
                            echo "A+";
                        } else if($nilai_akhir <= 95 && $nilai_akhir > 90 ){
                            echo "A";
                        } else if($nilai_akhir <= 90 && $nilai_akhir > 85){
                            echo "A-";
                        } else if($nilai_akhir <= 85 && $nilai_akhir > 80){
                            echo "B+";
                        } else if($nilai_akhir <= 80 && $nilai_akhir > 75){
                            echo "B";
                        } else if($nilai_akhir >= 70 && $nilai_akhir <= 75){
                            echo "B-";
                        } else {
                            echo "C";
                        }
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php $i = 2; ?>
                <?php foreach ($nasional as $d) : ?>
                    <?php
                    $nilai = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=>1, 'id_mapel' => $d['id_mapel'] ])->row_array();
                    $nilai_akhir = ($nilai['nilai_p'] + $nilai['nilai_k'])/2;
                    $mapel = $this->db->get_where('mapel',['kode_mapel'=>$d['id_mapel'],'id_kelompok'=>1])->row_array();
                    ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?=  $mapel['mapel'] ?></td>
                    <td align="center">
                        <?= $nilai['nilai_p']?>
                    </td>
                    <td align="center">
                    <?= $nilai['nilai_k']?>
                    </td>
                    <td align="center"><?= $nilai_akhir ?></td>
                    <td align="center">
                        <?php 
                        if($nilai_akhir >= 95) {
                            echo "A+";
                        } else if($nilai_akhir <= 95 && $nilai_akhir > 90 ){
                            echo "A";
                        } else if($nilai_akhir <= 90 && $nilai_akhir > 85){
                            echo "A-";
                        } else if($nilai_akhir <= 85 && $nilai_akhir > 80){
                            echo "B+";
                        } else if($nilai_akhir <= 80 && $nilai_akhir > 75){
                            echo "B";
                        } else if($nilai_akhir >= 70 && $nilai_akhir <= 75){
                            echo "B-";
                        } else {
                            echo "C";
                        }
                        ?>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
                <tr>
                    <th colspan="6" style="text-align: left;">Kelompok B (Muatan Kewilayahan)</th>
                </tr>
                <?php $i =1; ?>
                <?php foreach ($wilayah as $d) : ?>
                    <?php
                    $nilai = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=>2, 'id_mapel' => $d['id_mapel']])->row_array();
                    $nilai_akhir = ($nilai['nilai_p'] + $nilai['nilai_k'])/2;
                    $mapel = $this->db->get_where('mapel',['kode_mapel'=>$d['id_mapel'],'id_kelompok'=>2])->row_array();
                    ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?=  $mapel['mapel'] ?></td>
                    <td align="center">
                        <?= $nilai['nilai_p']?>
                    </td>
                    <td align="center">
                    <?= $nilai['nilai_k']?>
                    </td>
                    <td align="center"><?= $nilai_akhir ?></td>
                    <td align="center">
                        <?php 
                        if($nilai_akhir >= 95) {
                            echo "A+";
                        } else if($nilai_akhir <= 95 && $nilai_akhir > 90 ){
                            echo "A";
                        } else if($nilai_akhir <= 90 && $nilai_akhir > 85){
                            echo "A-";
                        } else if($nilai_akhir <= 85 && $nilai_akhir > 80){
                            echo "B+";
                        } else if($nilai_akhir <= 80 && $nilai_akhir > 75){
                            echo "B";
                        } else if($nilai_akhir >= 70 && $nilai_akhir <= 75){
                            echo "B-";
                        } else {
                            echo "C";
                        }
                        ?>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
                <tr>
                    <th colspan="6" style="text-align: left;">C1. Dasar Bidang Keahlian</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Fisika</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>C</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Kimia</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>C</td>
                </tr>
                <tr>
                    <th colspan="6" style="text-align: left;">C2. Dasar Program Keahlian</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Gambar Teknik Otomotif</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>C</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Teknologi Dasar Otomotif</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>C</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Pekerjaan dasar otomotif</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>C</td>
                </tr>
                <tr>
                    <th colspan="6" style="text-align: left;">C3. Kompetensi Keahlian</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="6" style="text-align: left;">Kelompok D(Muatan Lokal)</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Bahasa Jawa</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>C</td>
                </tr>
                <tr>
                    <th colspan="6" style="text-align: left;">Kelompok E (Ciri Khusus)</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Bahasa Arab</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>C</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Kemuhammadiyahan</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>C</td>
                </tr>
            </tbody>
        </table>
        <div class="bottom">
            <table>
                <tbody>
                    <tr>
                        <td width="30%">Wali Murid</td>
                        <td width="40%">Mengetahui, <br> Kepala Sekolah</td>
                        <td width="30%">Gunungkidul, 25 Oktober 2021 <br> Wali Kelas</td>
                    </tr>
                    <tr>
                        <td height="50px"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.........................</td>
                        <td>Munawar, S.Pd.I<br>NBM. 1 076 230</td>
                        <td>
                            <?php
                            $result = $this->db->get_where('tbl_siswa',['nis'=>$nis])->row_array();
                            $wali = $this->db->get_where('tbl_wali_kelas', ['id_kelas'=> $result['kelas']])->row_array(); 
                            echo $wali['name'];
                            ?>
                        <br>NBM. <?= $wali['nbm']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>