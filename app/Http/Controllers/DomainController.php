<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain;
use Validator;
use GuzzleHttp\Client;
use DiDom\Document;

class DomainController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $domains = Domain::paginate(15);
    
        return view('domains', ['domains' => $domains]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url'
        ]);
        
        if ($validator->fails()) {
            return view('home', ['errors' => $validator->errors()->all()]);
        }

        $url = $request->input('url');

        $res = $this->client->get($url);
        $responseCode = $res->getStatusCode();
        $body = $res->getBody()->getContents();

        if (isset($res->getHeader('Content-Length')[0])) {
            $contentLength = (int) $res->getHeader('Content-Length')[0];
        } else {
            $contentLength = mb_strlen($body);
        }

        $document = new Document($body);
        $h1 = $document->first('h1');
        $header = $h1 ? $h1->text() : '';
        
        $meta1 = $document->first('meta[name=keywords]');
        $keywords = $meta1 ? $meta1->getAttribute('content') : '';

        $meta2 = $document->first('meta[name=description]');
        $description = $meta2 ? $meta2->getAttribute('content') : '';

        $domain = Domain::create([
                                'name' => $url,
                                'response_code' => $responseCode,
                                'content_length' => $contentLength,
                                'h1' => $header,
                                'keywords' => $keywords,
                                'description' => $description,
                                'body' => mb_convert_encoding($body, "UTF-8")
                            ]);
    
        return redirect()->route('domains.show', ['id' => $domain->id]);
    }
    
    public function show($id)
    {
        $domain = Domain::findOrFail($id);

        return view('domain', ['domain' => $domain]);
    }
}
