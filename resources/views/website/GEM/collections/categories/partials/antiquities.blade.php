<section class="collection-four">
  <div class="container-fluid">
    <div class="row high-gutters">
      @foreach ($collections as $collection)
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="collection-four__single">
            <img
              src="{{ $collection->getFirstMediaUrl('collection_media') }}"
              alt="{{ $collection->name }}"
            />
            <div class="collection-four__content">
              <a href="{{ route('gem.collections.show', $collection->id) }}" class="collection-four__link">+</a>
              <p class="collection-four__cat">Ancient Egypt</p>
              <h3 class="collection-four__title">
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