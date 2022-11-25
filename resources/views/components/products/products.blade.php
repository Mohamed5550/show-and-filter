<!-- Start products -->
<div class="col-12 col-md-8 products-container">
    <h2 class="text-center mb-4"
        data-empty-text="@lang('No results')"
        data-found-text="@lang('Results found')"
        id="result-counter">13 Results found</h2>

    <div class="row products gx-4" id="products">
        @foreach($products as $product)
        <div class="col-6 mb-4">
            <div class="product">{{ $product->product }}</div>
        </div>
        @endforeach
    </div>
</div>
<!-- End Products -->