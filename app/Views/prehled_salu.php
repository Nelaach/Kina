<?php $db = \Config\Database::connect(); 

?>

<?php
$query   = $db->query('SELECT * from sal');
$results = $query->getResultArray();
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Název</th>
      <th scope="col">Kapacita</th>
      <th scope="col">3D</th>
      <th scope="col">Prostorový zvuk</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($results as $row) { ?>
    <?php $ids = $row['idSal']; ?>
<tr>
<td><?php echo $row['idSal']; ?></td>
<td><?php echo $row['nazev']; ?></td>
<td><?php echo $row['kapacita']; ?></td>
<td><?php echo $row['3D']; ?></td>
<td><?php echo $row['prostorovyZvuk']; ?></td>
<td><a href="<?php echo base_url('Users/smazat_sal/' . $row['idSal']) ?>">Smazat</a></td>
</tr>
<?php  } ?>
</tbody>
</table>
</div>
<div>&nbsp&nbsp </div>
<div>&nbsp&nbsp </div>
<div>&nbsp&nbsp </div>