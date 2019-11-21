<?php $settings = \App\Setting::pluck('value', 'name')->all(); $footer_text = isset($settings['footer_text'])?$settings['footer_text']:''; ?>
<footer class="footer text-center"> {{$footer_text}} </footer>
