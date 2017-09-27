<?php
namespace Fresh\Estet\Repositories;

use Fresh\Estet\Advertising;
use Validator;
use Cache;

class AdvertisingRepository extends Repository
{
    /**
     * construct
     */
    public function __construct(Advertising $advertising)
    {
        $this->model = $advertising;
    }

    /**
     * @param $request
     * @param $advertising
     * @return array
     */
    public function updateAdvertising($request, $advertising)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'nullable|string',
            'text2' => 'nullable|string',
            'text3' => 'nullable|string',
            'text4' => 'nullable|string',
            'text5' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ['error'=>$validator];
        }

        try {
            $advertising->fill($request->except('_token'))->save();
        } catch (Exception $e) {
            \Log::info('Ошибка записи advertising: ', $e->getMessage());
            $error[] = ['advertising' => 'Ошибка записи рекламы'];
            return $error;
        }
        Cache::forget('main');
        return ['status' => trans('admin.material_updated')];
    }

    /**
     * @return array
     */
    public function getMainPatient()
    {
        $collection = $this->model->select('text', 'text2', 'text3', 'text4', 'text5', 'placement')->where('own', 'patient')
            ->whereIn('placement', ['main_1', 'main_2'])->get();
        $result = [];
        foreach ($collection as $item) {
            if ('main_1' == $item->placement) {
                $result['main_1'] = collect($item->toArray())->forget('placement');
            } elseif ('main_2' == $item->placement) {
                $result['main_2'] = collect($item->toArray())->forget('placement');
            } else {
                continue;
            }
        }
        return $result;
    }

    /**
     * @return array
     */
    public function getMainDocs()
    {
        $collection = $this->model->select('text', 'text2', 'text3', 'text4', 'text5', 'placement')->where('own', 'doc')->get();
        $result = [];
        foreach ($collection as $item) {
            if ('main_1' == $item->placement) {
                $result['main_1'] = collect($item->toArray())->forget('placement');
            } elseif ('main_2' == $item->placement) {
                $result['main_2'] = collect($item->toArray())->forget('placement');
            } elseif ('main_3' == $item->placement) {
                $result['main_3'] = collect($item->toArray())->forget('placement');
            } else {
                continue;
            }
        }
        return $result;
    }

    /**
     * @param $own
     * @return array
     */
    public function getSidebar($own)
    {
        $collection = $this->model->select('text', 'text2', 'text3', 'text4', 'text5', 'placement')
            ->where('own', $own)->whereIn('placement', ['sidebar', 'sidebar_2'])->get();

        $result = [];
        foreach ($collection as $item) {
            if ('sidebar' == $item->placement) {
                $result['sidebar'] = collect($item->toArray())->forget('placement');
            } elseif ('sidebar_2' == $item->placement) {
                $result['sidebar_2'] = collect($item->toArray())->forget('placement');
            } else {
                continue;
            }
        }
        return $result;
    }

    public function getFooter($own)
    {
        $collection = $this->model->select('text', 'text2', 'text3', 'text4', 'text5', 'placement')->where(['own' => $own, 'placement' => 'footer'])->first();

        $result = collect($collection->toArray())->forget('placement');

        return $result;
    }
}