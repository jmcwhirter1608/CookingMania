<!-- <?php
  $result_ingredients = mysqli_query($connection, "SELECT * FROM Ingredients ORDER BY Ingredient_ID ASC");
  $ingredient_name = array();
  $ingredient_id = array();
  $ingredient_quanitity = array();
  while( $ingredient = mysqli_fetch_array($result_ingredients) ){
        $ingredient_name[] = $ingredient['Ingredient_Name'];
        $ingredient_id[] = $ingredient['Ingredient_ID'];
  }
?>

<?php foreach ($ingredient_name as $ingr) { ?>
  <label for="ingredient"> <?php echo $ingr ?> </label>
  <input type="number" name="ingredient_quantity[]" placeholder="0" min="0" max="30">
   <br />
<?php } ?>

<?php
foreach ($ingredient_quanitity as $ingr) {
 echo $ingr;
}
?>

$user_type = $_SESSION['User_type'];

//for all ingredients for this recipe print the item and the quantity
// $ingredient_list_res = mysqli_query($connection, "SELECT * FROM Ingredient_List WHERE Recipe_ID = ".$recipe['Recipe_ID']." ");
//
// while( $ingredient = mysqli_fetch_array($ingredient_list_res) ){
//
//   $ingredients_res = mysqli_query($connection, "SELECT * FROM Ingredients WHERE Ingredient_ID = ".$ingredient['Ingredient_ID']." ");
//
//   while( $item = mysqli_fetch_array($ingredients_res) ){
//       Print '<p align="center">'. $ingredient["Ingredient_Quantity"]. " " .$item["Ingredient_Name"] ."</p>";
//   }
// }


<!-- <?php
  $result_ingredients = mysqli_query($connection, "SELECT * FROM Ingredients ORDER BY Ingredient_ID ASC");
  $ingredient_name = array();
  $ingredient_id = array();
  $ingredient_quanitity = array();
  while( $ingredient = mysqli_fetch_array($result_ingredients) ){
        $ingredient_name[] = $ingredient['Ingredient_Name'];
        $ingredient_id[] = $ingredient['Ingredient_ID'];
  }
?>

<?php foreach ($ingredient_name as $ingr) { ?>
  <label for="ingredient"> <?php echo $ingr ?> </label>
  <input type="number" name="ingredient_quantity[]" placeholder="0" min="0" max="30">
   <br />
<?php } ?> -->


// <p>Ingredient options and Quantities: </p>;

// foreach ($ingredient_name as $ingr) {
//     echo "<label for='ingredient'>".$ingr. "</label>
//    <input type='number' name='ingredient_quantity[]' placeholder='0' min='0' max='30 value=".$ingr.">
//     <br />";
// }
//
//// <p>Ingredient special instructions: </p>


        //INGREDIENTS UPDATE:
        // $ingredient_quanitity = $_REQUEST["ingredient_quantity"];
        // $ingredient_id = 1;
        //
        // foreach ($ingredient_quanitity as $ingr_quantity){
        //
        //
        //   $ingredient_list_res = mysqli_query($connection, "SELECT Ingredient_Quantity FROM Ingredient_List WHERE Recipe_ID = $Recipe_ID AND Ingredient_ID=$ingredient_id");
        //   $item_quantity_curr = mysqli_fetch_array($ingredient_list_res);
        //   //echo
        //   $exists = mysqli_num_rows($ingredient_list_res);

          //echo $exists;
        //  if($exists > 0 ){
        //     if($ingr_quantity > 0 ){
        //       $insert_ingr = $connection->prepare("UPDATE Ingredient_List SET Ingredient_Quantity=? WHERE Recipe_ID= ? AND Ingredient_ID=?,");
        //       $insert_ingr->bind_param("iii",  $ingr_quantity, $Recipe_ID, $ingredient_id,);
        //       $insert_ingr->execute();
        //       echo "update";
        //     }
        //     elseif( $ingr_quantity == 0){
        //       $insert_ingr = $connection->prepare("DELETE FROM Ingredient_List WHERE Recipe_ID=? AND Ingredient_ID=? ");
        //       $insert_ingr->bind_param("ii", $Recipe_ID, $ingredient_id);
        //       $insert_ingr->execute();
        //       echo "deleted";
        //     }
        //   }
        //   else{
        //     if($ingr_quantity > 0 ){
        //       $insert_ingr = $connection->prepare("INSERT INTO Ingredient_List(Recipe_ID, Ingredient_ID, Ingredient_Quantity) Values (?, ?,?)");
        //       $insert_ingr->bind_param("iii", $Recipe_ID, $ingredient_id, $ingr_quantity);
        //
        //       if ($insert_ingr->execute() === TRUE) {
        //           Print  '<p>'. "ingredient linked successfully".$ingredient_id . $ingr_quantity . "</p> ";
        //           Print '<br />';
        //       } else {
        //           Print  '<p>'. "ingredient not linked". "</p> ";
        //       }
        //     }
        //   }
        //   $ingredient_id++;
        // }

        // $ingredient_list_res = mysqli_query($connection, "SELECT * FROM Ingredient_List WHERE Recipe_ID = $Recipe_ID ");
        //
        // while( $ingredient = mysqli_fetch_array($ingredient_list_res) ){
        //
        //   $ingredients_res = mysqli_query($connection, 'SELECT * FROM Ingredients WHERE Ingredient_ID = $ingredient["Ingredient_ID"] ');
        //
        //   while( $item = mysqli_fetch_array($ingredients_res) ){
        //       Print '<p align="center">'. $ingredient["Ingredient_Quantity"]. " " .$item["Ingredient_Name"] ."</p>";
        //   }
        // }
        // Print '<p align="center"> <b>'. " Recipe Special Instructions". " </b> </p>";
