<style type="text/css">
@page {
        margin-top: 0.5cm;
        margin-bottom: 0.5cm;
        margin-left: 1.0cm;
        margin-right: 1.0cm;
    }
    .page-konten{
        height: 100%;
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
.cap {
    text-transform: capitalize
    }
</style>
<?php
    $data_wali = $this->db->get_where('tbl_wali_kelas',['email'=>$email])->row_array();
    $data = $this->db->get_where('tbl_siswa',['kelas'=>$data_wali['id_kelas']])->result_array();
    // $nilai_akhir = ($nilai['nilai_p'] + $nilai['nilai_k'])/2;
?>
<?php foreach($data as $d): ?>
    <?php 
        $data_siswa = $this->db->get_where('master',['id_siswa'=>$d['nis']])->result_array();
    ?>
<div class="page-konten">
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
                <td>SMK Muhammadiyah Karangmojo</td>
                <td>Kelas</td>
                <td>:</td>
                <td>
                    <?php
                    $kelas = $this->db->get_where('tbl_kelas', ['id'=> $d['kelas']])->row_array(); 
                    echo $kelas['kelas'];
                    ?>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td width="420px">Jl. Karangmojo - Ponjong KM 0.5, Karangmojo</td>
                <td>Semester</td>
                <td>:</td>
                <td>1 (Gasal)</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td class="cap"><?= $d['nama']; ?></td>
                <td>Tahun Pelajaran</td>
                <td>:</td>
                <td>2021/2022</td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td><?= $d['nis'] ?></td>
            </tr>
        </tbody>
    </table>
    <div class="konten">
        <!-- <h4>A. Nilai Akademik</h4> -->
        <table border="1" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th width="45%">Mata Pelajaran</th>
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
                <?php
                $aqidah = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=>8, 'id_mapel' => 1])->row_array(); 
                $fikih = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=>8, 'id_mapel' => 2])->row_array(); 
                $alquran = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=>8, 'id_mapel' => 3])->row_array(); 
                $tarikh = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=>8, 'id_mapel' => 4])->row_array();
                
                $p = ($aqidah['nilai_p'] + $fikih['nilai_p'] + $alquran['nilai_p'] + $tarikh['nilai_p'])/4;
                $k = ($aqidah['nilai_k'] + $fikih['nilai_k'] + $alquran['nilai_k'] + $tarikh['nilai_k'])/4;
                $nilai_akhir = ($p + $k)/2;
                ?>

                <tr>
                    <td>1</td>
                    <td>Pendidikan Agama dan Budi Pekerti</td>
                    <td  align="center"><?= number_format($p, 2); ?></td>
                    <td  align="center"><?= number_format($k, 2); ?></td>
                    <td  align="center"><?= number_format($nilai_akhir, 2); ?></td>
                    <td  align="center">
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
                <?php   $pai = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=> 8])->result_array(); ?>
                <?php foreach ($pai as $p) : ?>
                    <?php
                    $nilai = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=>8, 'id_mapel' => $p['id_mapel']])->row_array();
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
                    <td align="center"><?= number_format($nilai_akhir, 2) ?></td>
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
                <?php $nasional = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=> 1])->result_array(); ?>
                <?php foreach ($nasional as $nas) : ?>
                    <?php
                    $nilai = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=>1, 'id_mapel' => $nas['id_mapel'] ])->row_array();
                    $nilai_akhir = ($nilai['nilai_p'] + $nilai['nilai_k'])/2;
                    $mapel = $this->db->get_where('mapel',['kode_mapel'=>$nas['id_mapel'],'id_kelompok'=>1])->row_array();
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
                    <td align="center"><?= number_format($nilai_akhir, 2) ?></td>
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
                <?php $wilayah = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=> 2])->result_array(); ?>
                <?php $i =1; ?>
                <?php foreach ($wilayah as $wil) : ?>
                    <?php
                    $nilai = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=>2, 'id_mapel' => $wil['id_mapel']])->row_array();
                    $nilai_akhir = ($nilai['nilai_p'] + $nilai['nilai_k'])/2;
                    $mapel = $this->db->get_where('mapel',['kode_mapel'=>$wil['id_mapel'],'id_kelompok'=>2])->row_array();
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
                    <td align="center"><?= number_format($nilai_akhir, 2) ?></td>
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
                <?php $bidang_keahlian = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=> 3])->result_array(); ?>
                <?php $i =1; ?>
                <?php foreach ($bidang_keahlian as $bid) : ?>
                    <?php
                    $nilai = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=>3, 'id_mapel' => $bid['id_mapel']])->row_array();
                    $nilai_akhir = ($nilai['nilai_p'] + $nilai['nilai_k'])/2;
                    $mapel = $this->db->get_where('mapel',['kode_mapel'=>$bid['id_mapel'],'id_kelompok'=>3])->row_array();
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
                    <td align="center"><?= number_format($nilai_akhir, 2) ?></td>
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
                    <th colspan="6" style="text-align: left;">C2. Dasar Program Keahlian</th>
                </tr>
                <?php $program_keahlian = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=> 4])->result_array(); ?>
                <?php $i =1; ?>
                <?php foreach ($program_keahlian as $pro) : ?>
                    <?php
                    $nilai = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=>4, 'id_mapel' => $pro['id_mapel']])->row_array();
                    $nilai_akhir = ($nilai['nilai_p'] + $nilai['nilai_k'])/2;
                    $mapel = $this->db->get_where('mapel',['kode_mapel'=>$pro['id_mapel'],'id_kelompok'=>4])->row_array();
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
                    <td align="center"><?= number_format($nilai_akhir, 2) ?></td>
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
                    <th colspan="6" style="text-align: left;">C3. Kompetensi Keahlian</th>
                </tr>
                <?php $kompetensi_keahlian = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=> 5])->result_array(); ?>
                <?php $i =1; ?>
                <?php foreach ($kompetensi_keahlian as $kom) : ?>
                    <?php
                    $nilai = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=>5, 'id_mapel' => $kom['id_mapel']])->row_array();
                    $nilai_akhir = ($nilai['nilai_p'] + $nilai['nilai_k'])/2;
                    $mapel = $this->db->get_where('mapel',['kode_mapel'=>$kom['id_mapel'],'id_kelompok'=>5])->row_array();
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
                    <td align="center"><?= number_format($nilai_akhir, 2) ?></td>
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
                    <th colspan="6" style="text-align: left;">Kelompok D(Muatan Lokal)</th>
                </tr>
                <?php $lokal = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=> 6])->result_array(); ?>
                <?php $i =1; ?>
                <?php foreach ($lokal as $lok) : ?>
                    <?php
                    $nilai = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=>6, 'id_mapel' => $lok['id_mapel']])->row_array();
                    $nilai_akhir = ($nilai['nilai_p'] + $nilai['nilai_k'])/2;
                    $mapel = $this->db->get_where('mapel',['kode_mapel'=>$lok['id_mapel'],'id_kelompok'=>6])->row_array();
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
                    <td align="center"><?= number_format($nilai_akhir, 2) ?></td>
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
                    <th colspan="6" style="text-align: left;">Kelompok E (Ciri Khusus)</th>
                </tr>
                <?php $khusus = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=> 7])->result_array(); ?>
                <?php $i =1; ?>
                <?php foreach ($khusus as $kus) : ?>
                    <?php
                    $nilai = $this->db->get_where('master',['id_siswa'=>$d['nis'],'id_kelompok'=>7, 'id_mapel' => $kus['id_mapel']])->row_array();
                    $nilai_akhir = ($nilai['nilai_p'] + $nilai['nilai_k'])/2;
                    $mapel = $this->db->get_where('mapel',['kode_mapel'=>$kus['id_mapel'],'id_kelompok'=>7])->row_array();
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
                    <td align="center"><?= number_format($nilai_akhir, 2) ?></td>
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
                        <td><?=$data_wali['name']?>
                        <br>NBM. <?= $data_wali['nbm']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endforeach; ?>