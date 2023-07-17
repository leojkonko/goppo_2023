<form wire:submit.prevent="send" class="row g-1 bg-white m-0 p-2" style="border: #8b8b8b 1px solid">
    @csrf
    <div class="col-12 col-lg-6 d-flex flex-column gap-1">
        <input type="text" placeholder="Nome Completo*" class="form-control" wire:model.defer="name" required>
        <input type="email" placeholder="Email*" class="form-control" wire:model.defer="email" required>
        <input type="text" placeholder="Telefone*" class="form-control mask-telefone" wire:model.defer="phone" required>
        <input type="text" placeholder="Cidade*" class="form-control" wire:model.defer="city" required>
    </div>
    <div class="col-12 col-lg-6">
        <textarea id="" Placeholder="Mensagem*" style="resize: none" class="form-control h-100" rows="5" wire:model.defer="message" required></textarea>
    </div>
    <div class="row pt-2 d-flex justify-content-between align-items-center">
        <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center justify-content-lg-start">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" wire:model.defer="accept" id="termosCheck"
                required>
                <label class="form-check-label" for="termosCheck">
                    <x-accept-text />
                </label>
            </div>
        </div>
        <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center justify-content-lg-end">
            <button type="submit" class="btn btn-primary rounded-0 text-white">
                <span wire:loading.remove>
                    ENVIAR CONTATO
                </span>
                <span wire:loading.inline>
                    Aguarde...
                </span>
            </button>
        </div>
    </div>
        
    <div class="col-12">
        <x-flash-messages />
    </div>
</form>
