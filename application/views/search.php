        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8 col-12">
                        <h2 class="breadcrumb-title">Search</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Search</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row align-items-center mb-3">
                    <div class="col-md-8 col-12">
                        <h2 class="sub-heading mb-0"><span id="searchResultsCount"><?=$countResults?></span> matches found.</h2>
                    </div>
                    <div class="col-md-4 col-12 d-md-block d-none">
                        <div class="sort-by">
                            <span class="sort-title">Sort by</span>
                            <span class="sortby-fliter">
                                <select class="form-select" name="sort">
                                    <option value="">Select</option>
                                    <option class="sorting" <?=($get['sort'] == 'ratting' ) ? 'selected' : ''?> value="ratting">Rating</option>
                                    <option class="sorting" <?=($get['sort'] == 'ASC' ) ? 'selected' : ''?> value="ASC">Name a-z</option>
                                    <option class="sorting" <?=($get['sort'] == 'DESC' ) ? 'selected' : ''?> value="DESC">Name z-a</option>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
                        <div class="card search-filter">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Search Filter</h4>
                            </div>
                            <div class="card-body">
                                <form id="searchForm">
                                    <div class="filter-widget">
                                        <h4>City</h4>
                                        <div class="">
                                            <select name="city_id" id="" class="select" required>
                                                <option value="">Select City</option>
                                                <?php foreach ($cities as $key => $c): ?>
                                                    <option value="<?=$c['city_id']?>" <?=($c['city_id'] == $get['city_id']) ? 'selected' : ''?> ><?=$c['name']?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="filter-widget">
                                        <h4>Gender</h4>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="gender" value="male" <?=($get['gender'] == 'male') ? 'checked' : ''?> >
                                                <span class="checkmark"></span> Male Doctor
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="gender" value="female" <?=($get['gender'] == 'female') ? 'checked' : ''?>>
                                                <span class="checkmark"></span> Female Doctor
                                            </label>
                                        </div>
                                    </div>
                                    <div class="filter-widget">
                                        <h4>Select Specialist</h4>
                                        <?php foreach ($services as $key => $service_): ?>
                                            <div>
                                                <label class="custom_check">
                                                    <input type="checkbox" name="service[]" value="<?=$service_['service_id']?>" <?=($service_['service_id'] == $get['service']) ? 'checked' : ''?> >
                                                    <span class="checkmark"></span> <?=$service_['title']?>
                                                </label>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="btn-search">
                                        <button type="submit" id="SearchFormBtn" class="btn w-100">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8 col-xl-9" id="searchParent">
                        <?=$searchResults?>
                    </div>
                </div>
            </div>
        </div>