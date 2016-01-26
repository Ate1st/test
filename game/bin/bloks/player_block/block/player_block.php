<div class="col-md-8">
    Аватар: <?php echo player_block_class::getValues('avatar')?><br>
    Имя: <?php echo player_block_class::getValues('name')?><br>
    Уровень: <?php echo player_block_class::getValues('level')?><br>
    Энергия: <?php echo player_block_class::getValues('stamina')?><br>
    Здоровье: <?php echo player_block_class::getValues('health')?><br>
    Мастерство: <?php echo player_block_class::getValues('mastery')?><br>
    Мана: <?php echo player_block_class::getValues('mana')?><br>
    
    <div class="form-group">
    <form method="post" action="/battle/pve">
        <input type="hidden" name="battlelevel" value="<?php echo player_block_class::getValues('level')?>">
        <input type="hidden" name="partystatus" value="1">
        <input type="hidden" name="battletype" value="1">
        <input class="form-control btn-info" type="submit" value="PVE">
    </form>
    </div>
</div>

