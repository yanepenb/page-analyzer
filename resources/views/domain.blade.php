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
            <tbody>
                <tr>
                <th scope="row">{{ $domain->id }}</th>
                <td>{{ $domain->name }}</td>
                <td>{{ $domain->updated_at }}</td>
                <td>{{ $domain->created_at }}</td>
                </tr>
            </tbody>
      </table>
@endsection