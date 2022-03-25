<!-- Main content -->
<div class="container mt-3">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Ujian Susulan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" style="margin-bottom:5px" action="" method="get">
                            <select class="custom-select rounded-0" name="kategori" id="kategori">
                                <option value="">Pilih Jenis Ujian</option>
                                <?php foreach ($kategori as $k) : ?>
                                    <option value="<?= $k['id']; ?>"><?= $k['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <select class="custom-select rounded-0" name="tp" id="tp">
                                <option value="">Pilih Tahun Pelajaran</option>
                                <?php foreach ($tp as $t) : ?>
                                    <option value="<?= $t['tp']; ?>"><?= $t['tp']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <select class="custom-select rounded-0" name="kelas" id="kelas">
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($kelas as $k) : ?>
                                    <option value="<?= $k['id']; ?>"><?= $k['kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <select class="custom-select rounded-0" name="mapel" id="mapel">
                                <option value="">Pilih Mata Pelajaran</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-3">INPUT</button>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>