<?
?>
<p>Даны два отсортированных списка с интервалами присутствия пользователей в онлайне. Начало интервала строго меньше конца. </p>
<p>Нужно вычислить интервалы, когда оба пользователя были в онлайне.</p>

<p>Примеры:<br>
user1 [(8, 12), (17, 22)]<br>
user2 [(5, 11), (14, 18), (20, 23), (42, 55)]<br>
 => [(8, 11), (17, 18), (20, 22)]
 </p>
<p>
user1 [(9, 15), (18, 21)]<br>
user2 [(10, 14), (21, 22)]<br>
 => [(10, 14)]
 </p>
<hr>
<?
function getUsersOnlineInterval($arr1, $arr2, $bIncludeLastHour=false)
{
    $arInterVals1 = array();
    $arInterVals2 = array();
    
    $intLastHourIncluded = 0;
    if ($bIncludeLastHour)
    {
        $intLastHourIncluded = 1;
    }
    
    foreach ($arr1 as $arInterval)
    {
        $arInterVals1 = array_merge($arInterVals1, range($arInterval[0], $arInterval[1] - $intLastHourIncluded));
    }
    foreach ($arr2 as $arInterval)
    {
        $arInterVals2 = array_merge($arInterVals2, range($arInterval[0], $arInterval[1] - $intLastHourIncluded));
    }
    $arInter = array_values(array_intersect($arInterVals1, $arInterVals2));
    
    $arResInterVals = array();
    $arTmpInterVal = array();
    $intPrevT = 0;
    foreach ($arInter as $key=>$intT)
    {
        if ($key == 0)
        {
            $arTmpInterVal[0] = $intT;
            continue;
        }
        if ( ($intT - $arInter[$key-1]) > 1)
        {
            $arTmpInterVal[1] = $arInter[$key-1];
            $arResInterVals[] = $arTmpInterVal;
            
            $arTmpInterVal = array();
            $arTmpInterVal[0] = $intT;
        }
    }
    $arTmpInterVal[1] = $arInter[$key];
    $arResInterVals[] = $arTmpInterVal;
    
    return $arResInterVals;
}

$arr1 = array(
    array(8, 12),
    array(17, 22),
);
$arr2 = array(
    array(5, 11),
    array(14, 18),
    array(20, 23),
    array(42, 55), // WTF?)
);

$res = getUsersOnlineInterval($arr1, $arr2, true);
echo '<pre>$res1: ';
print_r($res);
echo '</pre>';


$arr1 = array(
    array(9, 15),
    array(18, 21),
);
$arr2 = array(
    array(10, 14),
    array(21, 22),
);

$res = getUsersOnlineInterval($arr1, $arr2, true);
echo '<pre>$res2: ';
print_r($res);
echo '</pre>';

?>