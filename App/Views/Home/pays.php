<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crowdfunding</title>
    <!-- Bootstrap -->
    <link href="<?= ROOT ?>/App/Views/Components/css/bootstrap.css" rel="stylesheet">
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?= ROOT ?>/App/Views/Components/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?= ROOT ?>/App/Views/Components/js/bootstrap.js"></script>
    <!-- Include calendar option -->
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
  <!-- Include all custom functions and js events -->
    <script src="<?= ROOT ?>/App/Views/Components/js/custom.js"></script>

  </head>
  <body style="padding-top: 70px;">
  <div class="container">
    <div class="row">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= ROOT ?>/Public/Home">Index</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bounties <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <?php if(isset($_SESSION['user_id'])): ?>
                  <li><a data-toggle="modal" data-target="#addbounty" href="#">Add</a></li>
                  <?php endif; ?>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Finances <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <?php if(isset($_SESSION['user_id'])): ?>
                  <li><a href="<?= ROOT ?>/Public/Home/allPays">Search All Pays</a></li>
                  <li><a href="<?= ROOT ?>/Public/Home/allShares">Search All Shares</a></li>
                  <?php endif; ?>
                </ul>
              </li>
            </ul>
            <?php if(!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) :?>
            <div class="nav navbar-nav navbar-right">
              <!--<button type="button" class="btn btn-success navbar-btn" data-toggle="modal" data-target="#signup" href="#">Sing Up</button>-->
              <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#login" href="#">Log in</button>
            </div>
            <?php else : ?>
              <div class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['user']?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Profile</a></li>
                  <li><a href="#">Ships</a></li>
                  <li><a href="#">Buys</a></li>
                  <li><a href="<?= ROOT ?>/public/user/logout">Log Out</a></li>
                </ul>
              </li>
            </div>
            <?php endif; ?>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

      <!-- ALERT WITH STATUS MESSAGE -->
      <div class="alert alert-info text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= $msg ?>
      </div>


		<h1><?= $title ?></h1>
		<?php foreach ($pays as $pay): ?>
			<?php if(isset($pay['User']['pays'])): ?>
				<h3>User: <?= $pay['User']['first_name'].$pay['User']['last_name']?></h3>
				<h3>Email: <?= $pay['User']['email']?></h3>

				<table class="table table-striped">
					<tr>
						<th>Reference</th>
						<th>Amount</th>
						<th>Bounty</th>
						<th>Pay Date</th>
					</tr>
					<?php foreach ($pay['User']['pays'] as $val): ?>
						<tr>
							<td><?= $val['pay_reference']?></td>
							<td><?= $val['amount']?></td>
							<td><?= $val['title']?></td>
							<td><?= $val['created']?></td>

						</tr>
					<?php endforeach?>
					
				</table>
			<?php endif; ?>

		<?php endforeach;  ?>

</div><!-- End of Principal Row -->
	</div> <!-- End of Container Class -->
	<?php include(PROJECTPATH.'/App/Views/Elements/Modals/Home/modals.php'); ?>
	
    
    

  </body>
</html>