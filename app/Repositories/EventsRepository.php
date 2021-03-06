<?php
namespace Fresh\Estet\Repositories;

use Fresh\Estet\Event;
use Fresh\Estet\Slider;
use Image;
use Config;
use File;
use Cache;
use Validator;

class EventsRepository extends Repository
{
    protected $model;

    public function __construct(Event $event)
    {
        $this->model = $event;
    }

    public function addEvent($request)
    {
        $data = $request->except('_token');

        if (empty($data['alias'])) {
            $event['alias'] = $this->transliterate($data['title']);
        } else {
            $event['alias'] = $this->transliterate($data['alias']);
        }

        if ($this->one($event['alias'])) {
            $request->merge(array('alias' => $event['alias']));
            $request->flash();
            return ['error' => trans('admin.alias_in_use')];
        }

        $event['title'] = $data['title'];
        $event['short_title'] = $data['short_title'];
        $event['extlink'] = $data['extlink'];
        $event['extmail'] = $data['extmail'] ?? env('ADMIN_EMAIL');
        $event['country_id'] = $data['country'];
        $event['city_id'] = $data['city'];

        $event['organizer_id'] = $data['organizer'];
        $event['cat_id'] = $data['cats'];

        $event['start'] = date('Y-m-d', strtotime($data['start']));
        $event['stop'] = date('Y-m-d', strtotime($data['stop']));

        $event['content'] = $data['content'];
        $event['description'] = $data['description'];

        $img_prop['imgalt'] = $data['imgalt'] ? $data['imgalt'] : null;
        $img_prop['imgtitle'] = $data['imgtitle'] ? $data['imgtitle'] : null;


        if (!empty($data['confirmed'])) {
            $event['approved'] = 1;
        }
        // SEO handle
        if (!empty($data['seo_title'] || !empty($data['seo_keywords']) || !empty($data['seo_description']) || !empty($data['seo_text'])
            || !empty($data['og_image']) || !empty($data['og_title']) || !empty($data['og_description']))) {
            $obj = new \stdClass;
            $obj->seo_title = $data['seo_title'] ?? '';
            $obj->seo_keywords = $data['seo_keywords'] ?? '';
            $obj->seo_description = $data['seo_description'] ?? '';
            $obj->seo_text = $data['seo_text'] ?? '';
            $obj->og_image = $data['og_image'] ?? '';
            $obj->og_title = $data['og_title'] ?? '';
            $obj->og_description = $data['og_description'] ?? '';
            $event['seo'] = json_encode($obj);
        }

        $new = $this->model->firstOrCreate($event);
        $error = ['model' => 'Ошибка записи'];
        if (!empty($new)) {
            // Main Image handle
            if ($request->hasFile('img')) {
                $path = $this->mainImg($request->file('img'), $event['alias']);

                if (false === $path) {
                    $error[] =  ['img' => 'Ошибка загрузки картинки'];
                } else {
                    $img = $new->logo()->create(['path'=>$path, 'alt' => $img_prop['imgalt'], 'title' => $img_prop['imgtitle']]);
                }

                if (null == $img) {
                    $error[] = ['img' => 'Ошибка записи картинки'];
                }
            }

            $slider_path = [];
            if ($request->hasFile('slider')) {
                foreach ($request->file('slider') as $slider) {
                    $slider_path[] = $this->sliderImg($slider, $event['alias']);
                }

            }
            // slider imgs
            if (!empty($slider_path)) {
                try {
                    $new->slider()->createMany($slider_path);
                } catch (Exception $e) {
                    \Log::info('Ошибка записи фотографий слайдера: ', $e->getMessage());
                    $error[] = ['slider' => 'Ошибка записи фотографий слайдера'];
                }
            }
            $this->clearCache();
            return ['status' => trans('admin.material_added'), $error];
        }
        return ['error' => $error];

    }

