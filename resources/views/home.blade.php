@extends('layouts.app')
@section('content')
  <div class="jumbotron">
    <form action="{{ route('domains.analysis') }}" method="post">
      <div class="form-group">
        <label for="formGroupExampleInput"></label>
        <input type="text" class="form-control" name="domain" id="formGroupExampleInput" placeholder="Введите домен...">
      </div>
      <button type="submit" class="btn btn-primary mb-2">Анализировать</button>
    </form>

    @if (isset($errors))
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
  </div>
@endsection