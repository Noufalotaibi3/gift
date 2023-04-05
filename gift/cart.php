<?php
session_start();
include 'config.php';
include 'addcart.php';
if(!isset($_SESSION['cart'])){
    header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <title><?php echo $website; ?> - Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  	<div class="wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6 d-flex align-items-center">
						
					</div>
					<div class="col-md-6 d-flex justify-content-md-end">
						<div class="social-media mr-4">
			    		<p class="mb-0 d-flex">
			    			
			    			<a href="" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
			    			<a href="" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
			    		
			    		</p>
		        </div>
                <div class="reg">
                    <?php
                    if (isset($_SESSION['username']) && $_SESSION['username'] != "" ) {
                        ?>
		        	<p class="mb-0"><span class="welcome"> Welcome <?php echo $_SESSION['username']; ?></span> <a href="logout.php">Log Out</a></p>
                    <?php
                    }else{
                        ?>
                        <p class="mb-0"><a href="register.php">Sign Up</a> <a href="login.php">Log In</a></p>
                        <?php
                    }
                    
                    ?>
					
		        </div>
					</div>
				</div>
			</div>
		</div>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Your gift<span> store</span></a>
	      <div class="order-lg-last btn-group">
          <a href="cart.php" class="btn-cart dropdown-toggle dropdown-toggle-split">
          	<span class="flaticon-shopping-bag"></span>
              <div class="d-flex justify-content-center align-items-center"><small>
              <?php
                            if(isset($_SESSION['cart'])){
                                $cartsum = 0;
                                foreach($_SESSION['cart'] as $key => $value){
                                  $cartsum += $value['quantity'];
                                }
                              
                                echo $cartsum;
                }else{
                    echo 0;
                }
            ?>
                </small></div>
            </a>
          </div>
  
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="oi oi-menu"></span> Menu
            </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Occasions</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <?php
                    $sql = "SELECT * FROM categories";
                    $result = $pdo->prepare($sql);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                ?>
				<a class="dropdown-item" href="<?php echo $row['url'] . $row['id'] ?>"><?php echo $row['cat_name']?></a>
                <?php } ?>


              </div>
            </li>
	         
	          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>    
    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/nina-mercado-_qN6tmGjmtg-unsplash.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-5 text-center">
          	<p class="breadcrumbs mb-0"><span class="mr-2"><a href="home.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Cart <i class="fa fa-chevron-right"></i></span></p>
            <h2 class="mb-0 bread">My Cart</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="table-wrap">
						<table class="table">
						  <thead class="thead-primary">
						    <tr>
						    	<th>&nbsp;</th>
						    	<th>&nbsp;</th>
						    	<th>Product</th>
						      <th>Price</th>
						      <th>Quantity</th>
						      <th>total</th>
						      <th>&nbsp;</th>
						    </tr>
						  </thead>
						  <tbody>
						  <?php
        $totalAll = 0;
      foreach($_SESSION['cart'] as $key => $value){ ?>
						    <tr class="alert" role="alert">
						    	<td>
						    		<label class="checkbox-wrap checkbox-primary">
										  <input type="checkbox" checked>
										  <span class="checkmark"></span>
										</label>
						    	</td>
						    	<td>
						    		<div class="img" style="background-image: url(<?php echo $value['image'] ?>); width: 70px;"></div>
						    	</td>
						      <td>
						      	<div class="email">
						      		<span><?php echo $value['name'] ?></span>
						      		<span></span>
						      	</div>
						      </td>
						      <td><?php echo $value['price'] ?> SR</td>
						      <td class="quantity">
					        	<div class="input-group">
				             	<input type="text" name="quantity" class="quantity form-control input-number" value="<?php echo $value['quantity'] ?>" min="1" max="100">
				          	</div>
							  <?php 
							  $total = $value['price'] * $value['quantity'];
							  ?>
				          </td>
				          <td><?php echo $total;
						  $totalAll += $total;
						  $_SESSION['totalall'] = $totalAll;?> SR</td>
						      <td>
								<a href="remove_cart.php?action=remove&id=<?php echo $value['id']; ?>">
									<button type="button" class="close">
									<span aria-hidden="true"><i class="fa fa-close"></i></span>
									</button>
								</a>
				        	</td>
						    </tr>
	  <?php } ?>
						     
						    
				         
						    
				         
						  </tbody>
						  <tfoot>
							  <tr>
								  <td colspan="6" style="text-align:right;">
									  Clear All
								  </td>
								  <td>
								<a href="remove_cart.php?action=clearall">
									<button type="button" class="close">
									<span aria-hidden="true"><i class="fa fa-close"></i></span>
									</button>
								</a>
				        	</td>

							  </tr>
						  </tfoot>
						</table>
					</div>
    		</div>
    		<div class="row justify-content-end">
    			<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Cart Totals</h3>
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<span><?php echo $totalAll; ?> SR</span>
    					</p>
    				</div>
					<form action="cart_to_db.php" method="post">
					<?php foreach($_SESSION['cart'] as $key => $value){ ?>
							<input type="hidden" name="item_id" value="<?php echo $value['id'];?>">
							<input type="hidden" name="item_name" value="<?php echo $value['name']; ?>">
							<input type="hidden" name="price" value="<?php echo $value['price']; ?>">
							<input type="hidden" name="quantity" value="<?php echo $value['quantity']; ?>">
							<?php $total = $value['price'] * $value['quantity'];?>
							<input type="hidden" name="total" value="<?php echo $total; ?>">
							<input type="hidden" name="user" value="$_SESSION['id']">
							

					<?php 
					            $item_id = $value['id'];
								$item_name = $value['name'];
								$price = $value['price'];
								$quantity = $value['quantity'];
								$userid = $_SESSION['id'];
					}
					?>
					    					<p class="text-center"><button type="submit" name="submit" class="btn btn-primary py-3 px-4">Proceed to Checkout</button></p>
					</form>
    			</div>
    		</div>
    	</div>
    </section>
	<?php
	    if(isset($_POST['submit'])){
			foreach($_SESSION['cart'] as $key => $value){ ?>

				<input type="hidden" name="item_id" value="<?php echo $value['id'];?>">
				<input type="hidden" name="item_name" value="<?php echo $value['name']; ?>">
				<input type="hidden" name="price" value="<?php echo $value['price']; ?>">
				<input type="hidden" name="quantity" value="<?php echo $value['quantity']; ?>">
				<?php $total = $value['price'] * $value['quantity'];?>
				<input type="hidden" name="total" value="<?php echo $total; ?>">
				<input type="hidden" name="user" value="$_SESSION['id']">
				<?php
				$item_id = $value['id'];
				$item_name = $value['name'];
				$price = $value['price'];
				$quantity = $value['quantity'];
				$userid = $_SESSION['id'];
				$sql = "INSERT INTO cart (item_id, item_name, price, quantity, total, userid)
				VALUES ('$item_id', '$item_name', '$price', '$quantity', '$total', '$userid')";
				$pdo->query($sql);
			}
				if(isset($_POST['submit'])){
				$sql = "INSERT INTO orders (user_id)
				VALUES ('$userid')";
				$pdo->query($sql);
				if(isset($_POST['submit'])){
					// $d = date("Y-m-d H:i:s");
					$sql = "SELECT MAX(id) FROM orders;";
					$stmt = $pdo->prepare($sql);
					$stmt->execute();
					$result = $stmt->fetch(PDO::FETCH_ASSOC);
					$maxid = $result["MAX(id)"];
					if(isset($result["MAX(id)"])){
						foreach($_SESSION['cart'] as $key => $value){ ?>
							<input type="hidden" name="item_id" value="<?php echo $value['id'];?>">
							<input type="hidden" name="item_name" value="<?php echo $value['name']; ?>">
							<input type="hidden" name="price" value="<?php echo $value['price']; ?>">
							<input type="hidden" name="quantity" value="<?php echo $value['quantity']; ?>">
							<?php $total = $value['price'] * $value['quantity'];?>
							<input type="hidden" name="total" value="<?php echo $total; ?>">
							<input type="hidden" name="user" value="$_SESSION['id']">
							<?php
							$item_id = $value['id'];
							$item_name = $value['name'];
							$order_id = $maxid;
							$price = $value['price'];
							$quantity = $value['quantity'];
							$sql = "INSERT INTO order_items (item_id, item_name, order_id, price, quantity, total)
							VALUES ('$item_id', '$item_name', '$order_id', '$price', '$quantity', '$total')";
							$pdo->query($sql);
							unset($_SESSION['cart']);
						}
	
					}
	
					}
	
	
				}
	
		}
		if(isset($_POST['submit'])){
			header('location:checkout.php');
		}
	
	
	
		?>
	
	
	?>

   
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>