

<?php
$date_in = isset($_POST['date_in']) ? $_POST['date_in'] : date('Y-m-d');
$date_out = isset($_POST['date_out']) ? $_POST['date_out'] : date('Y-m-d', strtotime(date('Y-m-d') . ' + 3 days'));
$adult = isset($_POST['adult']) ? $_POST['adult'] : 1;
$children = isset($_POST['children']) ? $_POST['children'] : 2;
?>

 <!-- Masthead-->
 <head>

 <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
 <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
 <link href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
 
    <link rel="stylesheet" href="styless.css">
 </head>
 <script>
    $(document).ready(function(){
        var minDate = new Date();
        $("#date_in").datepicker({
            showAnim: 'drop',
            numberOfMonths: 1, 
            minDate: minDate,
            dateFormat: 'yy/mm/dd',
            onClose: function (selectedDate){
                $('#date_out').datepicker("option", "minDate", selectedDate);
            }
        });

		$("#date_out").datepicker({
            showAnim: 'drop',
            numberOfMonths: 1,
            minDate: minDate,
            dateFormat: 'yy/mm/dd',
            onClose: function (selectedDate){
                $('#date_in').datepicker("option", "maxDate", selectedDate);
            }
        });

    });

 

 </script>
 	
 <header class="masthead" id="masthead">
            <div class="container h-50">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    
                    <div class="col-lg-10 align-self-end mb-4">
                   
                    	<div class="card" id="filter-book">
                    		<div class="card-body shadow">
                    			<div class="container-fluid">
                    				<form action="index.php?page=list" id="filter" method="POST">
                    					<div class="row">
                    						<div class="col-md-3">
                    							<label for="" class="control-label">Check-in Date</label>
                    							<input type="text" class="form-control" id="date_in" name="date_in" autocomplete="off" required>
                    						</div>
                    						<div class="col-md-3">
                    							<label for=""class="control-label">Check-out Date</label>
                    							<input type="text" class="form-control" id="date_out"name="date_out" autocomplete="off" required>
                    						</div>
                                            <div class="form-group col-md-2">
                                                <label for="" class="control-label">Adult</label>
                                                <select class="custom-select browser-default" name="adult" autocomplete="off">
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                    <option value="4">Four</option>
                                                    <option value="5">Five</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="" class="control-label">Children</label>
                                                <select class="custom-select browser-default" name="children" autocomplete="off">
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                    <option value="4">Four</option>
                                                    <option value="5">Five</option>
                                                </select>
                                            </div>
                    						
                    						<div class="col-md-1">
                    							<br>
                    							<button type="submit" class="btn btn-sm btn-primary offset-md-8 blue-button">Check Availability</button>
                    						</div>

                    					</div>
                    				</form>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                   
                </div>
            </div>
            <div class="content">
                <h1>BCC HOTEL </h1>
                <h1>Experience </h1>
                <h1>Stay </h1>
                <h1>Event & Weddings</h1>
            </div>
        </header>
         
    <div id="counter">
    <section class="counter top">
            <div class="container grid">
                <div class="box">
                    <h1>500</h1>
                    <hr class="hr">
                    <span>CUSTOMER</span>
                </div>
                <div class="box">
                    <h1>100</h1>
                    <hr class="hr">
                    <span>BOOK</span>
                </div>
                <div class="box">
                    <h1>200</h1>
                    <hr class="hr">
                    <span>CHECK OUT</span>
                </div>
                <div class="box">
                    <h1>12</h1>
                    <hr class="hr">
                    <span>ROOMS</span>
                </div>

            </div>
    </section>
	</div>
	<!--<div id="portfolio">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                	<?php 
                	include'admin/db_connect.php';
                	$qry = $conn->query("SELECT * FROM  room_categories order by rand() ");
                	while($row = $qry->fetch_assoc()):
                	?>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="#">
                            <img class="img-fluid" src="assets/img/<?php echo $row['cover_img'] ?>" alt="" />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-30"><?php echo "Php ".number_format($row['price'],2) ?> per day</div>
                                <div class="project-name"><?php echo $row['name'] ?></div>
                            </div>
                        </a>
                    </div>
                	<?php endwhile; ?>

                </div>
            </div>
        </div>
                    -->


                        

                    <?php 
                    
                        $cat = $conn->query("SELECT * FROM room_categories order by id asc");
                        $cat_arr = array();
                        while($row = $cat->fetch_assoc()){
                            $cat_arr[$row['id']] = $row;
                        }

           
            $qry = $conn->query("SELECT distinct(category_id), category_id FROM rooms WHERE id NOT IN (SELECT room_id FROM checked WHERE '$date_in' BETWEEN date(date_in) AND date(date_out) AND '$date_out' BETWEEN date(date_in) AND date(date_out) ) ");
            $counter = 0;
            while($row= $qry->fetch_assoc()):
                $counter++;
            ?>
            <div class="card item-rooms mb-3"  id="room">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5" >
                            <img src="assets/img/<?php echo $cat_arr[$row['category_id']]['cover_img'] ?>" alt="" style="height: 200px; width: 400px" id="room-img">
                        </div>
                        <div class="col-md-5" height="100%" id="by-room">
                            <div class="name-room">
                            <h3><b><?php echo '&#8369;'.number_format($cat_arr[$row['category_id']]['price'],2) ?><span>/day</span></b></h3>
                            <h4><b><?php echo $cat_arr[$row['category_id']]['name'] ?></b></h4>
                            </div>

                     <!--------------------------------------------------------->

                     <?php
                        include("db_connect.php");

                        // Fetch review count from the database
                        $review_count_query = "SELECT review_count FROM rating_star WHERE id = ?";
                        $stmt = $con->prepare($review_count_query);
                        $stmt->bind_param("i", $row['category_id']); // Assuming $row['category_id'] holds the current category ID
                        $stmt->execute();
                        $stmt->bind_result($review_count);
                        $stmt->fetch();
                        $stmt->close();
                        
                        ?>

                        <div class="rating-container" id="rating-container">
                                <p>Rating:</p>
                                <!-- Star Rating -->
                                <div id="star-rating-<?php echo $row['category_id']; ?>" class="star-container">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <i class="fa-solid fa-star fa-1x" data-index="<?php echo $i; ?>" data-category-id="<?php echo $row['category_id']; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <!-- Review Number -->
                                <div class="review">
                                    <p id="review-number-<?php echo $row['category_id']; ?>">review: <?php echo $review_count; ?></p>
                                </div>
                                <hr>
                               
                                <div class="ameni">Free Amenities:
                                    <br>
                                    Shower
                                    <i class="fa-solid fa-shower"></i>
                                    Food
                                    <i class="fa-solid fa-bowl-food"></i>
                                    Wifi
                                    <i class="fa-solid fa-wifi"></i>
                                </div>
                                        
                        </div>
                                        
                        <!-------------------------Rating-------------------->
                        <div class="review-rating">
                                            <div class="container-rating">
                                                <?php
                                                include("db_connect.php");

                                                // Assuming $row['category_id'] holds the current category ID
                                                $stmt = $con->prepare("SELECT star_index_0, star_index_1, star_index_2, star_index_3, star_index_4 FROM rating_star WHERE id = ?");
                                                $stmt->bind_param("i", $row['category_id']);
                                                $stmt->execute();
                                                $stmt->bind_result($star_index_0, $star_index_1, $star_index_2, $star_index_3, $star_index_4);
                                                $stmt->fetch();
                                                $stmt->close();
                                                ?>

                                                <div class="skill-box">
                                                    <span class="title"><div class="number">1</div>&starf;</span>
                                                    <div class="skill-bar">
                                                        <span class="skill-per one-star" style="width: <?php echo $star_index_0; ?>%;">
                                                            <p><?php echo $star_index_0; ?></p> 
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="skill-box">
                                                    <span class="title"><div class="number">2</div>&starf;&starf;</span>
                                                    <div class="skill-bar">
                                                        <span class="skill-per two-star" style="width: <?php echo $star_index_1; ?>%;">
                                                            <p><?php echo $star_index_1; ?></p> 
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="skill-box">
                                                    <span class="title"><div class="number">3</div>&starf;&starf;&starf;</span>
                                                    <div class="skill-bar">
                                                        <span class="skill-per three-star" style="width: <?php echo $star_index_2; ?>%;">
                                                            <p><?php echo $star_index_2; ?></p> 
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="skill-box">
                                                    <span class="title"><div class="number">4</div> &starf;&starf;&starf;&starf;</span>
                                                    <div class="skill-bar">
                                                        <span class="skill-per four-star" style="width: <?php echo $star_index_3; ?>%;">
                                                            <p><?php echo $star_index_3; ?></p> 
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="skill-box">
                                                    <span class="title"><div class="number">5</div> &starf;&starf;&starf;&starf;&starf;</span>
                                                    <div class="skill-bar">
                                                        <span class="skill-per five-star" style="width: <?php echo $star_index_4; ?>%;">
                                                            <p><?php echo $star_index_4; ?></p>  
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
      
                         
                         <!--------------------------------------------------------->
                            
                           
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>







