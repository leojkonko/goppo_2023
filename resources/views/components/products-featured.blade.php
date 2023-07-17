@if ($products->count())
    <section class="produtos-destaques py-2 py-lg-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12 texto">
                    <div>
                        <h2>Produtos em destaques</h2>
                    </div>
                    <div>
                        <button class="btn btn-custom"><a href="<?= url('produtos') ?>">Veja Todos</a></button>
                    </div>
                </div>
                <div class="col-lg-10 col-md-12 col-sm-12">
                    <div class="swiper produtos-destaque-swiper">
                        <div class="swiper-wrapper">
                            @foreach ($products as $product)
                                <div class="swiper-slide h-100">
                                    <div class="slide-img">
                                        <x-product-card :product="$product" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination swiper-pagination1 d-xs-flex d-sm-none d-md-none d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif