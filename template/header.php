<?php

?>
<div class="top-bar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <div class="right-top">
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="right-top">
                    <div class="email-box">
                        <a href="my_account.php"><i class="fa fa-envelope-o" aria-hidden="true"></i>My account</a>
                    </div>
                    <div class="email-box">
                        <a href="cart.php"><i src="images/cart.png" height="50" width="50" aria-hidden="true"></i><?= isset($cart_count) ? $cart_count : 0 ?> items</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<header class="header header_style_01">
    <nav class="megamenu navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img src="images/logos/logo.png" height="50" width="200" alt="image">
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="healthplan.php">Healthy Meal Plans</a></li>
                    <li><a href="services.php">Product & Services</a></li>
                    <li><a  href="contact.php">About Us</a></li>
                    
                </ul>

                <ul class="nav navbar-nav navbar-right">
                	<li class="dropdown">
                        <a    href="receipe.php">Recipes</a>
                        <div class="dropdown-content">
                            <a href="breakfast.php">Breakfast Recipe</a>
                            <a href="salad.php">Salad Recipe</a>
                            <a href="lunch.php">Lunch Recipe</a>
                            <a href="dinner.php">Dinner Recipe</a>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                	
                    <li><a  href="index.php">Home</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
