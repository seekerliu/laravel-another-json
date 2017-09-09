<?php
/**
 * author: seekerliu
 * createTime: 2017/9/8 下午1:53
 * Description:
 */

namespace Seekerliu\YaJson;

class YaJson
{
    private $depth;
    private $decimals;

    /**
     * YaJson constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->depth = $config['depth'];
        $this->decimals = $config['decimals'];
    }

    /**
     * 对数据进行 json_encode
     * @param mixed $data
     * @param int $depth 遍历的深度
     * @param int $decimals 给浮点数定精度，默认为 8
     * @return string
     */
    public function encode($data = '', $decimals = 0, $depth = 0)
    {
        $data = $this->prepare($data, $decimals, $depth);
        return json_encode($data);
    }

    /**
     * 对数据进行遍历，修复浮点数的精度
     * @param string $data
     * @param int $decimals
     * @param int $depth
     * @param int $level
     * @return mixed $data
     */
    public function prepare($data = '', $decimals = 0, $depth = 0, $level = 0)
    {
        $depth = $depth ?: $this->depth;

        if($level > $depth - 1)
            return $data;

        if(is_array($data)){
            foreach ($data as $i => $v) {
                $data[$i] = $this->prepare($v, $decimals, $depth, $level + 1);
            }
            return $data;
        }

        if(is_float($data)){
            return $this->fixNumberPrecision($data, $decimals);
        }

        return $data;
    }

    /**
     * 修复浮点数精度
     * @param float $number
     * @param int $decimals
     * @return float
     */
    private function fixNumberPrecision($number, $decimals = 0)
    {
        $decimals = $decimals ?: $this->decimals;
        $formatted = number_format($number, $decimals, '.', '');

        return floatval($formatted);
    }

//    /**
//     * 原博提供的方法，供参考：
//     * @param $d
//     * @param int $depth
//     * @param int $level
//     * @return array
//     */
//    private function json_encode_pre($d, $depth=128, $level=0){
//        if($level>$depth) return $d;
//        if(is_array($d)){
//            foreach ($d as $i => $v) { $d[$i] = json_encode_pre($v, $depth, $level+1); }
//            return $d;
//        }
//        if(is_float($d)){
//            # 測試發現number_format有效數字低於18(保守取16)時,不會溢出
//            $p = 16 - strlen(intval($d));
//            $f = number_format($d, $p);
//            if($p>1){ $f = preg_replace('/0+$/','', $d); }
//            return $d;
//        }
//        return $d;
//    }
}
