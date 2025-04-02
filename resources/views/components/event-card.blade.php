<div class="event-two__single">
    <div class="event-two__image">
      <div class="event-two__time">
        {{ $event->category->name }}
      </div>
      <div class="event-two__image-inner">
        <div class="event-two__price">
          <span>{{ $event->prices->min('price_egyptian') }} <a style="color: #d99578;"> EGP /Person</a></span>
        </div>
        <img src="{{ $event->getFirstMediaUrl('event_media') }}" width="170px" height="170px" alt="{{ $event->title }}" />
      </div>
    </div>
    <div class="event-two__content">
      <div class="event-two__content-top">
        <div class="event-two__date">
          <div class="event-two__date-num">{{ $event->start_time->format('d') }}</div>
          <div class="event-two__date-text">
            <span>{{ $event->start_time->format('F') }}</span>
            {{ $event->start_time->format('Y') }}
          </div>
        </div>
      </div>
      <h3 class="event-two__title">
        <a href="{{ route('gem.events.show', $event->id) }}">
          {{ Illuminate\Support\Str::limit($event->title, 40) }}
        </a>
      </h3>
      <p class="event-two__text">
        {{ $event->place->name }}
      </p>
      <a href="{{ route('gem.events.show', $event->id) }}" class="event-two__link">
        <span>
          <i class="fa fa-angle-right"></i> More Details
        </span>
      </a>
    </div>
</div>
  