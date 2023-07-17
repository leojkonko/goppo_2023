@inject('site', 'App\\Services\\SiteService')
@if ($site->useLgpd())
    <script>
        function initElliteLgdp() {
            ElliteLgpdApi.init({
                @if ($site->hasPrivacy())
                    link_politica: {!! json_encode(route_lang('privacy')) !!},
                @endif
            });

            @if ($site->isLgpdTest())
                let intervalLgpdTest = setInterval(() => {
                    if (document.getElementById('lgpd-test-warning')) {
                        clearInterval(intervalLgpdTest);
                        return;
                    }
                    
                    let elemento = document.querySelector('#ellitelgpd-texto span');

                    if (!elemento) {
                        return;
                    }

                    let html = elemento.innerHTML + '<br><span id="lgpd-test-warning" style="color: red!important; background: yellow!important">';
                    html += 'Essa LGPD sendo usada é somenta para testes. Você deve ir no painel da LGPD e cadastrar um novo cliente para esse site, e configurar no arquivo config/lgpd.php o código correto.</span>';
                    elemento.innerHTML = html;
                }, 1000);
            @endif
        }
    </script>
    <script src="https://lgpd.ellitedigital.com.br/lgpd/v1/lgpd.js?cliente={{ $site->getLgpdCode() }}" crossorigin="anonymous" defer onLoad="initElliteLgdp()"></script>
@endif