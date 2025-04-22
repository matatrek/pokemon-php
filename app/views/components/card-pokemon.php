
<?php
$colors = colors();
            
foreach ($pokemons as $pokemon) {
    $pokemon = (object)$pokemon;
    $types   = json_decode($pokemon->type);
    $image   = $pokemon->has_gif ? $pokemon->sprite_animated : $pokemon->sprite_normal;
?>
<div class="card-pokemon">
    <div class="card-pokemon-top" style="background: <?php printer(background($colors[$types[0]]));?> ;">
        <span class="card-pokemon-number"><small>#<?php printer($pokemon->national_number); ?></small></span>
        <span class="card-pokemon-hp"><small>HP <?php printer($pokemon->hp); ?></small></span>
            <img class="card-pokemon-image" src="<?php printer($image); ?>" alt="<?php printer($pokemon->name); ?>">
    </div>
    <div class="card-pokemon-body">
        <p class="card-pokemon-name"><?php printer($pokemon->name); ?></p>
        <div class="card-pokemon-type">
        <?php
            foreach ($types as $type) {
        ?>
            <span style="background: <?php printer($colors[$type]);?>;"><?php printer($type); ?></span>
        <?php
            }
        ?>
        </div>
        <div class="card-pokemon-statistics">
            <p class="card-pokemon-attribute">
                <span><?php printer($pokemon->attack); ?></span>
                <span>attack</span>
            </p>
            <p class="card-pokemon-attribute">
                <span><?php printer($pokemon->defense); ?></span>
                <span>defense</span>
            </p>
            <p class="card-pokemon-attribute">
                <span><?php printer($pokemon->speed); ?></span>
                <span>speed</span>
            </p>
        </div>
    </div>

</div>
<?php
}
?>