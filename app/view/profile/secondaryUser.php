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
	<div class="container-fluid profilePage">
        <div class="container">
			<div class="row align-items-center justify-content-center profileHeader">
				<div class="col-4 profile-img">
					<?php printImage($secUserImage) ?>
				</div>
				<div class="col-7 profile-info">
					<div class="row userName">
						<h1 class="col-8"><?php echo $secUserDisplayName ?></h1>
					</div>
					<div class="row justify-content-between profStats">
						<h5 class="col-6"><?php echo $secUserCity . ", " . $secUserState; ?></h5>
						<h5 class="col-5">Birthday: <?php echo $secUserBirthday; ?></h5>
					</div>
					<div class="row bioRow">
						<p class="col p-2"><?php echo $secUserBio; ?></p>
					</div>
				</div>
			</div>
		</div>
        <div class="container pageContent">
			<div>
				<ul class="nav nav-tabs nav-fill" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="fitines-tab" data-toggle="tab" href="#fitines" role="tab">Fitines</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="followers-tab" data-toggle="tab" href="#followers" role="tab">Followers</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="following-tab" data-toggle="tab" href="#following" role="tab">Following</a>
					</li>
				</ul>
			</div>
			<div class="tab-content" id="myTabContent">
				<!--includes fitavations-->
				<div class="tab-pane fade show active" id="home" role="tabpanel">
                    
                </div>
                <!--Shows the fitines of the user-->
                <div class="tab-pane fade" id="fitines" role="tabpanel">
                    <h1 class="sectionHeader">User Created Fitines</h1>
					<div id="accordion">
						<?php foreach ($secUserArray as $secFitine) :?>
                            <?php if($secCount == 0): ?>
                                <?php if($secFitine->viewStatus == 1): ?>
                                    <div class="card">
                                        <div class="card-header row">
                                            <a class="card-link col-6 fitineNameProfile" data-toggle="collapse" href="#collapseOne"><?= $secFitine->fitineName ?></a>
                                            <h5 class="col- 3"><?php echo date('m-d-Y', strtotime($secFitine->dateCreated)); ?></h5>
											<form class="col-2" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                                <input name= "saveFitineID" type="hidden" value="<?php echo $secFitine->fitineID ?>" />
                                                <input name= "saveOwnerID" type="hidden" value="<?php echo $secFitine->ownerID ?>" />
                                                <?php if (in_array($secFitine->fitineID, $userFitineCheck)) :?>
                                                    <input name= "unfollowOthersFitine" type="submit" value="Unfollow Fitine" />
                                                <?php else: ?>
                                                    <input name= "saveOthersFitine" type="submit" value="Save Fitine" />
                                                <?php endif; ?>
                                            </form>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                            <div class="row justify-content-between">
												<?php $userInfoFollowers = createSecondaryUser($secFitine->ownerID); ?>
							  					<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
													<input name= "saveSecUserID" type="hidden" value="<?php echo $secFitine->ownerID; ?>" />
													<button id="viewProfile" name="viewProfile" type="submit" class="btn col-7 viewProfBtn">
														<?php printImageOthers($userInfoFollowers['userImage']); ?>
														<?php echo $userInfoFollowers['userDisplay']; ?>
													</button>
													<?php if(in_array($secFitine->owner_id, $userFollowCheck)):?>
														<button id="unfollowUser" name="unfollowUser" type="submit" class="btn col-4 unfollBtn" >Unfollow</button>
													<?php else: ?>
														<button id="followUser" name="followUser" type="submit" class="btn col-4 follBtn">Follow</button>
													<?php endif; ?>
												</form>
											</div>
											<div class="row">
												<?= $secFitine->printFitineBody(); ?>
											</div>
											    <?php $savedCount=1; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                <?php elseif($secCount > 0): ?>
                                    <?php if($secFitine->viewStatus == 1): ?>
                                        <div class="card">
                                            <div class="card-header row">
                                                <a class='collapsed card-link col-10 fitineNameProfile' data-toggle='collapse' href='#<?= $secFitine->fitineID?>'><?= $fitine->fitineName ?></a>
												<form class="col-2" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                                    <input name= "saveFitineID" type="hidden" value="<?php echo $secFitine->fitineID ?>" />
                                                    <input name= "saveOwnerID" type="hidden" value="<?php echo $secFitine->ownerID ?>" />
                                                    <?php if (in_array($secFitine->fitineID, $userFitineCheck)) :?>
                                                        <input name= "unfollowOthersFitine" type="submit" value="Unfollow Fitine" />
                                                    <?php else: ?>
                                                        <input name= "saveOthersFitine" type="submit" value="Save Fitine" />
                                                    <?php endif; ?>
                                                </form>
                                            </div>
                                            <div id="<?= $secFitine->fitineID ?>" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <?= $secFitine->printFitineProfile(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                <?php else: ?>
                                    <h4>Error</h4>
                                <?php endif; ?>
						<?php endforeach; ?>
                    </div>
                    <h1 class = "sectionHeader">User's Saved Fitines</h1>
					<div id="accordion">
						<?php foreach ($secSavedArray as $fitine) :?>
							<?php if($secSavedCount == 0): ?>
								<div class="card">
									<div class="card-header row">
										<a class="card-link col-10 fitineNameProfile" data-toggle="collapse" href="#<?= $fitine->fitineID?>"><?= $fitine->fitineName ?></a>
										<form class="col-2" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                            <input name= "saveFitineID" type="hidden" value="<?php echo $fitine->fitineID ?>" />
                                            <input name= "saveOwnerID" type="hidden" value="<?php echo $fitine->ownerID ?>" />
                                            <?php if (in_array($fitine->fitineID, $userFitineCheck)) :?>
                                                <input name= "unfollowOthersFitine" type="submit" value="Unfollow Fitine" />
                                            <?php else: ?>
                                                <input name= "saveOthersFitine" type="submit" value="Save Fitine" />
                                            <?php endif; ?>
                                        </form>
									</div>
									<div id="collapseOne" class="collapse show" data-parent="#accordion">
										<div class="card-body">
											<?= $fitine->printFitineBody(); ?>
											<?php $secSavedCount=1; ?>

										</div>
									</div>
								</div>
							<?php else: ?>
								<div class="card">
									<div class="card-header row">
										<a class='collapsed card-link col-10 fitineNameProfile' data-toggle='collapse' href='#<?= $fitine->fitineID?>'><?= $fitine->fitineName ?></a>
										<form class="col-2" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                            <input name= "saveFitineID" type="hidden" value="<?php echo $fitine->fitineID ?>" />
                                            <input name= "saveOwnerID" type="hidden" value="<?php echo $fitine->ownerID ?>" />
                                            <?php if (in_array($fitine->fitineID, $userFitineCheck)) :?>
                                                <input name= "unfollowOthersFitine" type="submit" value="Unfollow Fitine" />
                                            <?php else: ?>
                                                <input name= "saveOthersFitine" type="submit" value="Save Fitine" />
                                            <?php endif; ?>
                                        </form>
									</div>
									<div id="<?= $fitine->fitineID ?>" class="collapse" data-parent="#accordion">
										<div class="card-body">
											<?= $fitine->printFitineBody(); ?>
											
										</div>
									</div>
								</div>
							<?php endif ?>
						<?php endforeach; ?>
                    </div>
                </div>
                <!--Shows the user's follower-->
				<div class="tab-pane fade" id="followers" role="tabpanel">
                    <?php foreach ($secondUserFollowers as $otherFollower): ?>
						<div class="card">
  							<div class="card-body">
								<?php $otherUserInfo = createSecondaryUser($otherFollower['following_id']); ?>
							  	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
									<input name= "saveOtherUserID" type="hidden" value="<?php echo $otherFollower['following_id']; ?>" />
									<button id="viewProfile" name="viewProfile" type="submit" class="btn">
										<?php printImageOthers($otherUserInfo['userImage']); ?>
										<?php echo $otherUserInfo['userDisplay']; ?>
									</button>
                                    <?php if($otherFollower['following_id'] == $userIDprof) : ?>
                                        <input id="unfollowOtherUser" name="unfollowOtherUser" type="submit" class="btn" value="Unfollow" style="visibility: hidden" />
                                        <input id="followOtherUser" name="followOtherUser" type="submit" class="btn" value="Follow" style="visibility: hidden"/>
									<?php elseif(in_array($otherFollower['following_id'], $userFollowCheck)):?>
										<input id="unfollowOtherUser" name="unfollowOtherUser" type="submit" class="btn" value="Unfollow" />
									<?php else: ?>
										<input id="followOtherUser" name="followOtherUser" type="submit" class="btn" value="Follow" />
									<?php endif; ?>
								</form>
    							
  							</div>
						</div>
					<?php endforeach; ?>
                </div>
                <!--Shows who the user is following-->
				<div class="tab-pane fade" id="following" role="tabpanel">
                <?php foreach ($secondUserFollowing as $otherFollowing): ?>
						<div class="card">
							<div class="card-body">
								<?php $userInfoFollowing = createSecondaryUser($otherFollowing['user_id']); ?>
							  	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
									<input name= "saveOtherUserID" type="hidden" value="<?php echo $otherFollowing['user_id']; ?>" />
									<button id="viewProfile" name="viewProfile" type="submit" class="btn">
										<?php printImageOthers($userInfoFollowing['userImage']); ?>
										<?php echo $userInfoFollowing['userDisplay']; ?>
									</button>
                                    <?php if($otherFollowing['user_id'] == $userIDprof) :?>
                                        <input id="unfollowOtherUser" name="unfollowOtherUser" type="submit" class="btn" value="Unfollow" style="visibility: hidden" />
                                        <input id="followOtherUser" name="followOtherUser" type="submit" class="btn" value="Follow" style="visibility: hidden"/>
									<?php elseif(in_array($following['user_id'], $userFollowCheck)):?>
										<button id="unfollowOtherUser" name="unfollowUser" type="submit" class="btn" >Unfollow</button>
									<?php else: ?>
										<button id="followOtherUser" name="followUser" type="submit" class="btn">Follow</button>
									<?php endif; ?>
								</form>
							</div>
						</div>
					<?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

