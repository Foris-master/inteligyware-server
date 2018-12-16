export function TranslateConfig($translateProvider){
    'ngInject';

    //
    $translateProvider
        .useStaticFilesLoader({
                files: [
                    {
                        prefix: '/locales/',
                        suffix: '.json'
                    }
                ]
            }
        )
        .registerAvailableLanguageKeys(['en', 'fr'], {
            'en': 'en',
            'en_*': 'en',
            'fr': 'fr',
            'fr_*': 'fr'
        })
        .preferredLanguage('fr')
        .fallbackLanguage('fr')
        .determinePreferredLanguage()
        .useSanitizeValueStrategy('escapeParameters');
}
