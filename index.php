<!DOCTYPE html>
<html lang="en">
  <head>
    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

    <?php
    session_start();
    include('header.php');
    include('admin/db_connect.php');

	$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach ($query as $key => $value) {
		if(!is_numeric($key))
			$_SESSION['setting_'.$key] = $value;
	}
    ?>

    <style>
    	header.masthead {
      background:linear-gradient(to bottom, rgba(0, 0, 0, 1) 0%, rgb(245 242 240 / 45%) 100%), url(assets/img/<?php echo $_SESSION['setting_cover_img'] ?>);
		  background-repeat: no-repeat;
		  background-size: cover;
      z-index: -1;
		}
    #mainNav{
      background-color: var(--white);
  
    }
    .nav-link {
        color: #ff0000; /* Set the desired color */
    }
    @media (max-width: 600px){
      header.masthead{
           height: 810px;
        }   
    }
    @media only screen and (min-width: 610px) and (max-width: 768px) {
    header.masthead{
           height: 810px;

        }   
    }

    @media only screen and (min-width: 769px) and (max-width: 992px){
    header.masthead{
           height: 650px;
        }   
    }
   
    .logo-container {
    position: fixed;
    height: 50px;
    width: 50px;
    left: 50px;
    border-radius: 50%;
  
}

.logo {
    width: 100%; /* Make the image fill the container */
    height: auto; /* Maintain aspect ratio */
   
}

@media (max-width: 600px){
  .navbar-brand{
    position: relative;
      left: 100px;
  }
  .navbar-toggler{
    position: relative;
  }
  .logo-container{
   position: fixed;
}
.logo-container{
 
  filter: invert(0);
 
}

}
    </style>
    <body id="page-top">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body text-white">
            </div>
      </div>
      
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
             <div class="logo-container ">
                        <img src="logo.png" class="logo"id="bcc">
              </div>
            <div class="container">
            
                    

                <a class="navbar-brand js-scroll-trigger" style="color: black;" href="./"><?php echo $_SESSION['setting_hotel_name'] ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" style="color:black" href="index.php?page=home">Home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" style="color:black" href="index.php?page=list">Rooms</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger"style="color:black"  href="index.php?page=about">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" style="color:black" href="Event/index.php">Event</a></li>
                         <li class="nav-item"><a class="nav-link js-scroll-trigger"  style="color:black"href="Food_and_Drinks/index.php">Foods</a></li>
                    </ul>
                </div>
            </div>
        </nav>
       
        <?php 
        $page = isset($_GET['page']) ?$_GET['page'] : "home";
        include $page.'.php';
        ?>
       

<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  
       



       <?php include('footer.php') ?>
    </body>

    <?php $conn->close() ?>

</html>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    var navbarToggle = document.querySelector('.navbar-toggler');
    var logoContainer = document.querySelector('.logo-container');

    navbarToggle.addEventListener('click', function() {
        // Check if the navbar is collapsed or expanded
        if (logoContainer.style.position === 'fixed') {
            // If navbar is collapsed, make the logo fixed
            logoContainer.style.position = 'absolute';
            logoContainer.style.top = '15px'; // Adjust top position as needed
        } else {
            // If navbar is expanded, make the logo fixed again
            logoContainer.style.position = 'fixed';
            logoContainer.style.top = '15px'; // Adjust top position as needed
        }
    });
});

  
</script>
