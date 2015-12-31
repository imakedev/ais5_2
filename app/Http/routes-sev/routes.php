<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('ais/index');
});
/*
Route::get('/hello', function () {
    return "hello";
});

Route::get('welcome/hello','WelcomeController@hello');

Route::get('/hello/index' ,'HelloController@index');
*/
Route::get('/ais' ,function()
{
    return redirect('ais/index');
});
Route::get('/ais/index' ,function()
{
    return view('ais.index');
});
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

Route::get('/ais/trend', function(){
    return view('ais.trend');
});

Route::get('/ais/processView', function(){
    return view('ais.process_view');
});


Route::get('/ais/sootBlower', function(){
    return view('ais.soot_blower');
});
/* End Dashboard Menu */


Route::get('/ais/test_nong', function(){
    return view('ais.test_nong');
});
/* Start Design Menu */
Route::resource('/ais/trendColor','TrendColorController');

Route::resource('/ais/designTrend', 'TrendDesignController');

Route::get('/ais/designTrends', 'TrendDesignController@search');
  //  return view('ais.design_trend');
// });

Route::get('/designTrend/deleteSelect', 'TrendDesignController@deleteSelect');


Route::get('/ais/designCalculation', function(){
    return view('ais.design_calculation');
});

Route::get('/ais/formCalculation', function(){
    return view('ais.form_calculation');
});
/* End Design Menu */

Route::resource('/ais/soot', 'SootController@search');
Route::resource('/ais/sootBlower', 'SootController@search');


Route::get('/ais/design_trend', function(){
    return view('ais.design_trend');
});
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


Route::resource('/ais/addUser', 'AddUserController');

Route::get('/ais/addUser/store', 'AddUserController@store');

Route::get('/addUser/deleteSelect', 'AddUserController@deleteSelect');

Route::get('/addUser/destroy/{ZZ}', 'AddUserController@destroy');


Route::resource('/ais/tagConfiguration', 'TagConfigController');

Route::get('/ais/tagConfiguration/store', 'TagConfigController@store');

Route::get('/tagConfiguration/deleteSelect', 'TagConfigController@deleteSelect');

Route::get('/tagConfiguration/delete/{A}', 'TagConfigController@destroy');


Route::resource('/ais/pointConfiguration', 'PointConfigController');

Route::get('/ais/pointConfiguration/store', 'PointConfigController@store');

Route::get('/pointConfiguration/deleteSelect', 'PointConfigController@deleteSelect');

Route::get('/pointConfiguration/delete/{A}', 'PointConfigController@destroy');


Route::resource('/ais/serverSetting', 'ServController');

Route::get('/ais/serverSetting/store', 'ServController@store');
/* End General Menu */

Route::get('/ais/login', function(){
    return view('ais.login');
});

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
    Route::post('/ais/trendSetting/getDataByQuery/{query}','trendSetingController@getDataByQuery');

    // Route::get('/trendSetting/edit/','trendSetingController@editMember');
    
    /*trend seting end00*/



    
    /*trend service start*/
    Route::get('/ais/serviceTrend/getDataHru/{point}/{unit}/{startTime}/{endTime}/','serviceTrendController@getDataHru');
    Route::get('/ais/serviceTrend/readDataHru/','serviceTrendController@readDataHru');
    
    
    Route::get('/ais/serviceTrend/getDataDayu/{point}/{unit}/{startTime}/{endTime}/','serviceTrendController@getDataDayu');
    Route::get('/ais/serviceTrend/readDataDayu/','serviceTrendController@readDataDayu');
    
    
    //process view start

    Route::get('/ais/serviceTrend/getDataMonthu/{point}/{unit}/{startTime}/{endTime}/','serviceTrendController@getDataMonthu');
    Route::get('/ais/serviceTrend/readDataMonthu/','serviceTrendController@readDataMonthu');


    Route::get('/ais/serviceTrend/readDataSecondu/{folderName}/{fileName}/{point}/','serviceTrendController@readDataSecondu');
    Route::get('/ais/serviceTrend/readEventDataTrend/{point}/{unit}/{startTime}/{endTime}/','serviceTrendController@readEventDataTrend');
    Route::get('/ais/serviceTrend/readEventDataTrendByEvent/{point}/{unit}/{startTime}/{endTime}/{event}/','serviceTrendController@readEventDataTrendByEvent');



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
    
    //process view end
    
    //Test
    
    Route::get('/ais/Test/trendDashboard', function(){
        return view('ais.test-trend');
    });
    Route::get('/ais/Test/servProduction', function(){
        return view('ais.servProduction');
    });
    Route::get('/ais/processView/testMultiConnection/','processViewController@testMultiConnection');

        /*trend service end*/
    
    //Test GIT ADFASDFNONG THIS FLIE OK 001

