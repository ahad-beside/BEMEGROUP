 
 <!-- USE FOR LOAD TIME -->
 <script src="../dist/js/date_time.js"></script>       
 <footer class="main-footer" style="text-align:center">
        <strong>Copyright &copy; <?php echo date('Y');?> <a href="">Sales and Inventory with Credit Management System</a>.</strong> All rights reserved.
        <!--<b><span id="date_time" class="pull-right"></span></b>
        <!--<script type="text/javascript">window.onload = date_time('date_time');</script>-->
         <b><span id="tick2" class="pull-right"></span>&nbsp;|</b>
         <?php
            $date = new DateTime();
            echo $date->format('l, F jS, Y');
         ?>
 </footer>
 
