<html>
<style>
<!th,td,tr
    {
        border-collapse: collapse;
        
        align: center;
        color: #588c6F;
        font-size: 25px;
        text-align: center;
        border: 2px solid black;
    }	>
.nav{
  position: relative;
}
  #left-panel-link {
  position: absolute;
  margin-left: 9.5%;
}
  #right-panel-link {
  position: absolute;
  right: 9.5%;
}

</style>

<head>
	<link rel="stylesheet" href="theme3.css" >  
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Data Spareparts</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<head>
 <h1><center>Daftar Spareparts<center></h1>
</head>

<?php
require_once 'config.php';
?>

    <nav class="nav nav-pills" id = "left-panel-link">
        <a href="index.php" class="nav-item nav-link active">
            <i class="fa fa-home" ></i> Home
        </a>
        &nbsp;&nbsp;

        <a href="insert_own.php" class="nav-item nav-link active">
            <i class="fa fa-pencil-square-o" ></i> Insert
        </a>

    </nav>
    
    <nav class="nav nav-pills" id = "left-panel-link">
        <a href="index.php" class="nav-item nav-link active">
          <i class="fa fa-home" ></i> Home
        </a>&nbsp;&nbsp;

        <a href="insert_own.php" class="nav-item nav-link active">
          <i class="fa fa-pencil-square-o" ></i> Insert
        </a>
    </nav>

<form action="search.php" class="search-box" id = "right-panel-link" method="post">
  <div class="md-form mt-0">
  <form class="dropdown" id="right-panel-link" action="test_filter.php" method="post">
			<select name="dd_opt">
      <option value="id">ID</option>
				<option value="jenis">Jenis</option>
				<option value="merk">Merk</option>
				<option value="tipe">Tipe</option>
				<option value="harga">Harga</option>
			</select>

    <input class="form" type="text" name="search_param" placeholders="Search in list">
    <input type="submit" name="submit" class="btn btn-info" value="Go">
  </div>
  </form>
<br>
<?php

		
?>
<div class="container">
<table class="table table-hover">
<br>
	<thead>
		<tr>
			<th>ID</th>
			<th>Jenis</th>
			<th>Merk</th>
			<th>Tipe</th>
			<th>Harga</th>                         
		 </tr>
	</thead>

  <?php 
  if(isset($_POST['search_param']))
  {
    $search=$_POST['search_param'];
    echo "<b>Results for ".$search."</b>";
  }
    //$select_by = 'jenis';
    $select_by = $_POST["dd_opt"];
    $search=$_POST["search_param"];
    $query = pg_query("select * from spareparts WHERE ".$select_by." LIKE '%".$search."%'")or die(error);

  while ($data = pg_fetch_assoc($query)) {
    ?>
    <tr>
      <td><?php echo $data['id']; ?></td>                  
      <td><?php echo $data['jenis']; ?></td>
      <td><?php echo $data['merk']; ?></td>
      <td><?php echo $data['tipe']; ?></td>
      <td><?php echo "Rp.".$data['harga']; ?></td>              
    </tr>
    <?php               
  }
  ?>
  </table>
</div>

<nav class="nav nav-pills" id = "left-panel-link">
    <a href="view.php" class="nav-item nav-link active">
        <i class="fa fa-arrow-left" ></i> Return to View
    </a>
</nav>
<br></br>
<br>
</html>
