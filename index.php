    <?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class=" hero food-search text-center" style="background-image: 
        linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), /* Gradient overlay */
        url(./images/hero.png); ">
        <div class="container">

            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
    if (isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?> 

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //Create SQL Query to Display CAtegories from Database
            $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                //CAtegories Available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the Values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
            ?>

                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            //Check whether Image is available or not
                            if ($image_name == "") {
                                //Display MEssage
                                echo "<div class='error'>Image not Available</div>";
                            } else {
                                //Image Available
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                            <?php
                            }
                            ?>


                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>

            <?php
                }
            } else {
                //Categories not Available
                echo "<div class='error'>Category not Added.</div>";
            }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Featured Foods</h2>

            <?php

            //Getting Foods from Database that are active and featured
            //SQL Query
            $sql2 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //Count Rows
            $count2 = mysqli_num_rows($res2);

            //CHeck whether food available or not
            if ($count2 > 0) {
                //Food Available
                while ($row = mysqli_fetch_assoc($res2)) {
                    //Get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $cooking_time = $row['cooking_time'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
            ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            //Check whether image available or not
                            if ($image_name == "") {
                                //Image not Available
                                echo "<div class='error'>Image not available.</div>";
                            } else {
                                //Image Available
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                            }
                            ?>

                        </div>

                        <div class="food-menu-desc">
                        <form  action="manage_cart.php" method="post">
                            <div style="display: flex; justify-content: space-between;align-items:center;">
                                <h4><?php echo $title; ?></h4>
                                <div class="cook-time" style="padding: 8px 7px; background: orange; border-radius: 5px; color:white;"><?php echo $cooking_time; ?> Minutes</div>
                            </div>
                            <p class="food-price">RS <?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <input type="hidden" value="<?php echo $id; ?>" name="id">
                                <input type="hidden" value="<?php echo $title; ?>" name="title">
                                <input type="hidden" value="<?php echo $price; ?>" name="price">
                                <input type="hidden" value="<?php echo $image_name ?>" name="image_name">
                                <input type="hidden" value="<?php echo $cooking_time ?>" name="cooking_time">
                                <button type="submit" name="Add_To_Cart"  class="btn btn-primary">Add To Cart</button>
                        </form>
                        </div>

                    </div>

            <?php
                }
            } else {
                //Food Not Available 
                echo "<div class='error'>Food not available.</div>";
            }

            ?>





            <div class="clearfix"></div>



        </div>

        <p class="text-center">
            <a href="http://localhost/online-kitchen/foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>