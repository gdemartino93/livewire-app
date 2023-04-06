<div class="container mywrapper">
    <div class="row">   
        {{-- mostra flash message post creato --}}
        @if (session()->has('created'))
            <div class="alert alert-success">
                {{ session('created') }}
            </div>
        @endif
        @if (session()->has('deleted'))
            <div class="alert alert-danger">
                {{ session('deleted') }}
            </div>
        @endif
        @if (session()->has('tempDeleted'))
            <div class="alert alert-danger">
                {{ session('tempDeleted') }}
            </div>
        @endif
        <form wire:submit.prevent='createPost' action="" class="col-12 col-md-8 col-lg-6 mx-auto" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Inserisci il titolo(max 10 caratteri)</label>
                {{-- mostra l'errore sulle validazioni --}}
                @error('title')
                    <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                @enderror
                <input wire:model='title' type="text" class="form-control" placeholder="Inserisci il titolo">
                <span class={{ $this->titleLength > 10 ? 'text-danger' : 'text-success' }}>{{ $this->titleLength }}/10</span>
                @if ($this->titleLength > 10)
                    <span class="text-danger">Hai superato i caratteri consentiti</span>
                @endif
              </div>
              <div class="mb-3">
                <label for="body" class="form-label">Inserisci il testo</label>
                {{-- mostra l'errore sulle validazioni --}}
                @error('body')     
                    <div class="alert alert-danger">{{ $errors->first('body') }}</div>
                @enderror
                <textarea wire:model='body' class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Carica le foto</label>
                <input wire:model='photos' class="form-control" type="file" id="formFile" multiple>
                @if ($photos)                      
                    @if (count($photos) > 0)
                    <div class="box">
                        @foreach ($photos as $photo)
                        <div class="box-img-temp">
                            <img src="{{ $photo -> temporaryUrl() }}" class="_thumbnail" width="100%">
                            <i class="fa-regular fa-circle-xmark" wire:click.prevent="removeTempImg({{ $loop -> index }})"></i>
                        </div>
                        @endforeach
                    </div>
                    @endif
                @endif
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
                <div class="card-header">
                    <i class="fa-solid fa-trash" wire:click='deletePost({{ $post->id }})'></i>
                    <i class="fa-solid fa-pen-to-square" wire:click='updatePost({{ $post -> id }})'></i>
   
                </div>
                <div class="card-body">
                  <h5 class="card-title fw-bold">{{ $post -> title }}</h5>
                  <p class="card-text fw-bold">{{ $post -> body }}</p>
                </div>
              
              </div>      
            @endforeach

        </div>
    </section>
</div>