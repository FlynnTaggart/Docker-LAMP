<?php

class SortEngine {
    const PARAMETER_NAME = 'array';
    const DELIMITER = ',';
    private array $arr = [];

    public function __construct(string $array_string) {
        $tok = strtok($array_string, self::DELIMITER);
        while ($tok !== false) {
            $this->arr[] = $tok;
            $tok = strtok(self::DELIMITER);
        }

        if (!$this->check($this->arr)) {
            throw new Exception("Wrong input");
        }

        foreach ($this->arr as &$value) {
            $value = intval($value);
        }

        $this->selection_sort($this->arr);

        foreach ($this->arr as &$value) {
            $value = intval($value);
            echo $value, ', ';
        }

        unset($value);
    }

    function check(array $arr): bool {
        foreach ($arr as &$value) {
            if (!is_numeric($value))
                return false;
        }
        return true;
    }

    function selection_sort(array &$arr): void {
        for($i = 0; $i < count($arr) - 1; ++$i){
            $min_i = $i;
            for ($j = $i + 1; $j < count($arr); ++$j)
                if($arr[$j] < $arr[$min_i])
                    $min_i = $j;
            if ($min_i != $i)
                $this->swap($arr[$i], $arr[$min_i]);
        }
    }

    function swap(&$left, &$right): void{
        if ($left === $right)
            return;
        $tmp = $left;
        $left = $right;
        $right = $tmp;
    }

}

?>