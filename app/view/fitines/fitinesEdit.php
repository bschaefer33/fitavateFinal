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
    <title>FitineEdit</title>
</head>
<body>
<div class="Column middle">
    <h1 class="PageHeader">Edit Fitine</h1>
    <div id="fitineFormContainer">
    <!--Form-->
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <label class ="form-group row" for="fitineName">Fitine Name</label>
            <input class ="form-group row" type="text" class="form-control" id="fitineName" name="fitineName" value="<?php echo $fitine['fitineName'] ?>" />
        <div class ="form-group row">
            <div class="form-check form-check-inline ">
                <input class="form-check-input" type="radio" name="viewStatus" id="public" value="1" <?php echo $true ?> />
                <label class="form-check-label" for="public">Public</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="viewStatus" id="private" value="0" <?php echo $false ?> />
                <label class="form-check-label" for="private">Private</label>
            </div>
        </div>
        <div class="form-group row">
            <label class="col" for="liftNameInput">Lift</label>
            <label class="col" for="liftWtInput">Weight</label>
            <label class="col" for="liftSetsInput">Sets</label>
            <label class="col" for="liftRepsInput">Reps</label>
        </div>
        <?php foreach($liftArray as $lift): ?>
            <div class="form-group row" id="liftSel">
                <select class="col" id="listLifts" name="editLiftID[]">
                    <option value="null" selected>Add New Lift</option>
                        <?php foreach ($fullLiftArray as $liftSelect): ?>
                            <?php if ($lift['lift_id'] == $liftSelect['lift_id']): ?>
                                <option selected value ="<?php echo $liftSelect["lift_id"] ?>"><?php echo $liftSelect["liftName"] ?></option>;
                            <?php else: ?>
                                <option value ="<?php echo $liftSelect["lift_id"] ?>"><?php echo $liftSelect["liftName"] ?></option>;
                            <?php endif; ?>
                        <?php endforeach; ?>>
                </select>
                <input class="col" type="text" id="liftWtInput" name="editLiftWt[]" value="<?php echo $lift["liftWeight"] ?>"/>
                <input class="col" type="text" id="liftSetsInput" name="editLiftSet[]" value="<?php echo $lift["liftSet"] ?>"/>
                <input class="col" type="text" id="liftRepsInput" name="editLiftRep[]" value="<?php echo $lift["liftRep"] ?>"/>
            </div>
        <?php endforeach; ?>
        <div id="newInput"></div>

        <div class="form-group row">
            <button id="rowAdd" type="button" class="btn">Add Another Lift</button>
            <button id="fitineSubmit" type="submit" class="btn">Submit Fitine</button>
        </div>
    </form>
    </div>
</div>
<script>
  $("#rowAdd").click(function () {
        
    newRowAdd =
        '<div class="form-group row" id="liftSel">' +
                '<select class="col" id="listLifts" name="editLiftID[]">' +
                    '<option value="null" selected>Add New Lift</option>' +
                        '<?php foreach($fullLiftArray as $lift) : ?>' +
                            '<option value ="<?php echo $lift['lift_id'] ?>"><?= $lift['liftName'] ?></option>'+
                        '<?php endforeach; ?>'+
                '</select>'+
            '<input class="col" type="text" id="liftWtInput" name="editLiftWt[]"/>'+
            '<input class="col" type="text" id="liftSetsInput" name="editLiftSet[]"/>' +
            '<input class="col" type="text" id="liftRepsInput" name="editLiftRep[]"/></div>'
            $('#newInput').append(newRowAdd);
    });
</script>
