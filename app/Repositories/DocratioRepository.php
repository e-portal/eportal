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
        $data['data_key_doc_' . $data['doc_id']] = md5($request->ip() . $request->header('User-Agent') . substr(session()->getId(), 0, 5));

        session()->forget($data['data_key_doc_' . $data['doc_id']]);
        if (session()->has($data['data_key_doc_' . $data['doc_id']])) {
            return ['val' => $data['data_key_doc_' . $data['doc_id']]];
        }
        $data['data_key'] = $data['data_key_doc_' . $data['doc_id']];
        $data['value'] = $request->get('ratio');

        if ($val = $this->model->where(['doc_id' => $data['doc_id'], 'data_key' => $data['data_key_doc_' . $data['doc_id']]])->first()) {
            session()->put($data['data_key_doc_' . $data['doc_id']], $val->value);
            return ['val' => $val->value];
        }

        try {
            $this->model->fill($data)->save();
        } catch (Exception $e) {
            return ['val' => $data['data_key_doc_' . $data['doc_id']]];
        }

        session()->put($data['data_key_doc_' . $data['doc_id']], $data['value']);
        return ['val' => $data['value'], 'doc_id' => $data['doc_id']];

    }

}