<section class="collection-six">
  <div class="container">
    <div class="row" id="collectionContainer">
      @foreach ($collections as $collection)
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="collection-six__single">
            <img loading="lazy" src="{{ $collection->getFirstMediaUrl('collection_media') }}" alt="{{ $collection->name }}" />
            <div class="collection-six__content">
              <p class="collection-six__cat">{{ $collection->category->name }}</p>
              <h3 class="collection-six__title">
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
  