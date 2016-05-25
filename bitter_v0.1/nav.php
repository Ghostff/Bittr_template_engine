<?php
if (!defined('INDEX')) header('location: 404.html');
?>
<header id="hero" class="hero overlay">
    <nav class="navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            <a href="/" class="brand">
                <img src="img/logo.png" alt="Knowledge">
            </a>
        </div>
        <div class="navbar-collapse collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/">
                        Features
                    </a>
                </li>
                <li>
                    <a href="/manual/en/">
                         documentation
                    </a>
                </li>
                <li>
                    <a href="/manual/en/">
                        community
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div class="masthead text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="wrap">
                        <div class="type-wrap">
                            <div id="typed-strings">
                            	<p>[BITTER]</p>
                                <p>[ TITLE ]</p>
                                <p>[ POST.ID ]</p>
                                <p>[ ADMIN.NAME|VAR ]</p>
                                <p>[ BITTER.</p>
                            </div>
                            <span id="typed"></span>
                        </div>
                    </div>
                    <p class="lead text-muted">Bitter is a flexible, smart and secured template engine for php. </p>
                    <form>
                        <input class="search-field" placeholder="Search Something ... " type="text">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <a href="#" class="btn btn-hero"><span class="icon-dwnl"></span> Download &nbsp;&nbsp;&nbsp;<span class="icon-right"></span></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-hero"><span class="icon-git"></span>Fork On Git<span class="icon-right"></span></a>
                </div>
            </div>
        </div>
    </div>
</header>