    public function updateEvent($request, $event)
    {
        $event->load('logo');
        $event->load('slider');
        
        $data = $request->except('_token', 'logo', 'slider');

        $new['title'] = $data['title'];
        $new['short_title'] = $data['short_title'];
        $new['extlink'] = $data['extlink'];
        $new['extmail'] = $data['extmail'];

        if (empty($data['alias'])) {
            $new['alias'] = $this->transliterate($data['title']);
        } else {
            $new['alias'] = $this->transliterate($data['alias']);
        }

        if (($new['alias'] !== $event->alias) && $this->one($new['alias'])) {
            $request->merge(array('alias' => $event['alias']));
            $request->flash();
            return ['error' => trans('admin.alias_in_use')];
        }

        $new['country_id'] = $data['country'];
        $new['city_id'] = $data['city'];


        $new['organizer_id'] = $data['organizer'];
        $new['cat_id'] = $data['cats'];

        $new['start'] = date('Y-m-d', strtotime($data['start']));
        $new['stop'] = date('Y-m-d', strtotime($data['stop']));

        $new['content'] = $data['content'];
        $new['description'] = $data['description'];

        if (!empty($data['confirmed'])) {
            $new['approved'] = 1;
        } else {
            $new['approved'] = 0;
        }
        // SEO handle
        if (!empty($data['seo_title'] || !empty($data['seo_keywords']) || !empty($data['seo_description']) || !empty($data['seo_text'])
            || !empty($data['og_image']) || !empty($data['og_title']) || !empty($data['og_description']))) {
            $obj = new \stdClass;
            $obj->seo_title = $data['seo_title'] ?? '';
            $obj->seo_keywords = $data['seo_keywords'] ?? '';
            $obj->seo_description = $data['seo_description'] ?? '';
            $obj->seo_text = $data['seo_text'] ?? '';
            $obj->og_image = $data['og_image'] ?? '';
            $obj->og_title = $data['og_title'] ?? '';
            $obj->og_description = $data['og_description'] ?? '';
            $new['seo'] = json_encode($obj);
        }
        // SEO handle
        // Logo props
        if ($data['imgalt'] !== $event->logo->title) {
            $new['imgalt'] = $data['imgalt'];
        } else {
            $new['imgalt'] = $event->logo->title;
        }

        if ($data['imgtitle'] !== $event->logo->title) {
            $new['imgtitle'] = $data['imgtitle'];
        } else {
            $new['imgtitle'] = $event->logo->title;
        }
        // Logo props

        $updated = $event->fill($new)->save();

        $error = '';
        if (!empty($updated)) {

            // Main Image handle
            if ($request->hasFile('img')) {
                $old_img = $event->logo->path;
                $path = $this->mainImg($request->file('img'), $event['alias']);

                if (false === $path) {
                    $error[] =  ['img' => 'Ошибка загрузки картинки'];
                } else {
                    $img = $event->logo()->update(['path'=>$path, 'alt' => $new['imgalt'], 'title' => $new['imgtitle']]);
                }

                if (null == $img) {
                    $error[] = ['img' => 'Ошибка записи картинки'];
                }
                //DELETE OLD IMAGE
                $this->deleteOldImages($old_img, 'event');
            } else {
                try {
                    $event->logo()->update(['alt' => $new['imgalt'], 'title' => $new['imgtitle']]);
                } catch (Exception $e) {
                    \Log::info('Ошибка обновления главного изображения статьи: ', $e->getMessage());
                    $error[] = ['img' => 'Ошибка обновления главного изображения статьи'];
                }
            }
            //Slider
            $slider_path = [];
            if ($request->hasFile('slider')) {
                foreach ($request->file('slider') as $slider) {
                    $slider_path[] = $this->sliderImg($slider, $event['alias']);
                }

            }
            // slider imgs
            if (!empty($slider_path)) {
                try {
                    $event->slider()->createMany($slider_path);
                } catch (Exception $e) {
                    \Log::info('Ошибка записи фотографий слайдера: ', $e->getMessage());
                    $error[] = ['slider' => 'Ошибка записи фотографий слайдера'];
                }
            }

            $this->clearCache();
            return ['status' => trans('admin.material_updated'), $error];
        }
        return ['error' => $error];
    }

    /**
     * @param $event
     * @return array
     */
    public function deleteEvent($event)
    {

        $logo = $event->logo()->first();
        $slider = $event->slider()->select('path')->get();


        if ($slider->isNotEmpty()) {
            foreach ($slider->toArray() as $name) {
                $this->deleteOldImages($name['path'], 'event/slider');
            }
        }
        $this->deleteOldImages($logo->path, 'event');

        try {
            $event->delete();
        } catch (Exception $e) {
            \Log::info('Ошибка удаления мероприятия: ', $e->getMessage());
        }

        $this->clearCache();
        return ['status' => trans('admin.deleted')];
    }

