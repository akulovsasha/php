<?php

/**
 * @var \models\Category $category
 * @var \helpers\Request
 */

?>

<form method="post" action="/categories/update?id=<?= $category->id ?>">
    <div class="form-group">


        <label>Previous name of <?php echo $_GET['title']; ?> : <?= $category->title  ?></label>
        <input type="text" name="title" class="form-control" placeholder="Enter new name of category">



    </div>

    <input type="submit" value="Save" class="btn btn-success">
    <a href="/categories/cancel?id=<?= $category->id ?>" class="btn  btn-danger">Cancel</a>
</form>