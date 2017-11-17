@extends('layout.master-template')

@section('content')

<form action="/task" method="POST">
    {{-- Display token --}}
    {{ csrf_field() }}


    <div class="form-group">
        @include('common.errors')

        <label for="formTask">Task</label>
        <input type="text" class="form-control" name="name">
    </div>
    <button class="btn btn-primary">Submit Task</button>
</form>

<br>

@if ( count($tasks) > 0 )

<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Task</th>
        <th>Option</th>
      </tr>
    </thead>
    <tbody>

      @php $n = 1; @endphp
      @foreach($tasks as $task)
      <tr>
        <td>{{ $n++ }}</td>
        <td>{{ $task->name }}</td>
        <td>
          <form action="/task/{{ $task->id }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
</div>

@endif

@endsection
