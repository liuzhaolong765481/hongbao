<?php
/**
 * Created by lzl
 * Date: 2021 2021/3/22
 * Time: 13:31
 */
namespace App\Http\Controllers\Admin;

use App\Models\Paper;
use App\Services\PaperServices;

class PaperController extends Controller
{

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     * @throws \App\Exceptions\RequestException
     */
    public function paperList()
    {
        if($this->request->ajax()) {

            $rules = [
                'page'       => 'required',
                'limit'      => 'required',
                'status'     => 'nullable',
                'solt'       => 'nullable',
            ];

            $this->validateInput($rules);

            $validated = $this->validated;

            $where = [];
            if(isset($validated['status']) && $validated['status']){
                $where['status'] = $validated['status'];
            }

            if(isset($validated['solt']) && $validated['solt']){
                $where['solt'] = $validated['solt'];
            }

            $list = Paper::where($where)
                ->page($validated['page'], $validated['limit'])
                ->orderBy('id','desc')
                ->get();

            return $this->showJsonLayui($list);
        }

        return $this->rView('paper.list');
    }

    /**
     * 添加
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addPaper()
    {
        return $this->rView('paper.add');
    }

    /**
     * 批量添加
     * @return mixed
     * @throws \App\Exceptions\RequestException
     */
    public function addPaperPost()
    {
        $rules = [
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'count' => 'required|integer'
        ];

        $this->validateInput($rules);

        return $this->success(PaperServices::create($this->validated));
    }

    /**
     * 文件导出
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \App\Exceptions\RequestException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportPaper()
    {
        return PaperServices::export(['status' => 1]);
    }

    /**
     * 更新
     * @return mixed
     * @throws \App\Exceptions\RequestException
     */
    public function update()
    {
        $rules = [
            'id' => 'required',
            'status' => 'required',
        ];

        $this->validateInput($rules);

        return $this->successOrFailed(
            Paper::whereKey($this->validated['id'])->update(['status' => $this->validated['status']])
        );
    }

}