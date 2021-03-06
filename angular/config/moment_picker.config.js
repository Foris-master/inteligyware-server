export function MomentPickerConfig(momentPickerProvider,moment){
    'ngInject';

    //
    momentPickerProvider.options({
        /* Picker properties */
        // locale:        'en',
        format:        'L LTS',
        minView:       'decade',
        maxView:       'minute',
        startView:     'year',
        autoclose:     true,
        today:         false,
        keyboard:      false,

        /* Extra: Views properties */
        leftArrow:     '&larr;',
        rightArrow:    '&rarr;',
        yearsFormat:   'YYYY',
        monthsFormat:  'MMM',
        daysFormat:    'D',
        hoursFormat:   'HH:[00]',
        minutesFormat: moment.localeData().longDateFormat('LT').replace(/[aA]/, ''),
        secondsFormat: 'ss',
        minutesStep:   2,
        secondsStep:   1
    });
}
