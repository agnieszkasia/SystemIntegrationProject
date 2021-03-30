<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro:900|Overpass" rel="stylesheet">

</head>
<body>
    <div id="app">
        <div class="container-fluid">
            <div class="row">
                <form method="post" action="../../app/Controllers/Controller.php">
                    <input class="btn btn-dark m-2" type="submit" name="importTxtFile" id="importTxtFile" value="IMPORTUJ Z PLIKU TXT">
                    <input class="btn btn-dark m-2" type="submit" name="importXmlFile" id="importXmlFile" value="IMPORTUJ Z PLIKU XML">
                </form>
                <table class='table table-striped table-responsive'>
                    <thead class='thead-dark'>
                    <tr>
                        <th><div style='width: 100px'>Nazwa producenta</div></th>
                        <th><div style='width: 70px'>Przekatna ekranu</div></th>
                        <th><div style='width: 100px'>Rozdzielczosc ekranu</div></th>
                        <th><div style='width: 120px'>Rodzaj powierzechni ekranu</div></th>
                        <th><div style='width: 70px'>Ekran dotykowy</div></th>
                        <th><div style='width: 80px'>Nazwa procesora</div></th>
                        <th><div style='width: 80px'>Liczba rdzeni fizycznych</div></th>
                        <th><div style='width: 130px'>Predkosc taktowania MHz</th>
                        <th><div style='width: 80px'>Wielkosc pamieci RAM</div></th>
                        <th><div style='width: 80px'>Pojemnosc dysku</div></th>
                        <th><div style='width: 80px'>Rodzaj dysku</div></th>
                        <th><div style='width: 170px'>Nazwa ukladu graficznego</div></th>
                        <th><div style='width: 100px'>Pamiec ukladu graficznego</div></th>
                        <th><div style='width: 170px'>Nazwa systemu operacyjnego</div></th>
                        <th><div >Rodzaj napedu fizycznego</div></th>
                    </tr>
                    </thead>

                    <tbody style='font-size: 12px'>

                        <form method='post' action="../../app/Controllers/Controller.php">
                           <?php
                           session_start();
                           $i=0;
                           for ($i=0; $i<$_SESSION["lineCount"]; $i++){ ?>
                            <tr>
                                <td><input style='width: 100px' name = 'data[<?php echo $i?>][0]' value='<?php if ($_SESSION["data"][$i][0] != ''){ echo $_SESSION["data"][$i][0];} else echo 'Brak danych' ?>' pattern='[A-Za-z]{2,}' required></td>
                                <td><input style='width: 70px' name = 'data[<?php echo $i?>][1]' value='<?php if ($_SESSION["data"][$i][1] != ''){ echo $_SESSION["data"][$i][1];} else echo 'Brak danych' ?>' pattern='/[0-9]{2}\"/gm' required></td>
                                <td><input style='width: 100px' name = 'data[<?php echo $i ?>][2]' value='<?php if ($_SESSION["data"][$i][2] != ''){ echo $_SESSION["data"][$i][2];} else echo 'Brak danych' ?>' pattern='[0-9]{3,4}x[0-9]{3,4}|Brak danych'></td>
                                <td><select style='width: 120px' name = 'data[<?php echo $i ?>][3]'>
                                        <option value="blyszczaca" <?php if ($_SESSION["data"][$i][3]=='blyszczaca'){?> selected="selected" <?php }?>>Blyszczaca</option>
                                        <option value="matowa" <?php if ($_SESSION["data"][$i][3]=='matowa'){?> selected="selected" <?php }?>>Matowa</option>
                                        <option value="" <?php if ($_SESSION["data"][$i][3]==''){?> selected="selected" <?php }?>>Brak danych</option>
                                    </select>
                                </td>

                                <td><select style='width: 70px' name = 'data[<?php echo $i ?>][4]' >
                                        <option value="tak" <?php if ($_SESSION["data"][$i][4]=='tak'){?> selected="selected" <?php }?>>Tak</option>
                                        <option value="nie" <?php if ($_SESSION["data"][$i][4]=='nie'){?> selected="selected" <?php }?>>Nie</option>
                                        <option value="" <?php if ($_SESSION["data"][$i][4]==''){?> selected="selected" <?php }?>>
                                            Brak danych
                                        </option>
                                    </select>
                                </td>
                                <td><input style='width: 80px' name = 'data[<?php echo $i ?>][5]' value='<?php if ($_SESSION["data"][$i][5] != ''){ echo $_SESSION["data"][$i][5];} else echo 'Brak danych' ?>'  pattern='{2,}|Brak danych'></td>
                                <td><input style='width: 80px' name = 'data[<?php echo $i ?>][6]' value='<?php if ($_SESSION["data"][$i][6] != ''){ echo $_SESSION["data"][$i][6];} else echo 'Brak danych' ?>' pattern='[1-9]{1}|Brak danych'></td>
                                <td><input style='width: 130px' name = 'data[<?php echo $i ?>][7]' value='<?php if ($_SESSION["data"][$i][7] != ''){ echo $_SESSION["data"][$i][7];} else echo 'Brak danych' ?>' pattern='[0-9]{3,4}|Brak danych'></td>
                                <td><input style='width: 80px' name = 'data[<?php echo $i ?>][8]' value='<?php if ($_SESSION["data"][$i][8] != ''){ echo $_SESSION["data"][$i][8];} else echo 'Brak danych' ?>' pattern='[0-9]{1,3}GB|Brak danych'></td>
                                <td><input style='width: 80px' name = 'data[<?php echo $i ?>][9]' value='<?php if ($_SESSION["data"][$i][9] != ''){ echo $_SESSION["data"][$i][9];} else echo 'Brak danych' ?>' pattern='[0-9]{1,3}GB|Brak danych'></td>
                                <td><select style='width: 80px' name = 'data[<?php echo $i ?>][10]' >
                                        <option value="SSD" <?php if ($_SESSION["data"][$i][10]=='tak'){?> selected="selected" <?php }?>>SSD</option>
                                        <option value="HDD" <?php if ($_SESSION["data"][$i][10]=='nie'){?> selected="selected" <?php }?>>HDD</option>
                                        <option value="Inny" <?php if ($_SESSION["data"][$i][10]=='nie'){?> selected="selected" <?php }?>>Inny</option>
                                        <option value="" <?php if ($_SESSION["data"][$i][10]==''){?> selected="selected" <?php }?>>Brak danych</option>
                                    </select>
                                </td>
                                <td><input style='width: 170px' name = 'data[<?php echo $i ?>][11]' value='<?php if ($_SESSION["data"][$i][11] != ''){ echo $_SESSION["data"][$i][11];} else echo 'Brak danych' ?>' pattern='{2,}|Brak danych'></td>
                                <td><input style='width: 100px' name = 'data[<?php echo $i ?>][12]' value='<?php if ($_SESSION["data"][$i][12] != ''){ echo $_SESSION["data"][$i][12];} else echo 'Brak danych' ?>' pattern='[0-9]{1,3}GB|Brak danych'></td>
                                <td><input style='width: 170px' name = 'data[<?php echo $i ?>][13]' value='<?php if ($_SESSION["data"][$i][13] != ''){ echo $_SESSION["data"][$i][13];} else echo 'Brak danych' ?>' pattern='{2,}|Brak danych'></td>
                                <td><input style='width: 80px' name = 'data[<?php echo $i ?>][14]' value='<?php if ($_SESSION["data"][$i][14] != ''){ echo $_SESSION["data"][$i][14];} else echo 'Brak danych' ?>' pattern='{2,}|Brak danych'></td>
                                <td><input type="text" name="example" list="exampleList">
                                    <datalist id="exampleList">
                                        <option value="A">
                                        <option value="B">
                                    </datalist></td>
                            </tr>
                        <?php } ?>
                        <input class=' btn btn-dark m-2' type='submit' name='exportTxtFile' id='exportTxtFile' value='EXPORTUJ DO PLIKU TXT'>
                        <input class=' btn btn-dark m-2' type='submit' name='exportXmlFile' id='exportXmlFile' value='EXPORTUJ DO PLIKU XML'>

                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>