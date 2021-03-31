<!DOCTYPE html>
<html>
<title>Vstupenky</title>
<?php $db = \Config\Database::connect(); ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<body>
<div>&nbsp<div>
<div class="row">
<?php 
            $query = $db->query("SELECT * FROM prodeje");
            foreach ($query->getResult() as $row) { ?>
 
  <div class="col-sm-2">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo $row->idProdeje?>&nbsp <?php echo $row->film?> </h5>
        <p class="card-text"><b> Čas: </b> <?php echo $row->cas?> <br>
        <b> Sál: </b> <?php echo $row->sal?>, <b> Sedadlo: </b> <?php echo $row->sedadlo?> <br> 
        <?php echo $row->cena?>,-
        </p>
        
      </div>
    </div>
  </div>
  <?php  } ?>
</div>
                
                  
</body>
</html>
