</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0-rc
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url(); ?>/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url(); ?>/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url(); ?>/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url(); ?>/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url(); ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>/assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url(); ?>/assets/dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $('#example3').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<script>
    $(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
        // Kita sembunyikan dulu untuk loadingnya
        $("#loading").hide();

        $("#kelas").change(function() { // Ketika user mengganti atau memilih data kelas
            $("#mapel").hide(); // Sembunyikan dulu combobox kota nya
            $("#loading").show(); // Tampilkan loadingnya

            $.ajax({
                type: "GET", // Method pengiriman data bisa dengan GET atau POST
                url: "<?php echo base_url("home/listMapel"); ?>", // Isi dengan url/path file php yang dituju
                data: {
                    kelas: $("#kelas").val()
                }, // data yang akan dikirim ke file yang dituju
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) { // Ketika proses pengiriman berhasil
                    $("#loading").hide(); // Sembunyikan loadingnya
                    // set isi dari combobox kota
                    // lalu munculkan kembali combobox kotanya
                    $("#mapel").html(response.list_mapel).show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });
    });
</script>
</body>

</html>