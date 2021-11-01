<?php

namespace App\Http\Traits;

trait GenerateNameTrait
{
    /**
     * Handle the incoming request.
     *
     * @param $n
     * @param string $type
     * @return string
     */
    public function generateName($n, string $type = 'both'): string
    {
        $randomString = '';
        if ($type == 'letters')
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        elseif ($type == 'number')
            $characters = '012345678901234567890123456789';
        else
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
}