    public function clearCache()
    {
        Cache::forget('blogs');
        Cache::forget('blogs_sidebar');
        Cache::forget('eventSidebar');
        Cache::forget('event_content');
    }
    /**
     * @param File $image
     * @param $alias
     * @param string $position
     * @return bool|string
     */
    public function mainImg($image, $alias, $position = 'center')
    {
        if($image->isValid()) {

            $path = substr($alias, 0, 64) . '-' . time() . '.jpeg';

            $img = Image::make($image);

            $img->fit(Config::get('settings.events_img')['main']['width'], Config::get('settings.events_img')['main']['height'],
                function ($constraint) { $constraint->upsize();},
                $position)->save(public_path() . '/images/event/main/'.$path, 100);
            $img->fit(Config::get('settings.events_img')['middle']['width'], Config::get('settings.events_img')['middle']['height'],
                function ($constraint) { $constraint->upsize();},
                $position)->save(public_path() . '/images/event/middle/'.$path, 100);
            $img->fit(Config::get('settings.events_img')['small']['width'], Config::get('settings.events_img')['small']['height'],
                function ($constraint) { $constraint->upsize();},
                $position)->save(public_path() . '/images/event/small/'.$path, 100);
            $img->fit(Config::get('settings.events_img')['mini']['width'], Config::get('settings.events_img')['mini']['height'],
                function ($constraint) { $constraint->upsize();},
                $position)->save(public_path() . '/images/event/mini/'.$path, 100);
            return $path;
        } else {
            return false;
        }
    }

