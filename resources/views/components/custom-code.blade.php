@props(['type'])
{{-- type: head ou body --}}
@inject('site', 'App\\Services\\SiteService')

@if ($type === 'head')
    @if ($site->getCustomJsHead())
        <script 
            @if ($site->useLgpd()) 
            type="text/plain" data-type="application/javascript" data-ellite-lgpd-categoria="marketing" 
            @endif
        >
            {!! $site->getCustomJsHead() !!}
        </script>
    @endif
@endif
@if ($type === 'body')
    @if ($site->getCustomJsBody())
    <noscript>
        {!! $site->getCustomJsBody() !!}
    </noscript>
    @endif
@endif