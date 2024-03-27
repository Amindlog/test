<?php
include "./function.php";
            $arrayName = getReturnArray();            
            $ic = isSetCount("Select COUNT(`case_trade_number`) FROM `case` WHERE `case_trade_number` = '{$_POST['num']}'");//можно добавить по лоту что бы проверял
            if(!empty($arrayName)){
                if ($ic) {
                        setUpdateRow($arrayName,$_POST['num'],$_POST['lot']);
                    }else {
                        setInsertInto($arrayName,$_POST['num'], $_POST['lot']);
                    }
            }else{
                header("Location: https://{$_SERVER['SERVER_NAME']}");
            }
