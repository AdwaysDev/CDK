<?php
echo 'document.getElementsByTagName("head")[0].innerHTML = headHTML; 
        ';
require(__DIR__ . '/../PlayerDetector/PlayerDetector-1.0.0.js');
echo '
}(window));';
