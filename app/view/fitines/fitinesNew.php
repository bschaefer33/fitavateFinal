<?php

?>
<html lang="en">
<head>
    <!--
    Team: Jimma Shanko, Tram-Anh Ngo, Dominic Cummings, Brittany Schaefer
    Project: Fitavate
    Page: User Home Page
    Date Created: 2-8-22
    Date Updated: 3-6-22
    By: Brittany Schaefer
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel= "styleSheet" href="styleSheet.css">
</head>
<div class="Column middle">
    <h1 class="PageHeader">New Fitine</h1>
    <form>
        <div class ="form-group">
            <label for="newFitineName">Fitine Name</label>
            <input type="text" class="form-control" id="newFitineName" placeholder="<?php echo $_SESSION['newFitineName'];?>">
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="viewStatus" id="public" value="1" checked>
            <label class="form-check-label" for="public">Public</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="viewStatus" id="private" value="0">
            <label class="form-check-label" for="private">Private</label>
        </div>
        <div class="form-group">
            <select class="custom-select" id="lifts">
                <option selected>Add New Lift</option>
                <?php foreach($fullLiftArray as $lift) :?>
                    <option value ="<?= $lift['lift_id'] ?>"><?= $lift['liftName']?></option>
                <?php endforeach; ?>
            </select>
            <div class="row">
                <div class="col">
                    <label for="liftWt">Weight (lbs.)</label>
                    <input type="text" class="form-control" id="liftWt">
                </div>
                <div class="col">
                    <label for="liftSet">Sets</label>
                    <input type="text" class="form-control" id="liftSet">
                </div>
                <div class="col">
                    <label for="liftRep">LiftRep</label>
                    <input type="text" class="form-control" id="liftRep">
                </div>
            </div>
            <button class="btn">Add Another Lift</button>
        </div>
    </form>
</div>

