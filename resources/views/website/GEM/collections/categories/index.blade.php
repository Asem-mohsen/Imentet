@extends('layout.template.gem-template')

@section('title' , $category->name)

@section('content')

  <section class="inner-banner inner-banner__collection-page">
    <div class="container">
      <h2 class="inner-banner__title">{{$category->name . " Collection" }}</h2>
      <ul class="list-unstyled thm-breadcrumb">
        <li><a href="{{route('gem.home')}}">Home</a></li>
        <li><a href="{{route('gem.collections.index')}}">Collections</a></li>
        <li>{{ $category->name }}</li>
      </ul>
    </div>
  </section>

  <form method="GET">
    <div class="collection-search collection-page">
      <div class="container">
        <div class="inner-container">
          <div class="collection-search__outer">
            <div class="collection-search__field">
              <select class="selectpicker" name="category_id">
                <option value="0">{{ $category->name }}</option>
                @foreach ($categories as $otherCategory)
                  <option value="{{$otherCategory->id}}" @selected($otherCategory->id == request('category_id'))>{{$otherCategory->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <button type="submit" class="thm-btn collection-search__btn">
            Search 
          </button>
        </div>
      </div>
    </div>
  </form>

  @php
    $partialView = 'website.gem.collections.categories.partials.' . Str::slug($category->name);
    $defaultView = 'website.gem.collections.categories.partials.default';
  @endphp

  @if(View::exists($partialView))
    @include($partialView, ['collections' => $collections])
  @else
    @include($defaultView, ['collections' => $collections])
  @endif

@endsection

@section('js')
  <script>
      $(document).ready(function () {
        $('#loadMoreBtn').on('click', function () {
          let nextPageUrl = $(this).data('next-page');

          if (!nextPageUrl) return; 

          $.get(nextPageUrl, function (data) {
            let newCollections = $(data).find('#collectionContainer').html();
            $('#collectionContainer').append(newCollections);

            // Update the "Load More" button
            let nextPage = $(data).find('#loadMoreBtn').data('next-page');
            if (nextPage) {
              $('#loadMoreBtn').data('next-page', nextPage);
            } else {
              $('#loadMoreBtn').remove();
            }
          });
        });
      });
  </script>
@endsection