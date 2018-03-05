<?php
    $backgroundImage = "img/sea.jpg";
    
    if(isset($_GET['keyword'])){
        echo "You searched for: " . $_GET['keyword'];
        include 'api/pixabayAPI.php';
        $imageURLs = getImageURLs($_GET['keyword']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" href="" />
        <style>
            @import url("css/styles.css");
            body {
                background-image: url('<?=$backgroundImage ?>');
            }
        </style>
    </head>
    <body>
        <br/> <br/>
        <?php
            if(!isset($imageURLs)){
                echo "<h2> Type a keyword to display a slideshow <br /> with random images from Pixbay.com </h2>";
            } else { //form was submitted
                    //print_r($imageURLs); //checking that $imageURLs is not null
        ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicatord Here -->
            <ol class="carousel-indicators">
                <?php
                    for($i = 0; $i < 7; $i++){
                        echo "<li data-target= '#carousel-example-generic' data-slide-to='$i'";
                        echo ($i == 0) ? "class='active'" : "";
                        echo "></li>";
                    }
                ?>
            </ol>
            <div class="carousel-inner" role="listbox">
            <?php
                // Display Carousel Here
                for($i = 0; $i < 7; $i++){
                    do {
                        $randomIndex = rand(0, count($imageURLs));
                    } while (!isset($imageURLs[$randomIndex]));
                    
                    echo '<div class="item ';
                    echo ($i == 0) ? "active" : "";
                    echo '">';
                    echo'<img src"' . $imageURLs[$randomIndex] . '">';
                    echo '</div>';
                    unset($imageURLs[$randomIndex]);
                }
            ?>
            </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
        <?php
            } // End of the else statment
        ?>
        <br>
        
        <form>
            <input type="text" name="keyword" placeholder="Keyword" value="<?=$_GET['keyword']?>"/>
            <input type="radio" id="lhorizontal" name="layout" value="horizontal"/>
            <label for="Horizontal"></label><label for="lhorizontal"> Horizontal </label>
            <input type="radio" id="lvertical" name="layout" value="vertical"/>
            <label for="Vertical"></label><label for="lvertical"> Vertical </label>
            <select name = "category">
                <option value="">Select One</option>
                <option value="ocean">Sea</option>
                <option>Forest</option>
                <option>Mountain</option>
                <option>Snow</option>
            </select>
            <input type="submit" value="Search"/>
        </form>
        <br/> <br/>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>