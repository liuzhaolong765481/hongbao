<?php
/**
 * Created by lzl
 * Date: 2021 2021/3/22
 * Time: 13:55
 */
namespace App\Services;

use App\Exceptions\RequestException;
use App\Exports\PaperExport;
use App\Models\Paper;
use Maatwebsite\Excel\Facades\Excel;

class PaperServices extends BaseServices
{

    /**
     * @param $validated
     * @return bool
     * @throws RequestException
     */
    public static function create($validated)
    {

        if ($validated['min'] > $validated['max']) {
            throw new RequestException('最小金额不可大于最大金额');
        }

        for ($i = 0; $i < $validated['count']; $i++) {
            Paper::create([
                'amount' => mt_rand($validated['min'] * 100, $validated['max'] * 100) / 100,
                'solt'   => self::getSolt(),
            ]);
        }
        return true;

    }

    /**
     * 生成唯一标识
     * @param int $len
     * @return int|string
     */
    static function getSolt($len = 4)
    {
        $solt = mt_rand(100000, 999999);

        $a        = range('a', 'z');
        $b        = range('A', 'Z');
        $chars    = array_merge($a, $b);
        $charslen = count($chars) - 1;

        shuffle($chars);

        for ($i = 0; $i < $len; $i++) {
            $solt .= $chars[mt_rand(0, $charslen)];
        }

        if(Paper::where('solt',$solt)->exists()){
            self::getSolt($len);
        }
        return $solt;
    }


    /**
     * @param $validated
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public static function export($validated)
    {
        $all = Paper::where('status', $validated['status'])
            ->orderBy('id','asc')
            ->get(['id', 'solt', 'amount', 'create_time'])
            ->toArray();

        foreach ($all as &$item){
            unset($item['status_string']);
            unset($item['nick_name']);
        }

        $data = [
            // 设置表头信息
            ['序号','口令','金额','创建时间'],
        ];

        $data = array_merge($data, $all);

        //修改数据状态为已使用
        Paper::where('status', $validated['status'])->update(['status' => Paper::GRANTED]);

        return  Excel::download(new PaperExport($data), date('YmdHis').'-共计（'.count($all).'）条.xlsx');

    }

}