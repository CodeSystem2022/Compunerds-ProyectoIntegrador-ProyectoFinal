<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodTruck</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" >

</head>
<body>
    <!--seccion header inicio-->
    <?php include 'components/user_header.php'?>
    <!--seccion header fin-->

    <!--seccion footer inicio-->
    <?php include 'components/footer.php'?>
    <!--seccion footer fin-->

    <script src="js/scripts.js"></script>
</body>
</html>

