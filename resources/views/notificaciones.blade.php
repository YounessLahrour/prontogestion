@extends('layouts.app')

@section('titulo')
    Notificaciones
@endsection
@section('contenido')


    <table class="table table-dark mt-4">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Empleado</th>
            <th scope="col">Cliente</th>
            <th scope="col">Serial</th>
            <th scope="col">Fecha</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($empleados as $empleado)
          @foreach($empleado->clientes()->get() as $item)
          <tr>
              
              <td>{{$item->pivot->id}}</td>
              <td>{{$empleado->nombre}}, {{$empleado->apellido}}</td>
              <td>{{$item->pivot->cliente_id}}</td>
              <td>{{$item->pivot->serialOrden}}</td>
              <td>{{$item->pivot->created_at}}</td>
              
            </tr>
            @endforeach
          @endforeach
          
          
        </tbody>
      </table>
</div>


@endsection