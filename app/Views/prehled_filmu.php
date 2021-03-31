<?php $db = \Config\Database::connect(); 

?>

<?php
$query   = $db->query('SELECT idFilm, cesky_nazev, originalni_nazev, delka_filmu, typ_filmu, jazyky.nazev as jazyky, zeme.nazev as zeme, zanrfilmu.zanrFilmucol as zanr, promitani.datum as datum FROM film INNER JOIN jazyky ON film.jazyky_idJazyky=jazyky.idJazyky inner join zeme on film.zeme_idZeme = zeme.idZeme inner join zanrfilmu on film.zanrFilmu_idZanrFilmu = zanrfilmu.idZanrFilmu inner join promitani on film.promitani_idPromitani = promitani.idPromitani');
$results = $query->getResultArray();
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Český název</th>
      <th scope="col">Originální název</th>
      <th scope="col">Délka</th>
      <th scope="col">Jazyk</th>
      <th scope="col">Typ filmu</th>

      <th scope="col">Země</th>
      <th scope="col">Žánr</th>
      <th scope="col">Promítání</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($results as $row) { ?>
  <?php $ids = $row['idFilm']; ?>
<tr>
<td><?php echo $row['idFilm']; ?></td>
<td><a href="<?php echo base_url('Users/konkretni/' . $row['idFilm']) ?>"><?php echo $row['cesky_nazev']; ?></td>
<td><?php echo $row['originalni_nazev']; ?></td>
<td><?php echo $row['delka_filmu']; ?></td>
<td><?php echo $row['jazyky']; ?></td>
<td><?php echo $row['typ_filmu']; ?></td>
<td><?php echo $row['zeme']; ?></td>
<td><?php echo $row['zanr']; ?></td>
<td><?php echo $row['datum']; ?></td>
<td><a href="<?php echo base_url('Users/smazat/' . $row['idFilm']) ?>">Smazat</a></td>
</tr>
<?php  } ?>
</tbody>
</table>
</div>
<div>&nbsp&nbsp </div>
<div>&nbsp&nbsp </div>
<div>&nbsp&nbsp </div>
