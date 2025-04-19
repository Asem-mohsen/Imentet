@if ($collections->hasMorePages())
  <div class="text-center mt-4">
    <button id="loadMoreBtn" class="exhibhition-one__more-link" data-next-page="{{ $collections->nextPageUrl() }}">
      <i class="exhibhition-one__more-link__icon">+</i>
    </button>
  </div>
@endif