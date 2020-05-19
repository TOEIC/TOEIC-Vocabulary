@extends('layouts.master')
@section('title', '歷史單字')
@section('content')
<div class="container">

  <div class="btn-group">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Year
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
    </div>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Month
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
    </div>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Day
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
    </div>
  </div>

<button type="button" class="btn btn-primary">Submit</button>





<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">English</th>
      <th scope="col">
Part of speech</th>
      <th scope="col">Chinese</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($vocabularies as $vocabularies =>$vocabulary )

      <tr>
        <th scope="row">{{$vocabularies+1}}</th>
        <td><a href='https://dictionary.cambridge.org/zht/%E8%A9%9E%E5%85%B8/%E8%8B%B1%E8%AA%9E-%E6%BC%A2%E8%AA%9E-%E7%B9%81%E9%AB%94/{{$vocabulary->en}}' target='_blank'>{{$vocabulary->en}}</a></td>
        <td>{{$vocabulary->pos}}</td>
        <td>{{$vocabulary->zh}}</td>
      </tr>

    @endforeach

  </tbody>
</table>

</div>
@endsection
