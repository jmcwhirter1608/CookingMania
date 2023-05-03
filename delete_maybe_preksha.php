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
