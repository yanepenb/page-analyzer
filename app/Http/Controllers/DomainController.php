<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Validator;
use GuzzleHttp\Client;
use Illuminate\Container\Container;
use DiDom\Document;

class DomainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function showAll()
    {
        $domains = DB::table('domains')->paginate(5);
    
        return view('domains', ['domains' => $domains]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain' => 'required|url'
        ]);
        
        if ($validator->fails()) {
            return view('index', ['errors' => $validator->errors()->all()]);
        }

        $domain = $request->input('domain');
        
        $container = Container::getInstance();
        $client = $container->make('GuzzleHttp\Client');

        $res = $client->get($domain);
        $responseCode = $res->getStatusCode();
        $body = $res->getBody()->getContents();

        if (isset($res->getHeader('Content-Length')[0])) {
            $contentLength = (integer) $res->getHeader('Content-Length')[0];
        } else {
            $contentLength = strlen($body);
        }

        $document = new Document($body);
        if ($document->has('h1')) {
            $h1 = $document->first('h1')->text();
        } else {
            $h1 = '';
        }

        if ($document->has('meta[name="keywords"]')) {
            $keywords = $document->find('meta[name="keywords"]')[0]->getAttribute('content');
        } else {
            $keywords = '';
        }
        
        if ($document->has('meta[name="description"]')) {
            $description = $document->find('meta[name="description"]')[0]->getAttribute('content');
        } else {
            $description = '';
        }
        

        $date = Carbon::now();
        $id = DB::table('domains')->insertGetId([
                                            'name' => $domain,
                                            'updated_at' => $date,
                                            'created_at' => $date,
                                            'response_code' => $responseCode,
                                            'content_length' => $contentLength,
                                            'h1' => $h1,
                                            'keywords' => $keywords,
                                            'description' => $description,
                                            'body' => $body
                                        ]);
    
        return redirect()->route('domainId', ['id' => $id]);
    }

    public function showId($id)
    {
        $domain = DB::table('domains')->where('id', $id)->first();
    
        return view('domain', ['domain' => $domain]);
    }
}
