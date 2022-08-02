@props([
    'route' => '#',
    'id' => '',
    'product' => 'No Product',
])

<div class="col">
    <a href="{{ route($route, $id) }}" class="block block-rounded invisible" data-toggle="appear" data-offset="-200">
        <div class="block-content block-content-full">
            <div class="py-5 text-center">
                <div class="item item-2x item-rounded bg-danger-light text-danger mx-auto">
                    <i class="{{ $icon ?? 'si fa-2x si-lock' }}"></i>
                </div>
                <div class="fs-4 fw-semibold pt-3 mb-0">{{ $product }}</div>
            </div>
        </div>
    </a>
</div>
