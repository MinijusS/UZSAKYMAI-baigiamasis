<?php
/**
 * F-cija, kuri sugeneruoja formos atributus is masyvo
 * @param array $atrr siunciame atributu masyva
 * @return string gauname visus atributus sujungtus i viena teksta
 */
if (!function_exists('html_attr')) {
    function html_attr(array $atrr): string
    {
        $text = '';

        foreach ($atrr as $index => $item) {
            $text .= "{$index}=\"{$item}\" ";
        }

        return $text;
    }
}

/**
 * F-cija, kuri sugeneruoja inputa
 * @param array $field siunciame viena is fieldu
 * @param string $field_id siunciame jo indexo id, kuris yra toks pat kaip vardas
 * @return string graziname kita funkcija
 */
if (!function_exists('input_attr')) {

    function input_attr(array $field, string $field_id)
    {
        return html_attr(
            ($field['extras']['attr'] ?? []) +
            [
                'name' => $field_id,
                'type' => $field['type'],
                'placeholder' => $field['placeholder'] ?? '',
                'value' => $field['value'] ?? '',
                'step' => $field['step'] ?? ''
            ]);
    }
}

/**
 * F-cija, kuri sugeneruoja inputa
 * @param array $field siunciame viena is fieldu
 * @param string $field_id siunciame jo indexo id, kuris yra toks pat kaip vardas
 * @return string graziname kita funkcija
 */
if (!function_exists('color_attr')) {

    function color_attr(array $field, string $field_id)
    {
        return html_attr(
            ($field['extras']['attr'] ?? []) +
            [
                'name' => $field_id,
                'type' => $field['type'],
                'value' => $field['value'] ?? '',
            ]);
    }
}

/**
 * F-cija, kuri sugeneruoja radio inputa
 * @param array $field siunciame viena is fieldu
 * @param string $field_id siunciame jo indexo id, kuris yra toks pat kaip vardas
 * @return string graziname kita funkcija
 */
if (!function_exists('radio_attr')) {

    function radio_attr(array $field, $option_id, $field_id)
    {
        $attr = [
            'value' => $option_id ?? ''
        ];
        if (($field['value'] ?? null) == $option_id) {
            $attr['checked'] = true;
        }

        return html_attr(
            ($field['extras']['attr'] ?? []) +
            [
                'name' => $field_id,
                'type' => $field['type'],
            ] + $attr);
    }
}

/**
 * F-cija, kuri sugeneruoja textarea
 * @param array $field siunciame viena is fieldu
 * @param string $field_id siunciame jo indexo id, kuris yra toks pat kaip vardas
 * @return string graziname kita funkcija
 */
if (!function_exists('textarea_attr')) {

    function textarea_attr(array $field, string $field_id)
    {
        return html_attr(
            ($field['extras']['attr'] ?? []) +
            [
                'name' => $field_id,
                'placeholder' => $field['placeholder']
            ]);
    }
}

/**
 * F-cija, kuri sugeneruoja textarea
 * @param array $field siunciame viena is fieldu
 * @param string $field_id siunciame jo indexo id, kuris yra toks pat kaip vardas
 * @return string graziname kita funkcija
 */
if (!function_exists('select_attr')) {

    function select_attr(array $field, string $field_id)
    {
        if (isset($field['multiple'])) {
            return html_attr(
                ($field['extras']['attr'] ?? []) + [
                    'name' => $field_id . '[]',
                    'value' => $field['value'] ?? '',
                    $field['multiple'] ? 'multiple' : '' => ''
                ]);
        } else {
            return html_attr(
                ($field['extras']['attr'] ?? []) + [
                    'name' => $field_id,
                    'value' => $field['value'] ?? ''
                ]);
        }
    }
}

/**
 * F-cija, kuri sugeneruoja option attributa
 * @param array $field siunciame viena is fieldu
 * @param string $field_id siunciame jo indexo id, kuris yra toks pat kaip vardas
 * @return string graziname kita funkcija
 */
if (!function_exists('option_attr')) {

    function option_attr(array $field, $option_id)
    {
        $attr = [
            'value' => $option_id ?? ''
        ];

        if (isset($field['value']) && $field['value'] == $option_id) {
            $attr['selected'] = true;
        }

        return html_attr($attr);
    }
}

/**
 * F-cija, kuri sugeneruoja mygtuka
 * @param array $field siunciame viena is fieldu
 * @return string graziname kita funkcija
 */
if (!function_exists('button_attr')) {

    function button_attr(array $field, $button_id)
    {
        return html_attr(
            ($field['extras']['attr'] ?? []) +
            [
                'name' => 'action',
                'value' => $button_id
            ]);
    }
}
