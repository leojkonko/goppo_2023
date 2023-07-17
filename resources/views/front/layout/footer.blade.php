<footer id="footer" class="overflow-hidden position-relative" style="background: #505050;">
    @inject('site', 'App\\Services\\SiteService')
    @inject('contact', 'Ellite\\Contact\\Services\\ContactService')
    <div class="position-absolute top-0 h-100 w-100 border-left border-right mobile-footer-borderless"></div>
    <div style="background: #202020;">
        <div class="position-relative px-1 px-lg-3 px-xl-1">
            <div class="position-absolute top-0 h-100 border-cinza start-5 end-5 ">
            </div>
            <div class="container border-left border-right mobile-footer-borderless px-1">
                <div
                    class="row gy-2 gy-lg-0 text-center text-lg-start align-items-center justify-content-between py-2 py-lg-3">
                    <div class="col-lg-4 d-flex align-items-center justify-content-center z-index-2">
                        <a href="{{ route_lang('home') }}" class="d-block logo m-auto m-lg-0">
                            <img class="object-fit-contain w-100 h-100" src="{{ asset('front/images/logos/logo-restrita.png') }}"
                                title="Página principal" alt="Logo {{ env('APP_NAME') }}">
                        </a>
                    </div>
                    <div class="col-lg-7 d-flex align-items-center justify-content-center z-index-2">
                        <div>
                            <nav class="menu">
                                <ul
                                    class="mb-0 list-unstyled d-flex flex-column flex-lg-row align-items-lg-center gap-1 gap-lg-2">
                                    <li>
                                        <a href="{{ route_lang('home') }}" title="Home"
                                            class="p-16 p-700 text-white text-decoration-none @if (Route::is('home')) active @endif">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ route_lang('products') }}" title="Empresa"
                                            class="p-16 p-700 text-white text-decoration-none @if (Route::is('products')) active @endif">Produtos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route_lang('company') }}" title="company"
                                            class="p-16 p-700 text-white text-decoration-none @if (Route::is('company')) active @endif">Sobre
                                            a empresa</a>
                                    </li>
                                    <li>
                                        <a href="{{ route_lang('representatives') }}" title="Contato"
                                            class="p-16 p-700 text-white text-decoration-none @if (Route::is('contact')) active @endif">Representantes</a>
                                    </li>
                                    <li>
                                        <a href="{{ route_lang('contact') }}" title="Contato"
                                            class="p-16 p-700 text-white text-decoration-none @if (Route::is('contact')) active @endif">Contato</a>
                                    </li>
                                </ul>
                            </nav>
                            @if ($contact->getAdresses())
                                <p class=" mt-1">
                                    <a href="{{ $contact->getAdresses()[0]['link'] }}" target="_blank"
                                        class="p-16 p-400 text-white text-decoration-none underline-hover">
                                        <svg class="me-0-50" width="14" height="20" viewBox="0 0 14 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7 0.5C3.1351 0.5 0 3.57264 0 7.36055C0 13.4353 7 19.5 7 19.5C7 19.5 14 13.4353 14 7.36055C14 3.57264 10.8649 0.5 7 0.5ZM7 10.3123C5.3348 10.3123 3.98825 8.99258 3.98825 7.36055C3.98825 5.72853 5.3348 4.4088 7 4.4088C8.6652 4.4088 10.0117 5.72853 10.0117 7.36055C10.0117 8.99258 8.6652 10.3123 7 10.3123Z"
                                                fill="white" />
                                        </svg>
                                        {{ $contact->getAdresses()[0]['address'] }}
                                    </a>
                                </p>
                            @endif
                            @if ($contact->getPhones())
                                <p class="">
                                    <a href="tel:+{{ $contact->getPhones()[0]['phone_link'] }}" target="_blank"
                                        class="p-16 p-400 text-white text-decoration-none underline-hover">
                                        <svg class="me-0-50" width="20" height="19" viewBox="0 0 20 19"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M18.9669 13.3199C18.4911 13.0892 16.0777 11.9357 15.6358 11.771C15.16 11.6062 14.854 11.5073 14.5141 12.0016C14.1742 12.463 13.2565 13.5506 12.9505 13.8801C12.6786 14.1767 12.3727 14.2427 11.8968 13.979C11.387 13.7483 9.82338 13.254 7.91989 11.6062C6.45828 10.3538 5.47254 8.77196 5.16662 8.31057C4.89469 7.81623 5.13263 7.58554 5.37057 7.32189C5.6085 7.12416 5.84644 6.76164 6.11837 6.49799C6.3563 6.23435 6.45828 6.03661 6.62823 5.70705C6.79819 5.41045 6.7302 5.11384 6.59424 4.88315C6.49227 4.65246 5.50653 2.27962 5.09864 1.3239C4.69075 0.401132 4.28286 0.532956 3.97694 0.5C3.70501 0.5 3.3651 0.5 3.02519 0.5C2.71927 0.5 2.17542 0.631824 1.73354 1.09321C1.25766 1.58755 0 2.74101 0 5.08088C0 7.42076 1.76753 9.69473 2.00546 10.0243C2.2434 10.3538 5.47254 15.1654 10.4012 17.2417C11.5909 17.736 12.5087 18.0326 13.2225 18.2303C14.4122 18.5928 15.4659 18.5269 16.3156 18.3951C17.2674 18.2633 19.2389 17.2416 19.6468 16.1211C20.0546 15.0336 20.0546 14.0779 19.9187 13.8801C19.8167 13.6824 19.4768 13.5506 18.9669 13.3199Z"
                                                fill="white" />
                                        </svg>
                                        {{ $contact->getPhones()[0]['phone'] }}
                                    </a>
                                </p>
                            @endif
                            {{-- @endif --}}
                        </div>
                    </div>
                    @php
                        $socials = array_filter([
                            'facebook' => $contact->getSocial('facebook'),
                            'instagram' => $contact->getSocial('instagram'),
                            'youtube' => $contact->getSocial('youtube'),
                            'linkedin' => $contact->getSocial('linkedin'),
                        ]);
                    @endphp
                    <div class="col-lg-1 z-index-2">
                        <div class="d-flex align-items-center align-items-lg-end flex-column gap-1">
                            @if ($socials)
                                @if (array_key_exists('instagram', $socials))
                                    <a href="{{ $socials['instagram'] }}" target="_blank" class="socials-highlight">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="CurrentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 2.162C15.204 2.162 15.584 2.174 16.849 2.232C18.157 2.292 19.504 2.59 20.457 3.543C21.419 4.505 21.708 5.839 21.768 7.151C21.826 8.416 21.838 8.796 21.838 12C21.838 15.204 21.826 15.584 21.768 16.849C21.709 18.15 21.404 19.51 20.457 20.457C19.495 21.419 18.162 21.708 16.849 21.768C15.584 21.826 15.204 21.838 12 21.838C8.796 21.838 8.416 21.826 7.151 21.768C5.86 21.709 4.482 21.397 3.543 20.457C2.586 19.5 2.292 18.153 2.232 16.849C2.174 15.584 2.162 15.204 2.162 12C2.162 8.796 2.174 8.416 2.232 7.151C2.291 5.855 2.599 4.487 3.543 3.543C4.503 2.583 5.842 2.292 7.151 2.232C8.416 2.174 8.796 2.162 12 2.162ZM12 0C8.741 0 8.332 0.014 7.052 0.072C5.197 0.157 3.355 0.673 2.014 2.014C0.668 3.36 0.157 5.198 0.072 7.052C0.014 8.332 0 8.741 0 12C0 15.259 0.014 15.668 0.072 16.948C0.157 18.801 0.675 20.648 2.014 21.986C3.359 23.331 5.2 23.843 7.052 23.928C8.332 23.986 8.741 24 12 24C15.259 24 15.668 23.986 16.948 23.928C18.802 23.843 20.646 23.326 21.986 21.986C23.333 20.639 23.843 18.802 23.928 16.948C23.986 15.668 24 15.259 24 12C24 8.741 23.986 8.332 23.928 7.052C23.843 5.197 23.326 3.354 21.986 2.014C20.643 0.671 18.797 0.156 16.948 0.072C15.668 0.014 15.259 0 12 0Z"/>
                                            <path
                                                d="M12 5.83801C8.59701 5.83801 5.83801 8.59701 5.83801 12C5.83801 15.403 8.59701 18.162 12 18.162C15.403 18.162 18.162 15.403 18.162 12C18.162 8.59701 15.403 5.83801 12 5.83801ZM12 16C9.79101 16 8.00001 14.209 8.00001 12C8.00001 9.79101 9.79101 8.00001 12 8.00001C14.209 8.00001 16 9.79101 16 12C16 14.209 14.209 16 12 16Z"/>
                                            <path
                                                d="M18.406 7.03405C19.2013 7.03405 19.846 6.38934 19.846 5.59405C19.846 4.79876 19.2013 4.15405 18.406 4.15405C17.6107 4.15405 16.966 4.79876 16.966 5.59405C16.966 6.38934 17.6107 7.03405 18.406 7.03405Z"/>
                                        </svg>
                                    </a>
                                @endif
                                @if (array_key_exists('facebook', $socials))
                                    <a href="{{ $socials['facebook'] }}" target="_blank" class="socials-highlight">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="CurrentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M24 12C24 17.989 19.606 22.954 13.87 23.855V15.492H16.659L17.19 12.032H13.87V9.787C13.87 8.84 14.334 7.918 15.82 7.918H17.329V4.972C17.329 4.972 15.959 4.738 14.65 4.738C11.916 4.738 10.13 6.395 10.13 9.394V12.031H7.091V15.491H10.13V23.854C4.395 22.952 0 17.988 0 12C0 5.373 5.373 0 12 0C18.627 0 24 5.372 24 12Z"/>
                                        </svg>
                                    </a>
                                @endif
                                @if (array_key_exists('linkedin', $socials))
                                    <a href="{{ $socials['linkedin'] }}" target="_blank" class="socials-highlight">
                                        <svg width="24" height="25" viewBox="0 0 24 25" fill="CurrentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20.4496 21.3055H16.8933V15.7361C16.8933 14.4079 16.8697 12.6989 15.0436 12.6989C13.1915 12.6989 12.9077 14.1453 12.9077 15.6403V21.3055H9.35259V9.85208H12.767V11.4168H12.8143C13.5109 10.227 14.8047 9.51618 16.1825 9.56704C19.7873 9.56704 20.4508 11.9384 20.4508 15.0217L20.4496 21.3055ZM5.33977 8.28616C4.19968 8.28616 3.27601 7.36246 3.27601 6.22232C3.27601 5.08218 4.19968 4.15847 5.33977 4.15847C6.47987 4.15847 7.40354 5.08218 7.40354 6.22232C7.40354 7.36246 6.47987 8.28616 5.33977 8.28616ZM7.11733 21.3055H3.55748V9.85208H7.11733V21.3055ZM22.2224 0.856325H1.77046C0.804218 0.84568 0.0118267 1.62036 0 2.58664V23.1234C0.0118267 24.0908 0.804218 24.8655 1.77046 24.8548H22.2224C23.1911 24.8667 23.987 24.092 24 23.1234V2.58546C23.9858 1.61681 23.1899 0.842132 22.2224 0.855142"/>
                                        </svg>
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                    {{-- <div class="col-lg-auto">
                        <x-site-menu type="footer" />
                    </div>
                    <div class="col-lg-5 col-xl-4">
                        <x-footer-contacts />
                    </div>
                    <div class="col-lg-auto">
                        <x-footer-socials />
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="py-1 copyright position-relative">
            <div class="position-absolute w-100 top-0 border-left border-right border-top mobile-footer-borderless">
            </div>
            <div class="container z-index-2">
                <div
                    class="d-flex flex-column flex-lg-row text-center text-lg-start gap-1 justify-content-between align-items-center justify-content-sm-between z-index-2 px-3">
                    <div
                        class="col-12 col-md-6 col-lg-7 text-white-50 opacity-8 small grey-text text-center d-flex justify-content-center justify-content-lg-start">
                        Copyright &copy{{ date('Y') }}
                        {{ env('APP_NAME') }}. Todos os direitos reservados. CNPJ 43.290.683/0001-71</div>
                    <div class="col-12 col-md-2 col-lg-2 d-flex justify-content-center justify-content-lg-start">
                        @inject('site', 'App\\Services\\SiteService')
                        @if ($site->hasPrivacy())
                            <a href="{{ route_lang('privacy') }}" class="small text-white grey-text"
                                title="Política de privacidade text-white opacity-8 text-decoration-none">Política de
                                privacidade</a>
                        @elseif ($site->useLgpd())
                            <button onClick="ElliteLgpdApi.showModal()"
                                class="btn btn-link p-0 text-decoration-none text-white grey-text opacity-8">Gerenciar
                                preferências de cookies</button>
                        @endif
                    </div>
                    <div
                        class="col-12 col-md-2 col-lg-2 col-xl-3 d-flex justify-content-center justify-content-lg-end">
                        <a href="https://www.ellitedigital.com.br" target="_blank">
                            <img src="{{ asset('front/images/logos/logoellite.svg') }}" class="grey-filter"
                                alt="Ellite Agência Digital" width="80" height="18">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- Whatsapp fixed button --}}
<x-whatsapp-fixed />

{{-- Jquery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
    integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- Swiper.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.2.0/swiper-bundle.min.js"
    integrity="sha512-KBCt3sdFOcFtYTgEfE3uJckVpvPr1w8HPugyPgHFE/4iJOwhwj6eSaF27bDJTHRX2jyAFOgV3Ve9vOD97rbjrg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- Fancybox --}}
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

{{-- GSAP (caso necessário) --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/gsap.min.js"></script> --}}

{{-- Front js --}}
@vite(['resources/front/js/vendors/bootstrap.bundle.min.js', 'resources/front/js/main.js'])

@livewireScripts

{{-- <script>
    window.onload = function() {
  var contadorElemento = document.getElementById("contador");
  var numeroInicial = 1;
  var numeroFinal = 100;

  var duracaoTotal = 5000;

  var intervalo = duracaoTotal / (numeroFinal - numeroInicial);

  var contadorAtual = numeroInicial;

  function atualizarContador() {
    contadorAtual++;

    contadorElemento.textContent = contadorAtual + "%";

    if (contadorAtual < numeroFinal) {
      setTimeout(atualizarContador, intervalo);
    }
  }
  atualizarContador();
};

</script> --}}
</body>

</html>
