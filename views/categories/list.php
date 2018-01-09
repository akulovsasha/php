<?php

/**
 * @var \models\Category[] $categories
 * @var \models\Goods[] $goods
 * @var \models\Goods[] $count
 */


?>
<div class="container">
    <h1>Categories list</h1>
    <p><a href="/categories/create?title=category"" class="btn btn-success">Create category</a></p>

    <div id="accordion" role="tablist">
        <?php foreach ($categories

                       as $category) : ?>
            <div class="card">
                <div class="card-header" role="tab" id="heading<?= $category->id ?>">

                    <div class="row">

                        <div class="col-sm-8">
                            <h3 class="mb-1">
                                <a data-toggle="collapse" href="#collapse<?= $category->id ?>" aria-expanded="true"
                                   aria-controls="collapse<?= $category->id ?>">
                                    <?= $category->title ?>
                                </a>
                            </h3>
                        </div>
                        <div class="col-sm-3">

                            <a href="/categories/update?id=<?= $category->id ?>&title=category"
                               class="btn btn-sm btn-warning">Update</a>
                            <a href="/goods/create?id=<?= $category->id ?>&title=good"
                               class="btn btn-sm btn-primary">Add goods</a>
                            <a href="/categories/delete?id=<?= $category->id ?>"
                               class="btn btn-sm btn-danger">Delete</a>

                        </div>
                        <div class="col-sm-1">
                            <span class="badge badge-primary badge-pill">13</span>
                        </div>
                    </div>
                </div>


                <div id="collapse<?= $category->id ?>" class="collapse" role="tabpanel"
                     aria-labelledby="heading<?= $category->id ?>"
                     data-parent="#accordion">

                    <div class="card-body">
                        <?php foreach ($goods as $good) : ?>
                            <div class="alert alert-primary" role="alert">
                                <div class="row">
                                <div class="col-sm-10">
                                    <?= $good->title ?>
                                </div>
                                <div class="col-sm-2">
                                    <a href="/goods/update?id=<?= $good->id ?>&title=goods"
                                       class="btn btn-sm btn-warning">Update</a>
                                    <a href="/goods/delete?id=<?= $good->id ?>"
                                       class="btn btn-sm btn-danger">Delete</a>
                                </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>

