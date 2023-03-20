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
    <a href="?page=fitines/fitinesView">View</a>
    <a href="?page=fitines/fitinesEdit">Edit</a>
    <a href="?page=fitines/fitinesNew">Create New</a>
</div>
