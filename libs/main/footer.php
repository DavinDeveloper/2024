<!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  © Copyright
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  <a href="<? echo cfg(url); ?>" target="_blank" class="footer-link fw-bolder"><? echo cfg(nama); ?></a>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<? echo cfg(url); ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<? echo cfg(url); ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<? echo cfg(url); ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<? echo cfg(url); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<? echo cfg(url); ?>assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<? echo cfg(url); ?>assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<? echo cfg(url); ?>assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<? echo cfg(url); ?>assets/js/dashboards-analytics.js"></script>
    
    <script src="<? echo cfg(url); ?>assets/table/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="<? echo cfg(url); ?>assets/table/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="<? echo cfg(url); ?>assets/table/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="<? echo cfg(url); ?>assets/table/Buttons-1.5.6/js/buttons.bootstrap4.min.js"></script>
    <script src="<? echo cfg(url); ?>assets/table/JSZip-2.5.0/jszip.min.js"></script>
    <script src="<? echo cfg(url); ?>assets/table/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="<? echo cfg(url); ?>assets/table/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="<? echo cfg(url); ?>assets/table/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="<? echo cfg(url); ?>assets/table/Buttons-1.5.6/js/buttons.print.min.js"></script>
    <script src="<? echo cfg(url); ?>assets/table/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#tables').DataTable( {
                buttons: [ 'copy','csv','print', 'excel', 'pdf', 'colvis' ],
                dom: 
                "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu:[
                    [5,10,25,50,100,-1],
                    [5,10,25,50,100,"All"]
                ]
            } );
            table.buttons().container()
                .appendTo( '#table_wrapper .col-md-5:eq(0)' );
        } );
    </script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>