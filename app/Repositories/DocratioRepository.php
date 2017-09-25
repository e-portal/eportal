<?php

namespace Fresh\Estet\Repositories;

use Fresh\Estet\Docsratio;
use DB;

class DocratioRepository
{
    protected $model;

    public function __construct(Docsratio $rep)
    {
        $this->model = $rep;
    }

    public function getRatio($id)
    {
        return DB::select("SELECT COUNT(*) as count, ROUND(AVG(value), 1) as avg FROM `docsratios` WHERE doc_id=" . $id);
    }

    public function setRatio($request)
    {
        $data['doc_id'] = $request->get('data_id');
        $data['data_key'] = md5(
            $request->ip()
            . $request->header('User-Agent')
            . substr(session()->getId(), 0, 5)
            . $data['doc_id']
        );

        if (session()->has($data['data_key'])) {
            return ['val' => session()->get($data['data_key'])];
        }

        $data['value'] = $request->get('ratio');
        $val = $this->model->where(['doc_id' => $data['doc_id'], 'data_key' => $data['data_key']])->first();

        if (!empty($val)) {
            session()->put($data['data_key'], $val->value);
            return ['val' => $val->value];
        }

        try {
            $this->model->fill($data)->save();
        } catch (Exception $e) {
            return ['val' => $data['data']];
        }

        session()->put($data['data_key'], $data['value']);
        return ['val' => $data['value'], 'doc_id' => $data['doc_id']];

    }
}