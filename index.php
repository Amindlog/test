<?php 
include "./function.php";

    ?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>form</title>
    </head>
    <body>
        <form action="script.php" method="post">
            <div>
                <label for="bargaining">Номер торгов.</label>
                <input type="text" name="num" id="idBargaining" placeholder="В ведите 31710-ОТПП" pattern="[0-9]{5|6|7}-[А-Яа-яЁё]{4,}" required>
            </div>
            <div style="margin-top:10px;">
                <label for="lot">Номер лота.</label>
                <input type="number" name="lot" id="lot" required>
            </div>
            <input type="submit" value="Найти">
        </form>

        <?php 
            $result = queryAll("Select * FROM `case`");
            //    var_dump($result);
            echo "<pre>";
            // var_dump(count($result));
            // Создать таблицу 
            ?>
            <table style="border:1px solid #000;">
                <thead>
                    <tr style="border:1px solid #000;">
                        <th style="border:1px solid #000; background:yellow;">Url</th>
                        <th style="border:1px solid #000; background:yellow; max-width:150px">Сведения об имуществе</th>
                        <th style="border:1px solid #000; background:yellow;">Начальная цена лота</th>
                        <th style="border:1px solid #000; background:yellow;">Email контакта</th>
                        <th style="border:1px solid #000; background:yellow;">Телефон контакта</th>
                        <th style="border:1px solid #000; background:yellow;">Инн должника</th>
                        <th style="border:1px solid #000; background:yellow;">Номер дела о банкротсве</th>
                        <th style="border:1px solid #000; background:yellow;">Дата таргов (начало / окнчание)</th>
                    </tr>
                </thead>
                <tbody style="border:1px solid #000;">
                <?php
                if($result !== NULL){

                    for($i = 0; $i <= count($result)-1; $i++){
                ?>
                <tr style="text-align:center; max-width:100%; " >
                    <td style="border:1px solid #000;"><a href="<?= $result[$i]['case_url'];?>" target="_blank">Ссылка на лот</a></td>
                    <td style="border:1px solid #000; text-wrap: wrap;"><?= $result[$i]['case_information'];?></td>
                    <td style="border:1px solid #000;"><?= $result[$i]['case_initail_price'];?></td>
                    <td style="border:1px solid #000;"><?= $result[$i]['case_contact_email'];?></td>
                    <td style="border:1px solid #000;"><?= $result[$i]['case_contact_phone'];?></td>
                    <td style="border:1px solid #000;"><?= $result[$i]['case_debtor_INN'];?></td>
                    <td style="border:1px solid #000;"><?= $result[$i]['case_debtor_number'];?></td>
                    <td style="border:1px solid #000;"><?php echo $result[$i]['case_bidding_start'] ."/". $result[$i]['case_bidding_end'];?></td>
                </tr>
                <?php } }else{
                   echo "данных нет";
                }?>
                </tbody>
            </table>
        </body>
    </html>
