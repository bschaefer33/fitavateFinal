<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel= "styleSheet" href="styleSheet.css">
    <title>Profile Page</title>
</head>
<body>
    <div class="container middle">
        <h1 class="pageHeader">Following</h1>
        <?php foreach ($userFollowing as $following): ?>
		<div class="card">
			<div class="card-body">
                <div class="row align-items-center justify-content-between">
                    <?php $userInfoFollowing = createSecondaryUser($following['user_id']); ?>
                    <div class="col-7">
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <input name= "saveSecUserID" type="hidden" value="<?php echo $following['user_id']; ?>" />
                            <button id="viewProfile" name="viewProfile" type="submit" class="row align-content-center justify-content-between viewProfile">
                                <div class="col-2">
                                    <?php printImageOthers($userInfoFollowing['userImage']); ?>
                                </div>
                                <div class="col-9">
                                    <?php echo $userInfoFollowing['userDisplay']; ?>
                                </div>
                            </button>
                    </div>
                    <div class="col-4">
                        <button id="unfollowUser" name="unfollowUser" type="submit" class="btn" >Unfollow</button>
                    </div>
                    </form>
                </div>
			</div>
		</div>
		<?php endforeach; ?>
    </div>
</body>
</html>