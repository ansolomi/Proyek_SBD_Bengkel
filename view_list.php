<?php
  require('login.php');
  if(isset($_SESSION['login_user']))
 {?>

<html>
<style>

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
.md-form
{
	position: relative;
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
  <a href="home.php" class="nav-item nav-link active">
    <i class="fa fa-home" ></i> Home
  </a>&nbsp;&nbsp;

  <a href="insert_own.php" class="nav-item nav-link active">
    <i class="fa fa-pencil-square-o" ></i> Insert
  </a>
</nav>

<form action="search_list.php" class="search-box" id = "right-panel-link" method="post">
  <div class="form-row">
	  <div class"col">
		  <form class="dropdown" id="right-panel-link" action="test_filter.php" method="post">
					<select class="form-control" name="dd_opt">
            <option value="nama_jenis">Jenis</option>
						<option value="nama_merk">Merk</option>
						<option value="nama_tipe">Tipe</option>
            <option value="harga">Harga</option>
            <option value="stock">Stock</option>
					</select>
		</div>
		&nbsp;&nbsp;
		<div class"col">
			<input class="form-control" type="text" name="search_param" placeholders="Search in list">
		</div>
		&nbsp;&nbsp;

    <div class"col">
			<input type="submit" name="submit" class="btn btn-info" value="Go">
		</div>
	
  </div>
		</form>
</form>

<br>
<br>
<div class="container">
<table class="table table-hover">
<br>
  <thead>
		<tr>
			<th>Jenis</th>
			<th>Merk</th>
			<th>Tipe</th>
      <th>Harga</th>     
      <th>Stock</th>                                           
		 </tr>
	</thead>

  <?php 
  if(isset($_GET['search_param']))
  {
    $search=$_GET['search_param'];
    echo "<b>Results for ".$search."</b>";
  }

  if(isset($_GET['select_by']))
  {
    $search_by=$_GET['select_by'];
    echo "<b>Results for ".$search_by."</b>";
  }
  else{
    $search_by='jenis';
  }
  
  $halaman = 10;
  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
  $search_by = 'jenis';
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result = pg_query("SELECT * FROM complete_list");
  $total = pg_num_rows($result);
  $pages = ceil($total/$halaman);
  $no =$mulai+1;
  if (isset($_GET['search_param']))
  {
    $search=$_GET['search_param'];
      if($select_by == 'stock' OR $select_by == 'harga')
      {
        $query = pg_query("select * from complete_list WHERE ".$select_by." = ".$search."")or die(error); 
      }
      else
      {
        $query = pg_query("select * from complete_list WHERE ".$select_by." LIKE '%".$search."%'")or die(error);
      }
    
  }
  else
  {
  $query = pg_query("select * from complete_list LIMIT $halaman OFFSET $mulai")or die(error);
  }
  while ($data = pg_fetch_assoc($query)) {
    ?>
    <tr>               
      <td><?php echo $data['nama_jenis']; ?></td>
      <td><?php echo $data['nama_merk']; ?></td>
      <td><?php echo $data['nama_tipe']; ?></td>
      <td><?php echo "Rp.".$data['harga']; ?></td>
      <td><?php echo $data['stock']; ?></td>                        
    </tr>
    <?php               
  }
  ?>
  </table>
</div>
      

<div class="footer"><center>
  <?php for ($i=1; $i<=$pages ; $i++){ ?>
  <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>

  <?php } ?>

</div><center>

</html>
  <?php }

  else 
  {
    header("Location: index.php");
  }
