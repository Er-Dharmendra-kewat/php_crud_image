<?php include 'includes/header.php'; ?>


<?php

$id = $_GET['update_id'];

$sql = "SELECT * FROM `uploads_image` WHERE id= $id";

$sql_run = mysqli_query($conn, $sql);

if (mysqli_num_rows($sql_run) > 0) {
    while ($data = mysqli_fetch_array($sql_run)) {

        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        $password = $data['password'];


?>


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

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" value="<?= $data['name']; ?>" class="form-control" Required>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" value="<?= $data['email']; ?>" class="form-control" Required>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Image</label>

                                    <input type="file" name="image" class="form-control">
                                    <input type="hidden" name="stud_image_old" value="<?= $data['image']; ?>">
                                    <label for="">Current Image</label>
                                    <img src="<?= $data['image']; ?>" width="50px" height="50px" alt="">

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Number</label>
                                    <input type="number" name="mobile" value="<?= $data['mobile']; ?>" class="form-control" Required>


                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" value="<?= $data['password']; ?>" class="form-control" Required>
                                </div>
                                <input type="hidden" name="edit_id" value="<?= $data['id']; ?>">

                                <button type="submit" name="update_btn" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

<?php
    }
}

?>
<?php include 'includes/footer.php' ?>


<?php


if (isset($_POST['update_btn'])) {

    $edit_id = $_GET['edit_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // $image = $_POST['image'];


    $tmp_name = $_FILES['image']['tmp_name'];
    $new_image = $_FILES['image']['name'];
    $stud_image_old = $_POST['stud_image_old'];
    // $image_des = "uploaded_images/ . $original_name";


    if ($new_image != '') {

        $update_filename = $_FILES['image']['name'];
    } else {

        $update_filename = $stud_image_old;
    }

    if (file_exists("uploaded_images/" . $_FILES['image']['name'])) {
        $filename = $_FILES['image']['name'];
        $_SESSION['status'] = "image already Exists" . $filename;
        header('Location: create.php');
    } else {


        $query = "UPDATE `uploads_image` SET `name`=' $name',`email`='$email',`image`='
        $update_filename',`mobile`='$mobile',`password`='$password ' WHERE id=$edit_id";

        $query_run = mysqli_query($conn, $query);

        if ($query_run) {

            if ($_FILES['image']['name'] != '') {


                move_uploaded_file($_FILES['image']['tmp_name'], "uploaded_images/" . $_FILES['image']['name']);

                unlink("uploaded_images/" . $stud_image_old);
            }

            $_SESSION['status'] = "Image Updated Successfully";
            header('Location: read.php');
        } else {
            $_SESSION['status'] = "Image Not  Updated ";
            header('Location: read.php');
        }
    }
}
?>