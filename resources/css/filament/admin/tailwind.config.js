import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './app/Forms/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './resources/views/forms/**/*.blade.php',
        './resources/views/richie/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/filament-curator/resources/**/*.blade.php',
        './vendor/awcodes/richie/resources/views/**/*.blade.php',
        './vendor/awcodes/palette/resources/views/**/*.blade.php',
    ],
}
