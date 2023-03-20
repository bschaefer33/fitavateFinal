<div class="Column middle">
    <h1 class="PageHeader">Fitines</h1>
    <h1 class="SectionHeader">My Fitines</h1>
    <table class = "fitineTable">
        <tr><th></th></tr>
        <tr class = "fitineRow">
            <?php
                foreach ($userArray as $fitine) {
                    $fitine->printFitine();
                }
            ?>
        </tr>
    </table>
    <h1 class = "SectionHeader">My Fitines</h1>
    <table class = "fitineTable">
        <th></th>
        <tr class = "fitineRow">
            <?php
                foreach ($savedArray as $fitine) {
                    $fitine->printFitine();
                }
            ?>
        </tr>
    </table>

</div>
