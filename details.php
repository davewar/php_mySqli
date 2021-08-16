<?php 

//connect to db
include('config/db_conn.php');



if(isset($_POST['delete'])){

        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
	

        // create sql
        $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
		}




}

//check id param

 if(isset($_GET['id'])){


        $id = mysqli_real_escape_string($conn, $_GET['id']);
	

        // create sql
        $sql = "SELECT * FROM pizzas WHERE id= $id";

        // get the query rs
        $result = mysqli_query($conn, $sql);

        // fetch 1 row 
        $pizza = mysqli_fetch_assoc($result);

        // clear memory 
        mysqli_free_result($result);

        // close conn
        mysqli_close($conn);
        // print_r($pizza);


 }


?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

            <div class="container center">
                    <?php if($pizza): ?>
                        <h4><?php echo $pizza['title']; ?></h4>
                        <p>Created by <?php echo $pizza['email']; ?></p>
                        <p><?php echo date($pizza['created_at']); ?></p>
                        <h5>Ingredients:</h5>
                        <p><?php echo $pizza['ingredients']; ?></p>


                         <!-- delete    -->
                         <form action="details.php" method="POST">
                             <input type="hidden" value="<?php echo $pizza['id'] ?>" name="id_to_delete">
                             <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">



                         </form>


                    <?php else: ?>
                        <h5>No such pizza exists.</h5>
                    <?php endif ?>
	        </div>


<?php include('templates/footer.php'); ?>


</html>