<?php

require 'vendor/autoload.php';

use Alfred\Workflows\Workflow;

// $workflow->result()
//          ->uid('bob-belcher')   唯一编号 : STRING (可选)，用于排序
//          ->title('Bob')         标题： STRING， 显示结果
//          ->subtitle('Head Burger Chef')  副标题： STRING ,显示额外的信息
//          ->quicklookurl('http://www.bobsburgers.com')  快速预览地址 : STRING (optional)
//          ->type('default')   类型，可选择文件类型: "default" | "file"
//          ->arg('bob')    输出参数 : STRING (recommended)，传递值到下一个模块
//          ->valid(true)       回车是否可用 : true | false (optional, default = true)
//          ->icon('bob.png')   图标
//          ->mod('cmd', 'Search for Bob', 'search')   修饰键 : OBJECT (可选)
//          ->text('copy', 'Bob is the best!')   按cmd+c 复制出来的文本: OBJECT (optional)
//          ->autocomplete('Bob Belcher');    自动补全 : STRING (recommended)

class UnicodeToUtf8
{
    private $workflow;

    public function __construct()
    {
        $this->workflow = new Workflow;
    }

    public function unicode2utf8($str)
    {
        if (!$str) {
            return $str;
        }
        $decode = json_decode($str);
        if ($decode) {
            return $decode;
        }
        $str = '["' . $str . '"]';
        $decode = json_decode($str);
        if (count($decode) == 1) {
            return $decode[0];
        }
        return $str;
    }

    public function translate($query)
    {
        $res = $this->unicode2utf8($query);

        $this->workflow->result()
                    ->title($res)
                    ->subtitle($res)
                    ->arg($res)
                    ->icon('icon.png')
                    ->text('copy', $res);

        echo $this->workflow->output();
    }
}
