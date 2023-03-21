<?php
class Fitine
{
    public $userID;
    public $fitineID;
    public $ownerID;
    public $ownerName;
    public $fitineName;
    public $viewStatus;
    public $dateCreated;
    public $fitineLifts = [];

    public function __construct($userID, $fitineID, $ownerID, $ownerName, $fitineName, $viewStatus, $dateCreated, $fitineLifts)
    {
        $this->userID       = $userID;
        $this->fitineID     = $fitineID;
        $this->ownerID      = $ownerID;
        $this->ownerName    = $ownerName;
        $this->fitineName   = $fitineName;
        $this->viewStatus   = $viewStatus;
        $this->dateCreated  = $dateCreated;
        $this->fitineLifts  = $fitineLifts;
    }

    public function printFitine()
    {
        if ($this->viewStatus == 1) {
            $status = "public";
        } else {
            $status = "private";
        }
        $date = date('m-d-Y', strtotime($this->dateCreated));
        echo "<table>";
        echo "<thead>";
            echo "<tr>";
                echo "<th colspan='2'>Created By: ".$this->ownerName."</th>";
                echo "<th colspan='2'>Created On: ".$date."</th>";
                echo "<th colspan='1'>".$status."</th>";
            echo "</tr>";
            echo "<tr>";
                echo "<th>Lift</th>";
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
    }

    public function printFitineTitle()
    {
        echo "<li>".$this->fitineName."</li>";
    }
}
