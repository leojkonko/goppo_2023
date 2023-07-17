@inject('contact', 'Ellite\\Contact\\Services\\ContactService')

<ul class="mb-0 list-unstyled p-0 row g-0-50 row-cols-1 row-cols-lg-2">

    @foreach ($contact->getAdresses() as $address)
        <li class="col address">
            <a @if ($address['link']) href="{{ $address['link'] }}" target="_blank" @endif>
                <svg class="w-1-25 h-1-25" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                {{ $address['address'] }}
            </a>
        </li>
    @endforeach

    @foreach ($contact->getPhones() as $phone)
        <li class="col">
            <a href="tel:+{{ onlyNumbers($phone['phone_link']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-1-25 h-1-25">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                </svg>
                {{ $phone['phone'] }}
            </a>
        </li>
    @endforeach

    @foreach ($contact->getWhatsapps() as $whatsapp)
        <li class="col">
            <a href="https://api.whatsapp.com/send?phone={{ onlyNumbers($whatsapp['phone_link']) }}">
                <svg id="whatsapp" class="w-1-25 h-1-25" width="1.25em" height="1.25em" viewBox="0 0 256 256" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M207.15 47.8406C186.013 26.6531 157.864 15 127.95 15C66.2031 15 15.9585 65.2446 15.9585 126.991C15.9585 146.716 21.104 165.986 30.8906 182.987L15 241L74.3754 225.412C90.7201 234.341 109.133 239.033 127.899 239.033H127.95C189.646 239.033 241 188.788 241 127.042C241 97.1268 228.287 69.0281 207.15 47.8406V47.8406ZM127.95 220.166C111.201 220.166 94.8062 215.676 80.5299 207.201L77.15 205.183L41.9384 214.415L51.3214 180.061L49.1018 176.529C39.7692 161.698 34.8759 144.597 34.8759 126.991C34.8759 75.6871 76.6455 33.9174 128 33.9174C152.87 33.9174 176.227 43.6031 193.782 61.2089C211.337 78.8147 222.133 102.171 222.083 127.042C222.083 178.396 179.254 220.166 127.95 220.166V220.166ZM179.001 150.449C176.227 149.036 162.455 142.276 159.882 141.368C157.309 140.41 155.443 139.956 153.576 142.781C151.71 145.606 146.362 151.861 144.698 153.778C143.083 155.645 141.419 155.897 138.644 154.484C122.199 146.262 111.403 139.804 100.557 121.19C97.6817 116.246 103.433 116.599 108.78 105.904C109.688 104.038 109.234 102.424 108.528 101.011C107.821 99.5987 102.222 85.8268 99.9013 80.2272C97.6312 74.779 95.3107 75.5357 93.5955 75.4348C91.9812 75.3339 90.1147 75.3339 88.2482 75.3339C86.3817 75.3339 83.3549 76.0402 80.7821 78.8147C78.2094 81.6397 70.9955 88.3996 70.9955 102.171C70.9955 115.943 81.0344 129.261 82.3964 131.128C83.8089 132.994 102.121 161.244 130.22 173.402C147.977 181.07 154.938 181.725 163.817 180.414C169.215 179.607 180.363 173.654 182.684 167.096C185.004 160.538 185.004 154.938 184.298 153.778C183.642 152.517 181.776 151.811 179.001 150.449Z" />
                </svg>
                {{ $whatsapp['phone'] }}
            </a>
        </li>
    @endforeach

    @foreach ($contact->getEmails() as $email)
        <li class="col">
            <a href="mailto:{{ $email['email'] }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-1-25 h-1-25">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
                {{ $email['email'] }}
            </a>
        </li>
    @endforeach
</ul>
