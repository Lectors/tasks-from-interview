<?
echo '<p>Найти максимальную сумму трех соседних элементов массива (индекс первого элемента тройки и значение)</p><hr>';

class PosMaxSummResult
{
    private $position;
    private $summ;
    
    public function __construct($position=false, $summ=false)
    {
        $this->position = $position;
        $this->summ = $summ;
    }
    
    public function getPosition()
    {
        return $this->position;
    }
    
    public function getSumm()
    {
        return $this->summ;
    }
    
    public function setPosition($position)
    {
        $this->position = $position;
    }
    
    public function setSumm($summ)
    {
        $this->summ = $summ;
    }
}

function getPosOfMaxSumm($arItems, $intLength)
{
    $result = new PosMaxSummResult();
    
    foreach ($arItems as $intKey => $intVal)
    {
        $slice = array_slice($arItems, $intKey, $intLength);
        $intSumm = array_sum($slice);
        
        $curValue = $result->getSumm();
        if ($curValue === false || $intSumm > $curValue)
        {
            $result->setPosition($intKey);
            $result->setSumm($intSumm);
        }
    }
    
    return $result;
}

$arItems = range(-5, 5);
shuffle($arItems);
$intLength = 3;

echo '<pre>$arItems: ';
print_r($arItems);
echo '</pre>';

$res = getPosOfMaxSumm($arItems, $intLength);
?>
<hr>
<p>
    Позиция: <?=$res->getPosition()?><br>
    Сумма: <?=$res->getSumm()?>
</p>