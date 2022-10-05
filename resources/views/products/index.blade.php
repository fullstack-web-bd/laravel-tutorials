<x-guest-layout>
    <div class="container mx-auto">
        @include('partials.messages')

        <h2 class="my-3">
            Products
        </h2>

        <div class="flex flex-wrap">
            @foreach ($products as $product)
                <div class="mb-3">
                    <div class="p-3 mr-3 w-[300px] shadow-sm bg-slate-200">
                        <h4>
                            {{ $product->name }}

                            <span class="{{ empty($product->like) ? 'bg-slate-400' : 'bg-red-600' }} cursor-pointer text-white px-3"
                                id="product-like-{{ $product->id }}" onclick="toggleLikeProduct({{ $product->id }})">
                                Like
                            </span>
                        </h4>
                        <h5 class="text-blue-500 mb-5">
                            {{ $product->price }} TK
                        </h5>
                        <p>
                            @if ($product->category)
                                <a href="{{ route('category.show', $product->category->id) }}">
                                    {{ $product->category->name }}
                                </a>
                            @else
                                <span class="text-warning">N/A</span>
                            @endif
                        </p>
                        <p class="leading-10">
                            @foreach ($product->tags as $tag)
                                <span class="bg-blue-400 py-1 rounded mx-2">
                                    <a href="{{ route('tag.show', $tag->id) }}" class="text-white ">
                                        {{ $tag->name }}
                                    </a>
                                </span>
                            @endforeach
                        </p>
                        @if ($product->user_id)
                            <p>
                                Created by - {{ $product->user->name }}
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script>
            function toggleLikeProduct(productId) {
                $.ajax({
                        method: "POST",
                        url: "/api/like-product",
                        data: {
                            productId: parseInt(productId),
                        }
                    })
                    .done(function(response) {
                        if (response.status) {
                            // alert(response.message);
                            $("#product-like-" + productId).addClass('bg-red-600');
                            $("#product-like-" + productId).removeClass('bg-slate-400');
                        } else {
                            // alert(response.message);
                            $("#product-like-" + productId).removeClass('bg-red-600');
                            $("#product-like-" + productId).addClass('bg-slate-400');
                        }
                    })
                    .fail(function() {
                        console.error('Something went wrong.');
                    });
            }
        </script>
    @endsection
</x-guest-layout>
