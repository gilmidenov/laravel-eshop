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
                    <div class="collapse collapse-filters" id="collapseFilters">

                        @foreach($filter_groups as $key => $filter_group)
                            <div class="filter-block" wire:key="{{ $key }}">
                                <h5 class="section-title"><span>Filter by {{ $filter_group[0]->title }}</span></h5>

                                @foreach($filter_group as $filter)
                                    <div class="form-check d-flex justify-content-between" wire:key="{{ $filter->filter_id }}">
                                        <div>
                                            <input wire:model.live="selected_filters"
                                                   class="form-check-input"
                                                   type="checkbox"
                                                   value="{{ $filter->filter_id }}"
                                                   id="filter-{{ $filter->filter_id }}">
                                            <label class="form-check-label" for="filter-{{ $filter->filter_id }}">
                                                {{ $filter->filter_title }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endforeach

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
