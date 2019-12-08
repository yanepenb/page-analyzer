@extends('layouts.app')
@section('content')
      <table class="table table-striped table-light">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">updated_at</th>
                <th scope="col">created_at</th>
                </tr>
            </thead>
            @foreach ($domains as $domain)
                <tbody>
                    <tr>
                    <th scope="row"><a href="/domains/{{ $domain->id }}">{{ $domain->id }}</a></th>
                    <td><a href="{{ $domain->name }}" target="_blank">{{ $domain->name }}</a></td>
                    <td>{{ $domain->updated_at }}</td>
                    <td>{{ $domain->created_at }}</td>
                    </tr>
                </tbody>
            @endforeach
      </table>
      
      {{ $domains->links() }}
@endsection