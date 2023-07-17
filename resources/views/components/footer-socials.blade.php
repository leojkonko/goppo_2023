@inject('contact', 'Ellite\\Contact\\Services\\ContactService')

@php
    $socials = array_filter([
        'facebook' => $contact->getSocial('facebook'),
        'instagram' => $contact->getSocial('instagram'),
        'youtube' => $contact->getSocial('youtube'),
        'linkedin' => $contact->getSocial('linkedin'),
    ]);
@endphp

@if (count($socials))

    {{-- Icones em svg --}}
    <svg class="d-none visibility-hidden">
        <path id="facebook" d="M241 128.682C241 66.4341 190.423 16 128 16C65.5766 16 15 66.4341 15 128.682C15 184.922 56.3225 231.54 110.344 240V161.255H81.6381V128.682H110.344V103.855C110.344 75.6167 127.203 60.0185 153.024 60.0185C165.39 60.0185 178.321 62.2176 178.321 62.2176V89.9336H164.069C150.035 89.9336 145.656 98.621 145.656 107.531V128.682H176.996L171.983 161.255H145.656V240C199.678 231.54 241 184.922 241 128.682Z" />
        <path id="instagram" d="M128.025 70.0565C95.9521 70.0565 70.0817 95.9268 70.0817 128C70.0817 160.073 95.9521 185.944 128.025 185.944C160.098 185.944 185.969 160.073 185.969 128C185.969 95.9268 160.098 70.0565 128.025 70.0565ZM128.025 165.671C107.299 165.671 90.3544 148.777 90.3544 128C90.3544 107.223 107.248 90.3291 128.025 90.3291C148.802 90.3291 165.696 107.223 165.696 128C165.696 148.777 148.752 165.671 128.025 165.671V165.671ZM201.854 67.6863C201.854 75.2003 195.803 81.2014 188.339 81.2014C180.825 81.2014 174.824 75.1498 174.824 67.6863C174.824 60.2227 180.875 54.1711 188.339 54.1711C195.803 54.1711 201.854 60.2227 201.854 67.6863ZM240.231 81.4031C239.374 63.2989 235.238 47.2623 221.976 34.0498C208.763 20.8372 192.726 16.702 174.622 15.7943C155.963 14.7352 100.037 14.7352 81.378 15.7943C63.3242 16.6516 47.2876 20.7868 34.0246 33.9993C20.7616 47.2119 16.6769 63.2485 15.7691 81.3527C14.7101 100.012 14.7101 155.938 15.7691 174.597C16.6264 192.701 20.7616 208.738 34.0246 221.95C47.2876 235.163 63.2737 239.298 81.378 240.206C100.037 241.265 155.963 241.265 174.622 240.206C192.726 239.348 208.763 235.213 221.976 221.95C235.188 208.738 239.323 192.701 240.231 174.597C241.29 155.938 241.29 100.062 240.231 81.4031V81.4031ZM216.126 194.617C212.192 204.502 204.577 212.116 194.643 216.1C179.766 222.001 144.465 220.639 128.025 220.639C111.585 220.639 76.2341 221.95 61.4079 216.1C51.5237 212.167 43.9088 204.552 39.9249 194.617C34.0246 179.741 35.3862 144.44 35.3862 128C35.3862 111.56 34.075 76.2089 39.9249 61.3826C43.8584 51.4984 51.4732 43.8835 61.4079 39.8996C76.2846 33.9993 111.585 35.3609 128.025 35.3609C144.465 35.3609 179.816 34.0498 194.643 39.8996C204.527 43.8331 212.142 51.448 216.126 61.3826C222.026 76.2593 220.664 111.56 220.664 128C220.664 144.44 222.026 179.791 216.126 194.617Z" />
        <path id="linkedin" d="M65.5864 241H18.7307V90.1114H65.5864V241ZM42.1333 69.5288C27.1504 69.5288 14.9976 57.1187 14.9976 42.1357C14.9976 34.9389 17.8565 28.0368 22.9454 22.9479C28.0344 17.8589 34.9365 15 42.1333 15C49.3301 15 56.2322 17.8589 61.3212 22.9479C66.4101 28.0368 69.269 34.9389 69.269 42.1357C69.269 57.1187 57.1112 69.5288 42.1333 69.5288ZM240.952 241H194.197V167.548C194.197 150.043 193.844 127.594 169.836 127.594C145.475 127.594 141.742 146.613 141.742 166.287V241H94.9368V90.1114H139.875V110.694H140.531C146.787 98.8388 162.067 86.3278 184.865 86.3278C232.285 86.3278 241.003 117.555 241.003 158.115V241H240.952Z" />
        <path id="youtube" d="M236.278 73.4103C233.678 63.6235 226.02 55.9157 216.297 53.3C198.672 48.5469 128 48.5469 128 48.5469C128 48.5469 57.3282 48.5469 39.7033 53.3C29.9798 55.9161 22.3217 63.6235 19.7225 73.4103C15 91.1494 15 128.16 15 128.16C15 128.16 15 165.171 19.7225 182.911C22.3217 192.697 29.9798 200.084 39.7033 202.7C57.3282 207.453 128 207.453 128 207.453C128 207.453 198.672 207.453 216.297 202.7C226.02 200.084 233.678 192.697 236.278 182.911C241 165.171 241 128.16 241 128.16C241 128.16 241 91.1494 236.278 73.4103V73.4103ZM104.886 161.764V94.5572L163.954 128.161L104.886 161.764V161.764Z" />
    </svg>

    <ul class="list-unstyled mb-0 p-0 d-flex flex-lg-column gap-0-50 justify-content-center align-items-center">
        @foreach ($socials as $icon => $link)
            <li>
                <a href="{{ $link }}" class="d-flex grey-text" target="_blank" rel="noopener nofollow noreferer noreferrer">
                    <svg class="w-1-50 h-1-50" viewBox="0 0 256 256" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <use href="#{{ $icon }}" />
                    </svg>
                </a>
            </li>
        @endforeach
    </ul>
@endif
