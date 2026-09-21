<div>
    <li class="pc-item {{ $active ?? '' }}">
        <a href="{{ (!empty($route) && $route != '#') ? route($route) : '#' }}" class="pc-link">
            <span class="pc-micon"><i class="{{ $icon }}"></i></span>
            <span class="pc-mtext">{{ $title }}</span>
        </a>
    </li>
</div>