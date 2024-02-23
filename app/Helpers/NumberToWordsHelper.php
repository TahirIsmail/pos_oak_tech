<?php
if (!function_exists('numberToWords')) {
    function numberToWords($number)
    {
        $words = [
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine'
        ];
    
        $teens = [
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen'
        ];
    
        $tens = [
            10 => 'Ten',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety'
        ];
    
        $unitNames = ['', 'Thousand', 'Million', 'Billion', 'Trillion', 'Quadrillion', 'Quintillion'];
    
        $result = '';
    
        $number = strval($number);
        $length = strlen($number);
        $segments = ceil($length / 3);
    
        $number = str_pad($number, $segments * 3, '0', STR_PAD_LEFT);
    
        for ($i = 0; $i < $segments; $i++) {
            $chunk = substr($number, $i * 3, 3);
    
            if ($chunk != '000') {
                $segment = (int)$chunk;
    
                $hundreds = (int)($segment / 100);
                $remainder = $segment % 100;
    
                if ($hundreds > 0) {
                    $result .= $words[$hundreds] . ' Hundred';
                    if ($remainder > 0) {
                        $result .= ' and ';
                    }
                }
    
                if ($remainder > 0) {
                    if ($remainder < 10) {
                        $result .= $words[$remainder];
                    } elseif ($remainder < 20) {
                        $result .= $teens[$remainder];
                    } else {
                        $tensDigit = (int)($remainder / 10) * 10;
                        $unitDigit = $remainder % 10;
    
                        $result .= $tens[$tensDigit];
                        if ($unitDigit > 0) {
                            $result .= ' ' . $words[$unitDigit];
                        }
                    }
                }
    
                $result .= ' ' . $unitNames[$segments - $i - 1];
    
                if ($i < $segments - 1) {
                    $result .= ' ';
                }
            }
        }
    
        return $result . ' Rupees Only';
    }
    
}
