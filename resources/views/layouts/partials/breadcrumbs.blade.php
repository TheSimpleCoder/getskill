@if (count($breadcrumbs))
    <section class="breadcrumbs">
        <div class="container">
            <h2 class="visually-hidden">{{ __('breadcrumbs.title') }}</h2>
            <ul class="breadcrumbs__list">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url && !$loop->last)
                        <li class="breadcrumbs__item">
                            <a href="{{ $breadcrumb->url }}"> {{ $breadcrumb->title }} </a>
                        </li>
                    @else
                        <li>{{ $breadcrumb->title }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </section>
@endif