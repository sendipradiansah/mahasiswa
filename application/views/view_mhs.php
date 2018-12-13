<html>
<head>
    <script src="<?php echo base_url(); ?>assets/jquery-3.3.1.min.js" ></script>

  <script type="text/javascript">
     $(document).ready(function(){
         
         load_data();
         
         function load_data(keyword){
              //var field = $("#field").val();
              $.ajax({
                  method:"GET",
                  url:"<?php echo site_url(); ?>/mahasiswa/tampil",
                  data:{keyword:keyword},
                  success:function(data){
                      $("#tampil").html(data);
                  }
              });
          }
          
              $('#keyword').keyup(function(){
                  var search = $(this).val();
                  if(search != ''){
                      load_data(search);
                  }
                  else{
                      load_data();
                  }
              });
      });
            
  </script>
</head>
<body>
<!-- <form method="GET"> -->
    <label for="">Selamat datang <?php echo $_SESSION['username']?></label><br />
    <input type="text" id="keyword" name="keyword" placeholder="Masukkan kata kunci...">
    <button type="submit">Cari</button>
    <a href="<?php echo site_url(); ?>"><button type="submit">Reset</button></a>
<!-- </form> -->

    <button type="submit"><a href="<?php echo site_url('mahasiswa/tambah')?>">Tambah Data</a></button>
    <button type="submit"><a href="<?php echo site_url('mahasiswa/logout');?>">Logout</a></button>

     <div id="tampil"></div>
 </body>
</html>





