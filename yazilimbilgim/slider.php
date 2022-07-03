<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Auto Play Slider Two</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
    .img-slider {
        position: relative;
        width: 98%;
        height: 500px;
        /*display: grid;*/
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        place-items: center;
        /*margin: 30px 10px 10px 10px;*/
        margin: 25px 10px;
        border-radius: 11px;
    }

    .img-slider .slide {
        z-index: 1;
        position: absolute;
        /*width: 1000px;*/
        width: 100%;
        max-width: 100%;
        clip-path: circle(0% at 0 50%);
        border-radius: 15px;
        overflow: hidden;
        /*box-shadow: 0 0 15px rgba(0,0,0,0.5);*/

    }

    .img-slider .slide.active {
        clip-path: circle(150% at 0 50%);
        transition: 2s;
        transition-property: clip-path;
        border-radius: 15px;

    }

    .img-slider .slide img {
        z-index: 1;
        width: 100%;
        border-radius: 15px;
    }

    .img-slider .slide .info {
        position: absolute;
        top: 0px;
        width: 100%;
        height: 100%;
        display: grid;
        place-items: center;
        padding: 15px 30px;
    }

    .img-slider .slide .info h2 {
        color: #fff;
        font-size: 45px;
        text-transform: uppercase;
        font-weight: 800;
        margin: 0;
        letter-spacing: 2px;
    }

    .img-slider .slide .info p {
        color: #fff;
        background: rgba(0, 0, 0, 0.1);
        font-size: 16px;
        margin: 0;
        border-radius: 4px;
        position: absolute;
        z-index: 3;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        padding: 3px;
        clip-path: circle(150% at 0 50%);

    }

    .img-slider .navigation {
        z-index: 2;
        position: absolute;
        display: flex;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
    }

    .img-slider .navigation .btn {
        background: rgba(255, 255, 255, 0.5);
        width: 12px;
        height: 12px;
        margin: 10px;
        border-radius: 50%;
        cursor: pointer;
        transition: .3s;
        padding: 0;
    }

    .img-slider .navigation .btn:hover {
        background: black;
    }

    .img-slider .navigation .btn.active {
        background: black;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
    }


    @media (max-width: 820px) {
        .img-slider {
            height: 375px;
            margin: 20px 5px 15px 5px;
        }

        .img-slider .slide .info {
            padding: 10px 25px;
        }

        .img-slider .slide .info h2 {
            font-size: 35px;
        }

        .img-slider .slide .info p {
            width: 70%;
            font-size: 15px;
        }

        .img-slider .navigation {
            bottom: 25px;
        }

        .img-slider .navigation .btn {
            width: 10px;
            height: 10px;
            margin: 8px;
        }
    }

    @media (max-width: 620px) {
        .img-slider {
            height: 250px;
        }

        .img-slider .slide .info {
            padding: 10px 20px;
        }

        .img-slider .slide .info h2 {
            font-size: 30px;
        }

        .img-slider .slide .info p {
            width: 80%;
            font-size: 13px;
        }

        .img-slider .navigation {
            bottom: 15px;
        }

        .img-slider .navigation .btn {
            width: 8px;
            height: 8px;
            margin: 6px;
        }
    }

    @media (max-width: 420px) {
        .img-slider {
            height: 200px;
        }

        .img-slider .slide .info {
            padding: 5px 10px;
        }

        .img-slider .slide .info h2 {
            font-size: 25px;
        }

        .img-slider .slide .info p {
            width: 90%;
            font-size: 11px;
        }

        .img-slider .navigation {
            bottom: 10px;
        }
    }
    </style>
</head>

<body>
<div class="img-slider">
<?php
if (!empty($conn)) {
    $slider=$conn->prepare("select * from konular where konu_durum=? order by konu_id limit 1 ");
$slider->execute(array(1));
$m = $slider->fetchAll(PDO::FETCH_ASSOC);
$k = $slider->rowCount();
if ($k){
    foreach ($m as $d){
      ?>
        <div class="slide active">
            <img src="<?php echo $d["konu_resim"];  ?>" alt="<?php echo $d["konu_baslik"];  ?>">
            <div class="info">
                <a href="?do=devam&id=<?php echo $d["konu_id"]; ?> "> <p> <?php echo $d["konu_baslik"];  ?></p> </a>
            </div>
        </div>

        <?php
    }
}
}
?>

    <?php

        $slider2=$conn->prepare("select * from konular where konu_durum=? order by konu_id desc limit 4 ");
        $slider2->execute(array(1));
        $a = $slider2->fetchAll(PDO::FETCH_ASSOC);
        $l = $slider2->rowCount();
        if ($l){
            foreach ($a as $e){
                ?>
                <div class="slide">
                    <img src="<?php echo $e["konu_resim"];  ?>" alt="<?php echo $d["konu_baslik"];  ?>">
                    <div class="info">
                        <a href="?do=devam&id=<?php echo $d["konu_id"]; ?> "> <p> <?php echo $e["konu_baslik"];  ?></p> </a>
                    </div>
                </div>

                <?php
            }
        }

    ?>





        <div class="navigation">
            <div class="btn active"></div>
            <div class="btn"></div>
            <div class="btn"></div>
            <div class="btn"></div>
            <div class="btn"></div>
        </div>
    </div>

    <script type="text/javascript">
    var slides = document.querySelectorAll('.slide');
    var btns = document.querySelectorAll('.btn');
    let currentSlide = 1;

    // Javascript for image slider manual navigation
    var manualNav = function(manual) {
        slides.forEach((slide) => {
            slide.classList.remove('active');

            btns.forEach((btn) => {
                btn.classList.remove('active');
            });
        });

        slides[manual].classList.add('active');
        btns[manual].classList.add('active');
    }

    btns.forEach((btn, i) => {
        btn.addEventListener("click", () => {
            manualNav(i);
            currentSlide = i;
        });
    });

    // Javascript for image slider autoplay navigation
    var repeat = function(activeClass) {
        let active = document.getElementsByClassName('active');
        let i = 1;

        var repeater = () => {
            setTimeout(function() {
                [...active].forEach((activeSlide) => {
                    activeSlide.classList.remove('active');
                });

                slides[i].classList.add('active');
                btns[i].classList.add('active');
                i++;

                if (slides.length == i) {
                    i = 0;
                }
                if (i >= slides.length) {
                    return;
                }
                repeater();
            }, 5000);
        }
        repeater();
    }
    repeat();
    </script>

</body>

</html>