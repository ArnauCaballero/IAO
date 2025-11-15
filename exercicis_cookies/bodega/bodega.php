<html> 
    <body>
        <?php
            $majoredat_nom = "majoredat";
            $idioma_nom = "idioma";
            $moneda_nom = "moneda";
            $majoredat_value = $_POST['majoredat'];
            $idioma_value = $_POST['idioma'];
            $moneda_values = $_POST['moneda'];
            setcookie($majoredat_nom,$majoredat_value,time() + (30 * 24 * 60 * 60));
            setcookie($idioma_nom,$idioma_value,time() + (30 * 24 * 60 * 60));
            setcookie($moneda_nom,$moneda_values,time() + (30 * 24 * 60 * 60));
            if ($_COOKIE['majoredat']=="true"){
                if ($_COOKIE['idioma']=="catala"&&$_COOKIE['moneda']=="€"){
                    echo "Vi blanc: 39" . $_COOKIE['moneda']."<br>";
                    echo "Whisky: 14" . $_COOKIE['moneda']."<br>";
                    echo "T’oferim el vi “Les Terrasses” a un preu de 39". $_COOKIE['moneda'];
                }elseif ($_COOKIE['idioma']=="catala"){
                    echo "Vi blanc: 39" . $_COOKIE['moneda']."<br>";
                    echo "Whisky: 14" . $_COOKIE['moneda'];
                }elseif ($_COOKIE['idioma']=="espanyol"){
                    echo "Vino blanco: 39" . $_COOKIE['moneda']."<br>";
                    echo "Whisky: 14" . $_COOKIE['moneda'];
                }elseif ($_COOKIE['idioma']=="angles"){
                    echo "White vine: 39" . $_COOKIE['moneda']."<br>";
                    echo "Whisky: 14" . $_COOKIE['moneda'];
                }
            }else{
                if ($_COOKIE['idioma']=="catala"){
                    echo "<p>No et podem vendre alcohol si ets menor d’edat.</p>";
                }elseif ($_COOKIE['idioma']=="espanyol"){
                    echo "<p>No te podemos vender alcohol si eres menor de edad.</p>";
                }elseif ($_COOKIE['idioma']=="angles"){
                    echo "<p>We cannot sell you alcohol if you are underage.</p>";
                }
            }
        ?>
        <br><a href="./bodega.html">Canviar formulari</a>
    </body>
</html>