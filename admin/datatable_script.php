	<!-- This is over_all.php script -->
	<script type="text/javascript"src="js_new/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript"src="js_new/highcharts.js"></script>
	<script type="text/javascript"src="js_new/exporting.js"></script>
        
	
	<script src="js_new/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="js_new/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="js_new/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="css_new/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="css_new/iCheck/icheck.min.js"></script>
    
    
    <!-- Datatables -->
    <script src="js_new/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="js_new/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="js_new/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="js_new/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="js_new/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="js_new/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="js_new/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="js_new/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="js_new/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="js_new/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="js_new/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="js_new/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="js_new/jszip/dist/jszip.min.js"></script>
    <script src="js_new/pdfmake/build/pdfmake.min.js"></script>
    <script src="js_new/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    
    <script>
	function show2(){
		if (!document.all&&!document.getElementById)
		return
		thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
		var Digital=new Date()
		var hours=Digital.getHours()
		var minutes=Digital.getMinutes()
		var seconds=Digital.getSeconds()
		var dn="PM"
		if (hours<12)
		dn="AM"
		if (hours>12)
		hours=hours-12
		if (hours==0)
		hours=12
		if (minutes<=9)
		minutes="0"+minutes
		if (seconds<=9)
		seconds="0"+seconds
		var ctime=hours+":"+minutes+":"+seconds+" "+dn
		thelement.innerHTML=ctime
		setTimeout("show2()",1000)
		}
		window.onload=show2
				//-->
</script>