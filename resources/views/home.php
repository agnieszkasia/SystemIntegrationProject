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
    <main class="py-4">
        <div class="container-fluid">
            <div class="row">
                <form method="post" action="../../app/Controllers/Controller.php">
                    <input class="btn btn-link" type="submit" name="importTxtFile" id="importTxtFile" value="IMPORTUJ Z PLIKU TXT">
                </form>
                <form method="post" action="../../app/Controllers/Controller.php">
                    <input class="btn btn-link" type="submit" name="importXmlFile" id="importXmlFile" value="IMPORTUJ Z PLIKU XML">
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
                </table>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>