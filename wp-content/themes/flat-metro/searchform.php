<?php
/**
 * The template for displaying search forms in flat metro
 *
 */
?>

<form id='search'  class="searchform" action="<?php echo home_url() ?>" role="search" method='get' accept-charset="UTF-8">
	
  <div>
    <div class="container-inline">
      <div class="form-item form-type-textfield form-item-search-block-form">
        <label class="element-invisible" for="edit-search-block-form--2">Search </label>
        <input title="Enter the terms you wish to search for." class="small-8 columns form-text" type="text" id="edit-search-block-form--2" 
          name="s" value="" size="15" maxlength="128" <?php the_search_query()  ?> />
      </div>
      <button class="postfix small-4 columns form-submit" id="edit-submit--2" name="op" value="Search" type="submit">Search</button>
    </div>
  </div>
   
</form>


