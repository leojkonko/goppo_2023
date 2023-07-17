@extends('platform::dashboard')

@section('title')
    {{ __($name) }}
@endsection

@section('description')
    {{ __($description) }}
@endsection

@section('controller')
    base
@endsection

@if ($commandBar)

    {{-- Necessario verificação dessa variavel, caso contrario ira adicionar uma navbar sticky mesmo não tendo botão --}}
    @php
        $hasNavbarSticky = false;
    @endphp

    {{-- Faz um foreach nos botoes realocando o index de cada um pra ficar mais facil diferenciar --}}
    @foreach ($commandBar as $i => $command)
        @if ($command->slug === 'voltar')
            @php
                $commandBar['voltar'] = $commandBar[$i];
                unset($commandBar[$i]);
            @endphp
        @endif
        @if ($command->slug === 'adicionar')
            @php
                $commandBar['adicionar'] = $commandBar[$i];
                unset($commandBar[$i]);
            @endphp
        @endif
        @if ($command->slug !== 'voltar' && $command->slug !== 'adicionar')
            @php
                $hasNavbarSticky = true;
            @endphp
        @endif
    @endforeach

    {{-- Botão voltar a esquerda da navbar --}}
    @if (isset($commandBar['voltar']))
        @section('navbar-back')
            <li class="">
                {!! $commandBar['voltar'] !!}
            </li>
        @endsection
    @endif

    {{-- Demais botöes alinhados a direita da navbar sticky --}}
    @if ($hasNavbarSticky)
        @section('navbar')
            @foreach ($commandBar as $command)
                @if ($command->slug !== 'voltar' && $command->slug !== 'adicionar')
                    <li class="">
                        {!! $command !!}
                    </li>
                @endif
            @endforeach
        @endsection
    @endif

    {{-- Botão adicionar na navbar do topo --}}
    @if (isset($commandBar['adicionar']))
        @section('navbar-top')
            <li class="">
                {!! $commandBar['adicionar'] !!}
            </li>
        @endsection
    @endif

@endif

@section('content')
    <div id="modals-container">
        @stack('modals-container')
    </div>

    <form id="post-form" class="mb-md-4" method="post" enctype="multipart/form-data" data-controller="form" data-action="keypress->form#disableKey
                           form#submit" data-form-validation="{{ $formValidateMessage }}" novalidate>
        {!! $layouts !!}
        @csrf
        @include('platform::partials.confirm')
    </form>

    <div data-controller="filter">
        <form id="filters" autocomplete="off" data-action="filter#submit"></form>
    </div>
@endsection
