@extends('layouts.master')
@section('title', '歷史單字')
@section('content')
<div class="container">
<form id="history" method="get" action="{{route('toeic.show')}}">

  @csrf
  <div class="btn-group col-md-12">
    <div class="col-md-4">
        <label for="Year">Year</label>
        <select id="Year" name="Year"class="form-control" requested>
          <option>2020</option>
          <option>2019</option>

        </select>
      </div>
      <div class="col-md-4">
          <label for="Month">Month</label>
          <select id="Month" name="Month" class="form-control" requested>
            <option>05</option>
            <option>04</option>
          </select>
        </div>
        <div class="col-md-4">
            <label for="Day">Day</label>
            <select id="Day" name="Day" class="form-control" requested>
              <option>20</option>
              <option>19</option>
              <option>18</option>
              <option>17</option>
              <option>16</option>
              <option>15</option>
              <option>14</option>
              <option>13</option>
            </select>
          </div>

  </div>

  <button type="submit" class="btn btn-primary" >submit</button>


</form>





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
