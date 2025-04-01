<section class="collection-two collection-two__collection-page">
    <div class="container">
      <div class="row masonary-layout">
        @foreach ($collections as $collection)
          <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="0ms">
            <div class="collection-two__single">
              <div class="collection-two__image">
                  <img src="{{ $collection->getFirstMediaUrl('collection_media') }}" width="300" height="300" alt="{{ $collection->name }}">
                  <div class="collection-two__hover">
                      <a class="img-popup" href="{{ $collection->getFirstMediaUrl('collection_media') }}">
                        <i class="egypt-icon-focus"></i>
                      </a>
                  </div>
              </div>
              <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a href="{{ route('gem.collections.show', $collection->id) }}">
                      {{ $collection->getPlaceNames() }}
                    </a>
                  </p>
                  <h3 class="collection-two__title">
                    <a href="{{ route('gem.collections.show', $collection->id) }}">{{ $collection->name }}</a>
                  </h3>
              </div>
            </div>
          </div>
        @endforeach
      </div>
  
      @include('website.gem.collections.categories.partials.load-more')
    </div>
</section>
  