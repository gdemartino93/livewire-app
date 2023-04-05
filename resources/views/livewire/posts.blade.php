<div class="container">
    <div class="row">
        <form wire:submit.prevent='createPost' action="" class="col-12 col-md-8 col-lg-6 mx-auto">
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input wire:model='title' type="text" class="form-control" placeholder="Inserisci il titolo">
              </div>
              <div class="mb-3">
                <label for="body" class="form-label">Example textarea</label>
                <textarea wire:model='body' class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Pubblica</button>
        </form>
    </div>
    <section class="my-5">
        <div class="row justify-content-evenly">
            @foreach ($posts as $post)
            <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
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