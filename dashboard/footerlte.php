  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    <a href="" class="text-black me-4">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="#" class="text-black me-4">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="https://github.com/najmaa14" class="text-black me-4">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2024 <a href="">Najma Maharani</a>.</strong> All rights reserved.
  </footer>
</div>
</div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../asset/dist/js/adminlte.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.3/js/dataTables.dateTime.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

<script src="../asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../asset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../asset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../asset/plugins/jszip/jszip.min.js"></script>
<script src="../asset/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../asset/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../asset/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../asset/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../asset/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(function() {
		$('#tindakan').select2();
	});
    $(document).ready(function() {
		$('#obatSelect').select2();
	});
    $(document).ready(function() {
		$('#idTindakan').select2();
	});
    $(document).ready( function () {
		$('#pengobatan').DataTable();
	} );
    $(document).ready( function () {
		$('#Ttindakan').DataTable();
	} );
        $(document).ready(function() {
            // Retrieve the table title or ID to use as the filename
            var tableTitle = $('#tableTitle').text().trim() || 'DataTable';

            $("#initabel").DataTable({
                pageLength : 5,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [
                {
                    extend: 'csvHtml5',
                    title: function() { return tableTitle; },
                    exportOptions: {
                        columns: function (idx, data, node) {
                    // Mengabaikan kolom terakhir
                        return idx < $('#initabel').DataTable().columns().nodes().length - 1;
                    }}
                },
                {
                    extend: 'excelHtml5',
                    title: function() { return tableTitle; },
                    exportOptions: {
                        columns: function (idx, data, node) {
                    // Mengabaikan kolom terakhir
                        return idx < $('#initabel').DataTable().columns().nodes().length - 1;
                    }}
                },
                {
                    extend: 'pdfHtml5',
                    title: function() { return tableTitle; },
                    exportOptions: {
                        columns: function (idx, data, node) {
                    // Mengabaikan kolom terakhir
                        return idx < $('#initabel').DataTable().columns().nodes().length - 1;
                    }
                }
                },
                'colvis'
            ]
            
            }).buttons().container().appendTo('#initabel_wrapper .col-md-6:eq(0)');
        });
        $(document).ready(function() {
            // Retrieve the table title or ID to use as the filename
            var tableTitle = $('#tableTitle').text().trim() || 'DataTable';

            $("#initabel2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [
                {
                    extend: 'csvHtml5',
                    title: function() { return tableTitle; },
                    exportOptions: {
                        columns: function (idx, data, node) {
                    // Mengabaikan kolom terakhir
                        return idx < $('#initabel2').DataTable().columns().nodes().length - 1;
                    }}
                },
                {
                    extend: 'excelHtml5',
                    title: function() { return tableTitle; },
                    exportOptions: {
                        columns: function (idx, data, node) {
                    // Mengabaikan kolom terakhir
                        return idx < $('#initabel2').DataTable().columns().nodes().length - 1;
                    }}
                },
                {
                    extend: 'pdfHtml5',
                    title: function() { return tableTitle; },
                    exportOptions: {
                        columns: function (idx, data, node) {
                    // Mengabaikan kolom terakhir
                        return idx < $('#initabel2').DataTable().columns().nodes().length - 1;
                    }
                }
                },
                'colvis'
            ]
            }).buttons().container().appendTo('#initabel2_wrapper .col-md-6:eq(0)');
        });

                // Custom filtering function which will search data in column four between two values
            var tableTitle = $('#tableTitle').text().trim() || 'DataTable';
            let minDate, maxDate;
            
            let tables = new $('#initabel3').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [
                {
                    extend: 'csvHtml5',
                    title: function() { return tableTitle; },
                    exportOptions: {
                        columns: function (idx, data, node) {
                    // Mengabaikan kolom terakhir
                        return idx < $('#initabel3').DataTable().columns().nodes().length - 1;
                    }}
                },
                {
                    extend: 'excelHtml5',
                    title: function() { return tableTitle; },
                    exportOptions: {
                        columns: function (idx, data, node) {
                    // Mengabaikan kolom terakhir
                        return idx < $('#initabel3').DataTable().columns().nodes().length - 1;
                    }}
                },
                {
                    extend: 'pdfHtml5',
                    title: function() { return tableTitle; },
                    exportOptions: {
                        columns: function (idx, data, node) {
                    // Mengabaikan kolom terakhir
                        return idx < $('#initabel3').DataTable().columns().nodes().length - 1;
                    }
                }
                },
                'colvis'
            ]
            }).buttons().container().appendTo('#initabel3_wrapper .col-md-6:eq(0)');
        // });

 
// Custom filtering function which will search data in column four between two values
        DataTable.ext.search.push(function (settings, data, dataIndex) {
            let min = minDate.val();
            let max = maxDate.val();
            let date = new Date(data[1]);
        
            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        });
        
        // Create date inputs
        minDate = new DateTime('#min', {
            format: 'MMMM Do YYYY'
        });
        maxDate = new DateTime('#max', {
            format: 'MMMM Do YYYY'
        });
        
        // DataTables initialisation
        let table = new DataTable('#initabel3');
        
        // Refilter the table
        document.querySelectorAll('#min, #max').forEach((el) => {
            el.addEventListener('change', () => table.draw());
        });
    </script>
</body>
</html>