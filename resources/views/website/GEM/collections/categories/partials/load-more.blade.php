@if ($collections->hasMorePages())
  <div class="text-center mt-4">
    <a href="{{ $collections->nextPageUrl() }}" class="exhibhition-one__more-link">
      <i class="exhibhition-one__more-link__icon">+</i>
      <span class="text-uppercase">Load More</span>
    </a>
  </div>
@endif