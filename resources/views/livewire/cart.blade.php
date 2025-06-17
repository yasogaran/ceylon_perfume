<div>
    <h2 class="text-xl font-bold mb-4">Shopping Cart</h2>

    @if(count($items) === 0)
        <p>Your cart is empty.</p>
    @else
        <table class="w-full text-left">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    @php $qty = $items[$product->id]['quantity'] @endphp
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>
                            <input type="number" min="1" value="{{ $qty }}" 
                                wire:change="updateQuantity({{ $product->id }}, $event.target.value)" 
                                class="w-16 border rounded px-1" />
                        </td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>${{ number_format($product->price * $qty, 2) }}</td>
                        <td>
                            <button wire:click="removeProduct({{ $product->id }})" class="text-red-600 hover:underline">
                                Remove
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 font-bold">
            Total: ${{ number_format($products->sum(fn($p) => $p->price * $items[$p->id]['quantity']), 2) }}
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Checkout</button>
        </div>
    @endif
</div>
