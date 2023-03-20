<?php
class Lift
{
    public $liftID;
    public $liftWeight;
    public $liftSet;
    public $liftRep;
    public $liftName;
    public $muscleGroupID;
    public $muscleGroupName;

    public function __construct($liftID, $liftWeight, $liftSet, $liftRep, $liftName, $muscleGroupID, $muscleGroupName)
    {
        $this->liftID           = $liftID;
        $this->liftWeight       = $liftWeight;
        $this->liftSet          = $liftSet;
        $this->liftRep          = $liftRep;
        $this->liftName         = $liftName;
        $this->muscleGroupID    = $muscleGroupID;
        $this->muscleGroupName  = $muscleGroupName;
    }
    
}