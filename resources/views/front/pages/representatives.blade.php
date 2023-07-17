@extends('front.layout.app')

@section('content')
    @inject('site', 'App\\Services\\SiteService')

    <main id="representantes" class="py-2 py-lg-4">
        <section>
            <div class="container">
                <div class="row gy-2 gy-lg-0 gx-lg-4 flex-column-reverse flex-lg-row text-center text-lg-start">
                        <div class="editor-texto pb-2 pb-lg-4">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure libero tempore voluptatum, cumque corrupti quae adipisci. Possimus laborum ut similique minus odio doloribus repellat nisi ipsam. Sunt voluptates error similique!
                        </div>
                    <div class="col-lg-6">
                        <div class="editor-texto">
                            <p>Selecione um estado!</p>
                        </div>
                        <select class="form-select mt-2 form-select-img" name="" id="selectedState">
                            <option hidden selected>Selecione um estado</option>
                            @foreach (range(0,4) as $state)
                                <option value="value">Rio Grande do Sul</option>
                            @endforeach
                        </select>

                        @foreach (range(0,2) as $representative)
                            <div class="card p-2 bg-light mt-1 border" data-representative-id="" data-state="" style="display: none;">
                                <span class="fw-bold d-block"></span>
                                <span class="d-block mb-1"></span>
                                    <a href="mailto:" class="d-flex justify-content-center justify-content-lg-start align-items-center gap-0-50">
                                        <svg class="w-1 h-1" width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.77252 4.82L8.2916 7.976C8.7313 8.288 9.28092 8.288 9.72061 7.976L14.2397 4.82M1 3.452V12.548C1 13.352 1.57405 14 2.29466 14H15.7053C16.4137 14 17 13.352 17 12.548V3.452C17 2.648 16.426 2 15.7053 2H2.29466C1.57405 2 1 2.648 1 3.452Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
                                        </svg>
                                        email
                                    </a>
                                    <a href="tel:+55" class="d-flex align-items-center gap-0-50">
                                        <svg class="w-1 h-1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1736 11.971C14.7929 11.7916 12.8622 10.8945 12.5087 10.7663C12.128 10.6381 11.8832 10.5612 11.6113 10.9457C11.3394 11.3046 10.6052 12.1505 10.3604 12.4068C10.1429 12.6375 9.89816 12.6887 9.51746 12.4837C9.10957 12.3042 7.8587 11.9198 6.33591 10.6381C5.16662 9.6641 4.37803 8.43374 4.1333 8.07489C3.91576 7.6904 4.1061 7.51098 4.29645 7.30592C4.4868 7.15212 4.67715 6.87017 4.89469 6.66511C5.08504 6.46005 5.16662 6.30625 5.30259 6.04993C5.43855 5.81924 5.38416 5.58854 5.27539 5.40912C5.19381 5.22969 4.40522 3.38415 4.07891 2.64081C3.7526 1.9231 3.42629 2.02563 3.18155 2C2.96401 2 2.69208 2 2.42015 2C2.17542 2 1.74034 2.10253 1.38683 2.46138C1.00613 2.84587 0 3.74301 0 5.56291C0 7.38281 1.41402 9.15145 1.60437 9.40778C1.79472 9.6641 4.37803 13.4064 8.32098 15.0213C9.27273 15.4058 10.0069 15.6365 10.578 15.7903C11.5297 16.0722 12.3727 16.021 13.0525 15.9184C13.8139 15.8159 15.3911 15.0213 15.7174 14.1498C16.0437 13.3039 16.0437 12.5606 15.9349 12.4068C15.8534 12.253 15.5814 12.1505 15.1736 11.971Z" fill="currentColor" />
                                        </svg>
                                        telefone
                                    </a>
                                    <a href="tel:+55" class="d-flex align-items-center gap-0-50">
                                        <svg id="whatsapp" class="w-1 h-1" width="16" height="16" viewBox="0 0 256 256" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M207.15 47.8406C186.013 26.6531 157.864 15 127.95 15C66.2031 15 15.9585 65.2446 15.9585 126.991C15.9585 146.716 21.104 165.986 30.8906 182.987L15 241L74.3754 225.412C90.7201 234.341 109.133 239.033 127.899 239.033H127.95C189.646 239.033 241 188.788 241 127.042C241 97.1268 228.287 69.0281 207.15 47.8406V47.8406ZM127.95 220.166C111.201 220.166 94.8062 215.676 80.5299 207.201L77.15 205.183L41.9384 214.415L51.3214 180.061L49.1018 176.529C39.7692 161.698 34.8759 144.597 34.8759 126.991C34.8759 75.6871 76.6455 33.9174 128 33.9174C152.87 33.9174 176.227 43.6031 193.782 61.2089C211.337 78.8147 222.133 102.171 222.083 127.042C222.083 178.396 179.254 220.166 127.95 220.166V220.166ZM179.001 150.449C176.227 149.036 162.455 142.276 159.882 141.368C157.309 140.41 155.443 139.956 153.576 142.781C151.71 145.606 146.362 151.861 144.698 153.778C143.083 155.645 141.419 155.897 138.644 154.484C122.199 146.262 111.403 139.804 100.557 121.19C97.6817 116.246 103.433 116.599 108.78 105.904C109.688 104.038 109.234 102.424 108.528 101.011C107.821 99.5987 102.222 85.8268 99.9013 80.2272C97.6312 74.779 95.3107 75.5357 93.5955 75.4348C91.9812 75.3339 90.1147 75.3339 88.2482 75.3339C86.3817 75.3339 83.3549 76.0402 80.7821 78.8147C78.2094 81.6397 70.9955 88.3996 70.9955 102.171C70.9955 115.943 81.0344 129.261 82.3964 131.128C83.8089 132.994 102.121 161.244 130.22 173.402C147.977 181.07 154.938 181.725 163.817 180.414C169.215 179.607 180.363 173.654 182.684 167.096C185.004 160.538 185.004 154.938 184.298 153.778C183.642 152.517 181.776 151.811 179.001 150.449Z" />
                                        </svg>
                                        nemro
                                    </a>
                            </div>
                        @endforeach

                        <h2 id="emptyRepresentatives" style="display: none" class="h5 mb-0 mt-2">{{ __('ellite-representatives::strings.nenhum-representante') }}!</h2>
                    </div>
                    <div class="col-lg-6" style="min-height: 400px">
                        <div id="map" class="h-100 bg-danger">
                            Espaço mapa
                        </div>
                    </div>
                </div>
                <div class="d-flex col-12 justify-content-center">
                    <button type="button" class="btn btn-primary mt-2 mt-lg-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Seja um representante!
                    </button>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="send" class="row g-1" id="form-interest-representatives">
                                    @csrf
                                    <div class="col-12">
                                        <input type="text" placeholder="{{ __('Nome') }}*" class="form-control" wire:model.defer="name" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="email" placeholder="{{ __('E-mail') }}*" class="form-control" wire:model.defer="email" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="{{ __('Telefone') }}*" class="form-control mask-telefone" wire:model.defer="phone" required>
                                    </div>
                                    <div class="col-12">
                                        <textarea id="" Placeholder="{{ __('Mensagem') }}*" class="form-control" rows="5" wire:model.defer="message" required></textarea>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" wire:model.defer="accept" id="termosCheck" required>
                                            <label class="form-check-label" for="termosCheck">
                                                <x-accept-text />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-outline-primary">
                                            <span wire:loading.remove>
                                                {{ __('Enviar formulário') }}
                                            </span>
                                            <span wire:loading.inline>
                                                {{ __('Aguarde') }}...
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-12 p-0 m-0">
                                        <x-flash-messages />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
