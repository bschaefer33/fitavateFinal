<div class="Column middle">
    <h1 class="PageHeader">New Fitine</h1>
    <form>
        <div class ="form-group">
            <label for="newFitineName">Fitine Name</label>
            <input type="text" class="form-control" id="newFitineName" placeholder="<?php $tempFitineName ?>">
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

