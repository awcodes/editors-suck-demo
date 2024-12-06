import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './app/Forms/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './resources/views/forms/**/*.blade.php',
        './resources/views/typist/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/typist/resources/views/**/*.blade.php',
        './vendor/awcodes/preset-color-picker/resources/views/**/*.blade.php',
    ],
}
