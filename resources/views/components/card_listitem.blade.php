<li class="item">
    <div class="product-img">
        <img src="{{ $photo }}" alt="img" class="img-size-50">
    </div>
    <div class="product-info">
        <a href="{{ $link }}" class="product-title">{{ $title }}
        <span class="badge badge-warning float-right">{{ $value }}</span></a>
        <span class="product-description">
            {{ $desc }}
        </span>
    </div>
</li>