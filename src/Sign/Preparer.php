<?php

namespace Omnipay\Gpwebpay\Sign;

class Preparer
{
    /**
     * Prepare string to sign
     *
     * @param array $data - data to generate a signature for
     * @param array $arrayKeys - data array keys for values to be included into result string
     * @return string
     */
    public function getStringToSign(array $data, array $arrayKeys): string
    {
        $str = '';
        foreach ($arrayKeys as $key) {
            if (!isset($data[$key]) || $data[$key] === null) {
                continue;
            }
            $value = $data[$key];
            if ($value === true) {
                $str .= 'true';
            } elseif ($value === false) {
                $str .= 'false';
            } elseif (is_array($value)) {
                $str .= $this->getStringToSign($value, array_keys($value));
            } else {
                $str .= (string)$data[$key];
            }
            $str .= '|';
        }
        return rtrim($str, '|');
    }
}
