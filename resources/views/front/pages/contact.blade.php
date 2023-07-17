@extends('front.layout.app')

@section('content')
    <main id="contato" class="">
        <section class="formulario pb-2"
            style="background-image: url({{ $contact->getImage()->first()? $contact->getImage()->first()->url(): '' }});">
            <div class="container">
                <h2 class="title h2-40 p-400 text-dark w-100 text-center text-lg-start py-2">
                    Entre em contato
                    <svg class="ms-2" width="200" height="3" viewBox="0 0 200 3" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect x="200" y="0.5" width="2.00001" height="200" transform="rotate(90 200 0.5)"
                            fill="#f0611f" />
                    </svg>
                </h2>
                <div class="col-lg-9 {{ $contact->getImage()->first() ? '' :  'mx-auto'}}">
                    <livewire:form-contact type="contact">
                </div>
                @if ($contact->getAdresses()[0]['iframe_link'])
                    <h2 class="title h2-40 p-400 text-dark w-100 text-center text-lg-start py-2">
                        Onde estamos
                        <svg class="ms-2" width="200" height="3" viewBox="0 0 200 3" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="200" y="0.5" width="2.00001" height="200"
                                transform="rotate(90 200 0.5)" fill="#f0611f" />
                        </svg>
                    </h2>
                @endif

            </div>
        </section>
        @if ($contact->getAdresses()[0]['iframe_link'])
            <iframe class="mb--1" src="{{ $contact->getAdresses()[0]['iframe_link'] }}" width="100%" height="450"
                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        @endif
        {{-- <x-contact-iframe-map /> --}}
    </main>
@endsection
