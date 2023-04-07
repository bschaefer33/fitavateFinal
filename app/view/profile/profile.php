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
	<div class="container profilePage">
		<div class="row align-items-center justify-content-center profileHeader">
			<div class="col-4 profile-img">
				<?php printImage($userImage) ?>
			</div>
			<div class="col profile-info">
				<div class="row userName">
					<h1 class="col col-sm-10"><?php echo $userDisplayName ?></h1>
					<div class="col col-sm-2">
						<a class="btn editButton" href="?page=profile/edit_profile">Edit Profile</a>
					</div>
				</div>
				<div class="row profStats">
					<h5 class="col"><?php echo $userCity . ", " . $userState; ?></h5>
					<h5 class="col">Birthday: <?php echo $birthday; ?></h5>
				</div>
				<div class="row bioRow">
					<h5 class="col"><?php echo $userBio; ?></h5>
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
						<?php foreach ($userArray as $fitine) :?>
                            <?php if($count == 0): ?>
                                <?php if($fitine->viewStatus == 1): ?>
                                    <div class="card">
                                        <div class="card-header row">
                                            <a class="card-link col-10 fitineNameProfile" data-toggle="collapse" href="#collapseOne"><?= $fitine->fitineName ?></a>
											<form class="col-2" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                                    <input name= "saveFitineID" type="hidden" value="<?php echo $fitine->fitineID ?>" />
                                                    <input name= "saveOwnerID" type="hidden" value="<?php echo $fitine->ownerID ?>" />
                                                    <input name="saveFitine" type="submit" class="btn" value="Save Fitine" />
                                            </form>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                                <?= $fitine->printFitineProfile(); ?>
                                                <?php $count=1; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                <?php elseif($count > 0): ?>
                                    <?php if($fitine->viewStatus == 1): ?>
                                        <div class="card">
                                            <div class="card-header row">
                                                <a class='collapsed card-link col-10 fitineNameProfile' data-toggle='collapse' href='#<?= $fitine->fitineID?>'><?= $fitine->fitineName ?></a>
												<form class="col-2" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                                        <input name= "saveFitineID" type="hidden" value="<?php echo $fitine->fitineID ?>" />
                                                        <input name= "saveOwnerID" type="hidden" value="<?php echo $fitine->ownerID ?>" />
                                                        <input name="saveFitine" type="submit" class="btn" value="Save Fitine" />
                                                    </form>
                                            </div>
                                            <div id="<?= $fitine->fitineID ?>" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <?= $fitine->printFitineProfile(); ?>

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
						<?php foreach ($savedArray as $fitine) :?>
							<?php if($savedCount == 0): ?>
								<div class="card">
									<div class="card-header row">
										<a class="card-link col-10 fitineNameProfile" data-toggle="collapse" href="#<?= $fitine->fitineID?>"><?= $fitine->fitineName ?></a>
										<form class="col-2" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
											<input name= "saveFitineID" type="hidden" value="<?php echo $fitine->fitineID ?>" />
                                            <input name= "saveOwnerID" type="hidden" value="<?php echo $fitine->ownerID ?>" />
											<input name="saveFitine" type="submit" class="btn" value="Save Fitine" />
										</form>
									</div>
									<div id="collapseOne" class="collapse show" data-parent="#accordion">
										<div class="card-body">
											<?= $fitine->printFitineProfile(); ?>
											<?php $savedCount=1; ?>

										</div>
									</div>
								</div>
							<?php else: ?>
								<div class="card">
									<div class="card-header row">
										<a class='collapsed card-link col-10 fitineNameProfile' data-toggle='collapse' href='#<?= $fitine->fitineID?>'><?= $fitine->fitineName ?></a>
										<form class="col-2" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
											<input name= "saveFitineID" type="hidden" value="<?php echo $fitine->fitineID ?>" />
											<input name="saveFitine" type="submit" class="btn" value="Save Fitine" />
										</form>
									</div>
									<div id="<?= $fitine->fitineID ?>" class="collapse" data-parent="#accordion">
										<div class="card-body">
											<?= $fitine->printFitineProfile(); ?>
											
										</div>
									</div>
								</div>
							<?php endif ?>
						<?php endforeach; ?>
                    </div>
				</div>
				<!--Shows the user's follower-->
				<div class="tab-pane fade" id="followers" role="tabpanel">
					<ul class="list-group">
						<?php foreach ($resultFollowers as $follower): ?>
							<?php $secUserID= $follower['following_id']; ?>
							<?php $secUser = createSecondaryUser($follower['following_id']); ?>
								<form class="row" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
									<label class="col secProfImg"><?php printImage($secUser['userImage']); ?></label>
									<label class="col"><?php echo $secUser['userDisplay']; ?></label>
									<input class="col" type="hidden" name="secUserID" value="<?php echo $secUserID ?>" />
									<input name="secUserProf"id="secUserProf" type="submit" class="btn col" value="ViewProfile" />
								</form>
						<?php endforeach; ?>
					</ul>
				</div>
				<!--Shows who the user is following-->
				<div class="tab-pane fade" id="following" role="tabpanel">

				</div>
			</div>
		</div>
	</div>
</body>
</html>