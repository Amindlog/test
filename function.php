<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    function cURL($url) {
        preg_match('`((?:http|https+)\:\/\/.*?\/)`i', $url, $refer);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36 OPR/65.0.3467.72');
        curl_setopt($ch, CURLOPT_REFERER, $refer[1]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60 );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Expect:'));
        curl_exec($ch);
        $result = curl_multi_getcontent($ch);
        curl_close($ch);
        return $result;
    }

   function connect()
   {
       try {   
           $user = "user";
           $pass = "Password";
           $connect =  new PDO('mysql:host=localhost;dbname=nistpRu', $user, $pass);
           return $connect;
       } catch (PDOException $e) {
           return $e->getMessage();
       }
   }

   function queryAll(string $str):Array{
    $con = connect()->query($str);
    $con->execute();
    $result = $con->setFetchMode(PDO::FETCH_ASSOC);
    //    var_dump($result->fetchAll());
    return $con->fetchAll();
   }

   function setInsertInto($arrayName,$a, $b){
    try {
        echo "<pre>";
        var_dump($arrayName);
        $url = "https://nistp.ru/bankrot/trade_list.php?trade_number={$a}&lot_number={$b}";
        $con = connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO `case` (case_trade_number, case_lot,case_url,case_initail_price,case_contact_email,case_contact_phone,case_debtor_inn,case_debtor_number,case_bidding_start,case_bidding_end,case_information) VALUES (:num, :lot, :urls, :price, :email, :phone, :inn, :numerdebb, :datastart, :dataend, :descr)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":num", $a);
        $stmt->bindParam(":lot", $b);
        $stmt->bindParam(":urls", $url);
        if(isset($arrayName[8]['Начальная цена'])){
            $stmt->bindParam(":price", $arrayName[8]["Начальная цена"]);
        }else{
            $stmt->bindParam(":price", $arrayName[9][0]["Начальная цена"]);
        }
        $stmt->bindParam(":email", $arrayName[0]['E-mail']);
        $stmt->bindParam(":phone", $arrayName[0]['Телефон']);
        $stmt->bindParam(":inn", $arrayName[2]['ИНН']);
        $stmt->bindParam(":numerdebb", $arrayName[2]['Номер дела о банкротстве']);
        $stmt->bindParam(":datastart", $arrayName[1]['Дата начала представления заявок на участие']);
        $stmt->bindParam(":dataend", $arrayName[1]['Дата окончания представления заявок на участие']);
        if(isset($arrayName[8]['Наименование имущества'])){
            $stmt->bindParam(":descr", $arrayName[8]['Наименование имущества']);
        }else{
            $stmt->bindParam(":descr", $arrayName[9][0]['Наименование имущества']);
        }
        $stmt->execute();
        header("Location: https://{$_SERVER['SERVER_NAME']}");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
   }
   
   function setUpdateRow($arrayName,$a,$b){      
    try {
        $con = connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $url = "https://nistp.ru/bankrot/trade_list.php?trade_number={$a}Ф&lot_number={$b}";
        $sql = "UPDATE `case` SET case_trade_number = :num, case_lot = :lot, case_url = :urls, case_initail_price = :price, case_contact_email = :email, case_contact_phone = :phone, case_debtor_inn = :inn, case_debtor_number = :numerdebb, case_bidding_start = :datastart, case_bidding_end = :dataend, case_information = :descr WHERE case_trade_number = '$a'";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":num", $a);
        $stmt->bindParam(":lot", $b);
        $stmt->bindParam(":urls", $url);
        if(isset($arrayName[8]['Начальная цена'])){
            $stmt->bindParam(":price", $arrayName[8]["Начальная цена"]);
        }else{
            $stmt->bindParam(":price", $arrayName[9][0]["Начальная цена"]);
        }
        $stmt->bindParam(":email", $arrayName[0]['E-mail']);
        $stmt->bindParam(":phone", $arrayName[0]['Телефон']);
        $stmt->bindParam(":inn", $arrayName[2]['ИНН']);
        $stmt->bindParam(":numerdebb", $arrayName[2]['Номер дела о банкротстве']);
        $stmt->bindParam(":datastart", $arrayName[1]['Дата начала представления заявок на участие']);
        $stmt->bindParam(":dataend", $arrayName[1]['Дата окончания представления заявок на участие']);
        if(isset($arrayName[8]["Наименование имущества"])){
            $stmt->bindParam(":descr", $arrayName[8]["Наименование имущества"]);
        }else{
            $stmt->bindParam(":descr", $arrayName[9][0]["Наименование имущества"]);
        }
        $stmt->execute();
        $stmt->rowCount();
        header("Location: https://{$_SERVER['SERVER_NAME']}");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
   }

   function isSetCount($str):int{
    $con = connect()->query($str);
    $con->execute();
    $result = $con->fetchColumn();
    if($result > 0){
        return 1;
    }else{
        return 0;
    }
   }

   
function getReturnArray(){
   $sdfssd = cURL("https://nistp.ru/bankrot/trade_list.php?trade_number={$_POST['num']}&lot_number={$_POST['lot']}");
            preg_match('`trade_nid=([0-9]+)`ms', $sdfssd, $resy);
            @$inflot = cURL('https://nistp.ru/bankrot/trade_view.php?trade_nid='.$resy[1]);
            // var_dump($inflot);
            preg_match_all('`\s?(?:<table.*?class=(\'node_view\'|\'node_view \').*?>(.*?)</table+)`ms', $inflot, $res);
            $arrayName = array();
            for ($i=0; $i < count($res[2]); $i++) {
                preg_match_all('`\s?(?:<td( class=\'label\'|)>+)(?:(.*?)<+)`ms', $res[2][$i], $resk0);
                if ($i < 9) {
                    $resm = array_chunk($resk0[2], 2);
                    @$resn = array_combine(array_column($resm, 0), array_column($resm, 1));
                    $arrayName[] = $resn;
                } else {
                    $res0 = array_diff($resk0[2], array('', ' ', "\n", "\r\n", "\t", NULL, false));
                    $res1 = array_slice($res0, 0, 18);
                    $resm = array_chunk($res1, 2);
                    $resn = array_combine(array_column($resm, 0), array_column($resm, 1));
                    $res2 = array_slice($res0, 19);
                    $resm2 = array_chunk($res2, 4);
                    @$arrayName[] = array($resn,$res0[18] => $resm2);
                }
            }
            array_pop($arrayName);
            $arrayName = array_values($arrayName);
            return $arrayName;
}