    /**
     * @param File $image
     * @param $alias
     * @param string $position
     * @return bool|string
     */
    public function sliderImg($image, $alias, $position = 'center')
    {
        if($image->isValid()) {

            $path = substr($alias, 0, 64) . '-slider-' . str_random(2) . time() . '.jpeg';

            $img = Image::make($image);

            $img->fit(Config::get('settings.events_slider_img')['main']['width'], Config::get('settings.events_slider_img')['main']['height'],
                function ($constraint) { $constraint->upsize();},
                $position)->save(public_path() . '/images/event/slider/main/'.$path, 100);
            $img->fit(Config::get('settings.events_slider_img')['middle']['width'], Config::get('settings.events_slider_img')['middle']['height'],
                function ($constraint) { $constraint->upsize();},
                $position)->save(public_path() . '/images/event/slider/middle/'.$path, 100);
            $img->fit(Config::get('settings.events_slider_img')['small']['width'], Config::get('settings.events_slider_img')['small']['height'],
                function ($constraint) { $constraint->upsize();},
                $position)->save(public_path() . '/images/event/slider/small/'.$path, 100);
            $arr['path'] = $path;
            return $arr;
        } else {
            return false;
        }
    }
    /**
     * delete old main image
     * @param $path
     * @return true
     */
    public function deleteOldImages($name, $path)
    {
        if (File::exists(public_path('/images/'. $path .'/main/') . $name)) {
            File::delete(public_path('/images/'. $path .'/main/') . $name);
        }
        if (File::exists(public_path('/images/'. $path .'/middle/'). $name)) {
            File::delete(public_path('/images/'. $path .'/middle/') . $name);
        }
        if (File::exists(public_path('/images/'. $path .'/small/'). $name)) {
            File::delete(public_path('/images/'. $path .'/small/'). $name);
        }
        if (File::exists(public_path('/images/'. $path .'/mini/'). $name)) {
            File::delete(public_path('/images/'. $path .'/mini/'). $name);
        }
        if (File::exists(public_path('/images/'. $path .'/tmp/'). $name)) {
            File::delete(public_path('/images/'. $path .'/tmp/'). $name);
        }
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function displayed($event)
    {
        try {
            $event->increment('view');

        } catch (Exception $e) {
            \Log::info('Ошибка записи просмотра: ', $e->getMessage());

        }
        return true;
    }

    public function getWithoutPrems($where_in = false, $pagination = false, $where = false, $wherenot = false, $order = false)
    {
        $builder = $this->model->with('logo');

        if ($where) {
            $builder->where($where);
        }

        if ($where_in) {
            $builder->whereIn('organizer_id', $where_in);
        }

        if ($wherenot) {
            $wherenot = array_diff($wherenot, ['']);
            $builder->whereNotIn('id', $wherenot);
        }

        if ($order) {
            $builder->orderBy($order[0], $order[1]);
        }

        if($pagination) {
            return $builder->paginate(Config::get('settings.paginate'));
        }

        return $builder->get();
    }

    /**
     * @param $ids
     * @return \Illuminate\Support\Collection
     */
    public function getPrems($ids)
    {
        $result = $this->model->with('logo')
                        ->whereIn('id', $ids)
                        ->get();
        return $result;
    }

    /**
     * @param $select
     * @param $where
     * @param $take
     * @param $order
     * @return bool
     */
    public function mostDisplayed($select, $where, $take, $order)
    {
        return $this->check($this->model->where($where)
            ->take($take)
            ->select($select)
            ->orderBy($order[0], $order[1])
            ->get());
    }

    /**
     * @param $id
     * @return array
     */
    public function delSlider($id)
    {
        $slider = Slider::find($id);

        if (empty($slider)) {
            return ['error' => 'Ошибка удаления слайдера'];
        }
        $name = $slider->path;
        try {
            $slider->delete();
        } catch (Exception $e) {
            return ['error' => 'Ошибка удаления слайдера'];
        }
        $this->deleteOldImages($name, 'event/slider');

        return ['success' => 'Слайдер обновлен'];


    }

    public function getSimilar($id, $organizer_id, $cat_id)
    {
        $cat = $this->model->select('id', 'title', 'created_at', 'alias')
                                ->where('cat_id', $cat_id)
                                ->where('id', '<>', $id)
                                ->where('organizer_id', '<>', $organizer_id);
        $all = $this->model->select('id', 'title', 'created_at', 'alias')
                                ->where('id', '<>', $id)
                                ->where('cat_id', '<>', $cat_id)
                                ->where('organizer_id', '<>', $organizer_id);
        $similar = $this->model->select('id', 'title', 'created_at', 'alias')
                                ->where('organizer_id', $organizer_id)
                                ->where('id', '<>', $id)
                                ->union($cat)
                                ->union($all)
            ->with('logo')
                                ->take(3)
                                ->get();
        return $this->check($similar);
    }

    public function convertStop($result)
    {

        if($result->isEmpty()) {
            return FALSE;
        }

        $result->transform(function($item) {

            if (!empty($item->stop)) {
                $item->stop_date = date('d', strtotime($item->stop));
            }

            if (!empty($item->start)) {
                $item->start_date = date('d', strtotime($item->start));
                if (date('m', strtotime($item->stop)) != date('m', strtotime($item->start))) {
                    $item->stop_date = 31;
//                    $item->start_date = 1;
                }
            }

            return $item;

        });

        return $result;

    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAd($eadv)
    {
        return $eadv->select('id', 'extlink', 'title', 'image')->get();
    }

    /**
     * @param $request
     * @param $ad Instance of Eadv
     * @return array
     */
    public function updateAdvertising($request, $ad)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string',
            'extlink' => 'nullable|string|url',
            'img' => 'mimes:jpg,bmp,png,jpeg|max:5120|nullable',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        $data['title'] = $request->get('title');
        $data['extlink'] = $request->get('extlink');


        if ($request->hasFile('img')) {
            $image = $request->file('img');
            if ($image->isValid()) {

                $path = $data['title'] ? $this->transliterate($data['title']) : str_random(16);

                $path = substr($path, 0, 64) . '-' . time() . '.jpeg';

                $img = Image::make($image);

                $img->fit(Config::get('settings.events_ad')['main']['width'], Config::get('settings.events_ad')['main']['height'],
                    function ($constraint) {
                        $constraint->upsize();
                    },
                    'center')->save(public_path() . '/images/event/ad/main/' . $path, 100);
                $img->fit(Config::get('settings.events_ad')['small']['width'], Config::get('settings.events_ad')['small']['height'],
                    function ($constraint) {
                        $constraint->upsize();
                    },
                    'center')->save(public_path() . '/images/event/ad/small/' . $path, 100);

                $data['image'] = $path;

                if (File::exists(public_path('/images/event/ad/main/') . $ad->image)) {
                    File::delete(public_path('/images/event/ad/main/') . $ad->image);
                }
                if (File::exists(public_path('/images/event/ad/small/') . $ad->image)) {
                    File::delete(public_path('/images/event/ad/small/') . $ad->image);
                }
            }
        }

        try {
            $ad->fill($data)->save();
        } catch (Exception $e) {
            \Log::info('Ошибка записи рекламы мероприятий ', $e->getMessage());
            $error[] = ['advertising' => 'Ошибка записи рекламы'];
            return $error;
        }

        if ($request->hasFile('img')) {

        }

        Cache::forget('eventSidebar');
        return ['status' => trans('admin.material_updated')];
    }

    public function delAdvertising($ad)
    {
        $old_image = $ad->image;
        $ad->title = null;
        $ad->extlink = null;
        $ad->image = null;
        $ad->save();

        if (File::exists(public_path('/images/event/ad/main/') . $old_image)) {
            File::delete(public_path('/images/event/ad/main/') . $old_image);
        }
        if (File::exists(public_path('/images/event/ad/small/') . $old_image)) {
            File::delete(public_path('/images/event/ad/small/') . $old_image);
        }

    }
}