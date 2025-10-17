<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel" wire:ignore.self>
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCartLabel">Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if($cart = \App\Helpers\Cart\Cart::getCart())
            <div class="table-responsive">
                <table class="table offcanvasCart-table">
                    <tbody>

                    @foreach($cart as $id => $product)
                        <tr wire:key="{{ $id }}">
                            <td class="product-img-td"><a href="{{ route('product') }}"><img src="{{ asset($product['image']) }}" alt=""></a>
                            </td>
                            <td><a href="{{ route('product') }}"> {{$product['title']}}</a></td>
                            <td>${{ $product['price'] }}</td>
                            <td>&times;{{ $product['quantity'] }}</td>
                            <td><button wire:click="removeFromCart({{ $id }})" wire:loading.attr="disabled"
                                wire:target="removeFromCart" class="btn btn-danger">
                                    <i class="fa-regular fa-circle-xmark"></i></button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4" class="text-end">Total:</td>
                        <td>${{ \App\Helpers\Cart\Cart::getCartTotalSum() }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="text-end mt-3">
                <a href="#" class="btn btn-outline-warning">Cart</a>
                <a href="#" class="btn btn-outline-secondary">Checkout</a>
            </div>
        @else
            <p> Cart is empty...</p>
        @endif



    </div>
</div>
