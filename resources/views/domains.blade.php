@extends('layouts.app')
@section('content')
      <table class="table table-striped table-light">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">response_code</th>
                <th scope="col">content_length</th>
                <th scope="col">h1</th>
                <th scope="col">updated_at</th>
                <th scope="col">created_at</th>
                </tr>
            </thead>
            @foreach ($domains as $domain)
                <tbody>
                    <tr>
                    <th scope="row"><a href="{{ route('domains.show', ['id' => $domain->id]) }}">{{ $domain->id }}</a></th>
                    <td><a href="{{ $domain->name }}" target="_blank">{{ $domain->name }}</a></td>
                    <td>{{ $domain->response_code }}</td>
                    <td>{{ $domain->content_length }}</td>
                    <td>{{ $domain->h1 }}</td>
                    <td>{{ $domain->updated_at }}</td>
                    <td>{{ $domain->created_at }}</td>
                    </tr>
                </tbody>
            @endforeach
      </table>
      
      {{ $domains->links() }}
@endsection