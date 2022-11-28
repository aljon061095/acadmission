   <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
   <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

   <!-- Custom scripts for all pages-->
   <script src="js/sb-admin-2.min.js"></script>

   <!-- Page level plugins -->
   <script src="vendor/chart.js/Chart.min.js"></script>

   <!-- Page level custom scripts -->
   <script src="js/demo/chart-area-demo.js"></script>
   <script src="js/demo/chart-pie-demo.js"></script>

   <script src="vendor/datatables/jquery.dataTables.min.js"></script>
   <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

   <!-- Page level custom scripts -->
   <script src="js/demo/datatables-demo.js"></script>

   <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

   <!--Preloader-->
   <script>
      jQuery(window).on("load", function() {
         $('#preloader').fadeOut(1000);
         $('#wrapper').addClass('show');
      });
   </script>

   <script>
      $(document).ready(function() {
         // Delete 
         $('.delete').click(function() {
            var el = this;

            var deleteId = $(this).data('id');
            var tableName = $(this).data('table-name');

            var confirmalert = confirm("Are you sure you want to delete?");
            if (confirmalert == true) {
               // AJAX Request
               $.ajax({
                  url: 'remove.php',
                  type: 'POST',
                  data: {
                     id: deleteId,
                     tableName: tableName
                  },
                  success: function(response) {
                     if (response == 1) {
                        // Remove row from HTML Table
                        $(el).closest('tr').css('background', 'tomato');
                        $(el).closest('tr').fadeOut(800, function() {
                           $(this).remove();
                        });

                        $('.deleted-message').removeClass('hidden');
                     }

                  }
               });
            }

         });

      });
   </script>