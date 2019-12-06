<?php

use Illuminate\Http\Request;
use Carbon\Carbon;

// use Illuminate\Support\MessageBag;
// use Illuminate\View\Middleware\ShareErrorsFromSession;
// use Validator;
// use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () {
    return view('index');
});

$router->get('/domains', function () {
    $domains = DB::table('domains')->get();

    return view('domains', ['domains' => $domains]);
});

$router->post('/domains', function (Request $request) {

    $validator = Validator::make($request->all(), [
        'url' => 'required|url'
    ]);
    
    if ($validator->fails()) {
        return view('index', ['errors' => $validator->errors()->all()]);
    }

    $date = Carbon::now();
    $domain = $request->input('domain');
    $id = DB::table('domains')->insertGetId([
                                        'name' => $domain,
                                        'updated_at' => $date,
                                        'created_at' => $date
                                    ]);

    return redirect()->route('domainsId', ['id' => $id]);
});

$router->get('/domains/{id}', ['as' => 'domainsId', function ($id) {
    $domain = DB::table('domains')->where('id', $id)->first();

    return view('domain', ['domain' => $domain]);
}]);
