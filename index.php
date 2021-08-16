<?php


	include('config/db_conn.php');
  
	// write query for all pizzas
	$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql);

	// fetch the resulting rows as an array
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// free the $result from memory 
	mysqli_free_result($result);

	// close connection
	mysqli_close($conn);

	// print_r($pizzas);
	// print_r(explode(",",$pizzas[0]['ingredients']))



?>






<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>



	<h4 class="center grey-text">Pizzas!</h4>

	<div class="container">
		<div class="row">

			<?php foreach($pizzas as $pizza): ?>

				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
							<!-- <div><?php echo htmlspecialchars($pizza['ingredients']); ?></div> -->

								<ul>

									<?php foreach(explode(",",$pizza['ingredients']) as $ing ):      ?>
										<li><?php echo htmlspecialchars($ing) ?></li>

									<?php endforeach; ?>	
								</ul>

						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="details.php?id=<?php echo $pizza['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

			<?php   if(count($pizzas) >=2 ): ?>
						<p>There are 2 or more pizzaa</p>
			<?php 	else: ?>
							<p>There are less than 2 pizzas</p>
			<?php 	endif; ?>


		</div>
	</div>





<?php include('templates/footer.php'); ?>
    


</body>
</html>
