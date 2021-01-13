<?php
$veneer_terms_array = array();
foreach ($veneer_terms as $term)
{
    $starting_letter = $term->post_title[0];
    if (array_key_exists($starting_letter, $veneer_terms_array))
    {
        array_push($veneer_terms_array[$starting_letter], array(
            $term->post_title => $term->post_content
        ));
    }
    else
    {
        $veneer_terms_array[$starting_letter][0] = array(
            $term->post_title => $term->post_content
        );
    }
}
?>
<div class="row hm-section ">
    <?php
        foreach (range('A', 'Z') as $term)
        {
            foreach ($veneer_terms_array as $key => $value)
            {
                if ($key == $term)
                {
        ?>
            <a class="alphabet-check" href='#<?php echo $key; ?>'> <?php echo $key ?></a> 
            <?php
                }
            }
        }
    ?>
</div>
<div class="row hm-section">
    <?php
        foreach (range('A', 'Z') as $key)
            {
            if (array_key_exists($key, $veneer_terms_array) && sizeof($veneer_terms_array[$key]) > 0)
            {
    ?>
    <div class="row" id="<?php echo $key; ?>">
        <p class='alphabet-styling col-4' ><?php echo $key; ?></p>
        <?php
        foreach ($veneer_terms as $term)
        {
            if ($term->post_title[0] == $key)
            {
        ?>  
        <p class="veneer-content col-12">
            <?php echo "<strong>".$term->post_title."</strong>", "<br>", $term->post_content;?>
        </p> 
        <?php
        if (get_post_thumbnail_id($term->ID))
        {
            echo generate_image_by_ID(get_post_thumbnail_id($term->ID), ["glossary-image"]);
        } ?>
            
        <br>
    <?php
    }
}?>       
    <?php
    }
}
?>