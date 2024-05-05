<head>
<link rel="stylesheet" href="styless.css">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/font-awesome.min.css">-->

</head>
<?php

$date_in = isset($_POST['date_in']) ? $_POST['date_in'] : date('Y-m-d');
$date_out = isset($_POST['date_out']) ? $_POST['date_out'] : date('Y-m-d', strtotime(date('Y-m-d') . ' + 3 days'));
$adult = isset($_POST['adult']) ? $_POST['adult'] : 1;
$children = isset($_POST['children']) ? $_POST['children'] : 2;
?>
<style>
	.blue-button {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

.blue-button:hover {
    background-color: #0056b6;
    border-color: #0056b3;
}
</style>

<!-- Masthead-->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                <h1 class="text-uppercase text-white font-weight-bold">Rooms</h1>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>

<section class="page-section bg-dark">
    <div class="container">	
        <div class="col-lg-12">	
            <div class="card">
                <div class="card-body">	
                    <form action="index.php?page=list" id="filter" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Check-in Date</label>
                                <input type="text" class="form-control" name="date_in" autocomplete="off" value="<?php echo isset($date_in) ? date("Y-m-d", strtotime($date_in)) : "" ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="">Check-out Date</label>
                                <input type="text" class="form-control" name="date_out" autocomplete="off" value="<?php echo isset($date_out) ? date("Y-m-d", strtotime($date_out)) : "" ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="" class="control-label">Adult</label>
                                <select class="custom-select browser-default" name="adult" autocomplete="off">
                                    <option value="1" <?php echo ($adult == 1) ? 'selected' : ''; ?>>One</option>
                                    <option value="2" <?php echo ($adult == 2) ? 'selected' : ''; ?>>Two</option>
                                    <option value="2" <?php echo ($adult == 3) ? 'selected' : ''; ?>>Three</option>
                                    <option value="2" <?php echo ($adult == 4) ? 'selected' : ''; ?>>Four</option>
                                    <option value="2" <?php echo ($adult == 5) ? 'selected' : ''; ?>>Five</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="" class="control-label">Children</label>
                                <select class="custom-select browser-default" name="children" autocomplete="off">
                                    <option value="1" <?php echo ($children == 1) ? 'selected' : ''; ?>>One</option>
                                    <option value="2" <?php echo ($children == 2) ? 'selected' : ''; ?>>Two</option>
                                    <option value="2" <?php echo ($children == 3) ? 'selected' : ''; ?>>Three</option>
                                    <option value="2" <?php echo ($children == 4) ? 'selected' : ''; ?>>Four</option>
                                    <option value="2" <?php echo ($children == 5) ? 'selected' : ''; ?>>Five</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <br>
                                <button class="btn btn-sm btn-primary offset-md-8 blue-button">Check Availability</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>	

            <hr>	
            
            <?php 
            $cat = $conn->query("SELECT * FROM room_categories");
            $cat_arr = array();
            while($row = $cat->fetch_assoc()){
                $cat_arr[$row['id']] = $row;
            }

            // Assuming $status is a column in the rooms table
            $qry = $conn->query("SELECT distinct(category_id), category_id FROM rooms WHERE id NOT IN (SELECT room_id FROM checked WHERE '$date_in' BETWEEN date(date_in) AND date(date_out) AND '$date_out' BETWEEN date(date_in) AND date(date_out) ) AND status = 0");

            while($row= $qry->fetch_assoc()):
            ?>
            <div class="card item-rooms mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="assets/img/<?php echo $cat_arr[$row['category_id']]['cover_img'] ?>" alt="">
                        </div>
                        <div class="col-md-5" height="100%">
                            <h3><b><?php echo 'Php '.number_format($cat_arr[$row['category_id']]['price'],2) ?></b><span> / per day</span></h3>
                            <h4><b><?php echo $cat_arr[$row['category_id']]['name'] ?></b></h4>
                            <div class="align-self-end mt-5">
                                <button class="btn btn-primary  float-right book_now" type="button" data-id="<?php echo $row['category_id'] ?>">Book now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            

                            



            <?php endwhile; ?>
        </div>	
    </div>	
</section>
<hr>
<footer class="bg-light py-5">
          <h5>FOLLOW MORE IN SOCIAL MEDIA</h5>
            <div class="container"><div class="small text-center text-muted">

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
          </footer>
<style type="text/css">
    .item-rooms img {
        width: 23vw;
    }
</style>
<script>
     $(document).off('click', '.book_now').on('click', '.book_now', function() {
    var categoryId = $(this).data('id'); // Get the category_id from data-id attribute
    // Redirect to book.php with category_id, date_in, date_out, children, and adult as parameters
    uni_modal('Book','admin/book.php?in=<?php echo $date_in ?>&out=<?php echo $date_out ?>&cid='+$(this).attr('data-id')+'&children=<?php echo $children ?>&adult=<?php echo $adult ?>');
});


    
   
       
    
</script>



</script>

