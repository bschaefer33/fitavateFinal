<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel= "styleSheet" href="styleSheet.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0a8a331abf.js" crossorigin="anonymous"></script>
    <title>Home Page</title>
</head>
<body>
    <div class="container middle">
        <h1 class="pageHeader">Fitavations</h1>
        <h1 class="sectionHeader">Create a Fitavation</h1>
        <div class="container fitavationFormContainer">
            <div class="card userFitavations">
                <div class="card-header">
                    <div class="row align-items-center justify-content-start">
                        <div class="col-1">
                            <?php printImageOthers($userImage); ?>
                        </div>
                        <div class="col-10">
                            <?php echo $userDisplayName; ?>
                        </div>
                    </div>
                </div>
                <form id="fitavationForm" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <input name= "fitavationUserID" type="hidden" value="<?php echo $fitavationUserID['user_id']; ?>" />
                            <textarea class="form-control" id="fitavationText" name="fitavationText" value="<?php echo $fitavationText['fitavation']; ?>" placeholder="Type your Fitavation Here..."  required></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end postFooter">
                            <input id="submitFitavation" name="submitFitavation" type="submit" value="Post Fitavation" class="btn postFit" />
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
        <h1 class="sectionHeader">Explore Fitavations</h1>
        <div class="container fitavationContainer">
            <?php foreach ($fitavationArray as $fitavation) :?>
                <div class="card userFitavations">
                    <div class="card-header">
                    <!--Has the user's-->
                        <?php $secondUserInfo = createSecondaryUser($fitavation['user_id']); ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <input name= "saveSecUserID" type="hidden" value="<?php echo $fitavation['user_id']; ?>" />
                            <button id="viewProfile" name="viewProfile" type="submit" class="btn viewProfile">
                                <?php printImageOthers($secondUserInfo['userImage']); ?>
                                <?php echo $secondUserInfo['userDisplay']; ?>
                            </button>
                                <?php if ($fitavation['user_id'] != $userID) : ?>
                                    <?php if (in_array($fitavation['user_id'], $followCheck)):?>
                                        <button id="unfollowUser" name="unfollowUser" type="submit" class="btn" >Unfollow</button>
                                    <?php else: ?>
                                        <button id="followUser" name="followUser" type="submit" class="btn">Follow</button>
                                    <?php endif; ?>
                                <?php endif; ?>
                        </form>
                    </div>
                    <div class="card-body">
                        <p><?= $fitavation['fitavation']?></p>
                    </div>
                    <div class="card-footer">
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>