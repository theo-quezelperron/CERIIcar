<?php
echo '
<ul> <?php foreach( $context->trajet as $data ): ?>
  <li><?php echo $data ?></li> <?php end foreach; ?>
  </ul>';

?>