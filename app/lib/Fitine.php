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
        echo "<td class='fitinePic'>Pic</td>";
        echo "<td class='owner'>" . $this->ownerName . "</td>";
        echo "<td class='fitineName'>" . $this->fitineName . "</td>";
        echo "<td class='status'>" . $status . "</td>";
        echo "<td class='date'>" . $date . "</td>";
    }

    
}
