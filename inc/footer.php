               </div>
               <!-- Footer -->
               <footer class="bg-primary mt-2">
                   <div class="text-center pt-4 pb-1">
                       <p class='text-light'> &copy; Copyright Reserved | 2020-
                           <?php echo date('Y'); ?> <span style="color: #EFDF67;">HASAN</span></p>
                   </div>
               </footer>
               <!-- Footer -->
               </div>
               </div>

               <!-- Scroll to top -->
               <a class="scroll-to-top rounded" href="#page-top">
                   <i class="fas fa-angle-up"></i>
               </a>
               <!-- All js files-->
               <script src="js/jquery.min.js"></script>
               <!-- Datatables js files & sortable js file -->
               <script src="js/jquery.ui.sortable.min.js"></script>
               <script src="js/jquery.dataTables.min.js"></script>
               <!-- Boostarp bundel js OR Proper js file  -->
               <script src="js/bootstrap.bundle.min.js"></script>
               <script src="js/admin.min.js"></script>
               <!-- cunterup js file -->
               <script src="js/jquery.counterup.min.js"></script>
               <script src="js/jquery.waypoints.min.js"></script>
               <!-- custom js  -->
               <script type="text/javascript">
                   //counter count script
                   $('.c_number').counterUp({
                       delay: 10,
                       time: 1000
                   });

                   $(document).ready(function() {
                       // sortable script
                       $('#sort_product').DataTable();
                   });
               </script>
               </body>

               </html>