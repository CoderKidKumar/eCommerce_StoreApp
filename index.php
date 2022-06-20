<?php require "header.php"; ?>
<!-- Image Slider-->
<div id="slides" class="carousel slide" data-ride="carousel" data-interval="5000">
    <ul class="carousel-indicators">
        <li data-target="#slides" data-slide-to="0" class="active"></li>
        <li data-target="#slides" data-slide-to="1"></li>
        <li data-target="#slides" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url(img/home/new-slide1.jpg)">
            <div class="carousel-caption d-none d-md-block">
                <h4>Welcome To Apostolic Men Wear-House</h4>
                <p>Save 15% on your first order</p>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url(img/home/slide2.jpg)">
            <div class="carousel-caption d-none d-md-block">
                <h4>Fall Styles Are Here!</h4>
                <p>Come and order while supplies last</p>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url(img/home/slide3.jpg)">
            <div class="carousel-caption d-none d-md-block">
                <h4>Want to Make Your Own Style?</h4>
                <p>Add items to your kit, and save 25% of your order</p>
            </div>
        </div>
    </div>
</div>
<!--Message Section-->
<div class="container-fluid padding">
    <div class="row welcome text-center">
        <div class="col-12">
            <h3 class="display-4">Where Style and Holiness Meet</h3>
            <h6 class="lead">
                We offer many styles for Apostolic men, so that you can stay stylish
                for any Sunday service. Take a look at the categories we have below.
            </h6>
        </div>
    </div>
</div>
<!-- Two 3 Column Sections-->
<div class="container-fluid padding">
    <div class="row products text-center padding">
        <div class="col-xs-12 col-sm-4 col-md-2">
            <a href="products.php?items=coats">
                <img src="img/home/jackets1.jpg" />
            </a>
            <h5>Coats</h5>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2">
            <a href="products.php?items=shirts">
                <img src="img/home/shirts.jpg" />
            </a>
            <h5>Shirts</h5>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2">
            <a href="products.php?items=ties">
                <img src="img/home/ties.jpg" />
            </a>
            <h5>Ties</h5>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2">
            <a href="products.php?items=pants">
                <img src="img/home/pants.jpg" />
            </a>
            <h5>Pants</h5>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2">
            <a href="products.php?items=shoes">
                <img src="img/home/shoes.jpg" />
            </a>
            <h5>Shoes</h5>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2">
            <a href="products.php?items=all">
                <img class="imgArrow" src="img/home/arrow.png" />
            </a>
            <h5>All Items...</h5>
        </div>
    </div>
</div>
<?php require "footer.html"; ?>
