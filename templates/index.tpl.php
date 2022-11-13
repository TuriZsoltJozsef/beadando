<?php session_start(); ?>
<?php if(file_exists('./logicals/'.$keres['fajl'].'.php')) { include("./logicals/{$keres['fajl']}.php"); } ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $ablakcim['cim'] . ( (isset($ablakcim['mottó'])) ? ('|' . $ablakcim['mottó']) : '' ) ?></title>
	<link rel="stylesheet" href="./styles/stilus.css" type="text/css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	
	<?php if(file_exists('./styles/'.$keres['fajl'].'.css')) { ?><link rel="stylesheet" href="./styles/<?= $keres['fajl']?>.css" type="text/css"><?php } ?>
	<?php
    $rnd = rand (1,9);
?>

</head>
<body style="background: url('https://szentferencalapitvany.org/wp-content/themes/szentferenc/images/devai-szentferenc-bg-<?php echo $rnd ?>.jpg') center 0 no-repeat;">
<div id="wrapper" class="parent">
<header id="header" class="parent">
<div class="col-full parent">
		<div class="top_menu_search">	
		
					
					<!--<div class="search_main">
				<form method="get" class="searchform" action="https://szentferencalapitvany.org/" >
					<input type="text" class="field s" name="s" value="Search..." onfocus="if ( this.value == 'Search...' ) { this.value = ''; }" onblur="if ( this.value == '' ) { this.value = 'Search...'; }" />
					<input type="image" src="https://szentferencalapitvany.org/wp-content/themes/szentferenc/images/ico-search.png" class="search-submit" name="submit" alt="Submit" />
				</form>   
			</div><!--/.search_main-->
				
		</div><!--/.top_menu_search-->
	
		<!--		<a id="logo" href="." title="Böjte Csaba OFM">
                    <img src="./images/logo.png" alt="Szent Ferenc Alapítvány">
                </a>-->
		
		<div id="search-social">
			<div class="social-icons">
				<a class="magyarver" target="_blank" href="http://szentferencalapitvany.org/">Magyar</a>
				<a class="deutschver" target="_blank" href="http://szentferencalapitvany.org/de">Deutsch</a>
				<a class="facebook" href="https://www.facebook.com/pages/Magnificatro-B%C3%B6jte-Csaba-OFM-D%C3%A9vai-Szent-Ferenc-Alap%C3%ADtv%C3%A1ny-honlapja/161816877193336?fref=ts">Facebook oldalunk</a>
				<a class="googleplus" href="https://plus.google.com/communities/112038451241160591525">Google+ közösségünk</a>
			</div>
			
			<div class="search_main fix">
    <form method="get" class="searchform" action="https://szentferencalapitvany.org/">
        <input type="text" class="field s" name="s" value="Keresés..." onfocus="if ( this.value == &#39;Keresés...&#39; ) { this.value = &#39;&#39;; }" onblur="if ( this.value == &#39;&#39; ) { this.value = &#39;Keresés...&#39;; }">
        <input type="submit" value="Keresés" class="search-submit" name="submit" alt="Submit">
    </form>    
</div><!--/.search_main-->
		</div>
		<aside id="nav">
            <nav id="navigation" role="navigation" class="parent">
                <ul id="main-nav" class="nav parent">
					<?php foreach ($oldalak as $url => $oldal) { ?>
						<?php if(! isset($_SESSION['login']) && $oldal['menun'][0] || isset($_SESSION['login']) && $oldal['menun'][1]) { ?>
							<li <?= (($oldal == $keres) ? ' class="active"' : '') ?>>
							<a href="<?= ($url == '/') ? '.' : ('?oldal=' . $url) ?>">
							<?= $oldal['szoveg'] ?></a>
							</li>
						<?php } ?>
					<?php } ?>
                </ul>
            </nav>
        </aside>
		<div class="logo"><a href="."><img src="./images/<?=$fejlec['kepforras']?>" alt="<?=$fejlec['kepalt']?>"></a></div>
		<h1><?= $fejlec['cim'] ?></h1>
		<?php if (isset($fejlec['motto'])) { ?><h2><?= $fejlec['motto'] ?></h2><?php } ?>
		<?php if(isset($_SESSION['login'])) { ?>Bejlentkezve: <strong><?= $_SESSION['csn']." ".$_SESSION['un']." (".$_SESSION['login'].")" ?></strong><?php } ?>
	</header>
		
    
        <div id="content">
            <?php include("./templates/pages/{$keres['fajl']}.tpl.php"); ?>
        </div>
    </div>
    <footer id="copyright">
        <?php if(isset($lablec['copyright'])) { ?><?= $lablec['copyright'] ?>&nbsp;&copy;&nbsp; <?php } ?>
		&nbsp;
        <?php if(isset($lablec['ceg'])) { ?><?= $lablec['ceg']; ?><?php } ?>
		<a href="https://szentferencalapitvany.org/">https://szentferencalapitvany.org/</a>
    </footer>
</body>
</html>
 
