<?php
class Lift
{
    public $fitineID;
    public $liftID;
    public $liftWeight;
    public $liftSet;
    public $liftRep;
    public $liftName;
    public $muscleGroupID;
    public $muscleGroupName;

    public function __construct($fitineID, $liftID, $liftWeight, $liftSet, $liftRep, $liftName, $muscleGroupID, $muscleGroupName)
    {
        $this->fitineID         = $fitineID;
        $this->liftID           = $liftID;
        $this->liftWeight       = $liftWeight;
        $this->liftSet          = $liftSet;
        $this->liftRep          = $liftRep;
        $this->liftName         = $liftName;
        $this->muscleGroupID    = $muscleGroupID;
        $this->muscleGroupName  = $muscleGroupName;
    }
    
    public function printLift()
    {
        echo "<td>".$this->liftName."</td>";
        echo "<td>".$this->muscleGroupName."</td>";
        echo "<td>".$this->liftWeight."</td>";
        echo "<td>".$this->liftSet."</td>";
        echo "<td>".$this->liftRep."</td>";
    }


}