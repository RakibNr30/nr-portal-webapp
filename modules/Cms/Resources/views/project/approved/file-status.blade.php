@php
    $led = 'led-red';
    $counter = count($data->getMedia('project_attachment_company_1')) + count($data->getMedia('project_attachment_company_2')) + count($data->getMedia('project_attachment_company_3'));
    if ($counter == 0) $led = 'led-red';
    if ($counter == 1 || $counter == 2) $led = 'led-yellow';
    if ($counter == 3) $led = 'led-green';
@endphp

<div class="{{ $led }}" style="position: relative; margin: auto"></div>