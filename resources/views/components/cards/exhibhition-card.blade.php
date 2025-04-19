<div class="col-lg-4">
  <div class="exhibhition-one__single wow fadeInUp" data-wow-duration="1500ms">
    <div class="exhibhition-one__image">
      <div class="exhibhition-one__image-inner" style='max-height:210px'>
        <span class="exhibhition-one__image-border-1"></span>
        <span class="exhibhition-one__image-border-2"></span>
        <span class="exhibhition-one__image-border-3"></span>
        <span class="exhibhition-one__image-border-4"></span>
        <img loading="lazy" src="{{$event->getFirstMediaUrl('event_media')}}" alt="{{$event->title}}" />
        <a href="{{ $route }}" class="exhibhition-one__image-link">
          <i class="egypt-icon-arrow-1"></i>
        </a>
      </div>
    </div>
    <div class="exhibhition-one__content">
      <a href="{{ route('gem.events.index', ['event_category' => 'exhibitions']) }}" class="exhibhition-one__category">{{$event->category->name}}</a>
      <h3 class="exhibhition-one__title">
        <a href="{{ $route }}">
          {{$event->title}}
        </a>
      </h3>
      <div class="exhibhition-one__bottom">
        <div class="exhibhition-one__bottom-left">
          <span>{{$event->start_time->format('M d, Y')}} </span>
          <span>
            {{$event->end_time->format('M d, Y')}} <i class="fa fa-angle-double-left"></i>
          </span>
        </div>
        <div class="exhibhition-one__bottom-right">
          <a href="{{ $route }}" class="thm-btn exhibhition-one__btn">Read More</a>
        </div>
      </div>
    </div>
  </div>
</div>