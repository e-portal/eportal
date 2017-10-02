<?php

namespace Fresh\Estet\Repositories;

use Fresh\Estet\Article;
use Carbon\Carbon;
use Cache;
use Fresh\Estet\Subscriber;
use Validator;
use DB;

class AjaxRepository extends Repository
{
    protected $a_rep;

    public function __construct(ArticlesRepository $repository)
    {
        $this->a_rep = $repository;
    }

    /**
     * @return bool
     * @throws \Exception
     * @throws \Throwable
     */
    public function getLasts($request)
    {
        $currentPage = (int)$request->get('offset');
        $own = $request->get('own');

        if (($currentPage > 4294967294) || ($currentPage < 0)) {
            return $result['error'] = 'Ошибка получения данных';
        }

        switch ($own) {
            case 1:
                $own = 'patient';
                break;
            case 2:
                $own = 'docs';
                break;
            default:
                return $result['error'] = 'Ошибка получения данных';
        }
        $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', $own]);
        $articles_count = $this->a_rep->getCount($where);

        $articles = $this->a_rep->getLastAjax(
            '*', $where, $currentPage, 14, ['created_at', 'desc']);

        if (($currentPage + 14) < $articles_count) {
            $result['has_more'] = true;
        } else {
            $result['has_more'] = false;
        }

        if ('patient' == $own) {
            $own = 'doctors_art';
        } else {
            $own = 'articles';
        }

        $result['content'] = view('layouts.ajax.articles_cat')->with(['articles' => $articles, 'own' => $own])->render();

        return $result;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    /*  public function getDocs()
      {
          return Subscriber::select('email')->where('source', 'doctor')->get();
      }
  */
    /**
     * @return \Illuminate\Support\Collection
     */
    /* public function getPatients()
     {
         return Subscriber::select('email')->where('source', 'patient')->get();
     }*/

}