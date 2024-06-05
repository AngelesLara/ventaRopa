<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" class="form-control" placeholder="ingrese nombre o correo del usuario...">
        </div>
        @if ($users->count())
            <div class="card-body">
                <table class="table table-striper">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>EMAIL</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td width="10px">
                                    <a class="btn btn-primary" href="{{ route('admin.usuarios.edit', $item) }}">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>SIN REGISTROS...</strong>
            </div>
        @endif
    </div>
</div>
