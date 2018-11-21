{!! Form::open(['url' => 'products/'.$product->id, 'method' => 'DELETE', 'class' => 'inline-block'])!!}
    <input type="submit" class="btn btn-link red-text no-margin no-padding no-transform" value="Eliminar">
{!! Form::close() !!}