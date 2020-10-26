<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OP.GG do Mal</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <!-- CSS proprio -->
    <link rel="stylesheet" href="style.css">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</head>

<body>

<div class="fundinho"></div>

    <?php
        if (!empty($_POST)){
            try {
                $oldsumonnerName = $_POST['sumonnerName'];
                $sumonnerName = str_replace(' ', "%20", $oldsumonnerName);
                $api_key = "paste your API here";
                $data = json_decode(file_get_contents("https://br1.api.riotgames.com/lol/summoner/v4/summoners/by-name/".$sumonnerName."?api_key=".$api_key));
                $data2 = json_decode(file_get_contents("https://br1.api.riotgames.com/lol/league/v4/entries/by-summoner/".$data->id."?api_key=".$api_key));
                $countNum = count($data2);
                $i = 0;
                $solo = 0;
                $flex = 0;
                $soloelo = "Unranked";
                $solopontos = "0";
                $solotier = "Unranked";
                $flexelo = "Unranked";
                $flexpontos = "0";
                $flextier = "Unranked";
                if($countNum > 0){
                    while($i < $countNum){
                        if(strval($data2[$i]->queueType) == "RANKED_SOLO_5x5"){
                            $solo = $i;
                        }
                        if(strval($data2[$i]->queueType) == "RANKED_FLEX_SR"){
                            $flex = $i;
                        }
                        $i++;
                    }
                    $soloelo = strval($data2[$solo]->tier)." ".strval($data2[$solo]->rank);
                    $solopontos = strval($data2[$solo]->leaguePoints);
                    $solotier = strval($data2[$solo]->tier);
                    $flexelo = strval($data2[$flex]->tier)." ".strval($data2[$flex]->rank);
                    $flexpontos = strval($data2[$flex]->leaguePoints);
                    $flextier = strval($data2[$flex]->tier);
                }

                

                echo "<div class='container-fluid'>
                <br>
                <br>
                <br>
                <div class='row'>
                    <div class='col-md-6 offset-md-3 col-12'>
                        <div class='card text-white bg-dark'>
                        <div class='card-header text-center'><h2 class='font-weight-bold'>$data->name</h2></div>
                        <br>
                        <img class='mx-auto rounded-circle' src='http://ddragon.leagueoflegends.com/cdn/10.21.1/img/profileicon/".$data->profileIconId.".png' width='300' height='300'>
                        <div class='card-body text-center'>
                            <div class='row'>
                                <div class='col-md-6 offset-md-3 col-12'>
                                    <h4>Level: $data->summonerLevel</h4>
                                    <br>
                                    <h4 class='texto-rosa'>Filas Ranqueadas</h4>
                                </div>
                            </div>

                            <br>

                            <div class='row'>
                                <div class='col-md-6 col-12'>
                                    <h4>Ranqueada Solo/Duo</h4>
                                    <br>
                                    <h4>$soloelo</h4>
                                    <h4>$solopontos PDL</h4>
                                    <img src='".$solotier.".png' width='150'>
                                </div>

                                <div class='col-md-6 col-12'>
                                    <h4>Ranqueada Flex 5x5</h4>
                                    <br>
                                    <h4>$flexelo</h4>
                                    <h4>$flexpontos PDL</h4>
                                    <img src='".$flextier.".png' width='150'>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>";
                /* Test
                Nick: $data->name<br>
                echo "Level: $data->summonerLevel<br>";
                echo "ID: $data->id<br>";
                echo  "<img src='http://ddragon.leagueoflegends.com/cdn/10.21.1/img/profileicon/".$data->profileIconId.".png'><br>";
                echo "Tipo de Fila: Ranqueada Solo/Duo<br>";
                echo "Elo: ".$soloelo."<br>";
                echo "Pontos: ".$solopontos."<br><img src='".$solotier.".png' width='150'><br><br>";

                echo "Tipo de Fila: Ranqueada Flex 5x5<br>";
                echo "Elo: ".$flexelo."<br>";
                echo "Pontos: ".$flexpontos."<br><img src='".$flextier.".png' width='150'>";
                echo "<pre>";
                print_r($data2);
                echo "</pre><br>";*/
            } catch (Exception $e) {

            }
        }else{?>
        <div class="container-fluid">
            <br>
            <br>
            <br>
            <div class="row align-items-center" style="width: 100%; height: 800px;">
                <div class="col-md-6 offset-md-3 col-12">
                    <div class="card text-white bg-dark">
                        <div class="card-header text-center"><h2 class="font-weight-bold">OPGG do Mal</h2></div>
                        <div class="card-body">
                            <form action="riotapi.php" method="post">
                                <br>
                                <h4>Nome de Jogador</h4>
                                <input class="form-control" type="text" name="sumonnerName" value="">
                                <br>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <button class="btn btn-block btn-pink" type="submit">TESTAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>
</html>
