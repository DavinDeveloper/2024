    <!--            <footer class="footer">-->
				<!--	<div class="container-fluid">-->
				<!--		<div class="copyright ml-auto">-->
				<!--			Copyright <? echo date(Y); ?>, made with <i class="la la-heart heart text-danger"></i> by <a href="<? echo cfg(url); ?>"><? echo cfg(nama); ?></a>-->
				<!--		</div>				-->
				<!--	</div>-->
				<!--</footer>-->
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">									
					<p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
					<p>
						<b>We'll let you know when it's done</b></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="<? echo cfg(url); ?>dashboard/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/js/core/popper.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/js/core/bootstrap.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/js/plugin/chartist/chartist.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<!--<script src="<? echo cfg(url); ?>dashboard/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>-->
<script src="<? echo cfg(url); ?>dashboard/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/js/ready.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/js/demo.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/table/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/table/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/table/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/table/Buttons-1.5.6/js/buttons.bootstrap4.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/table/JSZip-2.5.0/jszip.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/table/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/table/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/table/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/table/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script src="<? echo cfg(url); ?>dashboard/assets/table/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
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
</html>