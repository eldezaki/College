<?php
// Helper sanitasi output untuk mencegah XSS
function e($value)
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}