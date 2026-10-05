function toggleField(triggerSelector, valuesEnable, targetSelector) {
    const trigger = $(triggerSelector);
    const target = $(targetSelector);
    if (trigger.length == 0 || target.length == 0) return;

    const currentValue = trigger.val();
    const enable = Array.isArray(valuesEnable)
        ? valuesEnable.includes(currentValue)
        : currentValue == valuesEnable;

    if (enable) {
        target.prop('disabled', false);
    } else {
        target.val('');
        target.prop('disabled', true);
    }
}

$('#origem').on('change', function() {
    toggleField('#origem', ['REDES_SOCIAIS'], '#redesSociaisComp');
    toggleField('#origem', ['OUTRO'], '#outroComp');
});
