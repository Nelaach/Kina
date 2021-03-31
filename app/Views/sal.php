<!DOCTYPE html>
<html>
  <head>
    <title>Film</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <?php $db = \Config\Database::connect(); ?>

    <style>
      html, body {
      height: 100%;
      }
      body, input, select { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 16px;
      color: #eee;
      }
      h1, h3 {
      font-weight: 400;
      }
      h1 {
      font-size: 32px;
      }
      h3 {
      color: #1c87c9;
      }
      .main-block, .info {
      display: flex;
      flex-direction: column;
      }
      .main-block {
      justify-content: center;
      align-items: center;
      width: auto; 
      min-height: auto;
      background: url("/uploads/media/default/0001/01/e7a97bd9b2d25886cc7b9115de83b6b28b73b90b.jpeg") no-repeat center;
      background-size: cover;
      }
      form {
      width: auto; 
      padding: 80px;
      margin-bottom: 200px;
      background: grey;
      }
      input, select {
      padding: 5px;
      margin-bottom: 20px;
      background: transparent;
      border: none;
      }
      input::placeholder {
      color: #eee;
      }
      option {
      background: black; 
      border: none;
      }
      .metod {
      display: flex; 
      }
      input[type=radio] {
      display: none;
      }
      label.radio {
      position: relative;
      display: inline-block;
      margin-right: 20px;
      text-indent: 32px;
      cursor: pointer;
      }
      label.radio:before {
      content: "";
      position: absolute;
      top: -1px;
      left: 0;
      width: 17px;
      height: 17px;
      border-radius: 50%;
      border: 2px solid #1c87c9;
      }
      label.radio:after {
      content: "";
      position: absolute;
      width: 8px;
      height: 4px;
      top: 5px;
      left: 5px;
      border-bottom: 3px solid #1c87c9;
      border-left: 3px solid #1c87c9;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      button {
      display: block;
      width: 200px;
      padding: 10px;
      margin: 20px auto 0;
      border: none;
      border-radius: 5px; 
      background: #1c87c9; 
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      }
      button:hover {
      background: #095484;
      }
      @media (min-width: 568px) {
      .info {
      flex-flow: row wrap;
      justify-content: space-between;
      }
      input {
      width: 46%;
      }
      input.fname {
      width: 100%;
      }

    </style>

  </head>
  <body>
    <div class="main-block">
      <h1>Nový sál</h1>
	  <form method="post" action="<?php echo base_url('/Users/novySal') ?>">
        <div class="info">
        <div class="row">
        <div class="col-12">
          <input type="text" name="nazev" required="vyžadováno" placeholder="Název">
          </div>
          <div class="col-12">
          <input type="number" name="kapacita" required="vyžadováno" placeholder="Kapacita">
          </div>
<div class="col-12">
<div> 3D: </div>
          <select class="form-control" name="3D" id="3D">
         <option value="1"> Ano </option>
         <option value="0"> Ne </option>
          </select>
          </div>

          <div class="col-12">
          <div> Prostorový zvuk: </div>
          <select class="form-control" name="prostorovyZvuk" id="prostorovyZvuk">
         <option value="1"> Ano </option>
         <option value="0"> Ne </option>
          </select>
</div></div>

<div>&nbsp&nbsp </div>
<div>&nbsp&nbsp </div>
<div>&nbsp&nbsp </div>
        </div>
        <button type="submit" class="button">Odeslat</button>
      </form>
    </div>
  </body>
</html>
