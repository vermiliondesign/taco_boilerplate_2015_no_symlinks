<?php
if(ENVIRONMENT !== ENVIRONMENT_PROD) {
  if(!defined('SHOW_BREAKPOINT_LABEL') || SHOW_BREAKPOINT_LABEL) {
    echo '<div id="breakpoint-label">';
    $breakpoints = array(
      'tiny',
      'small',
      'medium',
      'average',
      'large',
      'xlarge',
    );
    foreach($breakpoints as $breakpoint) {
      echo '<div class="show-for-'.$breakpoint.'-only">'.$breakpoint.'</div>';
    }
    echo '</div>';
  }
}
?>