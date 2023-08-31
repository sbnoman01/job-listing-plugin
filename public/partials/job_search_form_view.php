<?php 

    function job_search_form_view(){

        $page_slug = 'job-search-results';
        $id = get_page_by_path($page_slug);

        $cat_tax_args = [
            'taxonomy'   => 'job-category',
            'hide_empty' => false
        ];
        $get_cats_tax = get_terms($cat_tax_args);

        ob_start(); ?>
            <form action="<?php the_permalink( $id ); ?>" method="GET">
                <ul>
                    <li class="">		
                        <label>
                        <select name="job_cat" class="sf-input-select" >
                            <option class="" value="">All Jobs</option>
                            <?php foreach( $get_cats_tax as $key => $cat ): if($cat->term_id == 1){continue;}?>
                                <option class="" value="<?php echo esc_attr( $cat->slug )?>"><?php echo esc_html( $cat->name )?></option>
                            <?php endforeach; ?>
                        </select>
                        </label>
                    </li>
                    <li class="sf-field-search">
                        <label>
                            <input placeholder="Find your perfect job..." name="search" class="search_input">
                        </label>		
                    </li>
                    <li class="sf-field-submit" >
                        <button type="submit">Search Job</button>
                    </li>
                </ul>
                <!-- <input type="text" name="search" placeholder="FInd your perfect job..."> -->
            </form>
        <?php return ob_get_clean();
    }

?>