<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain;
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
        $domains = Domain::paginate(15);
    
        return view('domains', ['domains' => $domains]);
    }

    public function analysis(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain' => 'required|url'
        ]);
        
        if ($validator->fails()) {
            return view('home', ['errors' => $validator->errors()->all()]);
        }

        $domain = $request->input('domain');
        
        $container = Container::getInstance();
        $client = $container->make('GuzzleHttp\Client');

        $res = $client->get($domain);
        $responseCode = $res->getStatusCode();
        $body = $res->getBody()->getContents();

        if (isset($res->getHeader('Content-Length')[0])) {
            $contentLength = (int) $res->getHeader('Content-Length')[0];
        } else {
            $contentLength = mb_strlen($body);
        }

        $document = new Document($body);
        if ($document->has('h1')) {
            $header = $document->first('h1');
            $h1 = $header->text();
        } else {
            $h1 = '';
        }

        if ($document->has('meta[name="keywords"]')) {
            $meta1 = $document->find('meta[name="keywords"]')[0];
            $keywords = $meta1->getAttribute('content');
        } else {
            $keywords = '';
        }
        
        if ($document->has('meta[name="description"]')) {
            $meta2 = $document->find('meta[name="description"]')[0];
            $description = $meta2->getAttribute('content');
        } else {
            $description = '';
        }
        

        $date = Carbon::now();
        $id = Domain::create([
                                'name' => $domain,
                                'updated_at' => $date,
                                'created_at' => $date,
                                'response_code' => $responseCode,
                                'content_length' => $contentLength,
                                'h1' => $h1,
                                'keywords' => $keywords,
                                'description' => $description,
                                'body' => mb_convert_encoding($body, "UTF-8")
                            ]);
    
        return redirect()->route('domains.show', ['id' => $id]);
    }  
    
    public function show($id)
    {
        $domain = Domain::findOrFail($id);

        return view('domain', ['domain' => $domain]);
    }
}
