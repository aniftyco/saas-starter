<?php

use NiftyCo\Skeletor\Skeletor;

return fn (Skeletor $skeletor) => function () use ($skeletor): void {
    $skeletor->intro('## Saas Starter');
};
