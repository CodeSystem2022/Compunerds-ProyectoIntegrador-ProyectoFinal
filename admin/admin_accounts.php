<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
    $delete_admin->execute([$delete_id]);
    header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cuentas admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php include '../components/admin_header.php' ?>

<!-- cuenta admin section starts  -->

<section class="accounts">
    <h1 class="heading">cuentas admin</h1>

    <div class="box-container">

    <div class="box">
        <p>registrar nuevo admin</p>
        <a href="register_admin.php" class="option-btn">registrar</a>
    </div>

    <?php
        $select_account = $conn->prepare("SELECT * FROM `admin`");
        $select_account->execute();
        if($select_account->rowCount() > 0){
            while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
    ?>
    <div class="box">
        <p> admin id : <span><?= $fetch_accounts['id']; ?></span> </p>
        <p> usuario : <span><?= $fetch_accounts['name']; ?></span> </p>
        <div class="flex-btn">
            <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('desea eliminar esta cuenta?');">eliminar</a>
            <?php
                if($fetch_accounts['id'] == $admin_id){
                echo '<a href="update_profile.php" class="option-btn">editar</a>';
                }
            ?>
        </div>
    </div>
    <?php
        }
    }else{
        echo '<p class="empty">no hay cuentas disponibles</p>';
    }
    ?>
    </div>
</section>
<!-- cuenta admin fin -->

<script src="../js/admin_script.js"></script>

</body>
</html>