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
            <table name="formLifts">
                <thead>
                    <tr>
                        <th>Lift</th>
                        <th>Weight</th>
                        <th>Sets</th>
                        <th>Reps</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="liftRow">
                        <td>
                            <select id="listifts" name="listLift">
                                <option value="null" selected>Add New Lift</option>
                                <?php foreach($fullLiftArray as $lift)
                                {
                                    echo "<option value ='".$lift['lift_id']."'>".$lift['liftName']."</option>";
                                }
                                    
                                ?>
                            </select>
                        </td>
                        <td><input type="text" id="liftWt" name="liftWt"/></td>
                        <td><input type="text" id="liftSet" name="liftSet"/></td>
                        <td><input type="text" id="liftRep" name="liftRep"/></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <input type="submit" value="Add Another Lift" name="liftbutton">
        <input type="submit" value="Create FiTine" name="submitForm">
    </form>
</div>

