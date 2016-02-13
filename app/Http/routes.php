
<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
   // return view('welcome');
    return redirect('ais/index');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
/*
Route::filter('auth', function()
{
    if (Auth::guest()) {
        if (Request::ajax()) {
            return Response::json(false, 401);
        } else {
            return Redirect::guest('login');
        }
    }
});
*/
Route::post('/login2','Auth\AuthController@authenticate');
Route::get('/logout2','Auth\AuthController@doLogout');

Route::group(['middleware' => ['web','auth']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {

   Route::auth();
    /*

    Route::get('login', 'Auth\AuthController@getLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    //Route::post('auth/login', 'Auth\AuthController@postLogin');
    */
    //Route::get('login', 'Auth\AuthController@getLogin');
    //Route::get('logout', 'Auth\AuthController@getLogout');
    Route::post('login', 'Auth\AuthController@authenticate');

    Route::get('/home', 'HomeController@index');
    Route::get('profile', [
        'middleware' => 'auth',
        'uses' => 'ProfileController@show'
    ]);


    Route::get('/ais' , ['middleware' => 'auth', function()
    {
        return redirect('ais/index');
    }]);
    Route::get('/ais/index' ,['middleware' => 'auth',function()
    {
        return view('ais.index');
    }]);
    /*
    Route::get('/logout' ,['middleware' => 'auth' , function()
    {
        return redirect('ais/login');
    }]);
    */
    /*
    Route::resource('/test', 'SearchController'
    //    function(){
    //    $datas = \App\UserLoginLog::where(function($query){
    //
    //    $search_input = Input::has('search') ? Input::get('search') : null;
    //
    //    if(isset($search_input)){
    //        $query->orWhere('first_name','=',$search_input)
    //              ->orWhere('last_name','=' ,$search_input);
    //    }
    //
    //    })->get();
    //
    //    return view('ais.test',compact(['datas']));
    //}
    );
    */
// Route::resource('articles', 'HelloController');

    /* Start Dashboard Menu */

    Route::get('/ais/trend', ['middleware' => 'auth',function(){
        return view('ais.trend');
    }]);

    Route::get('/ais/processView',['middleware' => 'auth', function(){
        return view('ais.process_view');
    }]);


    Route::get('/ais/sootBlower', ['middleware' => 'auth',function(){
        return view('ais.soot_blower');
    }]);
    /* End Dashboard Menu */


    Route::get('/ais/test_nong',['middleware' => 'auth', function(){
        return view('ais.test_nong');
    }]);
    /* Start Design Menu */

    Route::get('/ais/specialMenu', function(){
     return view('ais.special_menu');
    });
   Route::resource('/ais/trendColor','TrendColorController');

    Route::resource('/ais/designTrend', 'TrendDesignController@search');

    //Route::get('/ais/designTrends', 'TrendDesignController@search');
    //  return view('ais.design_trend');
// });

    Route::get('/designTrend/deleteSelect', 'TrendDesignController@deleteSelect');

/*
    Route::get('/ais/designCalculation', function(){
        return view('ais.design_calculation');
    });

    Route::get('/ais/formCalculation', function(){
        return view('ais.form_calculation');
    });
*/
   Route::resource('/ais/designCalculation', 'CalculationController@search');
   Route::get('/designCalculation/destroy/{A}', 'CalculationController@destroy');
   Route::get('/designCalculation/deleteSelect', 'CalculationController@deleteSelect');
    Route::post('/ais/designCalculation/store', 'CalculationController@store');

  Route::get('/ais/formCalculation/{A}','CalculationController@edit');
    Route::get('/ais/formCalculation/clone/{A}','CalculationController@cloneCalculation');
    /* End Design Menu */

    Route::resource('/ais/soot', 'SootController@search');
    Route::resource('/ais/sootBlower', 'SootController@search');


    Route::get('/ais/design_trend', ['middleware' => 'auth',function(){
        return view('ais.design_trend');
    }]);
//
    /*
    Route::get('ais/test', ('SearchController@index'));

    Route::get('/ais/test2' ,('SearchController@test'));

    Route::get('/edit/{user_login_log_id}', ('searchController@edit'));

    Route::get('/a', function(){
        return view('ais.new');
    });
    */
    /* Start General Menu */


    Route::resource('/ais/statistics', 'StatisticsController@search');


    Route::resource('/ais/addUser', 'AddUserController@search');

    Route::post('/ais/addUser/store', 'AddUserController@store');

    Route::get('/addUser/deleteSelect', 'AddUserController@deleteSelect');

    Route::get('/addUser/destroy/{ZZ}', 'AddUserController@destroy');


    Route::resource('/ais/tagConfiguration', 'TagConfigController@search');

    Route::post('/ais/tagConfiguration/store', 'TagConfigController@store');

    Route::get('/tagConfiguration/deleteSelect', 'TagConfigController@deleteSelect');

    Route::get('/tagConfiguration/delete/{A}', 'TagConfigController@destroy');


    Route::resource('/ais/pointConfiguration', 'PointConfigController@search');

    Route::post('/ais/pointConfiguration/store', 'PointConfigController@store');

    Route::get('/pointConfiguration/deleteSelect', 'PointConfigController@deleteSelect');

    Route::get('/pointConfiguration/delete/{A}', 'PointConfigController@destroy');

    //Route::resource('/ais/tagofpoint/{A}', 'PointConfigController@searchTagOfPoint');

    Route::resource('/ais/serverSetting', 'ServController');

    Route::get('/ais/serverSetting/store', 'ServController@store');
    /* End General Menu */
   /*
    Route::get('/ais/login', function(){
        return view('ais.login');
    });
*/
// Ajax
    Route::get('/ajax/mmtrends/list','Ajax\TrendDesignAjax@listMmTrend');
    Route::get('/ajax/mmtrend/get','Ajax\TrendDesignAjax@getMmTrend');
    Route::get('/ajax/mmname/get','Ajax\TrendDesignAjax@getMmname');
    Route::post('/ajax/mmtrend/post','Ajax\TrendDesignAjax@postMmTrend');
    Route::post('/ajax/mmname/post','Ajax\TrendDesignAjax@postMmname');
    Route::delete('/ajax/mmname/delete','Ajax\TrendDesignAjax@deleteMmname');
    Route::delete('/ajax/mmtrend/delete','Ajax\TrendDesignAjax@deleteMmtrend');
    Route::post('/ajax/mmname/search','Ajax\TrendDesignAjax@postMmname');

    Route::post('/ajax/mmpoint/search','Ajax\TrendDesignAjax@searchMmpoint');
    Route::get('/ajax/multipledb/get','Ajax\TrendDesignAjax@mulipleDB');

    Route::post('/ajax/addmmpoint/search','Ajax\TrendDesignAjax@searchAddPointMmpoint');
    Route::post('/ajax/addmmpoint/doAdd','Ajax\TrendDesignAjax@doAddPointMmpoint');
    Route::post('/ajax/mmtag/get','Ajax\TrendDesignAjax@getMmTag');

    Route::post('/ajax/constant/search','Ajax\ConstantAjax@search');
    Route::post('/ajax/constant/post','Ajax\ConstantAjax@post');
    Route::post('/ajax/constant/get','Ajax\ConstantAjax@get');
    Route::post('/ajax/constant/delete','Ajax\ConstantAjax@delete');

    Route::post('/ajax/calculation/extract','Ajax\CalculationAjax@extractFormula');
    /*
    Route::get('/ajax/get', function () {
        // pass back some data
        $data   = array('value' => 'some data');
        // return a JSON response
        return  Response::json($data);
    });
    */
    Route::post('/ajax/post', function () {
        // pass back some data, along with the original data, just to prove it was received
        $data   = array('value' => 'some data', 'input' => Request::input());
        // return a JSON response
        return  Response::json($data);
    });



    /*trend seting start*/
    // Route::post('/trendSetting/post','trendSetingController@postMember');
    Route::get('/ais/trendSetting/getAllTrendGroup/','trendSetingController@getAllTrendGroup');
    Route::get('/ais/trendSetting/getTrendByGroup/{id}/{trendGroupName?}','trendSetingController@getTrendByGroup');
    Route::get('/ais/trendSetting/getPointByTrend/{trendID}/{unitID}','trendSetingController@getPointByTrend');
    Route::get('/ais/trendSetting/getPointByPointID/{pontID}','trendSetingController@getPointByPointID');
    Route::get('/ais/trendSetting/getPointCompareByTrendIDAndPointID/{trendID}/{pontID}','trendSetingController@getPointCompareByTrendIDAndPointID');
    Route::post('/ais/trendSetting/getDataByQuery/{query}','trendSetingController@getDataByQuery');
    // Route::get('/trendSetting/edit/','trendSetingController@editMember');

    /*trend seting end00*/




    /*trend service start*/
    
    //$point,$unit,$trendID,$empId,$mmPlant,$startTime,$endTime
    Route::get('/ais/serviceTrend/createDataMinuteu/{trendID}/{startTime}/{endTime}/{queryPoint}/{unitIdPointId}','serviceTrendController@createDataMinuteu');
    //readDataMinuteu(trendID,empID,mmPlant)
    Route::get('/ais/serviceTrend/readDataMinuteu/{trendID}/','serviceTrendController@readDataMinuteu');
    
    Route::get('/ais/serviceTrend/getDataHru/{startTime}/{endTime}/{trendID}/{queryPoint}/{unitIdPointId}','serviceTrendController@getDataHru');
    Route::get('/ais/serviceTrend/readDataHru/{trendID}/','serviceTrendController@readDataHru');
    
    
    Route::get('/ais/serviceTrend/getDataDayu/{startTime}/{endTime}/{trendID}/{queryPoint}/{unitIdPointId}','serviceTrendController@getDataDayu');
    Route::get('/ais/serviceTrend/readDataDayu/{trendID}/','serviceTrendController@readDataDayu');
    
    
    Route::get('/ais/serviceTrend/getDataMonthu/{startTime}/{endTime}/{trendID}/{queryPoint}/{unitIdPointId}','serviceTrendController@getDataMonthu');
    Route::get('/ais/serviceTrend/readDataMonthu/{trendID}','serviceTrendController@readDataMonthu');
    
    
    Route::get('/ais/serviceTrend/readDataSecondu/{trendID}/','serviceTrendController@readDataSecondu');
    Route::get('/ais/serviceTrend/createDataSecondu/{dateTime}/{point}/{trendID}','serviceTrendController@createDataSecondu');
    
    
    
    Route::get('/ais/serviceTrend/readEventDataTrend/{point}/{unit}/{startTime}/{endTime}/','serviceTrendController@readEventDataTrend');
    Route::get('/ais/serviceTrend/readEventDataTrendByEvent/{tagName}/{startDateTime}/{endDateTime}/{event}/','serviceTrendController@readEventDataTrendByEvent');
    
    
    
    /*trend service end*/



    //process view start
    //Steam47 START
    Route::get('/ais/processView/createDataPCVSteam47/{paramPCV}/{paramUnit}/{paramEmpId}/{paramFromDate}/{paramToDate}','processViewController@createDataPCVSteam47');
    Route::get('/ais/processView/readDataPCVSteam47/{paramPCV}/{paramUnit}/{paramEmpId}','processViewController@readDataPCVSteam47');

    Route::get('/ais/processView/createDataEventPCVSteam47/{paramPCV}/{paramUnit}/{paramEmpId}/{paramFromDate}/{paramToDate}','processViewController@createDataEventPCVSteam47');
    Route::get('/ais/processView/readDataEventPCVSteam47/{paramPCV}/{paramUnit}/{paramEmpId}','processViewController@readDataEventPCVSteam47');
    //Steam47 END

    //Plantow47 START
    Route::get('/ais/processView/createDataPCVPlantow47/{paramPCV}/{paramUnit}/{paramEmpId}/{paramFromDate}/{paramToDate}','processViewController@createDataPCVPlantow47');
    Route::get('/ais/processView/readDataPCVPlantow47/{paramPCV}/{paramUnit}/{paramEmpId}','processViewController@readDataPCVPlantow47');

    Route::get('/ais/processView/createDataEventPCVPlantow47/{paramPCV}/{paramUnit}/{paramEmpId}/{paramFromDate}/{paramToDate}','processViewController@createDataEventPCVPlantow47');
    Route::get('/ais/processView/readDataEventPCVPlantow47/{paramPCV}/{paramUnit}/{paramEmpId}','processViewController@readDataEventPCVPlantow47');
    //Plantow47 END
    
    
    //FGD START
    Route::get('/ais/processView/createDataPCVFGD/{paramPCV}/{paramUnit}/{paramEmpId}/{paramFromDate}/{paramToDate}','processViewController@createDataPCVFGD');
    Route::get('/ais/processView/readDataPCVFGD/{paramPCV}/{paramUnit}/{paramEmpId}','processViewController@readDataPCVFGD');
    
    Route::get('/ais/processView/createDataEventPCVFGD/{paramPCV}/{paramUnit}/{paramEmpId}/{paramFromDate}/{paramToDate}','processViewController@createDataEventPCVFGD');
    Route::get('/ais/processView/readDataEventPCVFGD/{paramPCV}/{paramUnit}/{paramEmpId}','processViewController@readDataEventPCVFGD');
    //FGD END
    
    //Turbine47 START
    Route::get('/ais/processView/createDataPCVTurbine47/{paramPCV}/{paramUnit}/{paramEmpId}/{paramFromDate}/{paramToDate}','processViewController@createDataPCVTurbine47');
    Route::get('/ais/processView/readDataPCVTurbine47/{paramPCV}/{paramUnit}/{paramEmpId}','processViewController@readDataPCVTurbine47');
    
    Route::get('/ais/processView/createDataEventPCVTurbine47/{paramPCV}/{paramUnit}/{paramEmpId}/{paramFromDate}/{paramToDate}','processViewController@createDataEventPCVTurbine47');
    Route::get('/ais/processView/readDataEventPCVTurbine47/{paramPCV}/{paramUnit}/{paramEmpId}','processViewController@readDataEventPCVTurbine47');
    //Turbine47 END
    
    

    //process view end

    //Test
    Route::get('/ais/serviceTrend/readSessEmpID','serviceTrendController@readSessEmpID');
    
    Route::get('/ais/Test/trendDashboard',['middleware' => 'auth', function(){
        return view('ais.test-trend');
    }]);
    
    Route::get('/ais/Test/servProduction',['middleware' => 'auth', function(){
        return view('ais.servProduction');
    }]);
    
    Route::get('/ais/processView/testMultiConnection/','processViewController@testMultiConnection');
    Route::get('/ais/processView/destinationSearch/','ParentRegionList@destinationSearch');


    Route::get('/logout', 'Auth\AuthController@getLogout');

//test 009




});

