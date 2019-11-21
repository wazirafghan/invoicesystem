<?php $settings = \App\Setting::pluck('value', 'name')->all();  ?>
<footer class="footer text-center"> {{isset($settings['footer_text'])?$settings['footer_text']:''}} </footer>
