    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Master Tahun Pelajaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Tahun Pelajaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tp as $t) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $t['tp']; ?></td>
                                            <td><span class="badge bg-danger">Edit</span></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Master Kategori</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($kategori as $k) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $k['nama']; ?></td>
                                            <td><span class="badge bg-danger">Edit</span></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Master Kelas</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($kelas as $k) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $k['kelas']; ?></td>
                                            <td><span class="badge bg-danger">Edit</span></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <!-- /.card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Master Mata Pelajaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                        <th>Kelas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($mapel as $m) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $m['mapel']; ?></td>
                                            <td><?= $m['guru']; ?></td>
                                            <td>
                                                <?php
                                                $kls = $this->db->get_where('tbl_kelas', ['id' => $m['id_kelas']])->row_array();
                                                echo $kls['kelas'];
                                                ?>
                                            </td>
                                            <td><span class="badge bg-danger">Edit</span></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <!-- /.card -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->