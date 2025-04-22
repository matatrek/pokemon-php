


<!-- <h4>Tipo</h4> -->
<?php 
    $colors = colors();
    foreach ($types as $type) { 
?>
    <li class="list-group-item">
        <div class="filter-body">
            <input id="<?php printer($type); ?>" type="checkbox" aria-label="<?php printer($type); ?>" style="accent-color: <?php printer($colors[$type]);?>;" name="filter-type[]" value="<?php printer($type); ?>">
            <div class="filter-color-tag" style="background: <?php printer($colors[$type]);?>;"></div>
            <label class="filter-label" for="<?php printer($type); ?>"><?php printer($type); ?></label>
        </div>
    </li>
<?php } ?>