<?php

function ga_tracking_code()
{ ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TVGNJYP2MN"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-TVGNJYP2MN');
    </script>
<?php
}
add_action('wp_head', 'ga_tracking_code');
