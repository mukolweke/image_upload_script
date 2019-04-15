<?php


require_once 'classes/Item.php';

$item = new Item();

// variables
$error_msg = $item_name = $item_price = $success_msg = $image_location = '';
$error = $success = false;

include "image_script.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // have POST in caps

    $action = $_POST['action'];

    if ($action === 'add-item') {

        // check if empty
        if (empty(trim($_POST['item_name'])) || empty(trim($_POST['item_price']))) {
            $error = true;
            $error_msg = "Please enter details in form to add item";
        }

        // check character size
        if (strlen($_POST['item_name']) < 3) {
            $error = true;
            $error_msg = "The name of item is too short";
        }


        // insert
        if (!$error) {

            if (isset($_FILES['fileToUpload'])) {
                $image_location = getImageLocation();
            }

            if ($item->saveItem($_POST, $image_location)) {
                $success = true;
                $success_msg = "Item Added Successfully";
            } else {
                $error = true;
                $error_msg = "Item Not Added";
            }
        }

    }
}

$items = $item->getAllItems();


?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>CRUD</title>
</head>

<body style="padding: 100px;">


<div class="container">

    <?php if ($error) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_msg; ?>
        </div>
    <?php } ?>


    <?php if ($success) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success_msg; ?>
        </div>
    <?php } ?>

    <div class="wrapper">
        <h3>My Shopping List</h3>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addItem">Add Item</button>

        <div style="display: flex; flex-wrap: wrap; justify-content: space-between">
            <?php if ($items) {

                foreach ($items as $item) {
                    ?>

                    <div class="card" style="width: 18rem;">
                        <img src="<?php if ($item['img_location']) {
                            echo $item['img_location'];
                        } else {
                            echo 'uploads/default.png'; } ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $item['item_name'] ?></h5>
                            <p class="card-text">$$<?php echo $item['item_price'] ?></p>
                            <p class="card-text">$$<?php echo $item['item_count'] ?></p>
                            <a href="#" class="btn btn-primary">BUY TICKET</a>
                        </div>
                    </div>

                    <?php
                }
            } ?>
        </div>
    </div>
</div>

<?php include "modals.php"; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
