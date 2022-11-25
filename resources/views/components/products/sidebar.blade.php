<!-- Start Sidebar -->
<div class="col-12 col-md-4 p-3 sidebar custom-border">
    <form class="form" id="filter-form">
        
        <!-- Start Product Search -->
        <div class="form-group mb-2">
            <input class="form-control input-search custom-border" name="search-input" id="search-input"/>
        </div>
        <!-- End Product Search -->

        <!-- Start Categories -->
        <fieldset>
            <legend class="px-2">Categories</legend>
            <div class="form-group py-2">
                <input type="checkbox" name="categories[]" value="category-1" id="category-1"/>
                <label for="category-1" class="mx-2">Category-1</label>
            </div>
            <div class="form-group py-2">
                <input type="checkbox" name="categories[]" value="category-2" id="category-2"/>
                <label for="category-2" class="mx-2">Category-2</label>
            </div>
            <div class="form-group py-2">
                <input type="checkbox" name="categories[]" value="category-3" id="category-3"/>
                <label for="category-3" class="mx-2">Category-3</label>
            </div>
        </fieldset>
        <!-- End Categories -->

        <!-- Start Brands -->
        <fieldset>
            <legend class="px-2">Brands</legend>
            <div class="form-group py-2">
                <input type="checkbox" name="brands[]" value="brand-1" id="brand-1"/>
                <label for="brand-1" class="mx-2">Brand-1</label>
            </div>
            <div class="form-group py-2">
                <input type="checkbox" name="brands[]" value="brand-2" id="brand-2"/>
                <label for="brand-2" class="mx-2">Brand-2</label>
            </div>
            <div class="form-group py-2">
                <input type="checkbox" name="brands[]" value="brand-3" id="brand-3"/>
                <label for="brand-3" class="mx-2">Brand-3</label>
            </div>
        </fieldset>
        <!-- End Brands -->
    </form>
</div>
<!-- End Sidebar -->