<!----------------- Feedbacking------------------>
                    <?php
                        require_once('notification/function.php');

                            if(isset($_POST['submit'])){
                                $type = $_POST['type'];
                                $uniqueid = $_POST['uniqueid'];

                                postNotification($type, $uniqueid);
                            }
                    ?>
    <div class="fedback">             
        <div class="container-feedback">
            <div class="contact-box">
                <div class="left">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62857.98707199284!2d124.10704906690113!3d10.047837422055823!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a98ae3382f2685%3A0x4b579ac8c3561f19!2sBuenavista%2C%20Bohol!5e0!3m2!1sen!2sph!4v1698834942155!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="right">
                    <h2>CONTACT US</h2>
                    <form action="" method="POST">
                        <input type="text" class="field" placeholder="Your Name" required>
                        <input type="email" class="field" placeholder="Your Email" id="uniqueid" name="uniqueid" required> 
                        <input type="text" class="field" placeholder="Your Phone" required>
                        <textarea class="field area" placeholder="Message" id="type" name="type" required></textarea>
                        <button class="btns" type="submit" name="submit">Send</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
<!--------------------Para sa Arrow------------------------>
    <div class="arrow">
            <div id="progress">
            <span id="progress-value">&#x1F815;</span>
            </div>
    </div>

    <!---- ----------------------- PAra sa footer --------------------------->
   <div class="footer-body">
        <div class="footer-container">
            <div class="footer-row">

                <div class="footer-col">
                      <h4>Customer Care</h4>
                      <ul>
                        <li><a href="">FAQs</a></li>
                        <li><a href="">Terms of Services</a></li>
                        <li><a href="">Privacy Policy</a></li>
                        <li><a href="">Hotline </a></li>
                        <li><a href="">Legalities</a></li>
                      </ul>
                </div>

                <div class="footer-col">
                      <h4>BCC HOTEL</h4>
                      <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">Rooms</a></li>
                        <li><a href="">What's New</a></li>
                        <li><a href="">Menu</a></li>
                        <li><a href="">Event</a></li>
                      </ul>
                </div>

                <div class="footer-col">
                      <h4>About Us</h4>
                      <ul>
                        <li><a href="">Blog</a></li>
                        <li><a href="">SiteMap</a></li>
                        <li><a href="">Page</a></li>
                        <li><a href="">Testimonials</a></li>
                        <li><a href="">Status</a></li>
                      </ul>
                </div>

                <!--<div class="footer-col">
                      <h4>Partners</h4>
                      <ul>
                        <li><a href="">Cangawa College</a></li>
                        <li><a href="">LGU-Buenavista</a></li>
                        <li><a href="">Municipality</a></li>
                        <li><a href="">Dait Buenavista</a></li>
                        <li><a href="">Osyter Farm</a></li>
                      </ul>
                </div>-->

                <div class="footer-col">
                      <h4>News Letters</h4>
                      <form action="">
                          <input type="text" placeholder="Your Name" class="inputName">
                          <input type="text" placeholder="Your Email" class="inputEmail">
                          <input type="submit" value="SEND" class="inputSubmit">
                      </form>
                </div>

            </div>
            <hr>

            
        </div>
   </div>

        <!------------------------------------------>

        <footer class="bg-light py-5">
          <h5>FOLLOW MORE IN SOCIAL MEDIA</h5>
            <div class="container">
                <div class="small text-center text-muted">

                <div class="icon">
                    <div class="socialIcons">
                            <a href=""><i class="fa-brands fa-facebook"></i></a>
                            <a href=""><i class="fa-brands fa-instagram"></i></a>
                            <a href=""><i class="fa-brands fa-twitter"></i></a>
                            <a href=""><i class="fa-brands fa-youtube"></i></a>
                        </div>
                </div>
                &#169; 2024 BCC_HOTEL All Rights Reserved. | <a href="https://bcc.com/" target="_blank">BCC - IT </a>
            </div>
            </div>
          </footer>
        <?php include('footer.php') ?>


