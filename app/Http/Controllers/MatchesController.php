<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Voyager\VoyagerBreadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBreadController as BaseVoyagerBreadController;
use App\Repositories\RoleRepositoryEloquent;


class MatchesController extends VoyagerBreadController{

    
    public function index(Request $request)
    {
        dd($request->slug);
         // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('browse_'.$dataType->name);

        $getter = $dataType->server_side ? 'paginate' : 'get';

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            $relationships = $this->getRelationships($dataType);

            $builder = $model->with($relationships);

            // @todo put in method?
            switch (get_class($model)) {

                case \TCG\Voyager\Models\User::class:

                    switch(Auth::user()->role_id){
                        case $this->roleRepository->admin:
                            # code...
                            // $builder->where('role_id', $this->roleRepository->volunteer);
                            break;
                    }

                    break;
            }

            if ($model->timestamps) {
                $dataTypeContent = call_user_func([$builder->latest(), $getter]);
            } else {
                $dataTypeContent = call_user_func([
                    $builder->orderBy($model->getKeyName(), 'DESC'),
                    $getter,
                ]);
            }
            //Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {

            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }
}