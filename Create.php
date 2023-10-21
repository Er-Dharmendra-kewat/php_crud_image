<?php include 'includes/header.php'; ?>

<div class="container">
    <div class="row my-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary">
                        <a href="Read.php" class="text-white">View Users</a>
                    </button>
                    <h4>Create Users <i class="fa fa-user"></i></h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['status'])) {

                        $message = $_SESSION['status'];
                        unset($_SESSION['status']);
                        echo $message;

                    }

                    ?>

                    <?php

                    if (isset($_POST['insert_btn'])) {
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $mobile = $_POST['mobile'];
                        $password = $_POST['password'];
                        $image = $_POST['image'];
                        $tmp_name = $_FILES['image']['tmp_name'];
                        $original_name = $_FILES['image']['name'];
                        $image_des = "uploaded_images/ . $original_name";

                        move_uploaded_file($tmp_name, $image_des);

                        $insert_query = "INSERT INTO `uploads_image`(`name`, `email`, `mobile`, `password`,`image`) VALUES ('$name','$email','$mobile','$password','$image_des') ";


                        $insert_query_run = mysqli_query($conn, $insert_query);


                        if ($insert_query_run) {


                            $_SESSION['status'] = "Data inserted successfully";
                            $_SESSION['status_code'] = "error";

                            header('Location: Create.php');
                        } else {
                            $_SESSION['status'] = "Data not inserted ";
                            $_SESSION['status_code'] = "error ";

                            header('Location: Create.php');
                        }


                    }

                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" Required>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" Required>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" Required>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Number</label>
                            <input type="text" name="mobile" class="form-control" Required>


                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" Required>
                        </div>

                        <button type="submit" name="insert_btn" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>