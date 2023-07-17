<div>
    <form wire:submit.prevent="send">
        @csrf

        <input type="text" placeholder="Nome *" class="w-100 mt-1" wire:model.defer="name" required>
        
        <input type="email" placeholder="Email *" class="w-100 mt-1" wire:model.defer="email" required>
        
        <input type="text" placeholder="Número de Telefone" class="w-100 mt-1 mask-telefone" wire:model.defer="phone">
        
        <textarea id="" Placeholder="Mensagem *" class="w-100 mt-1" cols="30" rows="10" wire:model.defer="message" required></textarea>

        <label class="mt-1">
            <input type="checkbox" value="1" wire:model.defer="accept" required>
            <x-accept-text />
        </label>

        <div class="div-button">
            <button type="submit" class="btn btn-custom mt-1 ">
                <span wire:loading.remove>
                    Enviar
                </span>
                <span wire:loading.inline>
                    Aguarde...
                </span>
            </button>
        </div>

        <x-flash-messages />
    </form>
</div>
