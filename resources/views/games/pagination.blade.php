@if(count($viewData["games"])>0)
    @foreach($viewData["games"] as $game)
        <div class="card game-card" style="width: 18rem;">
            <div class="card-header">
                <h5 class="card-title">{{ $game->getLocation() }}</h5>
                <h6 class="card-subtitle">{{ strftime("%d de %B", strtotime($game->getDate())) }}</h6>
            </div>
            <div class="card-body">
                <h6 class="card-sport">Deporte: <span>{{ $game->getSport() }}</span></h6>
                <p class="card-text">{{ substr($game->getDescription(), 0, 150) }}</p>
                <div class="card-group-buttons">
                    @if(\Illuminate\Support\Facades\Auth::id()==$game->getCreator())
                        <a href="{{ route('games.crud.edit', $game->getId()) }}" class="btn btn-warning">Editar</a>
                        <a href="#" class="btn btn-danger"
                           onclick="if(confirm('¿Esta seguro de que desea borrar esta pachanga?')) { document.getElementById('delete-form-{{ $game->getId() }}').submit(); }">Borrar</a>
                        <form id="delete-form-{{ $game->getId() }}"
                              action="{{ route('games.crud.delete', $game->getId()) }}" method="post"
                              style="display: none;">
                            @method('delete')
                            @csrf
                        </form>
                    @endif
                    <a href="{{ route('games.show', $game->getId()) }}" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
    @endforeach
@endif
