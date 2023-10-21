<?php include 'includes/header.php';

?>

<button class="btn btn-primary"><a href="create.php" class="text-white">Add User</a></button>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_SESSION['status'])) {

                $message = $_SESSION['status'];
                unset($_SESSION['status']);
                echo $message;

            }

            ?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Password</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $sql_select_data = "SELECT * FROM `uploads_image`";


                    $sql_select_data_run = mysqli_query($conn, $sql_select_data);

                    if (mysqli_num_rows($sql_select_data_run) > 0) {
                        while ($rows = mysqli_fetch_assoc($sql_select_data_run)) {

                            ?>

                            <tr>
                                <td>
                                    <?= $rows['id']; ?>
                                </td>
                                <td>
                                    <?= $rows['name']; ?>
                                </td>
                                <td>
                                    <?= $rows['email']; ?>
                                </td>
                                <td>
                                    <img src="<?= $rows['image'] ?>" alt="<?= $item['name']; ?>" width="50px" height="50px">

                                </td>
                                <td>
                                    <?= $rows['mobile']; ?>
                                </td>
                                <td>
                                    <?= $rows['password']; ?>
                                </td>
                                <td>
                                    <a href="delete.php?delete_id=<?= $rows['id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                                <td>
                                    <a href="update.php?update_id=<?= $rows['id']; ?>" class="btn btn-primary">Update</a>


                                </td>
                            </tr>

                            <?php
                        }

                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>