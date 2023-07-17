@inject('site', 'App\\Services\\SiteService')

@if ($site->hasPrivacy())
    <p class="p-14 p-600 text-dark">Li e aceito a <a class="text-decoration-underline text-dark" style="font-weight: 900" href="{{ route_lang('privacy') }}" target="_blank">política de privacidade</a> da {{ env('APP_NAME') }}</p>
@else
    <p class="p-14 p-600 text-dark">Aceito com a utilização de meus dados pela {{ env('APP_NAME') }}</p>
@endif