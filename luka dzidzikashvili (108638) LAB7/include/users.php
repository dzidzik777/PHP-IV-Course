<?php
	
	require_once 'dbconfig.php';

	


	if(isset($_POST['btnsave']))
	{
		$Name = $_POST['Name'];
		$Lastname = $_POST['Lastname'];
		$Age = $_POST['Age'];
		$BithDay = $_POST['BithDay'];
		$Reg_Date = $_POST['Reg_Date'];
		$Password = $_POST['Password'];
		$Gender = $_POST['Gender'];
		
		
		
		if(!isset($errMSG))
		{

			$stmt = $DB_con->prepare('INSERT INTO users(Name, Lastname, Age, BithDay, Reg_Date, Password, Gender)
			VALUES(:name, :lastName, :age, :BithDay, :reg_date, :password, :gender)');
			$stmt->bindParam(':name',$Name);
			$stmt->bindParam(':lastName',$Lastname);
			$stmt->bindParam(':age',$Age);
			$stmt->bindParam(':BithDay',$BithDay);
			$stmt->bindParam(':reg_date',$Reg_Date);
			$stmt->bindParam(':password',$Password);
			$stmt->bindParam(':gender',$Gender);

			
			if($stmt->execute())
			{
				$successMSG = "მომხმარებელი წარმატებით დაემატა...";
				header("refresh:5; /?do=users");
			}
			else
			{
				$errMSG = "დაფიქსირდა შეცდომა მომხმარებლის დამატებისას...";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head> 
<title> LUKA - მომხმარებლის დამატება </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php include ('template/css.php'); ?>
</head>


<body>



<div class="container" style="margin-top: 20px;">

<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            	<strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?>   

<form id="form1" method="post" enctype="multipart/form-data">


		<div class="form-group">
        <input type="text"required autocomplete="off" name="Name" class="form-control" id="Name" placeholder="სახელი">
        </div>

		<div class="form-group">
        <input type="text"required autocomplete="off" name="Lastname" class="form-control" id="Lastname" placeholder="გვარი">
        </div>

        <div class="form-group">
        <input type="text"required autocomplete="off" name="Age" class="form-control" id="Age" placeholder="ასაკი">
        </div>

		<div class="form-group">
        <input type="date"required autocomplete="off" name="BithDay" class="form-control" id="BithDay" placeholder="დაბადების თარიღი">
        </div>

		
		<div class="form-group">
        <input type="date"required autocomplete="off" name="Reg_Date" class="form-control" id="Reg_Date" placeholder="რეგისტრაციის დრო">
        </div>

		<div class="form-group">
        <input type="text"required autocomplete="off" name="Password" class="form-control" id="Password" placeholder="პაროლი">
        </div>

        <div class="form-group">
        <input type="text"required autocomplete="off" name="Gender" class="form-control" id="Gender" placeholder="სქესი">
        </div>



             
		   <div class="form-group">
			<button class="btn btn-success" type="submit" name="btnsave" id="submit" value="დამატება"/>დამატება</button> 
             </div>                  

         </form> 





<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">სახელი</th>
      <th scope="col">გვარი</th>
      <th scope="col">ასაკი</th>
      <th scope="col">დაბადების თარიღი</th>
      <th scope="col">რეგისტრაციის დრო</th>
      <th scope="col">პაროლი</th>
      <th scope="col">სქესი</th>
    </tr>
  </thead>
  <tbody>

  <?php
	$stmt2 = $DB_con->prepare('SELECT * FROM users ORDER BY id ASC');
	$stmt2->execute();
	if($stmt2->rowCount() > 0)
		{
		    while($stud=$stmt2->fetch(PDO::FETCH_ASSOC))
		{
		extract($stud);
	?>
    <tr>
      <th scope="row"><?php echo $stud['id']; ?></th>
      <td><?php echo $stud['Name']; ?></td>
      <td><?php echo $stud['Lastname']; ?></td>
      <td><?php echo $stud['Age']; ?></td>
      <td><?php echo $stud['BithDay']; ?></td>
      <td><?php echo $stud['Reg_Date']; ?></td>
      <td><?php echo $stud['Password']; ?></td>
      <td><?php echo $stud['Gender']; ?></td>
    </tr>

	<?php
            }
        }
	?>



  </tbody>
</table>


</div><!-- end container -->

<?php include ('template/javascript.php'); ?>
</body>
</html>                        
