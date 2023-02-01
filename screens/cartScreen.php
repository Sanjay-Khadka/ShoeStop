<?php session_start();
if(isset($_SESSION['cart'])){
    $count = count($_SESSION['cart']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" defer></script>
    <script defer>
    const deleteCartItem = (id) => {
        $.post("../includes/deleteCartItems.php", {
            id: id
        }, result => {
            $("table").load("cartScreen.php table");
            console.log(result);
        })
    }
    </script>

    <link rel=stylesheet href="../css/cart.css" />
    <title>Cart</title>
</head>

<body>
    <div class="cart">
        <h2>Cart</h2>
        <table>
            <tr class="identifier_row">
                <th>Product</th>
                <th>Name</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th> 
            </tr>

            <?php 

 
 foreach($_SESSION['cart'] as $item){
  
  echo "  <tr class='product_row'>
  <td><img src='".$item['photo']."' alt='product2' class='product-img'></td>
  <td>".$item['name']."</td>
  <td>".$item['size']."</td>
  <td>".$item['quantity']."</td>
  <td>".$item['price']."</td>
  <td class='action'>
    <button><img src='../images/edit3.svg'/></button>
    <button onclick = 'deleteCartItem(".$item['id'].")' ><img src='../images/x-circle.svg'/></button>
  </td>
</tr>";

 }

 
 
 ?>
            <?php  if($count<1){
    echo "<tr>
    <td style='height:48px; width:100%;'>
    No Items available
    </td>
    </tr>
    ";
 }?>
        </table>
    </div>
</body>

</html>