<?php $m = messages::get_message()?>
<?php foreach($m as $key => $value) {?>
<div class="col-md-12 alert <?php echo $value?>">
    <?php echo message_mapper::$messages[$key]?>
</div>
<?php }?>