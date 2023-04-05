<div class="container">
    <div class="row">
        <form wire:submit.prevent='createPost' action="" class="col-12 col-md-8 col-lg-6 mx-auto">
            <div class="mb-3">
                <label for="title" class="form-label">Inserisci il titolo(max 10 caratteri)</label>
                {{-- mostra l'errore sulle validazioni --}}
                @if ($errors -> has('title'))    
                <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                @endif
                <input wire:model='title' type="text" class="form-control" placeholder="Inserisci il titolo">
                <span class={{ $this->titleLength > 10 ? 'text-danger' : 'text-success' }}>{{ $this->titleLength }}/10</span>
                @if ($this->titleLength > 10)
                    <span class="text-danger">Hai superato i caratteri consentiti</span>
                @endif
              </div>
              <div class="mb-3">
                <label for="body" class="form-label">Inserisci il testo</label>
                {{-- mostra l'errore sulle validazioni --}}
                @if ($errors -> has('body'))    
                <div class="alert alert-danger">{{ $errors->first('body') }}</div>
                @endif
                <textarea wire:model='body' class="form-control" rows="3"></textarea>
            </div>
            <select wire:model='color' class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option selected value="primary-emphasis">Scegli il colore del post</option>
                <option value="primary">Blu</option>
                <option value="danger">Rosso</option>
                <option value="success">Verde</option>
                <option value="warning">Giallo</option>
                <option value="info">Celeste</option>
              

            </select>
            <button type="submit" class="btn btn-primary">Pubblica</button>
        </form>
    </div>
    <section class="my-5">
        <div class="row justify-content-evenly">
            @foreach ($posts as $post)
            <div class="card bg-{{ $post -> color ?? 'primary' }} mb-3" style="max-width: 18rem;">
                <div class="card-header">{{ Str::ucfirst($post -> title) }}</div>
                <div class="card-body">
                  <p class="card-text">
                    {{ $post -> body }}
                  </p>
                </div>
              </div>      
            @endforeach
        </div>
    </section>
</div>