<div class="mainHeader sticky-top" style="z-index: 9999; border-bottom: 1px solid #f1f1f1;">
    <div class="container ">
        <nav class="navbar navbar-expand-lg navbar-light mg-auto">
            <a class="navbar-brand hidden-sm-down col-xl-3 col-lg-3 col-md-2" href="/">
                <img src="<?php echo site_info("logo"); ?>">
            </a>
            <button class="navbar-dark navbar-toggler col-xl-3 col-lg-3 col-md-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse mg-auto navbar-collapse col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 justify-content-around" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto flex-wrap   justify-content-center text-align-center">
                    <li class="nav-item active">
                        <a class="nav-link current" href="/">
                            <?php echo t(42)[$l]; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">
                            <?php echo t(2)[$l]; ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo t(3)[$l]; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php 
                                foreach (categories() as $key) {
                                    echo "<a class=\"dropdown-item\" href=\"categories?id=".urlencode(base64_encode($key['id']))."\">".$key['name']."</a>";
                                }
                             ?>                            
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo t(4)[$l]; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/account?current=settings"><?php echo t(5)[$l]; ?></a>
                            <a class="dropdown-item" href="/account?current=orders"><?php echo t(6)[$l]; ?></a>
                            <a class="dropdown-item" href="/account?current=payments"><?php echo t(7)[$l]; ?></a>
                            <a class="dropdown-item" href="/account?current=cart"><?php echo t(8)[$l]; ?></a>
                            <form class="dropdown-item" method="POST"><button type="submit" name="logout" style="color:pink; outline: none; border: none; background: none;"><?php echo t(9)[$l]; ?> </button></form>
                            
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">
                            <?php echo t(10)[$l]; ?>
                        </a>
                    </li>
                    <div class="btn-group">
                      <a class="nav-link dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" style="font-size: 20px;padding: 5px 4px;">
                        <i class="fas fa-language"></i>
                      </a>
                      <div class="dropdown-menu" style="top: 100%;">
                        <?php 
                            foreach (t(1) as $key => $value) {
                                echo '<a href="?language='.$key.'&next='.$ext_url.'" class="dropdown-item">'.$value.'</a>';
                            }
                         ?>
                                    
                      </div>
                    </div>

                </ul>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <ul class="navbar-nav mr-auto flex-wrap align-items-center text-align-end col-sm-12 justify-content-end d-flex  d-flex justify-content-around flex-row" style="font-size: 20px;">
                    <li role="button" class="nav-item mg-auto col-sm-3" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true" onmouseover="document.getElementById('searchProduct').focus()">
                        <a href="/search" class="nav-link">
                            <i class="fas fa-search"></i>
                        </a>
                        <form class="dropdown-menu" aria-labelledby="navbarDropdown" method="GET" action="/search">
                            <input style="outline: none;" placeholder="<?php echo t(11)[$l]; ?>" type="search" id="searchProduct" name="search">
                        </form>
                    </li> 
                    <li role="button" class="nav-item mg-auto col-sm-3">
                        <a href="/account?current=cart" class="nav-link">
                           <i class="fas fa-shopping-cart"></i>
                        </a>                        
                    </li>
                    <li role="button" class="nav-item mg-auto col-sm-5">
                        <a href="/login" class="nav-link d-flex justify-content-around align-items-center">
                            <i class="fas fa-user"></i>
                            <?php 
                                if (isset($user_data) && isset($user_data['lname'])) {
                                    ?>
                                        <span class="col-sm-5 text-align-end" style="font-size: 12px;"><?php echo $user_data['lname']; ?></span>
                                    <?php
                                }
                             ?>
                            
                        </a>
                    </li>
                </ul>
            </div>
            </div>            
        </nav>
    </div>
    <div class="loader"><div class="loaded"></div></div>
</div>