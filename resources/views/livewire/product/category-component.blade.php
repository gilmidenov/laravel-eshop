<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>

                        @foreach($breadcrumbs as $breadcrumbs_slug => $breadcrumbs_title)
                            @if($loop->last)
                                <li><span>{{ $breadcrumbs_title }}</span></li>
                            @else
                                <li><a href="{{ route('category', $breadcrumbs_slug) }}">{{ $breadcrumbs_title }}</a></li>
                            @endif
                        @endforeach


                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container position-relative">

        <div class="update-loading" wire:loading wire:target.except="addToCart">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="sidebar">

                    <button class="btn btn-warning w-100 text-start collapse-filters-btn mb-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseFilters" aria-expanded="false"
                            aria-controls="collapseExample">
                        <i class="fa-solid fa-filter"></i> Filters
                    </button>

                    <div class="collapse collapse-filters" id="collapseFilters">
                        <div class="filter-block">
                            <h5 class="section-title"><span>Filter by color</span></h5>
                            <form action="">
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="black">
                                        <label class="form-check-label" for="black">
                                            Black
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="white">
                                        <label class="form-check-label" for="white">
                                            White
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="red">
                                        <label class="form-check-label" for="red">
                                            Red
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="blue">
                                        <label class="form-check-label" for="blue">
                                            Blue
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="filter-block">
                            <h5 class="section-title">
                                <span>Filter by size</span>
                            </h5>

                            <form action="">
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="xs">
                                        <label class="form-check-label" for="xs">
                                            XS
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="s">
                                        <label class="form-check-label" for="s">
                                            S
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="m">
                                        <label class="form-check-label" for="m">
                                            M
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="l">
                                        <label class="form-check-label" for="l">
                                            L
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="xl">
                                        <label class="form-check-label" for="xl">
                                            XL
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="filter-block">
                            <h5 class="section-title">
                                <span>Filter by type</span>
                            </h5>

                            <form action="">
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="man">
                                        <label class="form-check-label" for="man">
                                            Man
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="woman">
                                        <label class="form-check-label" for="woman">
                                            Woman
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value="" id="baby">
                                        <label class="form-check-label" for="baby">
                                            Baby
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-lg-9 col-md-8" id="products">
                <div class="row mb-3">
                    <div class="col-12">
                        <h1 class="section-title h3"><span>{{ $category->title }}</span></h1>
                    </div>
                    <div class="col-4 col-sm-2">
                        <img src="assets/img/products/8.jpg" alt="" class="img-thumbnail">
                    </div>
                </div>

                @if(count($products))
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Sort By:</span>
                                <select class="form-select" aria-label="Sort by:" wire:change="changeSort" wire:model="sort">
                                    @foreach($sortList as $key => $item)
                                        <option value="{{ $key }}"
                                                @if($key == $sort) selected @endif
                                                wire:key="{{ $key }}">{{ $item['title'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Show:</span>
                                <select class="form-select" aria-label="Show:" wire:change="changeLimit" wire:model="limit">
                                    @foreach($limitList as $key => $item)
                                        <option value="{{ $item }}"
                                                @if($key == $limit) selected @endif
                                                wire:key="{{ $key }}">{{$item}}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-sm-6 mb-3" wire:key="{{ $product->id }}">
                                @include('incs.product-card')
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{ $products->links(data: ['scrollTo' => '#products']) }}
                        </div>
                    </div>

                @else
                    <p>No products found...</p>
                @endif

            </div>
        </div>
    </div>
</div>