<script>
//Mao ni para sa Arrow para mo ibabaw
let calcScrollValue = () => {
    let scrollProgress = document.getElementById
    ("progress");

    let progressValue = document.getElementById
    ("progress-value");
    let pos = document.documentElement.scrollTop;
    let calcHeight = 
      document.documentElement.scrollHeight - document.documentElement.clientHeight;
    let scrollValue = Math.round((pos * 100)/calcHeight);

    if(pos>100){
        scrollProgress.style.display = "grid";
    }else{
      scrollProgress.style.display = "none"
    }

    scrollProgress .addEventListener("click", () => {
        document.documentElement.scrollTop = 0;
    });

    scrollProgress.style.background = `conic-gradient(#03cc65 ${scrollValue}%, #d7d7d7 ${scrollValue}%)`;
  }
  
  window.onscroll = calcScrollValue;
  window.onload = calcScrollValue


                        ////Mao ni para sa Star Rating

                       $(document).ready(function () {
                                    var ratedIndex = [];
                                    var review=1;
                                        

                                    // Load previously selected star ratings from localStorage
                                    for (var categoryId in <?php echo json_encode($cat_arr); ?>) {
                                        var storedIndex = localStorage.getItem('ratedIndex_' + categoryId);
                                        ratedIndex[categoryId] = storedIndex !== null ? parseInt(storedIndex) : -1;

                                        if (ratedIndex[categoryId] !== -1) {
                                            for (var j = 0; j <= ratedIndex[categoryId]; j++) {
                                                $('#star-rating-' + categoryId + ' .fa-star:eq(' + j + ')').css('color', '#FFD700');
                                            }
                                        }
                                    }

                                    $('.fa-star').mouseover(function () {
                                        var currentIndex = parseInt($(this).data('index'));
                                        var categoryId = $(this).data('category-id');

                                        resetStarColors(categoryId);

                                        for (var i = 0; i <= currentIndex; i++) {
                                            $('#star-rating-' + categoryId + ' .fa-star:eq(' + i + ')').css('color', '#FFD700');
                                        }
                                    });

                                    $('.fa-star').mouseleave(function () {
                                        var categoryId = $(this).data('category-id');
                                        resetStarColors(categoryId);

                                        if (ratedIndex[categoryId] !== -1) {
                                            for (var i = 0; i <= ratedIndex[categoryId]; i++) {
                                                $('#star-rating-' + categoryId + ' .fa-star:eq(' + i + ')').css('color', '#FFD700');
                                            }
                                        }
                                    });

                                    $('.fa-star').each(function () {
                                        var categoryId = $(this).data('category-id');
                                        $.ajax({
                                            url: 'get_review_count.php',
                                            method: 'POST',
                                            data: { categoryId: categoryId },
                                            success: function(response) {
                                                var reviewCount = parseInt(response);
                                                if (!isNaN(reviewCount)) {
                                                    for (var i = 0; i < reviewCount; i++) {
                                                        $('#star-rating-' + categoryId + ' .fa-star:eq(' + i + ')').css('color', '#FFD700');
                                                    }
                                                }
                                            },
                                            error: function(xhr, status, error) {
                                                console.error('Error fetching review count:', error);
                                            }
                                        });
                                    });



                                    $('.fa-star').on('click', function () {
                                        var currentIndex = parseInt($(this).data('index'));
                                        $('#currentIndex').val(currentIndex);
                                        var categoryId = $(this).data('category-id');
                                        ratedIndex[categoryId] = currentIndex;
                                        review++;
                                        
                                     

                                        console.log('Clicked star index:', currentIndex);
                                        console.log('Category ID:', categoryId);
                                    
                                        localStorage.setItem('ratedIndex_' + categoryId, currentIndex);

                                        console.log('Value stored in local storage:', localStorage.getItem('ratedIndex_' + categoryId));
                    
                                                            var categoryId = $(this).data('category-id');
                                                           
                                                            // Send AJAX request to update_reviews.php
                                                            // $.ajax({
                                                            //    url: 'update_review_number.php',
                                                            //     method: 'POST',
                                                            //     data: { categoryId: categoryId, review: review },
                                                            //     success: function(response) {
                                                            //        console.log('Review count updated successfully');
                                                            //     },
                                                            //     error: function(xhr, status, error) {
                                                            //        console.error('Error updating review count:', error);
                                                            //    }
                                                            // });


                                                            // Send AJAX request to insert_rating.php
                                                            $.ajax({
                                                                url: 'insert_rating.php',
                                                                method: 'POST',
                                                                data: { categoryId: categoryId, review: review, currentIndex: currentIndex },
                                                                success: function(response) {
                                                                    var data = JSON.parse(response);
                                                                        if (data.categoryId == categoryId) {
                                                                            $('#review-number-' + categoryId).text('Review: ' + data.review_count); // Update review count in HTML
                                                                            console.log('Review count updated successfully for categoryId ' + categoryId, data.review_count);
                                                                        }
                                                                    
                                                                },
                                                                error: function(xhr, status, error) {
                                                                    console.error('Error updating review count:', error);
                                                                }
                                                            });

                                                            $(this).off('click');


                                    ////// Para sa ranking every index_star



                                    });

                                    function resetStarColors(categoryId) {
                                        $('#star-rating-' + categoryId + ' .fa-star').css('color', 'black');
                                    }


                     });
   
</script>