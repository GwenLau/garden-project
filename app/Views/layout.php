<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/normalize.css') ?>">
	<link href="https://fonts.googleapis.com/css?family=Lobster|Roboto+Condensed:400,400i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel="stylesheet">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
	
	<!-- CDN jQuery -->
	<script src ="https://code.jquery.com/jquery-3.1.1.min.js"
	integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<script src ="<?= $this->assetUrl('js/bootstrap.min.js') ?>" defer></script> 
	<script src ="<?= $this->assetUrl('js/script.js') ?>" defer></script>

</head>
<body>


<div class="wrapper-header">
	<header>
		<nav class="bg-success">
		  <div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="<?= $this->url('default_home') ?>"> YoupiGarden</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li class="active"><a href="<?= $this->url('default_add') ?>">Inscription <span class="sr-only">(current)</span></a></li>
		        <li><a href="<?= $this->url('users_login') ?>">Connexion</a></li>
		        <!-- <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">Action</a></li>
		            <li><a href="#">Another action</a></li>
		            <li><a href="#">Something else here</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="#">Separated link</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="#">One more separated link</a></li>
		          </ul>
		        </li> -->
		      </ul>
		      <form class="navbar-form navbar-left">
		        <!-- <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-default">Rechercher</button> -->
		      </form>
		      <ul class="nav navbar-nav navbar-right">
		        <!-- <li><a href="#">A propos</a></li> -->
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="<?= $this->url('default_dashboard') ?>">Dashboard</a></li>
		            <li><a href="<?= $this->url('default_logout') ?>">Déconnection</a></li>
		  
		          </ul>
		        </li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

		<h1><?= $this->e($title) ?></h1>

	</header>

</div><!-- /.wrapper-header -->
<main>
	<?= $this->section('main_content') ?>
</main>


<footer class="main-footer">
	<h4>YoupiGarden !</h4>
	<a href='#'><i class="fa fa-facebook fa-3x fa-fw"></i></a>
    <a href='#'><i class="fa fa-twitter fa-3x fa-fw"></i></a>
    <a href='#'><i class="fa fa-youtube-play fa-3x fa-fw"></i></a>
	<p>6 rue Gino Raimondi<br />
	54490, Piennes<br />
	08 05 62 23 45</p>
</footer>
<!-- <div class="wrapper-footer">
	<footer>
    <div class="footer">
      <div class="container">
              <a href='#'><i class="fa fa-twitch fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-facebook fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-twitter fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-youtube-play fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-rss fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-vine fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-flickr fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-linkedin fa-3x fa-fw"></i></a>
            </span>
      </div>
    </div>
	</footer>
</div> -->


</body>
</html>