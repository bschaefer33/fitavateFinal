<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel= "styleSheet" href="styleSheet.css">
    <title>fitine</title>
</head>
<div class="Column middle">
    <h1 class="PageHeader">Fitines</h1>
    <h1 class="SectionHeader">My Fitines</h1>
    <div id="fitineTable">
        <div id="accordion">
            <div class="card">
                <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#collapseOne">
                        Create New Fitine
                    </a>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" name="startNewFitine" >
                            <div class ="form-group">
                                <label for="newFitineName">Fitine Name</label>
                                <input type="text" class="form-control" id="newFitineName" name="newFitineName" />
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tempViewStatus" id="public" value="1" />
                                <label class="form-check-label" for="public">Public</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tempViewStatus" id="private" value="0"/>
                                <label class="form-check-label" for="private">Private</label>
                            </div>
                            <input name="fitineSubmit" type="submit" value="New Fitine" />
                        </form>
                    </div>
                </div>
            </div>
            <?php foreach ($userArray as $fitine) :?>
                    <div class="card">
                        <div class="card-header">
                            <a class='collapsed card-link' data-toggle='collapse' href='#<?= $fitine->fitineID?>'><?= $fitine->fitineName ?></a>
                        </div>
                        <div id="<?= $fitine->fitineID ?>" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <?= $fitine->printFitine(); ?>
                                <input name="fitineEdit" type="submit" value="Edit" />
                                <a href="" class="btn btn-primary">Delete</a>
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>
        </div>
    </div>

    <h1 class = "SectionHeader">Saved Fitines</h1>
    <div id="fitineTable">
        <div id="accordion">
            
            <?php foreach ($savedArray as $fitine) :?>
                <?php if($count == 0): ?>
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#<?= $fitine->fitineID?>"><?= $fitine->fitineName ?></a>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <?= $fitine->printFitine(); ?>
                                <?php $count=1; ?>
                                <a href="?page=fitines/fitinesEdit" class="btn btn-primary">Edit</a>
                                <a href="" class="btn btn-primary">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card">
                        <div class="card-header">
                            <a class='collapsed card-link' data-toggle='collapse' href='#<?= $fitine->fitineID?>'><?= $fitine->fitineName ?></a>
                        </div>
                        <div id="<?= $fitine->fitineID ?>" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <?= $fitine->printFitine(); ?>
                                <a href="?page=fitines/fitinesEdit" class="btn btn-primary">Edit</a>
                                <a href="" class="btn btn-primary">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
    </div>

</div>
<script>

</script>
</html>
