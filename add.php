<?php


//connect to db
include('config/db_conn.php');



$email = "";
$title ="";
$ingredients= "";


$errors = array('email' => "", 'title' => "", 'ingredients' =>""  );



if(isset($_POST['submit'])){

    // echo htmlspecialchars($_POST['email']);
    // echo htmlspecialchars($_POST['title']);
    // echo htmlspecialchars($_POST['ingredients']);

    // check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required <br />';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}

            
		}

		// check title
		if(empty($_POST['title'])){
			$errors['title'] = 'A title is required <br />';
		} else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}

		// check ingredients
		if(empty($_POST['ingredients'])){
			$errors['ingredients'] =  'At least one ingredient is required <br />';
		} else{
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Ingredients must be a comma separated list';
			}
		}

        //if $errors array is "" for all 3 values then will return true.
        if(array_filter($errors)){
                // echo 'errors';


        } else{
            // echo 'all gd'

                //protect data to db
            $email = mysqli_real_escape_string($conn, $_POST['email']);
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

			// create sql
			$sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}



             //redirect method
            // header('location: index.php');


        }






}


?>




<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>


<section class="container grey-text">

<h4 class="center">Add a Pizza</h4>

    <form action="add.php" method="POST" class="white">

        <label for="">Your Email:</label>
        <input type="text" name="email"  value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>

        <label for="">Pizza Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>

        <label for="">Ingredients (comma sep)</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
        <div class="red-text"><?php echo $errors['ingredients']; ?></div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth" id="">
        </div>




    </form>

</section>

<?php include('templates/footer.php'); ?>
    


</body>
</html>
