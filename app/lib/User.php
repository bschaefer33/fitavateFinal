<?php
class User {
    public $userID;
    public $userDisplayName;
    public $userEmail;
    public $userFirstName;
    public $userLastName;
    public $userBio;
    public $userBirthday;
    public $userCity;
    public $userState;
    public $userImage;
    public $userFitines;
    public $userFollowers;
    public $userFollowing;
    public $userFitavations;
    public $userComments;
    public $userLikes;
    public $userLiked;

    public function __construct($userID)
    {
        $this->userID = $userID;
        $conn = mysqli_connect("localhost", "root", "mysql", "fitavate");
        $sql = "SELECT * FROM user_profile WHERE user_profile.user_id = $userID";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

        mysqli_close($conn);

    }

}