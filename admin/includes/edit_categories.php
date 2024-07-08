<?php
updateCategory();
?>

<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit category</label>
        
        <?php
        editCategory();
        ?>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update" value="Edit Category">
    </div>
</form>
