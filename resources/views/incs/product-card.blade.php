<div class="product-card">
    <div class="product-card-offer">
        @if($product->is_hit)
            <div class="offer-hit">Hit</div>
        @endif

        @if($product->is_new)
            <div class="offer-new">New</div>
        @endif
    </div>
    <div class="product-thumb">
        <a href="#">
            <img src="{{ asset($product->image) }}" alt="">
        </a>
    </div>
    <div class="product-details">
        <h4>
            <a href="#">{{ $product->title }}</a>
        </h4>
        <div class="product-bottom-details d-flex justify-content-between">
            <div class="product-price">
                @if($product->old_price)
                    <small>${{ $product->old_price }}</small>
                @endif
                ${{ $product->price }}
            </div>
            <div class="product-links">
                <button href="#" class="btn btn-outline-secondary add-to-cart">
                    <i class="fas fa-shopping-cart"></i>
                </button>
            </div>
        </div>
    </div>
</div>
