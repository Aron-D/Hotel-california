// $id = $_GET['id'];
// $sql = "SELECT * FROM categories WHERE id = :id LIMIT 1";

// $statement_object = $pdo->prepare($sql);
// $statement_object ->bindParam(':quantity', $quantity);
// $statement_object->execute();
// $categories = $statement_object->fetch();
// $quantity = $categories['quantity'];

//    $sql = "UPDATE `categories` SET `new_quantity` WHERE `categories`.`quantity` = :quantity";




$value = isset($_POST['rooms']) ? $_POST['rooms'] : 1; //to be displayed
if(isset($_POST['increase'])){
   $user->setCategoryQuantity('1', 1);

}

if(isset($_POST['decrease'])){
    $user>setCategoryQuantity('1', -1);
}
?>

<form method='post' action='<?= $_SERVER['PHP_SELF']; ?>'>
   <!--<input type='hidden' name='item'/> Why do you need this?-->
   <td>
       <button name='increase'>+</button>
       <input type='text' size='1' name='rooms' value='<?= $value; ?>'/>
       <button name='decrease'>-</button>
   </td>
</form>


          <td> <?=$row['id']?> </td>
          <td> <?=$row['category_name']?> </td>
          <td> <?=$row['quantity']?> </td>

          <!-- <a href="quantity.php"><i class="fas fa-edit"></i></a> -->
<!-- var_dump($result);  -->


<?php
$result = $db->prepare("SELECT * FROM categories");
$result->execute();

while ($row = $db->fetchAll(PDO::FETCH_ASSOC))
{
$id = $row['id'];
$category = $row['category_name'];
$amount = $row['quantity'];

echo $row;
echo $category;
echo $amount;
?>