<form action="{{ $route }}" method="get">
    <div class="inner-container">
        <div>
            <select class="selectpicker" id='SelectSort' name="Sort">
                <option value="default" {{ request('Sort') == 'default' ? 'selected' : '' }}>Default Sorting</option>
                <option value="1" {{ request('Sort') == '1' ? 'selected' : '' }}>Top Selling</option>
                <option value="DESC" {{ request('Sort') == 'DESC' ? 'selected' : '' }}>Highest Price</option>
                <option value="ASC" {{ request('Sort') == 'ASC' ? 'selected' : '' }}>Lowest Price</option>
            </select>
            <button class="thm-btn topbar-one__btn" style="background-color: #d99578; color:white; height: 50px;" name="Search" > Search</button>
        </div>
        <p class="product-sorting__text">
            Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} results
        </p>
    </div>
</form>