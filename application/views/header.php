 <script type="text/javascript">

$(document).ready(function(){
    var a = $(".sidebar-menu").find("li").find(".active");
    var b = a.parent("li").parent("li");
    $(".child").append(b.text() + ' > ' + a.text());
  })
    

          
        </script>
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small><?php //echo $subtitle; ?></small>
          </h1>
          <!--<ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active child"><?php //echo $menuName; ?></li>
          </ol>-->
        </section>
