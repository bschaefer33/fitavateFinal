<?php
class Fitine
{
    public $userID;
    public $fitineID;
    public $ownerID;
    public $ownerName;
    public $ownerImage;
    public $fitineName;
    public $viewStatus;
    public $dateCreated;
    public $fitineLifts = [];

    public function __construct($userID, $fitineID, $ownerID, $ownerName, $ownerImage, $fitineName, $viewStatus, $dateCreated, $fitineLifts)
    {
        $this->userID       = $userID;
        $this->fitineID     = $fitineID;
        $this->ownerID      = $ownerID;
        $this->ownerName    = $ownerName;
        $this->ownerImage   = $ownerImage;
        $this->fitineName   = $fitineName;
        $this->viewStatus   = $viewStatus;
        $this->dateCreated  = $dateCreated;
        $this->fitineLifts  = $fitineLifts;
    }

    public function printFitine()
    {
        if ($this->viewStatus == 1) {
            $status = "Public";
        } else {
            $status = "Private";
        }
        $date = date('m-d-Y', strtotime($this->dateCreated));
            echo "<div class='row justify-content-center fitineTableHeader'>";
                echo "<div class='col-2 align-self-start'>";
                    printImageOthers($this->ownerImage);
                echo "</div>";
                echo "<div class='col-4 align-self-center'>";
                    echo $this->ownerName;
                echo "</div>";
                echo "<div class='col-3 align-self-center'>";
                    echo $date;
                echo "</div>";
                if ($this->userID == $this->ownerID) {
                    echo "<div class='col-2 align-self-center'>";
                        echo $status;
                    echo "</div>";
                } else {
                    echo "<div class='col-2 align-self-center invisible'>";
                        echo $status;
                    echo "</div>";
                }
            echo "</div>";
            echo "<div class='table-responsive'>";
            echo "<table class='table fitineDisplay'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th scope='row'>Lift</th>";
                    echo "<th>Muscle Group</th>";
                    echo "<th>Weight</th>";
                    echo "<th>Sets</th>";
                    echo "<th>Reps</th>";
                echo "<tr>";
            echo "</thead>";
            echo "<tbody>";
                foreach ($this->fitineLifts as $lift) {
                    echo "<tr>";
                        $lift->printLift();
                    echo "</tr>";
                }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
    }

    public function printFitineProfile()
    {
        $date = date('m-d-Y', strtotime($this->dateCreated));
            echo "<div class='row justify-content-center fitineTableHeader'>";
                echo "<div class='col-2 align-self-start'>";
                    printImageOthers($this->ownerImage);
                echo "</div>";
                echo "<div class='col-4 align-self-center'>";
                    echo $this->ownerName;
                echo "</div>";
                echo "<div class='col-3 align-self-center'>";
                    echo $date;
                echo "</div>";
                echo "<div class='col-2 align-self-center invisible'>";
                        echo "";//put follow button here
                echo "</div>";
            echo "</div>";
            echo "<div class='table-responsive'>";
            echo "<table class='table fitineDisplay'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th scope='row'>Lift</th>";
                    echo "<th>Muscle Group</th>";
                    echo "<th>Weight</th>";
                    echo "<th>Sets</th>";
                    echo "<th>Reps</th>";
                echo "<tr>";
            echo "</thead>";
            echo "<tbody>";
                foreach ($this->fitineLifts as $lift) {
                    echo "<tr>";
                        $lift->printLift();
                    echo "</tr>";
                }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
    }
}
