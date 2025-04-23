
<div class="panel-body" style="display: flex; width: 100%; height: 100%;">
    <div class="col-md-3 height: 100%; overflow: auto">
        <h3>Filters: </h3>
        <h4>Type</h4>
        <ul id="filter-type" class="list-group" style="height: 200px; overflow-y: scroll;"></ul>
        <?php 
            require_once __DIR__ .'/components/filter-search.php'; 
            require_once __DIR__ .'/components/filter-attack.php'; 
            require_once __DIR__ .'/components/filter-defense.php';
            require_once __DIR__ .'/components/filter-speed.php';
        ?>
    </div>
    <div id="list-pokemon" class="col-md-9 card list-pokemon" style="width: 100%; height: 100%; overflow-y: scroll;" ></div>
</div>
