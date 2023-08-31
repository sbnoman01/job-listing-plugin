<?php 

    // get category term
    $cat_tax_args = [
        'taxonomy' => 'job-category',
        'hide_empty' => false
    ];
    $get_cats_tax = get_terms($cat_tax_args);
    
    // get job-type terms
     $jobtype_tax_args = [
        'taxonomy' => 'job-type',
        'hide_empty' => false
    ];
    $get_jobtype_tax = get_terms($jobtype_tax_args);

    // get job-type terms
    $location_tax_args = [
        'taxonomy' => 'job-location',
        'hide_empty' => false
    ];
    $get_location_tax = get_terms($location_tax_args);

    // get job-type terms
    $specific_tax_args = [
        'taxonomy' => 'job-specific',
        'hide_empty' => false
    ];
    $get_specific_tax = get_terms($specific_tax_args);

    // get job-type terms
    $season_tax_args = [
        'taxonomy' => 'job-season',
        'hide_empty' => false
    ];
    $get_season_tax = get_terms($season_tax_args);
    
    ?>

    <div class="category__widget mb-4">
        <input type="text" placeholder="Search" class="post_search_input" name='search' value="<?php echo esc_html( $_REQUEST['search'] ) ?>">
    </div>
    <div class="category__widget mb-4">
        <h5 class="widget__title">Categories: </h5>
<!--         <div class="single__cate">
            <input type="checkbox" id="all_cat" name="single__cate[]" class="filter_class" value="">
            <label for="all_cat">All</label>
        </div> -->
        <?php foreach( $get_cats_tax as $key => $cat ): if($cat->term_id == 1){continue;}?>
            <div class="single__cate">
                <input type="checkbox" id="<?php echo esc_attr( $cat->slug )?>" name="single__cate[]" class="filter_class term-id-<?php echo esc_attr( $cat->term_id )?>" value="<?php echo esc_attr( $cat->slug )?>">
                <label for="<?php echo esc_attr( $cat->slug )?>"><?php echo esc_html( $cat->name )?> (<?php print $cat->count ?>)</label>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="category__widget mb-4">
        <h5 class="widget__title">Job Type: </h5>
<!--         <div class="single__type">
            <input type="checkbox" id="all_type" name="single__type[]" class="filter_class" value="">
            <label for="all_type">All</label>
        </div> -->
        <?php foreach( $get_jobtype_tax as $key => $item ): //if($item->term_id == 1){continue;}?>
            <div class="single__type">
                <input type="checkbox" id="<?php echo esc_attr( $item->slug )?>" name="single__type[]" class="filter_class term-id-<?php echo esc_attr( $item->term_id )?>" value="<?php echo esc_attr( $item->slug )?>">
                <label for="<?php echo esc_attr( $item->slug )?>"><?php echo esc_html( $item->name )?> (<?php print $item->count ?>)</label>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="category__widget mb-4">
        <h5 class="widget__title">Location: </h5>
<!--         <div class="single__loc">
            <input type="radio" id="all_loc" name="single__loc[]" class="filter_class" value="">
            <label for="all_loc">All</label>
        </div> -->
        <?php foreach( $get_location_tax as $key => $item ): if($item->term_id == 1){continue;}?>
            <div class="single__loc">
                <input type="checkbox" id="<?php echo esc_attr( $item->slug )?>" name="single__loc[]" class="filter_class term-id-<?php echo esc_attr( $item->term_id )?>" value="<?php echo esc_attr( $item->slug )?>">
                <label for="<?php echo esc_attr( $item->slug )?>"><?php echo esc_html( $item->name )?> (<?php print $item->count ?>)</label>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="category__widget mb-4">
        <h5 class="widget__title">Specific: </h5>
<!--         <div class="single__spec">
            <input type="radio" id="all_spec" name="single__spec[]" class="filter_class" value="">
            <label for="all_spec">All</label>
        </div> -->
        <?php foreach( $get_specific_tax as $key => $item ): if($item->term_id == 1){continue;}?>
            <div class="single__spec">
                <input type="checkbox" id="<?php echo esc_attr( $item->slug )?>" name="single__spec[]" class="filter_class term-id-<?php echo esc_attr( $item->term_id )?>" value="<?php echo esc_attr( $item->slug )?>">
                <label for="<?php echo esc_attr( $item->slug )?>"><?php echo esc_html( $item->name )?> (<?php print $item->count ?>)</label>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="category__widget mb-4">
        <h5 class="widget__title">Season: </h5>
<!--         <div class="single__seas">
            <input type="radio" id="all_cat" name="single__seas[]" class="filter_class" value="">
            <label for="all_cat">All</label>
        </div> -->
        <?php foreach( $get_season_tax as $key => $item ): if($item->term_id == 1){continue;}?>
            <div class="single__seas">
                <input type="checkbox" id="<?php echo esc_attr( $item->slug )?>" name="single__seas[]" class="filter_class term-id-<?php echo esc_attr( $item->term_id )?>" value="<?php echo esc_attr( $item->slug )?>">
                <label for="<?php echo esc_attr( $item->slug )?>"><?php echo esc_html( $item->name )?> (<?php print $item->count ?>)</label>
            </div>
        <?php endforeach; ?>
    </div>

